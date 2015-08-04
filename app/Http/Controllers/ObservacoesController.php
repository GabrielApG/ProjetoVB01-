<?php namespace App\Http\Controllers;

use App\Clientes;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Observacoes;
use Illuminate\Http\Request;
use App\Http\Requests\ObservacoesRequest;

class ObservacoesController extends Controller {

	public function index()
	{
        $obs = Observacoes::all();
        return view('observacoes.index', compact('obs'));
	}

    public function detalhes($id)
    {
        $obs = Observacoes::all();
        $clientes = Clientes::find($id);
        return view('observacoes.index', compact('obs','clientes'));
    }

	public function create()
	{

	}

    public function store(ObservacoesRequest $request)
    {
        $input = $request->all();
        $id = $request->get('clientes_id');
        Observacoes::create($input);

        return redirect('admin/observacao/'.$id.'/detalhes');
    }

	public function show($id)
	{

	}


	public function edit($id)
	{
        $obs = Observacoes::find($id);
        return view('observacoes.edit', compact('obs'));
	}


    public function update(ObservacoesRequest $request,$id)
    {
        $obs = Observacoes::find($id)->update($request->all());
        $idCliente = $request->get('clientes_id');

        return redirect('admin/observacao/'.$idCliente.'/detalhes');

    }

    public function destroy($id)
    {
        $obs = Observacoes::find($id)->delete();
        return redirect()->back();
    }

}
