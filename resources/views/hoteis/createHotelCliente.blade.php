@extends('app')
@section('content')

    <div class="container">
    
    <legend>Cadastrar novo Hotel - {{$cliente->nome}}</legend><br />
    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
        <!-- <input name="nome" id="nome" class="form-control" type="hidden" readonly > -->
        <!-- {!! Form::text('valor', null, ['class'=>'form-control']) !!} -->
        {!! Form::open(['route'=>'hoteis.storeAttach', 'class'=>'form-horizontal', 'method'=>'post']) !!}
        <div class="form-group">
            <label for="hoteisIdHotelCliente" class="col-md-2 control-label">Hoteis Disponíveis <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                {!! Form::select('hoteis_id', array('0' => 'Selecione') + $hotel, '0', ['class'=>'form-control','id'=>'hoteisIdHotelCliente'])!!}
            </div>
        </div>
        
        {!! Form::hidden('clientes_id', $cliente->id, ['class'=>'form-control']) !!}
                
        <div class="form-group">
            <label for="telefoneHotelCliente" class="col-md-2 control-label">Telefone <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('telefone', null,['class'=>'form-control', 'placeholder'=>'(99) 99999-9999', 'id'=>'telefone']) !!}
            </div>

            <label for="numeroreservaHotelCliente" class="col-md-2 control-label">N. Reserva: <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                {!! Form::text('num_reserva', null,['class'=>'form-control', 'placeholder'=>'9999999', 'id'=>'numeroreservaHotelCliente']) !!}
            </div>
        </div>

        <div class="form-group-xs"> <!-- Campo Oculto -->
            {!! Form::hidden('clientes_id', $cliente->id, ['class'=>'form-control']) !!}
            <input name="nome" id="nome" class="form-control" type="hidden" readonly >
        </div>

        <div class="form-group">
            <label for="cepHotelCliente" class="col-md-2 control-label">CEP </label>
            <div class="col-sm-2">
                {!! Form::text('cep', null, ['class'=>'form-control', 'placeholder'=>'99999-999', 'id'=>'cep']) !!}
            </div>

            <label for="enderecoHotelCliente" class="col-md-2 control-label">Endereço </label>
            <div class="col-sm-4">
                {!! Form::text('endereco', null, ['class'=>'form-control','placeholder'=>'Logradouro, Rua, Avenida...', 'id'=>'enderecoHotelCliente']) !!}
            </div>

        </div>

        
        <div class="form-group">
            <label for="numeroHotelCliente" class="col-md-2 control-label">Número </label>
            <div class="col-sm-2">
                {!! Form::text('numero', null, ['class'=>'form-control','placeholder'=>'99999', 'id'=>'numeroHotelCliente']) !!}
            </div>

            <label for="bairroHotelCliente" class="col-md-1 control-label">Bairro </label>
            <div class="col-sm-3">
                {!! Form::text('bairro', null, ['class'=>'form-control', 'placeholder'=>'Bairro', 'id'=>'bairroHotelCliente']) !!}
            </div>

            <label for="estadoHotelCliente" class="col-md-1 control-label">Estado </label>
            <div class="col-sm-1">
                {!! Form::text('estado', null, ['class'=>'form-control', 'id'=>'estadoHotelCliente']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="statusHotelCliente" class="col-md-2 control-label">Status</label>
            <div class="col-sm-2">
                {!! Form::text('status', null, ['class'=>'form-control', 'id'=>'statusHotelCliente']) !!}
            </div>

            <label for="quantidadeadultosHotelCliente" class="col-md-1 control-label">Qtd. Adultos</label>
            <div class="col-sm-1">
                {!! Form::text('qtd_adultos', null, ['class'=>'form-control', 'id'=>'qtd_adultos']) !!}
            </div>

            <label for="quantidadecriancasHotelCliente" class="col-md-1 control-label">Qtd. Crianças</label>
            <div class="col-sm-1">
                {!! Form::text('qtd_criancas', null, ['class'=>'form-control', 'id'=>'qtd_criancas']) !!}
            </div>
            
        </div>

        <div class="form-group">
            <label for="diariasHotelCliente" class="col-md-2 control-label">Diárias </label>
            <div class="col-sm-1">
                {!! Form::text('diarias', null, ['class'=>'form-control', 'id'=>'diarias']) !!}
            </div>

            <label for="dataentradaHotelCliente" class="col-md-2 control-label">Data Entrada </label>
            <div class="col-sm-1">
                {!! Form::text('data_entrada', null, ['class'=>'form-control', 'id'=>'data_entrada']) !!}
            </div>

            <label for="datasaidaHotelCliente" class="col-md-1 control-label">Data Saída </label>
            <div class="col-sm-1">
                {!! Form::text('data_saida', null, ['class'=>'form-control', 'id'=>'data_saida']) !!}
            </div>
        </div>

        <div class="form-group" >
            <label for="cafedamanhaHotelCliente" class="col-md-2 control-label">Café da Manhã </label>
            <div class="col-sm-1">
                {!! Form::text('cafe_manha', null, ['class'=>'form-control', 'id'=>'cafe_manha']) !!}
            </div>
        
            <label for="wifiHotelCliente" class="col-md-2 control-label">Wifi </label>
            <div class="col-sm-1">
                {!! Form::text('wifi', null, ['class'=>'form-control', 'id'=>'wifi']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="siteHotelCliente" class="col-md-2 control-label">Site </label>
            <div class="col-sm-4">
                {!! Form::text('site', null, ['class'=>'form-control', 'id'=>'siteHotelCliente']) !!} 
            </div>
        </div>

        <div class="form-group">
            <label for="valorHotelCliente" class="col-md-2 control-label">Valor R$ </label>
            <div class="col-sm-2">
                {!! Form::text('valor', null, ['class'=>'form-control', 'id'=>'valorHotelCliente']) !!} 
            </div>
        </div>

        <div class="form-group"> <!-- Campo Oculto -->
            <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
        </div>
        <br/>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
        </div>
        {!! Form::close() !!}
</div>
@endsection


@section('post-script')
    <!--Java Script preenchimento Cidades-->
    <script type="text/javascript">

        $("#submit").hide(); // Inicia com btn OCULTO

        <!-- Java Script preenchimento Preco TREM-->

        $('select[name=hoteis_id]').change(function () {

            var t = $('#hoteis_id').val();

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
            var idHotel = $(this).val();

            $.get('/get-hot/' + idHotel, function (valor) {
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



