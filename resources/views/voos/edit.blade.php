@extends('app')
@section('content')

    <div class="container">
        <legend>Editando dados do Voo para Orçamento</legend><br />

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

        {!! Form::open(['route'=>['voos.updateVoo', $voos->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

        <div class="form-group">
            <label for="nomedovooCreateVooOrc" class="col-md-2 control-label">Nome do Voo <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                <input class="form-control" name="nome_voo" id="nome_voo" value="{{$voos->nome_voo}}">
            </div>
        </div>

        <div class="form-group">
            <label for="paisCreateVooOrc" class="col-md-2 control-label">País <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="cidades_id" id="cidades_id" value="{{$voos->cidades->id}}" type="hidden">
                <input class="form-control" name="pais" id="pais" value="{{$voos->cidades->codigo_pais}}" readonly>
            </div>

            <label for="cidadeidCreateVooOrc" class="col-md-2 control-label">Cidade <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="cidades" id="cidades" value="{{$voos->cidades->nome}}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="localembCreateVooOrc" class="col-md-2 control-label">Local de Embarque <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="local_emb" id="local_emb" value="{{$voos->local_emb}}">
            </div>

            <label for="localdesCreateVooOrc" class="col-md-2 control-label">Local de Desembarque <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="local_des" id="local_des" value="{{$voos->local_des}}">
            </div>
        </div>

        <div class="form-group">
            <label for="paisCreateVooOrc" class="col-md-2 control-label">Valor: </label>
            <div class="col-sm-2">
                <input class="form-control" name="valor" id="valor" value="{{$voos->valor}}">
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



