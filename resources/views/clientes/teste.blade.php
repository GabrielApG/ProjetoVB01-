<html>
<head>
    <title>Clientes</title>
</head>
<body>
@extends('app')
@section('content')

    @foreach($clientes as $c)
        {{ $c->nome }}
    @endforeach
@endsection

</body>
<html>