@extends('app')
@section('content')

    <div class="container">
    <legend>Editando Serviços Extras - {{$clientes->nome}}</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

        {!! Form::open(['route'=>['extras.update', $extras->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

            {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
            <input name="nome" id="nome" class="form-control" type="hidden" readonly >

        <div class="form-group">
            <label for="precoCreateTranferCliente" class="col-md-2 control-label">Nome <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-5">
                <input name="nome" id="nome" class="form-control" value="{{$extras->nome}}" type="hidden">
            </div>
        </div>

            <input name="cidades_id" id="cidades_id" class="form-control" type="hidden" value="{{$extras->cidades->id}}">

        <div class="form-group">
            <label for="nomeCreateTranferCliente" class="col-md-2 control-label">Data de ida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="data_saida" id="data_saida" class="form-control" value="{{$extras->data_saida}}">
            </div>

            <label for="horadeidaCreateTranferCliente" class="col-md-1 control-label">Hora de ida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="hora_ida" id="hora_ida" class="form-control" value="{{$extras->hora_ida}}">
            </div>
        </div>

        <div class="form-group">
            <label name="preco" id="preco" class="col-md-2 control-label">Preço R$: </label>
            <div class="col-sm-2">
                <input name="valor" id="valor" class="form-control" value="{{$extras->valor}}">
            </div>
        </div>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
        </div>
        {!! Form::close() !!}
</div>
@endsection



