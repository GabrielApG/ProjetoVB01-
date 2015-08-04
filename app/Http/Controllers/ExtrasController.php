<?php namespace App\Http\Controllers;

use App\Clientes;
use App\Cidades;
use App\Extras;
use App\Http\Requests\ExtraOrcamentoRequest;
use App\Http\Requests\ExtrasRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ExtrasController extends Controller {

    private $extrasModel;

    public function __construct(Extras $extrasModel)
    {
        $this->extrasModel = $extrasModel;
    }

    public function index()
    {
        $extras = $this->extrasModel->all();
        return view('extras.index', compact('extras'));
    }

    public function detalhes($id)
    {
        $clientes = Clientes::find($id);
        return view('extras.detalhes', compact('clientes'));
    }

    public function edit(Cidades $paises, $id, Extras $extras)
    {
        $extras = Extras::find($id);
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('extras.edit', compact('extras','paises'));
    }

    public function updateExtra(ExtraOrcamentoRequest $request, $id)
    {
        $extras = Extras::find($id)->update($request->all());
        $idCliente = DB::table('clientes_extras')->where('extras_id','=',$id)->pluck('clientes_id');

        return redirect('admin/extras');
    }

    public function create(Cidades $paises)
    {
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('extras.create', compact('paises'));
    }

    public function store(ExtrasRequest $request)
    {
        $input = $request->all();
        Extras::create($input);
        return redirect('admin/extras');
    }

    public function createExtrasCliente(Extras $transfer, $id)
    {
        $clientes = Clientes::find($id);
        $extras = Extras::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        return view('extras.createExtrasCliente', compact('clientes','extras'));
    }

    public function editExtraCliente($id, $idCliente)
    {
        $extras = Extras::find($id);
        $clientes = Clientes::find($idCliente);
        return view('extras.editExtrasCliente', compact('extras','clientes'));
    }

    public function update(ExtraOrcamentoRequest $request, $id)
    {
        $extras = Extras::find($id)->update($request->all());
        $idCliente = DB::table('clientes_extras')->where('extras_id','=',$id)->pluck('clientes_id');

        return redirect('admin/extras/'.$idCliente.'/detalhes');
    }

    public function editExtraOrcamento($id, $idCliente)
    {
        $extras = Extras::find($id);
        $clientes = Clientes::find($idCliente);
        return view('extras.editExtrasOrcamento', compact('extras','clientes'));
    }

    public function updateOrcamento(ExtraOrcamentoRequest $request, $id)
    {
        $extras = Extras::find($id)->update($request->all());
        $idCliente = DB::table('clientes_extras')->where('extras_id','=',$id)->pluck('clientes_id');

        return redirect('admin/clientes/'.$idCliente.'/orcamento');
    }


    public function storeAttach(ExtrasRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $t = $this->extrasModel->create($request->all());
        $t->clientes()->attach($clientes_id);
        return redirect()->back();
    }

    public function storeDetach($id)
    {
        $ct = DB::table('clientes_extras')->where('extras_id','=',$id)->pluck('id');
        $clt = DB::table('clientes_extras')->where('id','=',$ct)->delete();
        $extras = Extras::find($id)->delete();
        return redirect()->back();
    }

    public function storeAttachOrcamento(ExtrasRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $extras_id = $request->get('extras_id');
        $extras = Extras::find($extras_id);
        $extras->clientes()->attach($clientes_id);

        //Chamada de método para pré preenchimento da compra
        $clientes_id = $request->get('clientes_id');
        $t = $this->extrasModel->create($request->all());
        $t->clientes()->attach($clientes_id);

        return redirect()->back();
    }

    public function storeDetachOrcamento($id)
    {
        $ct = DB::table('clientes_extras')->where('extras_id','=',$id)->pluck('id');
        $clt = DB::table('clientes_extras')->where('id','=',$ct)->delete();
        return redirect()->back();
    }

    public function getExtras($idCidade)
    {
        $extras =  DB::table('extras')->where('cidades_id','=',$idCidade)->get();
        return Response::json($extras);
    }

    public function getExtraOrcamento()
    {
        $extras =  DB::table('extras')
            ->where('orcamento','=',1)
            ->get();
        return Response::json($extras);
    }

    public function getExtra($id)
    {
        $valor =  DB::table('extras')->where('id','=',$id)->get();
        return Response::json($valor);
    }

}