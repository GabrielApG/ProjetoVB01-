@extends('app')
@section('content')

    <div class="container">
    <legend>Cadastrar novo Transfer - {{$clientes->nome}}</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif


        {!! Form::open(['route'=>['transfers.update', $transfer->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

            {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}

        <div class="form-group">
            <label for="precoCreateTranferCliente" class="col-md-2 control-label">Nome <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-5">
                <input class="form-control" id="nome" name="nome" value="{{$transfer->nome}}" readonly/>
            </div>
        </div>

            <input name="cidades_id" id="cidades_id" class="form-control" type="hidden" value="{{$transfer->cidades->id}}">

        <div class="form-group">
            <label for="nomeCreateTranferCliente" class="col-md-2 control-label">Data de ida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" id="data_ida" name="data_ida" value="{{$transfer->data_ida}}"/>
            </div>

            <label for="horadeidaCreateTranferCliente" class="col-md-1 control-label">Hora de ida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" id="hora_ida" name="hora_ida" value="{{$transfer->hora_ida}}"/>
            </div>
        </div>

        <div class="form-group">
            <label name="preco" id="preco" class="col-md-2 control-label">Preço R$: </label>
            <div class="col-sm-2">
                <input name="valor" id="valor" class="form-control" value="{{$transfer->valor}}">
            </div>
        </div>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
        </div>
        {!! Form::close() !!}
</div>

@endsection



