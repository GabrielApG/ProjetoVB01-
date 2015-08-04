@extends('app')

@section('content')
<div class="container">
    <h1>Situações:</h1>

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    {!! Form::open(['route'=>'situacao.store']) !!}
    <!-- Nome Form Input -->
    <div class="form-group">
        {!! Form::label('nome', 'Situação:') !!}
        {!! Form::text('nome', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <a onclick="goBack()" class="btn btn-primary"><<   Voltar</a>
        {!! Form::submit('Criar Situação', ['class'=>'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}

</div>
@endsection




