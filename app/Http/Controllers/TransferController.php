<?php

namespace App\Http\Controllers;

use App\Cidades;
use App\Clientes;
use App\Http\Requests\TransferOrcamentoRequest;
use App\Http\Requests\TransfersRequest;
use App\Transfers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class TransferController extends Controller{

    private $transferModel;

    public function __construct(Transfers $transferModel)
    {
        $this->transferModel = $transferModel;
    }

    public function index()
    {
        $transfers = $this->transferModel->all();
        return view('transfers.index', compact('transfers'));
    }

    public function detalhes($id)
    {
        $clientes = Clientes::find($id);
        return view('transfers.detalhes', compact('clientes'));
    }

    public function edit(Cidades $paises, $id, Transfers $transfer)
    {
        $transfer = Transfers::find($id);
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('transfers.edit', compact('transfer','paises'));
    }

    public function updateTransfer(TransferOrcamentoRequest $request, $id)
    {
        $transfer = Transfers::find($id)->update($request->all());
        $idCliente = DB::table('clientes_transfers')->where('transfers_id','=',$id)->pluck('clientes_id');

        return redirect('admin/transfers');
    }

    public function create(Cidades $paises)
    {
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('transfers.create', compact('paises'));
    }

    public function store(TransfersRequest $request)
    {
        $input = $request->all();
        Transfers::create($input);
        return redirect('admin/transfers');
    }

    public function createTransferCliente(Transfers $transfer, $id)
    {
        $clientes = Clientes::find($id);
        $transfer = Transfers::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        return view('transfers.createTransferCliente', compact('clientes','transfer'));
    }

    public function editTransferCliente($id, $idCliente)
    {
        $transfer = Transfers::find($id);
        $clientes = Clientes::find($idCliente);
        return view('transfers.editTransferCliente', compact('transfer','clientes'));
    }

    public function update(TransferOrcamentoRequest $request, $id)
    {
        $transfer = Transfers::find($id)->update($request->all());
        $idCliente = DB::table('clientes_transfers')->where('transfers_id','=',$id)->pluck('clientes_id');

        return redirect('admin/transfers/'.$idCliente.'/detalhes');
    }

    public function editTransferOrcamento($id, $idCliente)
    {
        $transfer = Transfers::find($id);
        $clientes = Clientes::find($idCliente);
        return view('transfers.editTransferOrcamento', compact('transfer','clientes'));
    }

    public function updateOrcamento(TransferOrcamentoRequest $request, $id)
    {
        $transfer = Transfers::find($id)->update($request->all());
        $idCliente = DB::table('clientes_transfers')->where('transfers_id','=',$id)->pluck('clientes_id');

        return redirect('admin/clientes/'.$idCliente.'/orcamento');
    }

    public function storeAttach(TransfersRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $t = $this->transferModel->create($request->all());
        $t->clientes()->attach($clientes_id);
        return redirect()->back();
    }

    public function storeDetach($id)
    {
        $ct = DB::table('clientes_transfers')->where('transfers_id','=',$id)->pluck('id');
        $clt = DB::table('clientes_transfers')->where('id','=',$ct)->delete();
        $transfer = Transfers::find($id)->delete();
        return redirect()->back();
    }

    public function storeAttachOrcamento(TransfersRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $transfers_id = $request->get('transfers_id');
        $transfer = Transfers::find($transfers_id);
        $transfer->clientes()->attach($clientes_id);

        //Método para pré cadastro
        $clientes_id = $request->get('clientes_id');
        $t = $this->transferModel->create($request->all());
        $t->clientes()->attach($clientes_id);

        return redirect()->back();
    }

    public function storeDetachOrcamento($id)
    {
        $ct = DB::table('clientes_transfers')->where('transfers_id','=',$id)->pluck('id');
        $clt = DB::table('clientes_transfers')->where('id','=',$ct)->delete();
        return redirect()->back();
    }

    public function getTransfer($idCidade)
    {
        $transfer =  DB::table('transfers')->where('cidades_id','=',$idCidade)->get();
        return Response::json($transfer);
    }

    public function getTransferOrcamento()
    {
        $transfer =  DB::table('transfers')
                                        ->where('orcamento','=',1)
                                        ->get();
        return Response::json($transfer);
    }

    public function getTransf($id)
    {
        $valor =  DB::table('transfers')->where('id','=',$id)->get();
        return Response::json($valor);
    }

}