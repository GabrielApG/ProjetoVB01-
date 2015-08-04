<?php
namespace App\Http\Controllers;

use App\Categorias;
use App\Cidades;
use App\Clientes;
use App\Extras;
use App\Hoteis;
use App\Http\Controllers;
use App\Http\Requests\ClienteSituacaoRequest;
use App\Http\Requests\ClientesRequest;
use App\Pacotes;
use App\Passeios;
use App\Roteiros;
use App\Situacoes;
use App\Transfers;
use App\Trens;
use App\Voos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ClientesController extends Controller{

    private $clientesModel;

    public function __construct(Clientes $clientesModel) // passando o categoryModel para o construct
    {
        //$this->middleware('auth');// Para Autenticar
        $this->clientesModel = $clientesModel;
    }

    public function index(){

        //$clientes = Clientes::all();// método antigo
        //$situacao = Situacoes::all();
        //$clientes = $this->clientesModel->all(); // Assim mostra todos os cliente sem paginacao

        $clientes = $this->clientesModel->paginate(25); //
        $clientesAll = $this->clientesModel->all();

        //return view('clientes.index',['clientes'=>$clientes],['situacao'=>$situacao]);
        return view('clientes.index', compact('clientes','clientesAll'));
    }

    public function detalhes(Cidades $paises, Situacoes $situacoes, Categorias $categorias, Pacotes $pacotes, $id){

        $clientes = Clientes::find($id);
        $situacao = $situacoes->lists('nome','id');
        $categoria = $categorias->lists('nome','id');
        $pacote = $pacotes->lists('nome','id');

        $this->paisModel = $paises;
        $paises = $this->paisModel->lists('codigo_pais','codigo_pais');
        $trem = Trens::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        $voo = Voos::where('orcamento','=', 1)->orderBy('nome_voo')->lists('nome_voo', 'id');
        $transfers = Transfers::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        $passeios = Passeios::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        $hoteis = Hoteis::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        $extras = Extras::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        $roteiros = Roteiros::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');

        //return view('clientes.detalhes', compact('clientes','situacao','categoria','pacote'));
        return view('clientes.detalhes', compact('roteiros','extras','hoteis','passeios','transfers','clientes','situacao','categoria','pacote','paises','trem','voo'));
    }

    public function detalhesClientes($id){

        $clientes = Clientes::find($id);
        return view('clientes.detalhesClientes', compact('clientes'));
    }

    public function create(Situacoes $situacoes, Categorias $categorias,Pacotes $pacotes)
    {
        $clientesAll = $this->clientesModel->all();
        $situacao = $situacoes->lists('nome','id');
        $categoria = $categorias->lists('nome','id');
        $pacote = $pacotes->lists('nome','id');
        return view('clientes.create', compact('categoria','situacao','pacote','clientesAll'));
    }

    public function store(ClientesRequest $request)
    {
        $input = $request->all();
        Clientes::create($input);
        //return redirect('clientes');
        return redirect()->route('clientes');
    }

    public function destroy($id)
    {
        $cliente = Clientes::find($id)->delete();
        return redirect('clientes');
    }

    public function edit($id, Situacoes $situacoe, Categorias $categoria,Pacotes $pacote)
    {
        $cliente = Clientes::find($id);
        $categorias = $categoria->lists('nome','id');
        $situacoes = $situacoe->lists('nome','id');
        $pacotes = $pacote->lists('nome','id');
        return view('clientes.edit', compact('cliente', 'categorias','pacotes','situacoes'));
    }

    public function pesquisar($nome)
    {
        $clientes = DB::table('clientes')->where('nome','like',"%$nome%")->get();

        echo '<table class="table table-striped table-bordered table-hover" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($clientes as $c) {
               $rota =  route('clientes.detalhes',['id'=>$c->id]);
               $rotaEdit =  route('clientes.edit',['id'=>$c->id]);
                   echo '<tr class="text-center">';
                   echo '<td>'.$c->id.'</td>';
                   echo '<td>'.$c->nome.'</td>';
                   echo '<td>'.$c->telefone.'</td>';
                   echo '<td>'.$c->email.'</td>';
                   echo '<td><a href="'.$rotaEdit.'" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                         </td>';
                   echo '<td><a href="'.$rota.'" class="btn-xs btn-primary"><span class="glyphicon glyphicon-folder-open"></span> </a>
                         </td>';
                   echo '</tr>';
                }

        echo '</table>';
    }

    public function update(ClientesRequest $request, $id)
    {
        $cliente = Clientes::find($id)->update($request->all());
        return redirect()->route('clientes');
    }

    public function updateSituacao(ClienteSituacaoRequest $request, $id)
    {
        $cliente = Clientes::find($id)->update($request->all());
        return redirect()->back();
    }

    public function updateCategoria(ClienteSituacaoRequest $request, $id)
    {
        $cliente = Clientes::find($id)->update($request->all());
        return redirect()->back();
    }

    public function updatePacote(ClienteSituacaoRequest $request, $id)
    {
        $cliente = Clientes::find($id)->update($request->all());
        return redirect()->back();
    }

    public function updateLembrete(ClienteSituacaoRequest $request, $id)
    {
        $cliente = Clientes::find($id)->update($request->all());
        return redirect()->back();
    }

    public function pedidosOrcamento(){

        $clientes = $this->clientesModel->all();
        return view('clientes.pedidosOrcamento', compact('clientes'));
    }

    public function compraConfirmada(){

        $clientes = $this->clientesModel->all();
        return view('clientes.compraConfirmada', compact('clientes'));
    }

    public function emViajem(){

        $clientes = $this->clientesModel->all();
        return view('clientes.emViajem', compact('clientes'));
    }
    // *************  Parte do Orçamento *************************** //

    public function orcamento(Roteiros $roteiros, Extras $extras,Hoteis $hoteis, Transfers $transfers, Voos $voos,Trens $trens,Cidades $paises, Situacoes $situacoes, Categorias $categorias, Pacotes $pacotes, $id){

        $clientes = Clientes::find($id);
        $situacao = $situacoes->lists('nome','id');
        $categoria = $categorias->lists('nome','id');
        $pacote = $pacotes->lists('nome','id');
        $this->paisModel = $paises;
        $paises = $this->paisModel->lists('codigo_pais','codigo_pais');
        $trem = Trens::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        $voo = Voos::where('orcamento','=', 1)->orderBy('nome_voo')->lists('nome_voo', 'id');
        $transfers = Transfers::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        $passeios = Passeios::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        $hoteis = Hoteis::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');
        $extras = Extras::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');

        $roteiros = Roteiros::where('orcamento','=', 1)->orderBy('nome')->lists('nome', 'id');

        return view('clientesOrcamento.orcamento', compact('roteiros','extras','hoteis','passeios','transfers','clientes','situacao','categoria','pacote','paises','trem','voo'));
    }



}