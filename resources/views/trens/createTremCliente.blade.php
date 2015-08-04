@extends('app')
@section('content')

    <div class="container">
    <legend>Cadastrar novo Trem - {{$cliente->nome}}</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

        {!! Form::open(['route'=>['trens.storeAttach'], 'class'=>'form-horizontal', 'method'=>'post']) !!}

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Trens Disponíveis <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
                {!! Form::select('trens_id', array('0' => 'Selecione') + $trem, '0', ['class'=>'form-control','id'=>'trens_id'])!!}
            </div>
        </div>

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Destino <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
                <input name="destino" id="destino" class="form-control" readonly>
            </div>
        </div>

            {!! Form::hidden('clientes_id', $cliente->id, ['class'=>'form-control']) !!}
            <input name="nome" id="nome" class="form-control" type="hidden" readonly >

            <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">

        <div class="form-group">
            <label for="empresatremCreateTremCliente" class="col-md-2 control-label">Empresa do Trem <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
                {!! Form::text('empresa_trem', null, ['class'=>'form-control', 'id'=>'empresatremCreateTremCliente']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Data da saida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('data_saida', null, ['class'=>'form-control', 'id'=>'data_saida']) !!}
            </div>

            <label for="horaidaCreateTremCliente" class="col-md-2 control-label">Horário de Ida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('hora_ida', null, ['class'=>'form-control', 'id'=>'hora_ida']) !!} <br/>
            </div>
        </div>

        <div class="form-group">
            <label for="numeroCreateTremCliente" class="col-md-2 control-label">Número <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('numero', null, ['class'=>'form-control', 'id'=>'numeroCreateTremCliente']) !!}
            </div>

            <label for="vagaoCreateTremCliente" class="col-md-1 control-label">Vagão <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-1">
                {!! Form::text('vagao', null, ['class'=>'form-control', 'id'=>'vagaoTremCreateCliente']) !!}
            </div>

            <label for="poltronaCreateTremCliente" class="col-md-1 control-label">Poltrona <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-1">
                {!! Form::text('poltrona', null, ['class'=>'form-control', 'id'=>'poltronaCreateTremCliente']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="valorCreateTremCliente" class="col-md-2 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('valor', null, ['class'=>'form-control', 'id'=>'valor']) !!}
            </div>
        </div>

        <div class="form-group">
            
        </div>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            {{--{!! Form::submit('Salvar', ['class'=>'btn btn-success','id'=>'submit']) !!}--}}
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
        </div>
        {!! Form::close() !!}
</div>
@endsection


@section('post-script')
    <!--Java Script preenchimento Cidades-->
    <script type="text/javascript">

        $("#submit").hide(); // Inicia com btn OCULTO

        /*$('select[name=pais]').change(function () {
            var idPais = $(this).val();

            $.get('/get-cidades/' + idPais, function (cidades_id) {
                $('select[name=cidades_id]').empty();//.append('<option value=' + 0 + '>Selecione</option>');
                $('select[name=cidades_id]').append('<option value=' + 0 + '>Selecione...</option>');
                $('select[name=trens_id]').empty();
                $('select[name=valor]').empty();
                $('select[name=destino]').empty();
                $('select[name=empresa_trem]').empty();
                $.each(cidades_id, function (key, value) {
                    $('select[name=cidades_id]').append('<option value=' + value.id + '>' + value.nome + '</option>');
                });
            });
        });*/

        <!-- Java Script preenchimento TRENS-->
        /*$('select[name=cidades_id]').change(function () {
            var idCidade = $(this).val();

            $.get('/get-trensOrcamento/' + idCidade, function (nome) {
                $('select[name=trens_id]').empty();
                $('select[name=trens_id]').append('<option value=' + 0 + '>Selecione...</option>');
                $('select[name=valor]').empty();
                $('select[name=destino]').empty();
                //$('select[name=empresa_trem]').empty();

                $.each(nome, function (key, value) {
                    $('select[name=trens_id]').append('<option value=' + value.id + '>' + value.nome + '</option>');
                });
            });
        });*/

        <!-- Java Script preenchimento Preco TREM-->

        $('select[name=trens_id]').change(function () {

            var t = $('#trens_id').val();

            if(t == 0){ // Oculta Btn Submit
                //alert('Selecione um Trem Válido!');
                $("#submit").hide();
                $('input[name=valor]').val('');
                $('input[name=cidades_id]').val('');
                $('input[name=destino]').val('');
                $("input[name=nome]").val('');
            }else{ // Mostra Btn Submit
                $("#submit").show();
            }
            var idTrem = $(this).val();

            $.get('/get-valor/' + idTrem, function (valor) {
                $.each(valor, function (key, value) {

                    $('input[name=valor]').val(value.valor);
                    $('input[name=cidades_id]').val(value.cidades_id);
                    $('input[name=destino]').val(value.destino);
                    $("input[name=nome]").val(value.nome);
                });
            });
        });
    </script>
@endsection
@endsection



