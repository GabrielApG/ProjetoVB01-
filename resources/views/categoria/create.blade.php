@extends('app')
@section('content')
<div class="container">
    <h1>Categorias:</h1>

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    {!! Form::open(['route'=>'categoria.store']) !!}

    <div class="form-group">
        {!! Form::label('nome', 'Nome Categoria:') !!}
        {!! Form::text('nome', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <a onclick="goBack()" class="btn btn-primary"><<   Voltar</a>
        {!! Form::submit('Salvar Categoria', ['class'=>'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}

</div>
@endsection




