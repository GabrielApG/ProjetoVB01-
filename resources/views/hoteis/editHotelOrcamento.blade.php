@extends('app')
@section('content')

    <div class="container">
    
    <legend>Cadastrar novo Hotel - {{$clientes->nome}}</legend><br />
    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
        {!! Form::open(['route'=>['hoteis.updateOrcamento', $hotel->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

        <div class="form-group">
            <label for="hoteisIdHotelCliente" class="col-md-2 control-label">Nome do Hotel <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                <input class="form-control" id="nome" name="nome" value="{{$hotel->nome}}" readonly>
            </div>
        </div>

        {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}

        <div class="form-group">
            <label for="telefoneHotelCliente" class="col-md-2 control-label">Telefone <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" id="telefone" name="telefone"  value="{{$hotel->telefone}}" />
            </div>

            <label for="numeroreservaHotelCliente" class="col-md-2 control-label">N. Reserva: <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                <input class="form-control" id="num_reserva" name="num_reserva"  value="{{$hotel->num_reserva}}" />
            </div>
        </div>

        <div class="form-group">
            <label for="cepHotelCliente" class="col-md-2 control-label">CEP </label>
            <div class="col-sm-2">
                <input class="form-control" id="cep" name="cep"  value="{{$hotel->cep}}" />
            </div>

            <label for="enderecoHotelCliente" class="col-md-2 control-label">Endereço </label>
            <div class="col-sm-4">
                <input class="form-control" id="endereco" name="cep"  value="{{$hotel->endereco}}" />
            </div>

        </div>


        <div class="form-group">
            <label for="numeroHotelCliente" class="col-md-2 control-label">Número </label>
            <div class="col-sm-2">
                <input class="form-control" id="numero" name="numero"  value="{{$hotel->numero}}" />
            </div>

            <label for="bairroHotelCliente" class="col-md-1 control-label">Bairro </label>
            <div class="col-sm-3">
                <input class="form-control" id="bairro" name="bairro"  value="{{$hotel->bairro}}" />
            </div>

            <label for="estadoHotelCliente" class="col-md-1 control-label">Estado </label>
            <div class="col-sm-1">
                <input class="form-control" id="estado" name="estado"  value="{{$hotel->estado}}" />
            </div>
        </div>

        <div class="form-group">
            <label for="statusHotelCliente" class="col-md-2 control-label">Status</label>
            <div class="col-sm-2">
                <input class="form-control" id="status" name="status"  value="{{$hotel->status}}" />
            </div>

            <label for="quantidadeadultosHotelCliente" class="col-md-1 control-label">Qtd. Adultos</label>
            <div class="col-sm-1">
                <input class="form-control" id="qtd_adultos" name="qtd_adultos"  value="{{$hotel->qtd_adultos}}" />
            </div>

            <label for="quantidadecriancasHotelCliente" class="col-md-1 control-label">Qtd. Crianças</label>
            <div class="col-sm-1">
                <input class="form-control" id="qtd_criancas" name="qtd_criancas"  value="{{$hotel->qtd_criancas}}" />
            </div>

        </div>

        <div class="form-group">
            <label for="diariasHotelCliente" class="col-md-2 control-label">Diárias </label>
            <div class="col-sm-1">
                <input class="form-control" id="diarias" name="diarias"  value="{{$hotel->diarias}}" />
            </div>

            <label for="dataentradaHotelCliente" class="col-md-2 control-label">Data Entrada </label>
            <div class="col-sm-1">
                <input class="form-control" id="data_entrada" name="data_entrada"  value="{{$hotel->data_entrada}}" />
            </div>

            <label for="datasaidaHotelCliente" class="col-md-1 control-label">Data Saída</label>
            <div class="col-sm-1">
                <input class="form-control" id="data_saida" name="data_saida"  value="{{$hotel->data_saida}}" />
            </div>
        </div>

        <div class="form-group" >
            <label for="cafedamanhaHotelCliente" class="col-md-2 control-label">Café da Manhã </label>
            <div class="col-sm-1">
                <input class="form-control" id="cafe_manha" name="cafe_manha"  value="{{$hotel->cafe_manha}}" />
            </div>

            <label for="wifiHotelCliente" class="col-md-2 control-label">Wifi </label>
            <div class="col-sm-1">
                <input class="form-control" id="wifi" name="wifi"  value="{{$hotel->wifi}}" />
            </div>
        </div>

        <div class="form-group">
            <label for="siteHotelCliente" class="col-md-2 control-label">Site </label>
            <div class="col-sm-4">
                <input class="form-control" id="site" name="site"  value="{{$hotel->site}}" />
            </div>
        </div>

        <div class="form-group">
            <label for="valorHotelCliente" class="col-md-2 control-label">Valor R$ </label>
            <div class="col-sm-2">
                <input class="form-control" id="valor" name="valor"  value="{{$hotel->valor}}" />
            </div>
        </div>

        <div class="form-group"> <!-- Campo Oculto -->
            <input name="cidades_id" id="cidades_id" class="form-control" value="{{$hotel->cidades->id}}" type="hidden">
        </div>
        <br/>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
        </div>
        {!! Form::close() !!}
</div>
@endsection



