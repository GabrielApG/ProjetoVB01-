<?php
namespace App\Http\Controllers;

use App\Cidades;
use App\Clientes;
use App\Dependentes;
use App\Http\Requests\DependentesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class DependentesController extends Controller
{

    private $dependentesModel;

    public function __construct(Dependentes $dependentesModel)
    {
        $this->dependentesModel = $dependentesModel;
    }

    public function index()
    {
        $dependentes = $this->dependentesModel->all();
        return view('dependentes.index', compact('dependentes'));
    }

    public function detalhes($id)
    {
        $clientes = Clientes::find($id);
        return view('dependentes.detalhes', compact('clientes'));
    }

    public function edit($id)
    {
        $dependentes = Dependentes::find($id);
        $clientes = DB::table('dependentes')->where('id','=',$id)->pluck('clientes_id');
        return view('dependentes.edit', compact('dependentes','clientes'));
    }

    public function update(DependentesRequest $request, $id)
    {
        $dependentes = Dependentes::find($id)->update($request->all());
        $id_cliente = DB::table('dependentes')->where('id','=',$id)->pluck('clientes_id');
        return redirect('admin/dependentes/'.$id_cliente.'/detalhes');
    }

    public function store(DependentesRequest $request)
    {
        $input = $request->all();
        $id = $request->get('clientes_id');
        Dependentes::create($input);
        return redirect('admin/dependentes/'.$id.'/detalhes');
    }

    public function createDependentesCliente(Dependentes $dependentes, $id)
    {
        $clientes = Clientes::find($id);
        $dependentes = Dependentes::where('clientes_id', '=', 1)->orderBy('nome')->lists('nome', 'id');
        return view('dependentes.createDependentesCliente', compact('clientes', 'dependentes'));
    }

    public function destroy($id)
    {
        $dependentes = Dependentes::find($id)->delete();
        //return redirect(route('dependentes/'.$id.'/detalhes'));
        return redirect()->back();
    }

}