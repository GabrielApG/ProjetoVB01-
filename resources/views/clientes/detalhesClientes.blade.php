@extends('app')

@section('content')
<div class="container">
    <legend><span class="glyphicon glyphicon-user"></span> INFORMAÇÕES PESSOAIS - {{$clientes->nome}}</legend><br />

    <ul class="nav nav-tabs">
        {{--<li role="presentation"><a href="{{ route('clientes.orcamento',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-usd"></span> Orçamento</a></li>--}}
        <li role="presentation"><a href="{{ route('clientes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-tasks"></span> Pacote</a></li>
        <li role="presentation" class="active"><a href="{{ route('clientes.detalhesClientes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span> Inf. Pessoais</a></li>
        <li role="presentation"><a href="{{ route('dependentes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span> Dep.</a></li>
        <li role="presentation"><a href="{{ route('voos.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{route('transfers.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{route('passeios.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{route('hoteis.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{route('extras.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
        <li role="presentation"><a href="{{ route('observacao.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-book"></span> Observações</a></li>
        <li role="presentation"><a href="{{ route('relatorios',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-file"></span> Relatórios</a></li>
    </ul>
    <br />
    <!--btn para acesso de detalhamento-->
    <div class="form-group">
        <a href="{{ route('clientes.edit',['id'=>$clientes->id]) }}" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span>  Editar Dados</a>
    </div>


    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    <h4>Dados para contato</h4>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Nome</th>
            <th>Telefone </th>
            <th>Email</th>
        </tr>
        <tr class="text-center">
            <td>{{$clientes->nome}}</td>
            <td>{{$clientes->telefone}}</td>
            <td>{{$clientes->email}}</td>
        </tr>
    </table>
    <h4>Moradia</h4>
     <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>CEP</th>
            <th>Endereço</th>
            <th>Numero </th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>País</th>
        </tr>
         <tr class="text-center">
            <td>{{$clientes->cep}}</td>
            <td>{{$clientes->endereco}}</td>
            <td>{{$clientes->numero}}</td>
            <td>{{$clientes->bairro}}</td>
            <td>{{$clientes->cidade}}</td>
            <td>{{$clientes->estado}}</td>
            <td>{{$clientes->pais}}</td>
        </tr>
    </table>

    <h4>Dados pessoais</h4>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Data Nascimento</th>
            <th>CPF</th>
            <th>Identidade </th>
            <th>Orgão Emissor</th>
            <th>Data Expedição</th>
            <th>Numero Passaporte</th>
            <th>Data Emissão Passaporte</th>
            <th>Validade Passaporte</th>
        </tr>
        <tr class="text-center">
            <td>{{$clientes->data_nasc}}</td>
            <td>{{$clientes->cpf}}</td>
            <td>{{$clientes->identidade}}</td>
            <td>{{$clientes->orgao_emissor}}</td>
            <td>{{$clientes->data_exp}}</td>
            <td>{{$clientes->num_passaporte}}</td>
            <td>{{$clientes->data_emissao_passaporte}}</td>
            <td>{{$clientes->validade_passaporte}}</td>
        </tr>
    </table>

    <h4>Paternidade</h4>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Nome Pai</th>
            <th>Nome Mãe</th>
        </tr>
        <tr class="text-center">
            <td>{{$clientes->nome_pai}}</td>
            <td>{{$clientes->nome_mae}}</td>
        </tr>
    </table>

    

</div>
@endsection