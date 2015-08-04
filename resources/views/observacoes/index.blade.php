<html>
<head>
    <title>Observações </title>
</head>

<body>

@extends('app')
@section('content')
<div class="container">

    <legend><span class="glyphicon glyphicon-book"></span> Observações</legend><br />

    <ul class="nav nav-tabs">
        {{--<li role="presentation"><a href="{{ route('clientes.orcamento',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-usd"></span> Orçamento</a></li>--}}
        <li role="presentation"><a href="{{ route('clientes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-tasks"></span> Pacote</a></li>
        <li role="presentation"><a href="{{ route('clientes.detalhesClientes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span> Inf. Pessoais</a></li>
        <li role="presentation"><a href="{{ route('dependentes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span> Dep.</a></li>
        <li role="presentation"><a href="{{ route('relatorios',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-file"></span> Rel.</a></li>
        <li role="presentation"><a href="{{ route('voos.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{ route('transfers.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{ route('passeios.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{ route('hoteis.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{ route('extras.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
        <li role="presentation" class="active"><a href="{{ route('observacao.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-book"></span> Observações</a></li>
    </ul>
    <br />

    <a href="#lembretesCreate" rel="modal"  class="btn-sm btn-success" role="group" data-toggle="modal" data-target="#lembretesCreate" data-whatever="@mdo" ><span class="glyphicon glyphicon-plus-sign"></span> Criar</a>
    <br/><br/>

    <table class="table table-striped table-bordered table-hover">

        <tr>
            <th>ID</th>
            <th>Observações</th>
            <th colspan="2">Ações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($obs as $o)
            <tr class="text-center">
                <td>{{ $o->id }}</td>
                <td>{{ $o->observacao }}</td>
                <td class="acoes">
                    <a href="{{ route('observacao.edit',['id'=>$o->id]) }}" rel="modal"  class="btn-xs btn-warning" role="group" data-toggle="modal" data-whatever="@mdo" ><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td class="acoes">
                    <a href="{{ route('observacao.destroy',['id'=>$o->id]) }}" name="excluir" class="btn-xs btn-danger"> <span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
        @endforeach
    </table>

    <br/>

</div>


<!-- Modal CREATE Lembretes-->
<div class="modal fade" id="lembretesCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Observações:</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=>['observacao.store']]) !!}

                <div class="form-group">
                    {!! Form::label('descricao', 'Observações:') !!}

                    <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control">
                    </textarea>
                </div>

                {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
                </div>

                {!! Form::close() !!}

            </div>
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