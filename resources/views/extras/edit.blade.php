@extends('app')
@section('content')

    <div class="container">
        <legend>Cadastrar novo Extra para Ciclo de Orçamento</legend><br />

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['route'=>['extras.updateExtra', $extras->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

        <div class="form-group">
            <label for="nomeCreateTrens" class="col-md-2 control-label">Nome <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                <input type="text" name="nome" id="nome" value="{{$extras->nome}}" class="form-control"/>
            </div>
        </div>

        <div class="form-group">
            <label for="paisCreateVooOrc" class="col-md-2 control-label">País <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="cidades_id" id="cidades_id" value="{{$extras->cidades->id}}" type="hidden">
                <input class="form-control" name="pais" id="pais" value="{{$extras->cidades->codigo_pais}}" readonly>
            </div>

            <label for="cidadeidCreateVooOrc" class="col-md-2 control-label">Cidade <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="cidades" id="cidades" value="{{$extras->cidades->nome}}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="paisCreateTransfers" class="col-md-2 control-label">Tipo <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input type="text" name="tipo" id="tipo" value="{{$extras->tipo}}" class="form-control"/>
            </div>

            <label for="paisCreateTransfers" class="col-md-2 control-label">Destino <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input type="text" name="destino" id="destino" value="{{$extras->destino}}" class="form-control"/>
            </div>
        </div>

        <div class="form-group">
            <label for="paisCreateTransfers" class="col-md-2 control-label">Empresa <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input type="text" name="empresa_extra" id="empresa_extra" value="{{$extras->empresa_extra}}" class="form-control"/>
            </div>

            <label for="valortransferCreateTransfers" class="col-md-2 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input type="text" name="valor" id="valor" value="{{$extras->valor}}" class="form-control"/>
            </div>
        </div>

            {!! Form::hidden('orcamento', 1, ['class'=>'form-control']) !!}
            {!! Form::hidden('hora_ida', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('data_saida', null, ['class'=>'form-control']) !!}
        
        <br/>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
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



