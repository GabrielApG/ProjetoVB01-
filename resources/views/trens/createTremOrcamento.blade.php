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

        {!! Form::open(['route'=>['trens.storeAttach'], 'method'=>'post']) !!}

        <div class="form-group">
            <label for="trensdisponiveisCreateTremOrcamento" class="col-md-2 control-label">Trens Disponíveis <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-5">
                {!! Form::select('trens_id', [], null, ['class'=>'form-control']) !!}
            </div>
        </div>
        
        <div class="form-group">
            <label for="paisCreateTremOrcamento" class="col-md-2 control-label">Pais <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('pais', $paises, null, ['class'=>'form-control', 'id'=>'paisCreateTremOrcamento']) !!}
            </div>    

            <label for="cidadeidCreateTremOrcamento" class="col-md-2 control-label">Cidade <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('cidades_id', [], null, ['class'=>'form-control', 'id'=>'cidadesidCreateTremOrcamento']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="destinoCreateTremOrcamento" class="col-md-2 control-label">Destino <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-5">
                {!! Form::text('destino', null, ['class'=>'form-control', 'id'=>'destinoCreateTremOrcamento']) !!}
            </div>
        </div>

            {!! Form::hidden('clientes_id', $cliente->id, ['class'=>'form-control']) !!}
            {!! Form::hidden('numero', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('vagao', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('poltrona', null, ['class'=>'form-control']) !!}

        <div class="form-group">
            <label for="empresaCreateTremOrcamento" class="col-md-2 control-label">Empresa <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-5">
                {!! Form::text('empresa', null, ['class'=>'form-control', 'id'=>'empresaCreateTremOrcamento']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="valorCreateTremOrcamento" class="col-md-2 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('valor', null, ['class'=>'form-control', 'id'=>'valorCreateTremOrcamento']) !!}
            </div>
            
        </div>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><<   Voltar</a>
            {!! Form::submit('Salvar', ['class'=>'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}
</div>
@endsection


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



