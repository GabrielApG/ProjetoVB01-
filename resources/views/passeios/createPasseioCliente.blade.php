@extends('app')
@section('content')

    <div class="container">
    
    <legend> Cadastrar novo Passeio - {{$cliente->nome}}</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
       
        {!! Form::open(['route'=>['passeios.storeAttach'],'class'=>'form-horizontal', 'method'=>'post']) !!}


        <div class="form-group">
            <label for="passeiosidCreatePasseiosCliente" class="col-md-2 control-label">Passeios Disponíveis <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                {!! Form::select('passeios_id', array('0' => 'Selecione') + $passeios, '0', ['class'=>'form-control','id'=>'passeiosidCreatePasseiosCliente'])!!}
            </div>
            <!-- campo oculto -->
            {!! Form::hidden('clientes_id', $cliente->id, ['class'=>'form-control']) !!}
            <input name="nome" id="nome" class="form-control" type="hidden" readonly >
            <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">    
        </div>

        <div class="form-group">
            <label for="descricaoCreatePacotes" class="col-md-2 control-label">Descrição <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                <textarea class="form-control" name="descricao" id="descricao" readonly></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label for="empresaCreatePasseiosCliente" class="col-md-2 control-label">Empresa<span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                {!! Form::text('empresa_passeio', null, ['class'=>'form-control', 'id'=>'empresaCreatePasseiosCliente']) !!}
            </div>

            <label for="pontodepartidaCreatePasseiosCliente" class="col-md-2 control-label">Ponto de Partida </label>
            <div class="col-sm-2">
                <input name="ponto_partida" id="ponto_partida" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="datadeidaCreatePasseiosCliente" class="col-md-2 control-label">Data de ida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('data_ida', null, ['class'=>'form-control', 'id'=>'data_ida']) !!}
            </div>

            <label for="horadeidaPasseiosCliente" class="col-md-1 control-label">Hora de ida<span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('hora_ida', null, ['class'=>'form-control', 'id'=>'hora_ida']) !!}
            </div>

            <label for="precoCreatePasseiosCliente" class="col-md-1 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="valor" id="valor" class="form-control">
            </div>
        </div>



        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </div>
        {!! Form::close() !!}
</div>
@endsection


@section('post-script')
    <!--Java Script preenchimento Cidades-->
    <script type="text/javascript">

        $("#submit").hide(); // Inicia com btn OCULTO

        <!-- Java Script preenchimento Preco TREM-->

        $('select[name=passeios_id]').change(function () {

            var t = $('#passeios_id').val();

            if(t == 0){ // Oculta Btn Submit
                //alert('Selecione um Trem Válido!');
                $("#submit").hide();
                $('input[name=valor]').val('');
                $('input[name=cidades_id]').val('');
                $('input[name=ponto_partida]').val('');
                $("input[name=nome]").val('');
                $("textarea[name=descricao]").val('');
            }else{ // Mostra Btn Submit
                $("#submit").show();
            }
            var idPasseio = $(this).val();

            $.get('/get-pass/' + idPasseio, function (valor) {
                $.each(valor, function (key, value) {
                    $('input[name=valor]').val(value.valor);
                    $('input[name=cidades_id]').val(value.cidades_id);
                    $('input[name=ponto_partida]').val(value.ponto_partida);
                    $("input[name=nome]").val(value.nome);
                    $("textarea[name=descricao]").val(value.descricao);
                });
            });
        });
    </script>
@endsection
@endsection
