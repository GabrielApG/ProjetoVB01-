<?php
namespace App\Http\Controllers;

use App\Cidades;
use App\Clientes;
use App\Http\Requests\HoteisOrcamentoRequest;
use App\Http\Requests\HoteisRequest;
use App\Hoteis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class HoteisController extends Controller
{

    private $hoteisModel;

    public function __construct(Hoteis $hoteisModel)
    {
        $this->hoteisModel = $hoteisModel;
    }

    public function index()
    {
        $hoteis = $this->hoteisModel->all();
        return view('hoteis.index', compact('hoteis'));
    }

    public function detalhes($id)
    {
        $clientes = Clientes::find($id);
        return view('hoteis.detalhes', compact('clientes'));
    }

    public function edit(Cidades $paises, $id, Hoteis $hoteis)
    {
        $hoteis = Hoteis::find($id);
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('hoteis.edit', compact('hoteis','paises'));
    }

    public function updateHotel(HoteisOrcamentoRequest $request, $id)
    {
        $hoteis = Hoteis::find($id)->update($request->all());
        $idCliente = DB::table('clientes_hoteis')->where('hoteis_id','=',$id)->pluck('clientes_id');

        return redirect('admin/hoteis');
    }

    public function create(Cidades $paises)
    {
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('hoteis.create', compact('paises'));
    }

    public function store(HoteisOrcamentoRequest $request)
    {
        $input = $request->all();
        Hoteis::create($input);
        return redirect('admin/hoteis');
    }

    public function createHotelCliente(Hoteis $hotel, $id)
    {
        $cliente = Clientes::find($id);
        $hotel = Hoteis::where('orcamento', '=', 1)->orderBy('nome')->lists('nome', 'id');
        return view('hoteis.createHotelCliente', compact('cliente', 'hotel'));
    }

    public function editHotelCliente($id, $idCliente)
    {
        $hotel = Hoteis::find($id);
        $cliente = Clientes::find($idCliente);
        return view('hoteis.editHotelCliente', compact('hotel','cliente'));
    }

    public function update(HoteisOrcamentoRequest $request, $id)
    {
        $hotel = Hoteis::find($id)->update($request->all());
        $idCliente = DB::table('clientes_hoteis')->where('hoteis_id','=',$id)->pluck('clientes_id');

        return redirect('admin/clientes/'.$idCliente.'/detalhes');
    }

    public function editHotelOrcamento($id, $idCliente)
    {
        $hotel = Hoteis::find($id);
        $clientes = Clientes::find($idCliente);
        return view('hoteis.editHotelOrcamento', compact('hotel','clientes'));
    }

    public function updateOrcamento(HoteisOrcamentoRequest $request, $id)
    {
        $hotel = Hoteis::find($id)->update($request->all());
        $idCliente = DB::table('clientes_hoteis')->where('hoteis_id','=',$id)->pluck('clientes_id');

        return redirect('admin/clientes/'.$idCliente.'/detalhes');

    }

    public function storeAttach(HoteisOrcamentoRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $t = $this->hoteisModel->create($request->all());
        $t->clientes()->attach($clientes_id);

        return redirect()->back();
    }

    public function storeDetach($id)
    {
        $ct = DB::table('clientes_hoteis')->where('hoteis_id', '=', $id)->pluck('id');
        $clt = DB::table('clientes_hoteis')->where('id', '=', $ct)->delete();
        $hotel = Hoteis::find($id)->delete();
        return redirect()->back();
    }

    public function storeAttachOrcamento(HoteisOrcamentoRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $h = $this->hoteisModel->create($request->all());
        $h->clientes()->attach($clientes_id);

        //Método para pré Cadastro no Banco

        $id = $request->get('hoteis_id');
        $nome = $request->get('nome');
        $c_id = $request->get('clientes_id');
        $cidades_id = $request->get('cidades_id');
        $qtd_adultos = $request->get('qtd_adultos');
        $qtd_criancas = $request->get('qtd_criancas');
        $diarias =  $request->get('diarias');
        $valor = $request->get('valor');
        $orcamento = 0;

        $NovoHotel = $this->hoteisModel->
        create(['id' => $id,'nome'=>$nome,'clientes_id'=>$c_id,'cidades_id'=>$cidades_id,
            '$qtd_adultos'=>$qtd_adultos,'qtd_criancas'=>$qtd_criancas,'diarias'=>$diarias,
            'valor'=>$valor,'orcamento'=>0]);

        $NovoHotel->clientes()->attach($clientes_id);

        return redirect()->back();
    }

    public function storeDetachOrcamento($id)
    {
        $ct = DB::table('clientes_hoteis')->where('hoteis_id', '=', $id)->pluck('id');
        $clt = DB::table('clientes_hoteis')->where('id', '=', $ct)->delete();
        return redirect()->back();
    }

    public function getHoteis($idCidade)
    {
        $hoteis = DB::table('hoteis')->where('cidades_id', '=', $idCidade)->get();
        return Response::json($hoteis);
    }

    public function getHoteisOrcamento()
    {
        $hoteis = DB::table('hoteis')
                                    ->where('orcamento', '=', 1)
                                    ->get();
        return Response::json($hoteis);
    }

    public function getHot($id)
    {
        $valor = DB::table('hoteis')->where('id', '=', $id)->get();
        return Response::json($valor);
    }

}