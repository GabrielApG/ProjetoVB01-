<html>
<head>
    <title>Situações</title>
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
        <li role="presentation" class="active"><a href="{{ route('situacao') }}"><span class="glyphicon glyphicon-pushpin"></span> Situações</a></li>
        <li role="presentation"><a href="{{ route('categorias') }}"><span class="glyphicon glyphicon-pushpin"></span> Categorias</a></li>
        <li role="presentation"><a href="{{ route('pacotes') }}"><span class="glyphicon glyphicon-pushpin"></span> Pacotes</a></li>
    </ul>

    <legend><span class="glyphicon glyphicon-pushpin"></span> Manutenção Situações</legend><br />
    <a onclick="goBack()" class="btn-sm btn-info"><< Voltar</a>
    <a href="{{route('situacao.create')}}" class="btn-sm btn-success">Adicionar</a>
    <br /><br />
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Situações</th>
             <th colspan="2">Ações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($situacoes as $situacao)
        <tr class="text-center">
            <td>{{ $situacao->id }}</td>
            <td>{{ $situacao->nome }}</td>
            <td class="acoes">
                <a href="{{ route('situacao.edit',['id'=>$situacao->id]) }}" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
            </td>
            <td class="acoes">
                <a href="{{ route('situacao.destroy',['id'=>$situacao->id]) }}" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>

</div>
@endsection

</body>

<html>