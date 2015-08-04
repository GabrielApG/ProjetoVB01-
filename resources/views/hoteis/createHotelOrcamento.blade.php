@extends('app')
@section('content')

    <div class="container">
    
    <legend><span></span> Cadastrar novo Trem - {{$cliente->nome}}</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

        {!! Form::open(['route'=>'trens.storeAttach', 'class'=>'form-horizontal' 'method'=>'post']) !!}

        <div class="form-group">
            {!! Form::label('pais', 'Pais:') !!}
            {!! Form::select('pais', $paises, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('cidades', 'Cidades:') !!}
            {!! Form::select('cidades_id', [], null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group"> <!-- Campo Oculto -->
            {!! Form::hidden('clientes_id', $cliente->id, ['class'=>'form-control']) !!}
            {!! Form::hidden('numero', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('vagao', null, ['class'=>'form-control']) !!}
            {!! Form::hidden('poltrona', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('trens', 'Trens Disponíveis:') !!}
            {!! Form::select('trens_id', [], null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <label>Preço: </label>
            <text name="valor" id="valor"></text>
        </div>

        <div class="form-group">
            <label>Destino: </label>
            <text name="destino" id="destino"></text>
        </div>

        <div class="form-group">
            <label>Empresa: </label>
            <text name="empresa" id="empresa"></text>
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



