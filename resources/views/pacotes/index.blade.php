<html>
<head>
    <title>Pacotes</title>
</head>
<body id="corFundo">

@extends('app')
@section('content')
    <div class="container" id="corFundo2">
        <style>
            #corFundo{
                background-color: #F5F5F5;
            }
            #corFundo2{
                background-color: #FFFFFF;
            }
        </style>
    <legend><span class="glyphicon glyphicon-tasks"></span> Manutenção Administrativa</legend><br />
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="{{ route('voos') }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens') }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{ route('transfers') }}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{ route('passeios') }}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{ route('hoteis') }}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{ route('extras') }}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros') }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
        <li role="presentation"><a href="{{ route('lembretes') }}"><span class="glyphicon glyphicon-book"></span> Notas</a></li>
        <li role="presentation"><a href="{{ route('situacao') }}"><span class="glyphicon glyphicon-pushpin"></span> Situações</a></li>
        <li role="presentation"><a href="{{ route('categorias') }}"><span class="glyphicon glyphicon-pushpin"></span> Categorias</a></li>
        <li role="presentation" class="active"><a href="{{ route('pacotes') }}"><span class="glyphicon glyphicon-pushpin"></span> Pacotes</a></li>
    </ul>

    <legend><span class="glyphicon glyphicon-pushpin"></span> Manutenção de Pacotes</legend><br />
    <a onclick="goBack()" class="btn-sm btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
    <a href="{{route('pacotes.create')}}" class="btn-sm btn-success"><span class="glyphicon glyphicon-plus-sign"></span>  Adicionar</a>
    <br /><br />
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Pacotes</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Categorias</th>
            <th>Listar Clientes</th>
            <th colspan="2">Ações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($pacotes as $pacote)
        <tr class="text-center">
            <td>{{ $pacote->id }}</td>
            <td>{{ $pacote->nome }}</td>
            <td class="text-justify">{{ $pacote->descricao }}</td>
            <td>{{ $pacote->valor }}</td>
            <td>{{ $pacote->categorias->nome }}</td>
            <td class="acoes">
                <a href="{{ route('pacotes.listaClientes',['id'=>$pacote->id]) }}" class="btn-xs btn-info"><span class="glyphicon glyphicon-search"></span> </a>
            </td>
            <td class="acoes">
                <a href="{{ route('pacotes.edit',['id'=>$pacote->id]) }}" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
            </td>
            <td class="acoes">
                <a href="{{ route('pacotes.destroy',['id'=>$pacote->id]) }}" name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>

</div>
@endsection

</body>

<html>

@section('post-script')
    <script type="text/javascript">

        $('a[name=excluir]').on('click', function () {
            $('a[name=excluir]').confirmation();
        });

    </script>
@endsection