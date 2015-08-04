@extends('app')
@section('content')
<div class="container">
    <legend><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"> </span> DEPENDENTES - {{$clientes->nome}}</legend><br />
    <ul class="nav nav-tabs">
        {{--<li role="presentation"><a href="{{ route('clientes.orcamento',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-usd"></span> Orçamento</a></li>--}}
        <li role="presentation"><a href="{{ route('clientes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-tasks"></span> Pacote</a></li>
        <li role="presentation"><a href="{{ route('clientes.detalhesClientes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span> Inf. Pessoais</a></li>
        <li role="presentation" class="active"><a href="{{ route('dependentes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span> Dep.</a></li>
        <li role="presentation"><a href="{{ route('relatorios',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-file"></span> Rel.</a></li>
        <li role="presentation"><a href="{{ route('voos.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{ route('transfers.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{route('passeios.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{route('hoteis.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{route('extras.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
    </ul>
    <br />
    <div class="form-group-xs">
        <a href="{{ route('dependentes.createDependentesCliente',['id'=>$clientes->id]) }}" class="btn-sm btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar Dependente</a>
    </div>
    <br/>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="21">Dependentes Cadastrados</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tel.</th>
            <th>D. Nasc.</th>
            <th>E-mail</th>
            <th>CEP</th>
            <th>End.</th>
            <th>Num.</th>
            <th>Bairro</th>
            <th>CPF</th>
            <th>R.G.</th>
            <th>Org. Emissor</th>
            <th>D. Exp.</th>
            <th>N. Pass.</th>
            <th>D. Emis. Pass.</th>
            <th>V. Pass.</th>
            <th>N. Pai</th>
            <th>N. Mãe</th>
            <th>Lembrete</th>
            <th colspan="2">Ações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($clientes->dependentes as $d)
            <tr class="text-center" style="font-size:9px;">
                <td>{{ $d->id }}</td>
                <td>{{$d->nome}}</td>
                <td>{{$d->telefone}}</td>
                <td>{{$d->data_nasc}}</td>
                <td>{{$d->email}}</td>
                <td>{{$d->cep}}</td>
                <td>{{$d->endereco}}</td>
                <td>{{$d->numero}}</td>
                <td>{{$d->bairro}}</td>
                <td>{{$d->cpf}}</td>
                <td>{{$d->identidade}}</td>
                <td>{{$d->orgao_emissor}}</td>
                <td>{{$d->data_exp}}</td>
                <td>{{$d->num_passaporte}}</td>
                <td>{{$d->data_emissao_passaporte}}</td>
                <td>{{$d->validade_passaporte}}</td>
                <td>{{$d->nome_pai}}</td>
                <td>{{$d->nome_mae}}</td>
                <td>{{$d->lembretes}}</td>
                <td>
                    <a href="{{route('dependentes.edit',['dependentes'=>$d->id])}}" class="btn-sm btn-warning"> <span class="glyphicon glyphicon-pencil"></span> </a>
                </td>

                <td>
                    <a href="{{route('dependentes.destroy',['dependentes'=>$d->id])}}" name="excluir" class="btn-sm btn-danger"> <span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
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