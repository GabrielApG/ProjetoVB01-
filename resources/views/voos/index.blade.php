<html>
<head>
    <title>Voos</title>
</head>

<body>

@extends('app')

@section('content')
<div class="container">
    <legend><span class="glyphicon glyphicon-tasks"></span> Manutenção Administrativa</legend><br />
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="{{ route('voos') }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens') }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{ route('transfers') }}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{ route('passeios') }}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{ route('hoteis') }}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{ route('extras') }}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros') }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
        <li role="presentation"><a href="{{ route('lembretes') }}"><span class="glyphicon glyphicon-book"></span> Notas</a></li>
        <li role="presentation"><a href="{{ route('situacao') }}"><span class="glyphicon glyphicon-pushpin"></span> Situações</a></li>
        <li role="presentation"><a href="{{ route('categorias') }}"><span class="glyphicon glyphicon-pushpin"></span> Categorias</a></li>
        <li role="presentation"><a href="{{ route('pacotes') }}"><span class="glyphicon glyphicon-pushpin"></span> Pacotes</a></li>
    </ul>

    <div class="alert alert-warning alert-dismissible" role="alert">
        <strong>Atenção!</strong> Os Voos cadastrados aqui, serão disponibilizados apenas para ciclo de orçamento.
    </div>

    <div class="form-group">
    <a href="{{ route('voos.create')}}" class="btn-sm  btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Cadastrar Voo para Orçamento</a>
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>País</th>
            <th>Cidade Origem</th>
            <th>Destino</th>
            <th colspan="2" class="acoes">Ações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($voos as $voo)
        <?php if($voo->orcamento == 1){?>
        <tr class="text-center">
            <td>{{ $voo->id }}</td>
            <td>{{$voo->nome_voo}}</td>
            <td>{{ $voo->cidades->codigo_pais}}</td>
            <td>{{ $voo->cidades->nome}}</td>
            <td>{{ $voo->local_des }}</td>
            <td class="acoes">
                <a href="{{ route('voos.edit',['id'=>$voo->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
            </td>
            <td class="acoes">
                <a href="{{ route('voos.destroy',['id'=>$voo->id]) }}" name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
            </td>
        </tr>
        <?php }?>
        @endforeach
        </tbody>
    </table>

    <button  type= "button"  class= "close"  data-dismiss= "alert"  aria-label= "Close" >
        <span  aria-hidden= "true" > × </span>
    </button>

</div>
@section('post-script')
    <script type="text/javascript">

        $('a[name=excluir]').on('click', function () {
            $('a[name=excluir]').confirmation();
        });

    </script>
@endsection
@endsection

</body>
<html>