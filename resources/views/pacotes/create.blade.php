@extends('app')

@section('content')
<div class="container">
     <legend>Cadastro de Pacote</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    {!! Form::open(['route'=>'pacotes.store', 'class'=>'form-horizontal']) !!}

    <div class="form-group">
        <label for="nomedacategoriaCreatePacotes" class="col-md-2 control-label">Nome da categoria <span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-2">
            {!! Form::select('categorias_id', $categoria, null, ['class'=>'form-control', 'id'=>'nomedacategoriaCreatePacotes']) !!}
        </div>

        <label for="nomedopacoteCreatePacotes" class="col-md-2 control-label">Nome do pacote<span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-4">
            {!! Form::text('nome',null, ['class'=>'form-control', 'id'=>'nomedopacoteCreatePacotes']) !!}
        </div>
    </div>

    <div class="form-group">
        <label for="descricaoCreatePacotes" class="col-md-2 control-label">Descrição <span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-8">
            {!! Form::textArea('descricao',null, ['class'=>'form-control', 'id'=>'descricaoCreatePacotes']) !!}
        </div>
    </div>

    <div class="form-group">
        <label for="precoCreatePacotes" class="col-md-2 control-label">Preço <span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-2">
            {!! Form::text('valor', null, ['class'=>'form-control', 'id'=>'precoCreatePacotes']) !!}
        </div>
    </div>

    
    <div class="form-group">
        <a onclick="goBack()" class="btn btn-primary"><<   Voltar</a>
        {!! Form::submit('Criar Pacote', ['class'=>'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}

</div>
@endsection




