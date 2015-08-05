<html>
<head>
    <title>Clientes</title>
</head>
<body>
@extends('app')
@section('content')
    <?php
        $contSituacao = 0;
        $contCompra = 0;
        $contViagem = 0;
    ?>

    @foreach($clientesAll as $c)
        <?php
        if($c->situacoes->nome == 'Aguardando Orçamento'){
             $contSituacao++;
        }
        if($c->situacoes->nome == 'Compra Confirmada'){
            $contCompra++;
        }

        if($c->situacoes->nome == 'Em Viagem'){
            $contViagem++;
        }
        ?>
    @endforeach

<div class="container containerTelaInicial">
    <legend><span class="glyphicon glyphicon-list-alt"></span> Controle de Clientes</legend><br />

</div>

  <div class="container containerTelaInicial">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">
                <span class="glyphicon glyphicon-list-alt"></span> Todos Clientes</a></li>
        <li role="presentation"><a href="{{ route('clientes.pedidosOrcamento')}}">
                <span class="glyphicon glyphicon-arrow-down"></span> Pedidos de Orçamento <span class="badge"><?php echo $contSituacao; ?></span></a></li>
        <li role="presentation"><a href="{{ route('clientes.compraConfirmada')}}"><span class="glyphicon glyphicon-warning-sign">
                </span> Compra Confirmada <span class="badge"><?php echo $contCompra; ?></span></a></li>
        <li role="presentation"><a href="{{route('clientes.emViajem')}}"><span class="glyphicon glyphicon-plane">
                </span> Em Viagem <span class="badge"><?php echo $contViagem; ?></span></a></li>
        <li role="presentation"><a href="{{ route('clientes.create')}}">
                <span class="glyphicon glyphicon-plus-sign"></span> Cadastrar</a></li>
    </ul>
    <br />
    {{--Formulário de pesquisa por nome--}}
    <div class="input-group input-group-sm">
        <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-search"></span></span>
        <input type="text" class="form-control"name="busca" id="busca" placeholder="Buscar por ..."  onkeyup="buscar(this.value)" aria-describedby="sizing-addon3">
        <!-- Mostra detalhe no fim da busca-->
        <!-- <div class="input-group-addon">
                    <a href="{{route('clientes')}}">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>
            </div> -->
    </div>

    <div name="resultado" id="resultado">

     <table class="table table-striped table-bordered table-hover" id="resultado">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Categoria</th>
            <th>Pacote</th>
            <th>Status</th>
            <th colspan="2">Ações</th>
            {{--<th><span class="glyphicon glyphicon-pencil"></span></th>--}}
            {{--<th><span class="glyphicon glyphicon-folder-open"></span></th>--}}
        </tr>
        </thead>
        <tbody>

        @foreach($clientes as $cliente)
        <tr>
            <td id="index_tab_id">{{ $cliente->id }}</td>
            <td id="index_tab_nome">{{ $cliente->nome }}</td>
            <td id="index_tab_telefone">{{ $cliente->telefone }}</td>
            <td id="index_tab_email">{{ $cliente->email}}</td>
            <td id="index_tab_categorias">{{ $cliente->categorias->nome }}</td>
            <td id="index_tab_pacotes">{{ $cliente->pacotes->nome }}</td>
            <td id="index_tab_situacoes">{{ $cliente->situacoes->nome }}</td>
            <td id="index_tab_editar">
                <a href="{{ route('clientes.edit',['id'=>$cliente->id]) }}" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
            </td>
            <td id="index_tab_visualizar">
                <a href="{{ route('clientes.detalhes',['id'=>$cliente->id]) }}" class="btn-xs btn-primary"><span class="glyphicon glyphicon-folder-open"></span> </a>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>

    </div>
    <!-- Isso e para mostrar a renderizacao da pagina  -->
    {!! $clientes->render() !!}
</div>

<!-- Java Script para efeito MODAL -->
@section('post-script')
<script type="text/javascript">

    var req;

    function buscar(valor) {

        if (window.XMLHttpRequest) {
            req = new XMLHttpRequest();
        }
        else if (window.ActiveXObject) {
            req = new ActiveXObject("Microsoft.XMLHTTP");
        }

        if (valor == '') {
            window.location.reload();
        } else {
            var url = 'clientes/' + valor + '/pesquisar/';
            req.open("GET", url, true);

            req.onreadystatechange = function () {// Quando o objeto recebe o retorno, chamamos a seguinte função;

                if (req.readyState == 1) { // Exibe a mensagem "Buscando Noticias..." enquanto carrega
                    document.getElementById('resultado').innerHTML = '';
                }
                if (req.readyState == 4 && req.status == 200) {// Verifica se o Ajax realizou todas as operações corretamente

                    var resposta = req.responseText;// Resposta retornada pelo busca.php
                    document.getElementById('resultado').innerHTML = resposta;// Abaixo colocamos a(s) resposta(s) na div resultado
                }
            }
            req.send(null);
        }
    }

</script>
@endsection
@endsection

</body>
<html>