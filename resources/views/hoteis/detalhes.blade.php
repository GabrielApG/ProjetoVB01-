@extends('app')
@section('content')
<div class="container">
    <legend><span class="glyphicon glyphicon-king"></span> HOTEIS - {{$clientes->nome}}</legend><br />
    <ul class="nav nav-tabs">
        {{--<li role="presentation"><a href="{{ route('clientes.orcamento',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-usd"></span> Orçamento</a></li>--}}
        <li role="presentation"><a href="{{ route('clientes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-tasks"></span> Pacote</a></li>
        <li role="presentation"><a href="{{ route('clientes.detalhesClientes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span> Inf. Pessoais</a></li>
        <li role="presentation"><a href="{{ route('dependentes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-tags"></span> Dep.</a></li>
        <li role="presentation"><a href="{{ route('relatorios',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-file"></span> Rel.</a></li>
        <li role="presentation"><a href="{{ route('voos.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{ route('transfers.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{route('passeios.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation" class="active"><a href="{{route('hoteis.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{route('extras.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
        <li role="presentation"><a href="{{ route('observacao.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-book"></span> Observações</a></li>
    </ul>
    <br />

        <div class="form-group-xs">
        <a href="{{ route('hoteis.createHotelCliente',['id'=>$clientes->id]) }}" class="btn-sm btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar Hotel</a>
    </div>
    <br/>

    <style>
       #tableHotel {
            font-size: 9px; }

    </style>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="22">Hoteis {{$clientes->nome}}</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Hotel</th>
            <th>N. Reserva</th>
            <th>Telefone</th>
            <th>CEP</th>
            <th>Endereço</th>
            <th>Numero</th>
            <th>Bairro</th>
            <th>Estado</th>
            <th>Status</th>
            <th>Qtd. Adultos</th>
            <th>Qtd. Crianças</th>
            <th>Data Entrada</th>
            <th>Data Saída</th>
            <th>Café Manhã</th>
            <th>Wifi</th>
            <th>Site</th>
            <th>Diárias</th>
            <th>Valor</th>
            <th>Valor Extra</th>
            <th colspan="2">Ações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($clientes->hoteis as $h)
            <?php if($h->orcamento == 0){?>
            <tr class="text-center" style="font-size:11px;">
                <td id="tableHotel">{{$h->id}}</td>
                <td id="tableHotel">{{$h->nome}}</td>
                <td id="tableHotel">{{$h->num_reserva}}</td>
                <td id="tableHotel">{{$h->telefone}}</td>
                <td id="tableHotel">{{$h->cep}}</td>
                <td id="tableHotel">{{$h->endereco}}</td>
                <td id="tableHotel">{{$h->numero}}</td>
                <td id="tableHotel">{{$h->bairro}}</td>
                <td id="tableHotel">{{$h->estado}}</td>
                <td id="tableHotel">{{$h->status}}</td>
                <td id="tableHotel">{{$h->qtd_adultos}}</td>
                <td id="tableHotel">{{$h->qtd_criancas}}</td>
                <td id="tableHotel">{{$h->data_entrada}}</td>
                <td id="tableHotel">{{$h->data_saida}}</td>
                <td id="tableHotel">{{$h->cafe_manha}}</td>
                <td id="tableHotel">{{$h->wifi}}</td>
                <td id="tableHotel">{{$h->site}}</td>
                <td id="tableHotel">{{$h->diarias}}</td>
                <td id="tableHotel">{{$h->valor}}</td>
                <td id="tableHotel">{{$h->valor_extra}}</td>
                <td class="acoes">
                    <a href="{{ route('hoteis.editHotelCliente',['id'=>$h->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td class="acoes">
                   <a href="{{route('hoteis.storeDetach',['hoteis_id'=>$h->id])}}" name="excluir" class="btn-xs btn-danger"> <span class="glyphicon glyphicon-trash"></span> </a>
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