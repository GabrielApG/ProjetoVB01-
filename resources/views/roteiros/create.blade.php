@extends('app')

@section('content')
<div class="container">
     <legend>Cadastro de Roteiros</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    {!! Form::open(['route'=>'roteiros.store', 'class'=>'form-horizontal']) !!}

    <div class="form-group">
        <label for="nomedacategoriaCreatePacotes" class="col-md-2 control-label">Selecione o Pais <span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-2">
            {!! Form::select('pais', $paises, null, ['class'=>'form-control', 'id'=>'nomedacategoriaCreatePacotes']) !!}
        </div>
        </div>

    <div class="form-group">
        <label for="nomedacategoriaCreatePacotes" class="col-md-2 control-label">Selecione a Cidade<span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-2">
            {!! Form::select('cidades_id', [], null, ['class'=>'form-control', 'id'=>'nomedacategoriaCreatePacotes']) !!}
        </div>
    </div>

    <div class="form-group">
        <label for="nomedopacoteCreatePacotes" class="col-md-2 control-label">Insira o nome do Roteiro<span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-4">
            {!! Form::text('nome',null, ['class'=>'form-control', 'id'=>'nomedopacoteCreatePacotes']) !!}
        </div>
    </div>

    <div class="form-group">
        <label for="descricaoCreatePacotes" class="col-md-2 control-label">Descrição <span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-8">
            {!! Form::textArea('descricao',null, ['class'=>'form-control', 'id'=>'descricaoCreatePacotes']) !!}
        </div>
    </div>

    {!! Form::hidden('orcamento', 1, ['class'=>'form-control']) !!}

    <div class="form-group">
        <a onclick="goBack()" class="btn btn-primary"><<   Voltar</a>
        {!! Form::submit('Criar Roteiro', ['class'=>'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}

</div>
@section('post-script')
    <!--Java Script preenchimento Cidades-->
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

        <!-- Java Script preenchimento TRENS-->
        $('select[name=cidades_id]').change(function () {
            var idCidade = $(this).val();

            $.get('/get-trens/' + idCidade, function (trens_id) {
                $('select[name=trens_id]').empty();
                $('text[name=valor]').empty();
                $('text[name=destino]').empty();
                $('text[name=empresa]').empty();
                $.each(trens_id, function (key, value) {
                    $('select[name=trens_id]').append('<option value=' + value.id + '>' + value.nome + '</option>');
                });
            });
        });

        <!-- Java Script preenchimento Preco TREM-->
        $('select[name=trens_id]').change(function () {
            var idTrem = $(this).val();
            $('select[name=valor]').empty();
            $.get('/get-valor/' + idTrem, function (valor) {
                $.each(valor, function (key, value) {
                    $('text[name=valor]').append('<a value=' + value.id + '>' + value.valor + '</a>');
                    $('text[name=destino]').append('<a value=' + value.id + '>' + value.destino + '</a>');
                    $('text[name=empresa]').append('<a value=' + value.id + '>' + value.empresa_trem + '</a>');
                });
            });
        });

    </script>
@endsection
@endsection




