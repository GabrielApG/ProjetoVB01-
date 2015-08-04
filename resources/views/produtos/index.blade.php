<html>
 <head>
 	<title>Produtos</title>
 </head>

 <body>

 <!--<h1>Produtos </h1>-->

<ul> UTILIZANDO TAGS PHP
	<?php //foreach($produtos as $produto): ?>
		<li>
			<?php //echo $produto->nome; ?> (<?php// echo $produto->descricao;?>)
		</li>
	<?php //endforeach; ?>
</ul>

<!-- UTILIZANDO TAGS DO BLADE-->
<!--<ul>
 @foreach($produtos as $produto)
 	<li>{{ $produto->nome }} <br>
 		{{ $produto->descricao }}</li>
 @endforeach
</ul>-->

<!--<h1>Aqui começa o templete utilizando nativo do laravel 5 </h1>-->

@extends('app') 

 @section('content')
 <div class="container">
	 <h1>Produtos</h1>
	 	<h3><a href="{{ route('produtos.create') }}"  class="btn-sm btn-success">Adicionar</a> </h3>
		 <table class="table table-striped table-bordered table-hover">
		<thead>
		 <tr>
		 	<th>ID</th>
		 	<th>Nome</th>
		 	<th>Descricao</th>
		 	<th>Ação</th>
		 </tr>
		</thead>
		<tbody>
		
		@foreach($produtos as $produto)

	<tr>
		<td>{{ $produto->id }}</td>
		<td>{{ $produto->nome }}</td>
		<td>{{ $produto->descricao}}</td>
		<td>
			<a href="{{ route('produtos.edit',['id'=>$produto->id]) }}" class="btn-sm btn-success">Editar</a>
			<a href="{{ route('produtos.destroy',['id'=>$produto->id]) }}" class="btn-sm btn-danger">Remover</a>

		</td>
	</tr>

		@endforeach

		</tbody>
		</table>

 </div>
 @endsection

 </body>

<html>