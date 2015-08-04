<?php namespace App\Http\Controllers;

use App\Categorias;
use App\Clientes;
use App\Http\Requests;
use App\Http\Requests\PacotesRequest;
use App\Pacotes;
use App\Situacoes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class PacotesController extends Controller {

    private $pacotesModel;

    public function __construct(Pacotes $pacotesModel)
    {
        $this->pacotesModel = $pacotesModel;
    }

	public function index()
	{
        $pacotes =  Pacotes::all();
        return view ('pacotes.index', compact('pacotes'));
	}

  	public function create(Categorias $categorias)
	{
        $categoria = $categorias->lists('nome', 'id');
        return view('pacotes.create', compact('categoria'));
	}

    public function store(PacotesRequest $request)
    {
        $input = $request->all();
        Pacotes::create($input);
        return redirect('admin/pacotes');
    }

    public function destroy($id)
    {
        $pacotes = Pacotes::find($id)->delete();
        return redirect('admin/pacotes');
    }

    public function edit($id, Categorias $category)
    {
        $pacotes = Pacotes::find($id);
        $categorias = $category->lists('nome','id');
        return view('pacotes.edit', compact('pacotes','categorias'));
    }

    public function update(PacotesRequest $request, $id)
    {
        $pacotes = Pacotes::find($id)->update($request->all());
        return redirect()->route('pacotes');
    }
    public function listaClientes(Categorias $categorias,Situacoes $situacoes, Pacotes $pacotes, $id){

        $clientes = DB::table('clientes')->where('pacotes_id','=',$id)->get();
        $pacotes = DB::table('pacotes')->where('id','=',$id)->get();
        return view('pacotes.listaPacotes',compact('clientes','pacotes'));
    }

    public function getPacotes($idCategoria)
    {
        $extras =  DB::table('pacotes')->where('categorias_id','=',$idCategoria)->get();
        return Response::json($extras);
    }

}
