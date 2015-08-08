@extends('app')
@section('content')

    <div class="container">
    <legend>Cadastrar novo Extra - {{$clientes->nome}}</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

        {!! Form::open(['route'=>['extras.storeAttach'],'class'=>'form-horizontal', 'method'=>'post']) !!}

        <div class="form-group">
            <label for="transfersdispCreateTransfers" class="col-md-2 control-label">Extras Disponíveis <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                {!! Form::select('extras_id', array('0' => 'Selecione') + $extras, '0', ['class'=>'form-control','id'=>'transfersdispCreateTransferCliente'])!!}
            </div>
        </div>

            {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
            <input name="nome" id="nome" class="form-control" type="hidden" readonly >

        <div class="form-group">
            <div class="col-sm-5">
                <input name="nome" id="nome" class="form-control" type="hidden" >
            </div>
        </div>

            <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">

        <div class="form-group">
            <label for="nomeCreateTranferCliente" class="col-md-2 control-label">Data de ida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('data_saida', null, ['class'=>'form-control', 'id'=>'data_saida']) !!}
            </div>

            <label for="horadeidaCreateTranferCliente" class="col-md-1 control-label">Hora de ida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('hora_ida', null, ['class'=>'form-control', 'id'=>'hora_ida']) !!} <br/>
            </div>
        </div>

        <div class="form-group">
            <label name="preco" id="preco" class="col-md-2 control-label">Preço R$: </label>
            <div class="col-sm-2">
            <input name="valor" id="valor" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
        </div>
        {!! Form::close() !!}
</div>

@section('post-script')
    <!--Java Script preenchimento Cidades-->
    <script type="text/javascript">

        $("#submit").hide(); // Inicia com btn OCULTO

        $('select[name=extras_id]').change(function () {

            var t = $('#extras_id ').val();
            if(t == 0){ // Oculta Btn Submit
                //alert('Selecione um Trem Válido!');
                $("#submit").hide();
                $('input[name=valor]').val('');
                $('input[name=cidades_id]').val('');
                $("input[name=nome]").val('');
            }else{ // Mostra Btn Submit
                $("#submit").show();
            }
            var idExtra = $(this).val();

            $.get('/get-extra/' + idExtra, function (valor) {
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



