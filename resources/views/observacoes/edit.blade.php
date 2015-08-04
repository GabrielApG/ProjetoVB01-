@extends('app')

 @section('content')
 <div class="container">
	 <h3>Editando Observação</h3>
	
	@if ($errors->any())
	 <ul class="alert alert-warning">
		 @foreach($errors->all() as $error)
			 <li>{{ $error }}</li>
		 @endforeach
	 </ul>
	@endif

     {!! Form::open(['route'=>['observacao.update', $obs->id], 'method'=>'put']) !!}

		 <!-- Descricao Form Input -->
		 <div class="form-group">
		 {!! Form::label('observacao', 'Observacao:') !!}
		 {!! Form::textarea('observacao', $obs->observacao, ['class'=>'form-control']) !!}
		 </div>

     {!! Form::hidden('clientes_id', $obs->clientes_id, ['class'=>'form-control']) !!}

     <div class="form-group">
         <div class="col-sm-2">
             <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
         </div>

         <div class="col-sm-2">
             <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
         </div>
         <br/><br/>
     </div>

 {!! Form::close() !!}

 </div>
@endsection




