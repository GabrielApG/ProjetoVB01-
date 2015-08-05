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

    @foreach($clientes as $c)
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
        <legend><span class="glyphicon glyphicon-list-alt"></span> Pedidos de Orçamento</legend><br />

    </div>
    <div class="container containerTelaInicial">
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="{{route('clientes')}}">
                <span class="glyphicon glyphicon-list-alt"></span> Todos Clientes</a></li>
        <li role="presentation" class="active"><a href="{{ route('clientes.pedidosOrcamento')}}">
                <span class="glyphicon glyphicon-arrow-down"></span> Pedidos de Orçamento <span class="badge"><?php echo $contSituacao; ?></span></a></li>
        <li role="presentation"><a href="{{ route('clientes.compraConfirmada')}}"><span class="glyphicon glyphicon-warning-sign">
                </span> Compra Confirmada <span class="badge"><?php echo $contCompra; ?></span></a></li>
        <li role="presentation"><a href="{{route('clientes.emViajem')}}"><span class="glyphicon glyphicon-plane">
                </span> Em Viagem <span class="badge"><?php echo $contViagem; ?></span></a></li>
        <li role="presentation"><a href="{{ route('clientes.create')}}">
                <span class="glyphicon glyphicon-plus-sign"></span> Cadastrar</a></li>
    </ul>

    <div class="alert alert-warning" role="alert">
        <strong>ATENÇÃO! Lista de Clientes </strong> com Status de Solicitação de Orçamento.
    </div>

     <table class="table table-striped table-bordered table-hover" id="table">
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
        <?php if($cliente->situacoes->id == 1){
        $contSituacao++;?>

        <tr name="conteudo" id="conteudo">
            <td name="id" id="id">{{ $cliente->id }}</td>
            <td name="nome" id="nome">{{ $cliente->nome }}</td>
            <td>{{ $cliente->telefone }}</td>
            <td>{{ $cliente->email}}</td>
            <td>{{ $cliente->categorias->nome }}</td>
            <td>{{ $cliente->pacotes->nome }}</td>
            <td>{{ $cliente->situacoes->nome }}</td>
            <td>
                <a href="{{ route('clientes.edit',['id'=>$cliente->id]) }}" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
            </td>
            <td>
                <a href="{{ route('clientes.detalhes',['id'=>$cliente->id]) }}" class="btn-xs btn-primary"><span class="glyphicon glyphicon-folder-open"></span> </a>
            </td>
        <?php }?>
        </tr>
        @endforeach

        </tbody>
    </table>
    <!-- Isso e para mostrar a renderizacao da pagina  -->
</div>

<!-- Java Script para efeito MODAL -->
@section('post-script')
<script type="text/javascript">

    var req;
    // FUNÇÃO PARA BUSCA NOTICIA
    function buscarNoticias(valor) {
    // Verificando Browser
    if(window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    }
    else if(window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var url =  'clientes/'+valor+'/pesquisar/';
    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

        // Quando o objeto recebe o retorno, chamamos a seguinte função;
        req.onreadystatechange = function() {

            // Exibe a mensagem "Buscando Noticias..." enquanto carrega
            if(req.readyState == 1) {
                document.getElementById('resultado').innerHTML = 'Buscando Clientes...';
            }
            // Verifica se o Ajax realizou todas as operações corretamente
            if(req.readyState == 4 && req.status == 200) {

                // Resposta retornada pelo busca.php
                var resposta = req.responseText;

                // Abaixo colocamos a(s) resposta(s) na div resultado
                document.getElementById('resultado').innerHTML = resposta;

                /*$.each(resposta, function (value) {
                    $('text[name=resultado]').append(value.nome);
                });*/
            }
        }
    req.send(null);
   }

</script>
@endsection
@endsection

</body>
<html>