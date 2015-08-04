@extends('app')
@section('content')

    <div class="container">
        <legend>Criar novo Hotel</legend><br /> 
        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['route'=>'hoteis.store', 'class'=>'form-horizontal']) !!}

        <div class="form-group">
            <label for="nomeCreateHoteis" class="col-md-2 control-label">Nome Hotel <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                {!! Form::text('nome', null, ['class'=>'form-control', 'id'=>'nomeCreateHoteis']) !!}
            </div>
        </div>

        <div class="form-group">        
            <label for="paisCreateHoteis" class="col-md-2 control-label">País <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('pais', $paises, null, ['class'=>'form-control', 'id'=>'paisCreateHoteis']) !!}
            </div>

            <label for="cidadesidCreateHoteis" class="col-md-1 control-label">Cidades <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('cidades_id', [], null, ['class'=>'form-control', 'id'=>'cidadesidCreateHoteis']) !!}
            </div>

            <label for="ValorCreateHoteis" class="col-md-1 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('valor', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        

            {!! Form::hidden('orcamento', 1, ['class'=>'form-control']) !!}
    
        
        <br/>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button class="btn btn-success"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </div>
        {!! Form::close() !!}

    </div>


@section('post-script')
    <script type="text/javascript">
        $('select[name=pais]').change(function () {
            var idPais = $(this).val();

            $.get('/get-cidades/' + idPais, function (cidades_id) {
                $('select[name=cidades_id]').empty();
                $.each(cidades_id, function (key, value) {
                    $('select[name=cidades_id]').append('<option value=' + value.id + '>' + value.nome + '</option>');
                });
            });
        });
    </script>
@endsection
@endsection



