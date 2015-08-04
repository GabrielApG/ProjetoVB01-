@extends('app')
@section('content')

    <div class="container">
        <legend>Cadastrar novo Trem para Orçamento</legend><br />


        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['route'=>'trens.store', 'class'=>'form-horizontal']) !!}

        <div class="form-group">
            <label for="nomeCreateTrens" class="col-md-2 control-label">Nome <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                {!! Form::text('nome', null, ['class'=>'form-control', 'id'=>'nomeCreateTrens']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="paisCreateTrens" class="col-md-2 control-label">Pais <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('pais', $paises, null, ['class'=>'form-control', 'id'=>'paisCreateTrens']) !!}
            </div>

            <label for="cidadesidCreateTrens" class="col-md-1 control-label">Cidade <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('cidades_id', [], null, ['class'=>'form-control', 'id'=>'cidadesidCreateTrens']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="destinoCreateTrens" class="col-md-2 control-label">Destino <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-5">
                {!! Form::text('destino', null, ['class'=>'form-control']) !!}
            </div>
        </div>

            {!! Form::hidden('orcamento', 1, ['class'=>'form-control']) !!}

        <div class="form-group">
            <label for="valorCreateTrens" class="col-md-2 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('valor', null, ['class'=>'form-control', 'id'=>'valorCreateTrens']) !!}
            </div>
        </div>
            {!! Form::hidden('numero', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('vagao', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('poltrona', null, ['class'=>'form-control']) !!}
        <br/>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            {{--{!! Form::submit('Salvar', ['class'=>'btn btn-success']) !!}--}}
            <button class="btn btn-success"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </div>
        {!! Form::close() !!}

    </div>
@endsection

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



