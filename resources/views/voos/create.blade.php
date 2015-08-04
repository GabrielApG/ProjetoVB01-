@extends('app')
@section('content')

    <div class="container">
        <legend>Cadastrar novo Voo para Orçamento</legend><br />

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="alert alert-warning" role="alert">
            <strong>ATENÇÃO! O valor</strong> do voo deverá ser preenchido no ato do orçamento.
        </div>

        {!! Form::open(['route'=>'voos.store', 'class'=>'form-horizontal']) !!}
        <div class="form-group">
            <label for="nomedovooCreateVooOrc" class="col-md-2 control-label">Nome do Voo <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                {!! Form::text('nome_voo', null, ['class'=>'form-control', 'id'=>'nomedovooCreateVooOrc']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="paisCreateVooOrc" class="col-md-2 control-label">País <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('pais', $paises, null, ['class'=>'form-control', 'id'=>'paisCreateVooOrc']) !!}
            </div>

            <label for="cidadeidCreateVooOrc" class="col-md-2 control-label">Cidade <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('cidades_id', [], null, ['class'=>'form-control', 'id'=>'cidadeidCreateVooOrc']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="localembCreateVooOrc" class="col-md-2 control-label">Local de Embarque <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('local_emb', null, ['class'=>'form-control', 'id'=>'localembCreateVooOrc']) !!}
            </div>

            <label for="localdesCreateVooOrc" class="col-md-2 control-label">Local de Desembarque <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('local_des', null, ['class'=>'form-control', 'id'=>'localdesCreateVooOrc']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="paisCreateVooOrc" class="col-md-2 control-label">Valor: </label>
            <div class="col-sm-2">
                {!! Form::text('valor', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::hidden('orcamento', 1, ['class'=>'form-control']) !!}
        </div>

            {!! Form::hidden('data_ida', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('data_volta', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('hora_ida', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('hora_volta', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('empresa_voo', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('num_bilhete', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('poltrona', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('num_voo', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('escalas', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('observacao', null, ['class'=>'form-control']) !!}

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



