<?php
namespace App\Http\Controllers;

use App\Clientes;
use App\Http\Controllers;
use App\Situacoes;
use Illuminate\Http\Request;
use App\Http\Requests\SituacoesRequest;

class SituacaoController extends Controller{

    public function index()
    {
        $situacoes = Situacoes::all();
        return view('situacoes.index', compact('situacoes'));
    }

    public function create()
    {
        return view('situacoes.create');
    }

    public function store(SituacoesRequest $request)
    {
        $input = $request->all();
        Situacoes::create($input);
        return redirect('admin/situacao');
    }

    public function destroy($id)
    {
        $situacao = Situacoes::find($id)->delete();
        return redirect()->route('situacao');
    }

    public function edit($id)
    {
        $situacao = Situacoes::find($id);
        return view('situacoes.edit', compact('situacao'));
    }

    public function update(SituacoesRequest $request, $id)
    {
        $situacao = Situacoes::find($id)->update($request->all());
        return redirect()->route('situacao');
    }
}