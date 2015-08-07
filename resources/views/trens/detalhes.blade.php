@extends('app')
@section('content')
<div class="container">
    <legend><span class="glyphicon glyphicon-bed"></span> TRENS - {{$clientes->nome}}</legend><br />
    <ul class="nav nav-tabs">
        {{--<li role="presentation"><a href="{{ route('clientes.orcamento',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-usd"></span> Orçamento</a></li>--}}
        <li role="presentation"><a href="{{ route('clientes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-tasks"></span> Pacote</a></li>
        <li role="presentation"><a href="{{ route('clientes.detalhesClientes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span> Inf. Pessoais</a></li>
        <li role="presentation"><a href="{{ route('dependentes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span> Dep.</a></li>
        <li role="presentation"><a href="{{ route('voos.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation" class="active"><a href="{{route('transfers.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{route('passeios.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{route('hoteis.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{route('extras.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
        <li role="presentation"><a href="{{ route('observacao.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-book"></span> Observações</a></li>
        <li role="presentation"><a href="{{ route('relatorios',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-file"></span> Relatórios</a></li>
    </ul>
    <br />

        <div class="form-group-xs">
        <a href="{{ route('trens.createTremCliente',['id'=>$clientes->id]) }}" class="btn-sm btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar Trem</a>
    </div>
    <br/>

    <style>
        #tableVoo {
            font-size: 9px; }
    </style>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="14">Trens Pessoais {{$clientes->nome}}</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>País</th>
            <th>Cidade Origem</th>
            <th>Destino</th>
            <th>Empresa</th>
            <th>Numero</th>
            <th>Vagão</th>
            <th>Poltrona</th>
            <th>Data Saída</th>
            <th>Hora Ida</th>
            <th>Valor</th>
            <th colspan="2">Ações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($clientes->trens as $trem)
            <?php if($trem->orcamento == 0){?>
            <tr class="text-center">
                <td id="tableVoo">{{ $trem->id }}</td>
                <td id="tableVoo">{{ $trem->nome }}</td>
                <td id="tableVoo">{{ $trem->cidades->codigo_pais}}</td>
                <td id="tableVoo">{{ $trem->cidades->nome}}</td>
                <td id="tableVoo">{{ $trem->destino }}</td>
                <td id="tableVoo">{{ $trem->empresa_trem }}</td>
                <td id="tableVoo">{{$trem->numero}}</td>
                <td id="tableVoo">{{$trem->vagao}}</td>
                <td id="tableVoo">{{$trem->poltrona}}</td>
                <td id="tableVoo">{{ $trem->data_saida }}</td>
                <td id="tableVoo">{{ $trem->hora_ida }}</td>
                <td id="tableVoo">{{ $trem->valor }}</td>
                <td>
                    <a href="{{ route('trens.editTremCliente',['id'=>$trem->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td>
                   <a href="{{route('trens.storeDetach',['trens_id'=>$trem->id])}}" name="excluir" class="btn-xs btn-danger"> <span class="glyphicon glyphicon-trash"></span> </a>
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