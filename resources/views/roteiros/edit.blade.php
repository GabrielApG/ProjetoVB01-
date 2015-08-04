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


    {!! Form::open(['route'=>['roteiros.updateRoteiro', $roteiros->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

    <div class="form-group">
        <label for="nomeCreateTrens" class="col-md-2 control-label">Nome <span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-8">
            <input type="text" name="nome" id="nome" value="{{$roteiros->nome}}" class="form-control"/>
        </div>
    </div>

    <div class="form-group">
        <label for="paisCreateVooOrc" class="col-md-2 control-label">País <span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-2">
            <input class="form-control" name="cidades_id" id="cidades_id" value="{{$roteiros->cidades->id}}" type="hidden">
            <input class="form-control" name="pais" id="pais" value="{{$roteiros->cidades->codigo_pais}}" readonly>
        </div>

        <label for="cidadeidCreateVooOrc" class="col-md-2 control-label">Cidade <span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-2">
            <input class="form-control" name="cidades" id="cidades" value="{{$roteiros->cidades->nome}}" readonly>
        </div>
    </div>

    <div class="form-group">
        <label for="precoCreateTranferCliente" class="col-md-2 control-label">Data<span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-2">
            <input type="text" name="data" id="data" class="form-control" placeholder="99/99/9999" value="{{$roteiros->data}}"/>
        </div>
    </div>

    <div class="form-group">
        <label for="descricaoCreatePacotes" class="col-md-2 control-label">Descrição <span class="campo_obrigatorio">*</span></label>
        <div class="col-sm-8">
            <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control">{{$roteiros->descricao}}</textarea>
        </div>
    </div>

    {!! Form::hidden('orcamento', 1, ['class'=>'form-control']) !!}

    <div class="form-group">
        <a onclick="goBack()" class="btn btn-primary"><<   Voltar</a>
        {!! Form::submit('Salvar Roteiro', ['class'=>'btn btn-success']) !!}
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




