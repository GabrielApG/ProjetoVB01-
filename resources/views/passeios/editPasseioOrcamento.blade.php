@extends('app')
@section('content')

    <div class="container">
    
    <legend> Editando Passeio - {{$clientes->nome}}</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

        {!! Form::open(['route'=>['passeios.updateOrcamento', $passeios->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

        <div class="form-group">
            <label for="passeiosidCreatePasseiosCliente" class="col-md-2 control-label">Passeios Disponíveis <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                <input name="nome" id="nome" class="form-control" value="{{$passeios->nome}}" readonly>
            </div>
            <!-- campo oculto -->
            {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
            <input name="cidades_id" id="cidades_id" class="form-control" type="hidden" value="{{$passeios->cidades->id}}" >
        </div>

        <div class="form-group">
            <label for="descricaoCreatePacotes" class="col-md-2 control-label">Descrição <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                <textarea class="form-control" name="descricao" id="descricao" readonly> {{$passeios->descricao}}</textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label for="empresaCreatePasseiosCliente" class="col-md-2 control-label">Empresa<span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                <input name="empresa_passeio" id="empresa_passeio" class="form-control" value="{{$passeios->empresa_passeio}}" readonly>
            </div>

            <label for="pontodepartidaCreatePasseiosCliente" class="col-md-2 control-label">Ponto de Partida </label>
            <div class="col-sm-2">
                <input name="ponto_partida" id="ponto_partida" class="form-control" value="{{$passeios->ponto_partida}}" readonly>
            </div>
        </div>

        <div class="form-group">
             <label for="precoCreatePasseiosCliente" class="col-md-2 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="valor" id="valor" class="form-control" value="{{$passeios->valor}}" readonly>
            </div>
        </div>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </div>
        {!! Form::close() !!}
</div>
@endsection
