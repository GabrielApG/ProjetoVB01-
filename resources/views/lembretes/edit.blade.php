@extends('app')

 @section('content')
 <div class="container">
	 <h1>Editando Nota</h1>
	
	@if ($errors->any())
	 <ul class="alert alert-warning">
		 @foreach($errors->all() as $error)
			 <li>{{ $error }}</li>
		 @endforeach
	 </ul>
	@endif

     {!! Form::open(['route'=>['lembretes.update', $lembretes->id], 'method'=>'put']) !!}

     <!-- Nome Form Input -->
		 <div class="form-group">
		 {!! Form::label('titulo', 'Titulo:') !!}
		 {!! Form::text('titulo', $lembretes->titulo, ['class'=>'form-control']) !!}
		 </div>

		 <!-- Descricao Form Input -->
		 <div class="form-group">
		 {!! Form::label('descricao', 'Descrição:') !!}
		 {!! Form::textarea('descricao', $lembretes->descricao, ['class'=>'form-control']) !!}
		 </div>

     <div class="form-group">
         <div class="col-sm-2">
             <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
         </div>


         <div class="col-sm-2">
             <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
         </div>
     </div>

 {!! Form::close() !!}

 </div>
@endsection




