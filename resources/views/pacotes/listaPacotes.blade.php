<html>
<head>
    <title>Pacotes</title>
</head>
<body>
@extends('app')
@section('content')

<div class="container">

     <a onclick="goBack()" class="btn-sm btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> </a>
    <br/> <br/>
     <table class="table table-striped table-bordered table-hover" id="resultado">
        <thead>
        <tr>
            <th colspan="5"><h4>Lista de Clientes </h4></th>
        </tr>
        <tr>
            <th>Cod.</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Abrir</th>
        </tr>
        </thead>
        <tbody>

        @foreach($clientes as $cliente)
        <tr class="text-center">
            <td>{{$cliente->id}}</td>
            <td>{{ $cliente->nome }}</td>
            <td>{{ $cliente->telefone }}</td>
            <td>{{ $cliente->email}}</td>
            <td>
                <a href="{{ route('clientes.detalhes',['id'=>$cliente->id]) }}" class="btn-sm btn-primary"><span class="glyphicon glyphicon-folder-open"></span> Visualizar</a>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>

    </div>

</div>

@endsection

</body>
<html>