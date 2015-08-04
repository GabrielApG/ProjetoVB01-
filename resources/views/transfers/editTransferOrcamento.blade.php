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

        {!! Form::open(['route'=>['transfers.updateOrcamento', $transfer->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}


        <div class="form-group">
            <label for="precoCreateTranferCliente" class="col-md-2 control-label">Nome <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-5">
                <input name="nome" id="nome" class="form-control" value="{{$transfer->nome}}" readonly >
            </div>
        </div>

            <input name="cidades_id" id="cidades_id" class="form-control" type="hidden" value="{{$transfer->cidades->id}}">

        <div class="form-group">
            <label name="preco" id="preco" class="col-md-2 control-label">Preço R$: </label>
            <div class="col-sm-2">
            <input name="valor" id="valor" class="form-control" value="{{$transfer->valor}}" readonly>
            </div>
        </div>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
        </div>
        {!! Form::close() !!}
</div>
@endsection



