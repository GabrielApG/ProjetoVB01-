@extends('app')

@section('content')
<div class="container">
    <h1>Editar Situação:</h1>

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>

    @endif
    {!! Form::open(['route'=>['situacao.update', $situacao->id], 'method'=>'put']) !!}

    <!-- Nome Form Input -->
    <div class="form-group">
        {!! Form::label('situacao', 'Situação:') !!}
        {!! Form::text('nome', $situacao->nome, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <a onclick="goBack()" class="btn btn-info"><<  Voltar</a>
        {!! Form::submit('Salvar Edição', ['class'=>'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}

</div>
@endsection