<?php

namespace App\Http\Controllers;

use App\Cidades;
use App\Clientes;
use App\Http\Requests\TrensOrcamentoRequest;
use App\Http\Requests\TrensRequest;
use App\Trens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class TrensController extends Controller{

    private $trensModel;

    public function __construct(Trens $trensModel)
    {
        $this->trensModel = $trensModel;
    }

    public function index()
    {
        $trens = $this->trensModel->all();
        return view('trens.index', compact('trens'));
    }

    public function detalhes($id)
    {
        $clientes = Clientes::find($id);
        return view('trens.detalhes', compact('clientes'));
    }

    public function edit(Cidades $paises, $id, Trens $trens)
    {
        $trens = Trens::find($id);
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('trens.edit', compact('trens','paises'));
    }

    public function updateTrem(TrensOrcamentoRequest $request, $id)
    {
        $trens = Trens::find($id)->update($request->all());
        $idCliente = DB::table('clientes_trens')->where('trens_id','=',$id)->pluck('clientes_id');

        return redirect('admin/trens');
    }

    public function create(Cidades $paises)
    {
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('trens.create', compact('paises'));
    }

    public function store(TrensRequest $request)
    {
        $input = $request->all();
        Trens::create($input);
        return redirect('admin/trens');
    }

    public function createTremCliente(Trens $trem, $id)
    {
        $cliente = Clientes::find($id);
        $trem = Trens::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        return view('trens.createTremCliente', compact('cliente','trem'));
    }

    public function editTremCliente($id, $idCliente)
    {
        $trens = Trens::find($id);
        $clientes = Clientes::find($idCliente);
        return view('trens.editTremCliente', compact('trens','clientes'));
    }

    public function update(TrensOrcamentoRequest $request, $id)
    {
        $trens = Trens::find($id)->update($request->all());
        $idCliente = DB::table('clientes_trens')->where('trens_id','=',$id)->pluck('clientes_id');

        return redirect('admin/trens/'.$idCliente.'/detalhes');
    }

    public function editTremOrcamento($id, $idCliente)
    {
        $trens = Trens::find($id);
        $clientes = Clientes::find($idCliente);
        return view('trens.editTremOrcamento', compact('trens','clientes'));
    }

    public function updateOrcamento(TrensOrcamentoRequest $request, $id)
    {
        $trens = Trens::find($id)->update($request->all());
        $idCliente = DB::table('clientes_trens')->where('trens_id','=',$id)->pluck('clientes_id');

        return redirect('admin/clientes/'.$idCliente.'/orcamento');
    }

    public function storeAttach(TrensRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $t = $this->trensModel->create($request->all());
        $t->clientes()->attach($clientes_id);
        return redirect()->back();
    }

    public function storeDetach($id)
    {
        $ct = DB::table('clientes_trens')->where('trens_id','=',$id)->pluck('id');
        $clt = DB::table('clientes_trens')->where('id','=',$ct)->delete();
        $trem = Trens::find($id)->delete();
        return redirect()->back();
    }

    public function storeAttachOrcamento(TrensRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $trens_id = $request->get('trens_id');
        $trem = Trens::find($trens_id);
        $trem->clientes()->attach($clientes_id);

        //Método igual StoreAttach para pré Cadastro no Banco

        $clientes_id = $request->get('clientes_id');
        $t = $this->trensModel->create($request->all());
        $t->clientes()->attach($clientes_id);

        return redirect()->back();
    }

    public function storeDetachOrcamento($id)
    {
        $ct = DB::table('clientes_trens')->where('trens_id','=',$id)->pluck('id');
        $clt = DB::table('clientes_trens')->where('id','=',$ct)->delete();

        return redirect()->back();
    }

    public function getTrens($idCidade)
    {
        $trens =  DB::table('trens')->where('cidades_id','=',$idCidade)->get();
        return Response::json($trens);
    }

    public function getTrensOrcamento()
    {
        $trens =  DB::table('trens')
                                    ->where('orcamento','=',1)
                                    ->get();
        return Response::json($trens);
    }

    public function getValor($id)
    {
        $valor =  DB::table('trens')->where('id','=',$id)->get();
        return Response::json($valor);
    }

}