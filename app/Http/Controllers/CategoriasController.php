<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Categorias;
use App\Http\Requests\CategoriasRequest;
use App\Clientes;

class CategoriasController extends Controller {

    public function index()
    {
        $categorias = Categorias::all();
        return view('categoria.index', compact('categorias'));
    }

    public function create()
    {
        return view('categoria.create');
    }

    public function store(CategoriasRequest $request)
    {
        $input = $request->all();
        Categorias::create($input);
        return redirect('admin/categorias');// mudando para a nova configuração de rota
    }

    public function destroy($id)
    {
        $categorias = Categorias::find($id)->delete();
        return redirect('admin/categorias');
    }

    public function edit($id)
    {
        $categorias = Categorias::find($id);
        return view('categoria.edit', compact('categorias'));
    }

    public function update(CategoriasRequest $request, $id)
    {
        $categorias = Categorias::find($id)->update($request->all());
        return redirect()->route('categorias');
    }

}
