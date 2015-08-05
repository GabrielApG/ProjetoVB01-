<?php namespace App\Http\Controllers;

use App\Cidades;
use App\Clientes;
use App\Http\Requests;
use App\Http\Requests\RoteirosRequest;
use App\Http\Requests\RoteirosOrcamentoRequest;
use App\Rdatas;
use App\Roteiros;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class RoteirosController extends Controller {

    private $roteirosModel;

    public function __construct(Roteiros $roteirosModel)
    {
        $this->roteirosModel = $roteirosModel;
    }

	public function index()
	{
        $roteiros = Roteiros::all();
		return view('roteiros.index',compact('roteiros'));
	}

	public function create(Cidades $paises)
	{
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('roteiros.create', compact('cidades', 'paises'));
	}

    public function store(RoteirosRequest $request)
    {
        $input = $request->all();
        Roteiros::create($input);
        return redirect('admin/roteiros');
    }

    public function edit(Cidades $paises, $id, Roteiros $roteiros)
    {
        $roteiros = Roteiros::find($id);
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('roteiros.edit', compact('roteiros','paises'));
    }

    public function updateRoteiro(RoteirosOrcamentoRequest $request, $id)
    {
        $roteiros = Roteiros::find($id)->update($request->all());
        $idCliente = DB::table('clientes_roteiros')->where('roteiros_id','=',$id)->pluck('clientes_id');

        if( $idCliente == null || $idCliente == ''){ // para direcionamento correto da rota

            return redirect('admin/roteiros');

        }else{
            return redirect('admin/clientes/'.$idCliente.'/detalhes');
        }
    }

    public function update(RoteirosRequest $request, $id)
    {
        $roteiros = Roteiros::find($id)->update($request->all());
        return redirect()->route('roteiros');
    }

    public function destroy($id)
    {
        $roteiros = Roteiros::find($id)->delete();
        return redirect()->route('roteiros');
    }

    public function detalhes($id)
    {
        $clientes = Clientes::find($id);
        return view('roteiros.detalhes', compact('clientes'));
    }

    public function createRoteiroCliente(Roteiros $roteiro, $id)
    {
        $clientes = Clientes::find($id);
        $roteiros = Roteiros::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        return view('roteiros.createRoteirosCliente', compact('clientes','roteiros'));
    }

    public function storeAttach(RoteirosRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $t = $this->roteirosModel->create($request->all());
        $t->clientes()->attach($clientes_id);

        return redirect('admin/roteiros/'.$clientes_id.'/detalhes');
    }

    public function storeDetach($id)
    {
        $ct = DB::table('clientes_roteiros')->where('roteiros_id','=',$id)->pluck('id');
        $clt = DB::table('clientes_roteiros')->where('id','=',$ct)->delete();
        $roteiros = Roteiros::find($id)->delete();
        return redirect()->back();
    }

    public function storeAttachOrcamento(RoteirosOrcamentoRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $roteiros_id = $request->get('roteiros_id');
        $roteiros = Roteiros::find($roteiros_id);
        $roteiros->clientes()->attach($clientes_id);

        //Método para pré cadastro
        $clientes_id = $request->get('clientes_id');
        $t = $this->roteirosModel->create($request->all());
        $t->clientes()->attach($clientes_id);


        return redirect()->back();
    }

    public function storeDetachOrcamento($id)
    {
        $ct = DB::table('clientes_roteiros')->where('roteiros_id','=',$id)->pluck('id');
        $clt = DB::table('clientes_roteiros')->where('id','=',$ct)->delete();
        return redirect()->back();
    }

    public function getRoteirosOrcamento()
    {
        $trens =  DB::table('roteiros')
            ->where('orcamento','=',1)
            ->get();
        return Response::json($trens);
    }

    public function getRoteiro($id)
    {
        $valor =  DB::table('roteiros')->where('id','=',$id)->get();
        return Response::json($valor);
    }
}
