<?php

namespace App\Http\Controllers;
use App\Cidades;
use App\Http\Requests\VoosOrcamentoRequest;
use App\Http\Requests\VoosRequest;
use App\Voos;
use App\Clientes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class VoosController extends Controller{

    private $voosModel;

    public function __construct(Voos $voosModel)
    {
        $this->voosModel = $voosModel;
    }

    public function index()
    {
        $voos = $this->voosModel->all();
        return view('voos.index', compact('voos'));
    }

    public function detalhes($id)
    {
        $clientes = Clientes::find($id);
        return view('voos.detalhes', compact('clientes'));
    }

    public function destroy($id)
    {
        $voos = Voos::find($id)->delete();
        return redirect()->route('voos');
    }

    public function edit(Cidades $paises, $id, Voos $voos)
    {
        $voos = Voos::find($id);
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('voos.edit', compact('voos','paises'));
    }

    public function create(Cidades $paises)
    {
        $this->paisModel = $paises;
        $paises = Cidades::where('codigo_pais','>', 0)->orderBy('codigo_pais')->lists('codigo_pais', 'codigo_pais');
        return view('voos.create', compact('paises'));
    }

    public function store(VoosRequest $request)
    {
        $input = $request->all();
        voos::create($input);
        return redirect('admin/voos');
    }

    public function createVooCliente(Voos $voo, $id)
    {
        $cliente = Clientes::find($id);
        $voo = Voos::where('orcamento','=', 1)->orderBy('nome_voo')->lists('nome_voo', 'id');
        return view('voos.createVooCliente', compact('cliente','voo'));
    }

    public function editVooCliente($id, $idCliente)
    {
        $voo = Voos::find($id);
        $clientes = Clientes::find($idCliente);
        return view('voos.editVooCliente', compact('voo','clientes'));
    }

    public function update(VoosOrcamentoRequest $request, $id)
    {
        $voos = Voos::find($id)->update($request->all());
        $idCliente = DB::table('clientes_voos')->where('voos_id','=',$id)->pluck('clientes_id');

        return redirect('admin/clientes/'.$idCliente.'/detalhes');
    }

    public function updateVoo(VoosOrcamentoRequest $request, $id)
    {
        $voos = Voos::find($id)->update($request->all());
        $idCliente = DB::table('clientes_voos')->where('voos_id','=',$id)->pluck('clientes_id');

        return redirect('admin/voos');
    }

    public function editVooOrcamento($id, $idCliente)
    {
        $voo = Voos::find($id);
        $clientes = Clientes::find($idCliente);
        return view('voos.editVooOrcamento', compact('voo','clientes'));
    }

    public function updateOrcamento(VoosOrcamentoRequest $request, $id)
    {
        $voos = Voos::find($id)->update($request->all());
        $idCliente = DB::table('clientes_voos')->where('voos_id','=',$id)->pluck('clientes_id');

        return redirect('admin/clientes/'.$idCliente.'/orcamento');
    }

    public function storeAttach(VoosRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $t = $this->voosModel->create($request->all());
        $t->clientes()->attach($clientes_id);
        return redirect()->back();
    }

    public function storeDetach($id)
    {
        $ct = DB::table('clientes_voos')->where('voos_id','=',$id)->pluck('id');
        $clt = DB::table('clientes_voos')->where('id','=',$ct)->delete();
        $voo = voos::find($id)->delete();
        return redirect()->back();
    }

    public function storeAttachOrcamento(VoosRequest $request)
    {
        $clientes_id = $request->get('clientes_id');
        $t = $this->voosModel->create($request->all());
        $t->clientes()->attach($clientes_id);

        //Método para pré Cadastro no Banco

        $id = $request->get('voos_id');
        $nome = $request->get('nome_voo');
        $c_id = $request->get('clientes_id');
        $cidades_id = $request->get('cidades_id');
        $local_emb = $request->get('local_emb');
        $local_des = $request->get('local_des');
        $valor = $request->get('valor');
        $orcamento = 0;

        $principal = $request->get('principal');
        if($principal == null){
            $principal = 'Não';
        }else{
            $principal = 'Sim';
        }

        $NovoVoo = $this->voosModel->create(['id' => $id,'nome_voo'=>$nome,'clientes_id'=>$c_id,'cidades_id'=>$cidades_id,'local_emb'=>$local_emb,'local_des'=>$local_des,'valor'=>$valor,'principal'=>$principal,'orcamento'=>0]);
        $NovoVoo->clientes()->attach($clientes_id);

        return redirect()->back();
    }

    public function storeDetachOrcamento($id)
    {
        $ct = DB::table('clientes_voos')->where('voos_id','=',$id)->pluck('id');
        $clt = DB::table('clientes_voos')->where('id','=',$ct)->delete();
        return redirect()->back();
    }

    public function getVoosOrcamento()
    {
        $voos =  DB::table('voos')
                                ->where('orcamento','=',1)
                                ->get();
        return Response::json($voos);
    }

    public function getVoos($id)
    {
        $voos =  DB::table('voos')->where('id','=',$id)->get();
        return Response::json($voos);
    }


}