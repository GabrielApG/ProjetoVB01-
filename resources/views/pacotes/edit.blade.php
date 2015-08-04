@extends('app')
@section('content')
    <div class="container">
        <legend>Editar Pacote - {{$pacotes->nome}}</legend><br />

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {!! Form::open(['route'=>['pacotes.update', $pacotes->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

        <div class="form-group">
            <label for="nomedacategoriaEditPacotes" class="col-md-2 control-label">Nome da categoria <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('categorias_id', $categorias, $pacotes->categorias->id, ['class'=>'form-control', 'id'=>'nomedacategoriaEditPacotes']) !!}
            </div>

            <label for="nomedopacoteEditPacotes" class="col-md-2 control-label">Nome do pacote<span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                {!! Form::text('nome', $pacotes->nome, ['class'=>'form-control', 'id'=>'nomedopacoteEditPacotes']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="descricaoEditPacotes" class="col-md-2 control-label">Descrição <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                {!! Form::textArea('descricao', $pacotes->descricao, ['class'=>'form-control', 'id'=>'descricaoEditPacotes']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="precoEditPacotes" class="col-md-2 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('valor', $pacotes->valor, ['class'=>'form-control', 'id'=>'precoEditPacotes']) !!}
            </div>
        </div>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><<   Voltar</a>
            {!! Form::submit('Criar Pacote', ['class'=>'btn btn-success']) !!}
        </div>

        {!! Form::close() !!}

    </div>
@endsection




