@extends('app')
@section('content')
<div class="container">
    <legend><span class="glyphicon glyphicon-plane"></span> VOOS - {{$clientes->nome}}</legend> <br />
    <ul class="nav nav-tabs">
        {{--<li role="presentation"><a href="{{ route('clientes.orcamento',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-usd"></span> Orçamento</a></li>--}}
        <li role="presentation"><a href="{{ route('clientes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-tasks"></span> Pacote</a></li>
        <li role="presentation"><a href="{{ route('clientes.detalhesClientes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span> Inf. Pessoais</a></li>
        <li role="presentation"><a href="{{ route('dependentes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span> Dep.</a></li>
        <li role="presentation"><a href="{{ route('relatorios',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-file"></span> Rel.</a></li>
        <li role="presentation" class="active"><a href="{{ route('voos.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{route('transfers.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{route('passeios.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{route('hoteis.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{route('extras.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
        <li role="presentation"><a href="{{ route('observacao.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-book"></span> Observações</a></li>
    </ul>
    <br />
        <div class="form-group-xs">
        <a href="{{ route('voos.createVooCliente',['id'=>$clientes->id]) }}" class="btn-sm btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar Voo</a>
    </div>
    <br/>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="20">Voos Pessoais {{$clientes->nome}}</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Pais</th>
            <th>Cidade</th>
            <th>Emb.</th>
            <th>Des.</th>
            <th>D. Ida</th>
            <th>D. Volta</th>
            <th>H. Ida</th>
            <th>H. Volta</th>
            <th>Emp.</th>
            <th>N. Bilhete</th>
            <th>Poltrona</th>
            <th>N. Voo</th>
            <th>Escalas</th>
            <th>Obs.</th>
            <th>Principal</th>
            <th>Valor</th>
            <th colspan="2">Ações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($clientes->voos as $v)
            <?php if($v->orcamento == 0){?>
            <tr class="text-center" style="font-size:11px;">
                <td>{{ $v->id }}</td>
                <td>{{ $v->nome_voo }}</td>
                <td>{{ $v->cidades->codigo_pais}}</td>
                <td>{{ $v->cidades->nome}}</td>
                <td>{{ $v->local_emb }}</td>
                <td>{{ $v->local_des }}</td>
                <td>{{ $v->data_ida}}</td>
                <td>{{ $v->data_volta}}</td>
                <td>{{ $v->hora_ida}}</td>
                <td>{{ $v->hora_volta }}</td>
                <td>{{ $v->empresa_voo }}</td>
                <td>{{$v->num_bilhete}}</td>
                <td>{{$v->poltrona}}</td>
                <td>{{$v->num_voo}}</td>
                <td>{{$v->escalas}}</td>
                <td>{{$v->observacao}}</td>
                <td>{{$v->principal}}</td>
                <td>{{ $v->valor }}</td>
                <td class="acoes">
                    <a href="{{ route('voos.editVooCliente',['id'=>$v->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td>
                   <a href="{{route('voos.storeDetach',['voos_id'=>$v->id])}}" name="excluir" class="btn-xs btn-danger"> <span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
            <?php } ?>
    @endforeach
    </table>
</div>

@section('post-script')
    <script type="text/javascript">

        $('a[name=excluir]').on('click', function () {
            $('a[name=excluir]').confirmation();
        });

    </script>
@endsection
@endsection