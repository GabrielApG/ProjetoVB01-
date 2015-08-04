@extends('app')
@section('content')

    <div class="container">
    <legend>Cadastrar novo Trem - {{$clientes->nome}}</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

        {!! Form::open(['route'=>['trens.updateOrcamento', $trens->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

        {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}

        <div class="form-group">
            <label for="precoCreateTranferCliente" class="col-md-2 control-label">Nome do Trem<span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-5">
                <input name="nome" id="nome" class="form-control" value="{{$trens->nome}}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Destino <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
                <input name="destino" id="destino" class="form-control" value="{{$trens->destino}}" readonly>
            </div>
        </div>

            {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
            <input name="cidades_id" id="cidades_id" class="form-control" value="{{$trens->cidades->id}}" type="hidden">

        <div class="form-group">
            <label for="valorCreateTremCliente" class="col-md-2 control-label">Valor <span class="campo_obrigatorio" >*</span></label>
            <div class="col-sm-2">
                <input name="valor" id="valor" class="form-control" value="{{$trens->valor}}" readonly>
            </div>
        </div>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            {{--{!! Form::submit('Salvar', ['class'=>'btn btn-success','id'=>'submit']) !!}--}}
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
        </div>
        {!! Form::close() !!}
</div>
@endsection



