<html>
<head>
    <title>Notas </title>
</head>

<body>

@extends('app')
@section('content')
<div class="container">
    <legend><span class="glyphicon glyphicon-tasks"></span> Manutenção Administrativa</legend><br />
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="{{ route('voos') }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens') }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{ route('transfers') }}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{ route('passeios') }}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{ route('hoteis') }}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{ route('extras') }}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros') }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
        <li role="presentation" class="active"><a href="{{ route('lembretes') }}"><span class="glyphicon glyphicon-book"></span> Notas</a></li>
        <li role="presentation"><a href="{{ route('situacao') }}"><span class="glyphicon glyphicon-pushpin"></span> Situações</a></li>
        <li role="presentation"><a href="{{ route('categorias') }}"><span class="glyphicon glyphicon-pushpin"></span> Categorias</a></li>
        <li role="presentation"><a href="{{ route('pacotes') }}"><span class="glyphicon glyphicon-pushpin"></span> Pacotes</a></li>
    </ul>

    <legend><span class="glyphicon glyphicon-book"></span> Manutenção de Notas</legend><br />
    <a onclick="goBack()" class="btn-sm btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
    <a href="#lembretes" rel="modal"  class="btn-sm btn-success" role="group" data-toggle="modal" data-target="#lembretes" data-whatever="@mdo" ><span class="glyphicon glyphicon-plus-sign"></span>Adicionar </a>
    <br/><br/>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="cod">Cod</th>
            <th>Titulo</th>
            <th>Descrição</th>
            <th colspan="2">Ações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($lembretes as $l)
        <tr class="text-center">
            <td>{{ $l->id }}</td>
            <td>{{ $l->titulo }}</td>
            <td>{{ $l->descricao }}</td>
            <td class="acoes">
                <a href="{{ route('lembretes.edit',['id'=>$l->id]) }}" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
            </td>
            <td class="acoes">
                <a href="{{ route('lembretes.destroy',['id'=>$l->id]) }}" name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>

</div>


<!-- Modal Lembretes-->
<div class="modal fade" id="lembretes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Nova Nota:</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=>'lembretes.store']) !!}

                <div class="form-group">
                    {!! Form::label('titulo', 'Titulo:') !!}
                    {!! Form::text('titulo', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('descricao', 'Descrição:') !!}
                    {!! Form::textarea('descricao', null, ['class'=>'form-control']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

@section('post-script')
    <script type="text/javascript">

        $('a[name=excluir]').on('click', function () {
            $('a[name=excluir]').confirmation();
        });

    </script>
@endsection
@endsection