@extends('app')
@section('content')

    <div class="container">
        <legend>Criar novo Hotel</legend><br /> 
        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['route'=>['hoteis.updateHotel', $hoteis->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

        <div class="form-group">
            <label for="nomeCreateHoteis" class="col-md-2 control-label">Nome Hotel <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                <input type="text" name="nome" id="nome" value="{{$hoteis->nome}}" class="form-control"/>
            </div>
        </div>

        <div class="form-group">
            <label for="paisCreateVooOrc" class="col-md-2 control-label">País <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="cidades_id" id="cidades_id" value="{{$hoteis->cidades->id}}" type="hidden">
                <input class="form-control" name="pais" id="pais" value="{{$hoteis->cidades->codigo_pais}}" readonly>
            </div>

            <label for="cidadeidCreateVooOrc" class="col-md-2 control-label">Cidade <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="cidades" id="cidades" value="{{$hoteis->cidades->nome}}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="valorCreateTrens" class="col-md-2 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input type="text" name="valor" id="valor" value="{{$hoteis->valor}}" class="form-control"/>
            </div>
        </div>

        

            {!! Form::hidden('orcamento', 1, ['class'=>'form-control']) !!}
    
        
        <br/>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button class="btn btn-success"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </div>
        {!! Form::close() !!}

    </div>


@section('post-script')
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
    </script>
@endsection
@endsection



