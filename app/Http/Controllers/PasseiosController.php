<?php
namespace App\Http\Controllers;

use App\Cidades;
use App\Clientes;
use App\Http\Requests\PasseiosOrcamentoRequest;
use App\Http\Requests\PasseiosRequest;
use App\Passeios;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class PasseiosController extends Controller
{
    private $passeiosModel;

    public function __construct(Passeios $passeiosModel)
    {
        $this->passeiosModel = $passeiosModel;
    }

    public function index()
    {
        $passeios = $this->passeiosModel->all();
        return view('passeios.index', compact('passeios'));
    }

    public function detalhes($id)
    {
        $clientes = Clientes::find($id);
        return view('passeios.detalhes', compact('clientes'));
    }

    public function edit(Cidades $paises, $id, Passeios $passeios)
    {
        $passeios = Passeios::find($id);
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('passeios.edit', compact('passeios','paises'));
    }

    public function updatePasseios(PasseiosOrcamentoRequest $request, $id)
    {
        $passeios = Passeios::find($id)->update($request->all());
        $idCliente = DB::table('clientes_passeios')->where('passeios_id','=',$id)->pluck('clientes_id');

        return redirect('admin/passeios');
    }

    public function create(Cidades $paises)
    {
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('passeios.create', compact('paises'));
    }

    public function store(PasseiosRequest $request)
    {
        $input = $request->all();
        Passeios::create($input);
        return redirect('admin/passeios');
    }

    public function createPasseioCliente(Passeios $passeio, $id)
    {
        $cliente = Clientes::find($id);
        $passeios = Passeios::where('orcamento', '=', 1)->orderBy('nome')->lists('nome', 'id');
        return view('passeios.createPasseioCliente', compact('cliente', 'passeios'));
    }

    public function editPasseiosCliente($id, $idCliente)
    {
        $passeios = Passeios::find($id);
        $clientes = Clientes::find($idCliente);
        return view('passeios.editPasseioCliente', compact('passeios','clientes'));
    }

    public function update(PasseiosOrcamentoRequest $request, $id)
    {
        $passeios = Passeios::find($id)->update($request->all());
        $idCliente = DB::table('clientes_passeios')->where('passeios_id','=',$id)->pluck('clientes_id');

        return redirect('admin/clientes/'.$idCliente.'/detalhes');
    }

    public function editPasseioOrcamento($id, $idCliente)
    {
        $passeios = Passeios::find($id);
        $clientes = Clientes::find($idCliente);
        return view('passeios.editPasseioOrcamento', compact('passeios','clientes'));
    }

    public function updateOrcamento(PasseiosOrcamentoRequest $request, $id)
    {
        $passeios = Passeios::find($id)->update($request->all());
        $idCliente = DB::table('clientes_passeios')->where('passeios_id','=',$id)->pluck('clientes_id');

        return redirect('admin/clientes/'.$idCliente.'/detalhes');
    }

    public function storeAttach(PasseiosRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $t = $this->passeiosModel->create($request->all());
        $t->clientes()->attach($clientes_id);

        return redirect()->back();
    }

    public function storeDetach($id)
    {
        $ct = DB::table('clientes_passeios')->where('passeios_id', '=', $id)->pluck('id');
        $clt = DB::table('clientes_passeios')->where('id', '=', $ct)->delete();
        $passeio = passeios::find($id)->delete();
        return redirect()->back();
    }

    public function storeAttachOrcamento(PasseiosRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $passeios_id = $request->get('passeios_id');
        $passeio = Passeios::find($passeios_id);
        $passeio->clientes()->attach($clientes_id);

        //Método para pré cadastro

        $clientes_id = $request->get('clientes_id');
        $t = $this->passeiosModel->create($request->all());
        $t->clientes()->attach($clientes_id);

        return redirect()->back();
    }

    public function storeDetachOrcamento($id)
    {
        $ct = DB::table('clientes_passeios')->where('passeios_id', '=', $id)->pluck('id');
        $clt = DB::table('clientes_passeios')->where('id', '=', $ct)->delete();
        return redirect()->back();
    }

    public function getPasseios($idCidade)
    {
        $passeios = DB::table('passeios')->where('cidades_id', '=', $idCidade)->get();
        return Response::json($passeios);
    }

    public function getPasseiosOrcamento()
    {
        $passeios = DB::table('passeios')
                                        ->where('orcamento', '=', 1)
                                        ->get();
        return Response::json($passeios);
    }

    public function getPass($id)
    {
        $valor = DB::table('passeios')->where('id', '=', $id)->get();
        return Response::json($valor);
    }
}

