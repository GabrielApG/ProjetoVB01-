@extends('app')
@section('content')
<div class="container">
    <legend><span class="glyphicon glyphicon-grain"></span> PASSEIOS - {{$clientes->nome}}</legend><br />
    <ul class="nav nav-tabs">
        {{--<li role="presentation"><a href="{{ route('clientes.orcamento',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-usd"></span> Orçamento</a></li>--}}
        <li role="presentation"><a href="{{ route('clientes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-tasks"></span> Pacote</a></li>
        <li role="presentation"><a href="{{ route('clientes.detalhesClientes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span> Inf. Pessoais</a></li>
        <li role="presentation"><a href="{{ route('dependentes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span> Dep.</a></li>
        <li role="presentation"><a href="{{ route('relatorios',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-file"></span> Rel.</a></li>
        <li role="presentation"><a href="{{ route('voos.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{ route('transfers.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation" class="active"><a href="#"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{route('hoteis.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{route('extras.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
        <li role="presentation"><a href="{{ route('observacao.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-book"></span> Observações</a></li>
    </ul>
    
        <br />

        <div class="form-group-xs">
        <a href="{{ route('passeios.createPasseioCliente',['id'=>$clientes->id]) }}" class="btn-sm btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar Passeio</a>
    </div>
    <br/>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="11">Passeio Pessoais {{$clientes->nome}}</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Pais</th>
            <th>Cidade</th>
            <th>Ponto Partida</th>
            <th>Empresa</th>
            <th>Data Saída</th>
            <th>Hora Ida</th>
            <th>Valor</th>
            <th colspan="2">Ações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($clientes->passeios as $p)
            <?php if($p->orcamento == 0){?>
            <tr class="text-center">
                <td>{{ $p->id }}</td>
                <td>{{ $p->nome }}</td>
                <td>{{ $p->cidades->codigo_pais}}</td>
                <td>{{ $p->cidades->nome}}</td>
                <td>{{ $p->ponto_partida }}</td>
                <td>{{ $p->empresa_passeio }}</td>
                <td>{{ $p->data_ida }}</td>
                <td>{{ $p->hora_ida }}</td>
                <td>{{ $p->valor }}</td>
                <td class="acoes">
                    <a href="{{ route('passeios.editPasseiosCliente',['id'=>$p->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td>
                   <a href="{{route('passeios.storeDetach',['passeios_id'=>$p->id])}}" name="excluir" class="btn-xs btn-danger"> <span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
            <?php } ?>
    @endforeach
    </table>
</div>
@endsection
@section('post-script')
    <script type="text/javascript">

        $('a[name=excluir]').on('click', function () {
            $('a[name=excluir]').confirmation();
        });

    </script>
@endsection