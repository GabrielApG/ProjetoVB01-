@extends('app')
@section('content')

    <div class="container">
    <legend>Cadastrar novo Roteiro - {{$clientes->nome}}</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

        {!! Form::open(['route'=>['roteiros.storeAttach'],'class'=>'form-horizontal', 'method'=>'post']) !!}

        <div class="form-group">
            <label for="transfersdispCreateTransfers" class="col-md-2 control-label">Roteiros Disponíveis <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-5">
                {!! Form::select('roteiros_id', array('0' => 'Selecione') + $roteiros, '0', ['class'=>'form-control','id'=>'roteiros_id'])!!}
            </div>
        </div>

            {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
            <input name="nome" id="nome" class="form-control" type="hidden" readonly >

        <div class="form-group">
            <label for="precoCreateTranferCliente" class="col-md-2 control-label">Nome <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-5">
                <input name="nome" id="nome" class="form-control" readonly>
            </div>
        </div>

        <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
        <div class="form-group">
            <label for="descricaoCreatePacotes" class="col-md-2 control-label">Descrição <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                <textarea class="form-control" name="descricao" id="descricao" readonly></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="precoCreateTranferCliente" class="col-md-2 control-label">Data<span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input type="text" name="data" id="data" class="form-control" placeholder="99/99/9999"/>
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

        <!-- Java Script preenchimento Preco TREM-->

        $('select[name=roteiros_id]').change(function () {

            var t = $('#roteiros_id ').val();
            if(t == 0){ // Oculta Btn Submit
                //alert('Selecione um Trem Válido!');
                $("#submit").hide();
                $('input[name=cidades_id]').val('');
                $("input[name=nome]").val('');
                $("textarea[name=descricao]").val('');
            }else{ // Mostra Btn Submit
                $("#submit").show();
            }
            var idRoteiro = $(this).val();

            $.get('/get-roteiro/' + idRoteiro, function (valor) {
                $.each(valor, function (key, value) {
                    $('input[name=cidades_id]').val(value.cidades_id);
                    $("input[name=nome]").val(value.nome);
                    $("textarea[name=descricao]").val(value.descricao);
                });
            });
        });
    </script>
@endsection
@endsection



