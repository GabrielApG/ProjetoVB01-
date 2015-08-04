@extends('app')
@section('content')
    <div class="container">
        <h1>Editar Categorias:</h1>

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['route'=>['categoria.update', $categorias->id], 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::text('nome', $categorias->nome, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><<   Voltar</a>
            {!! Form::submit('Criar Categoria', ['class'=>'btn btn-success']) !!}
        </div>

        {!! Form::close() !!}

    </div>
@endsection




