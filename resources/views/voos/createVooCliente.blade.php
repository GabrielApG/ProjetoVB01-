@extends('app')
@section('content')

    <div class="container">
    <legend>Cadastrar novo Voo para - {{$cliente->nome}}</legend><br />
    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

        {!! Form::open(['route'=>['voos.storeAttach'], 'class'=>'form-horizontal', 'method'=>'post']) !!}

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Voos Disponíveis <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
            {!! Form::select('voos_id', array('0' => 'Selecione') + $voo, '0', ['class'=>'form-control','id'=>'voos_id'])!!}
            </div>
        </div>

        <div class="form-group-xs"> <!-- Campo Oculto -->
            {!! Form::hidden('clientes_id', $cliente->id, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group-xs"> <!-- Campo Oculto -->
            <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
        </div>

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Nome Voo: <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
                <input name="nome_voo" id="nome_voo" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Local de Embarque <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="local_emb" id="local_emb" class="form-control">
            </div>

            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Local de Desembarque <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="local_des" id="local_des" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Data Ida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="data_ida" id="data_ida" class="form-control">
            </div>

            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Data Volta <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="data_volta" id="data_volta" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Hora Ida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
            <input name="hora_ida" id="hora_ida" class="form-control">
        </div>

           <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Hora Volta <span class="campo_obrigatorio">*</span></label>
                <div class="col-sm-2">
            <input name="hora_volta" id="hora_volta" class="form-control">
        </div>
            </div>

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Empresa do Voo <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
                {!! Form::text('empresa_voo', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">N. Bilhete <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
            {!! Form::text('num_bilhete', null, ['class'=>'form-control']) !!}
        </div>

            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">N. Poltrona <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('poltrona', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">N. Voo <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
            {!! Form::text('num_voo', null, ['class'=>'form-control']) !!}
        </div>
            </div>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Escalas <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
                {!! Form::text('escalas', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Observação <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
                {!! Form::text('observacao', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group-xs">

            {!! Form::hidden('orcamento', 0, ['class'=>'form-control']) !!}
        </div>
        <br/>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="valor" id="valor" class="form-control">
            </div>

            <div class="col-sm-2">
                <div class="checkbox">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="principal" id="principal" value="Sim"> Voo Principal
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group-xs">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button class="btn btn-success" name="submit" id="submit"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </div>
        {!! Form::close() !!}
</div>

@section('post-script')
    <!--Java Script preenchimento Cidades-->
    <script type="text/javascript">

        $("#submit").hide(); // Inicia com btn OCULTO
        <!-- Java Script preenchimento Preco VOO-->
        $('select[name=voos_id]').change(function () {

            var t = $('#voos_id').val();
            if(t == 0){ // Oculta Btn Submit
                //alert('Selecione um Trem Válido!');
                $("#submit").hide();
                $("input[name=nome_voo]").val('');
                $('input[name=cidades_id]').val('');
                $('input[name=valor]').val('');
                $('input[name=local_emb]').val('');
                $('input[name=local_des]').val('');
            }else{ // Mostra Btn Submit
                $("#submit").show();
            }
            var idVoo = $(this).val();

            $.get('/get-voo/' + idVoo, function (valor) {
                $.each(valor, function (key, value) {
                    $("input[name=nome_voo]").val(value.nome_voo);
                    $('input[name=cidades_id]').val(value.cidades_id);
                    $('input[name=valor]').val(value.valor);
                    $('input[name=local_emb]').val(value.local_emb);
                    $('input[name=local_des]').val(value.local_des);
                });
            });
        });

    </script>
@endsection
@endsection



