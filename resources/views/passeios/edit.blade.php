@extends('app')
@section('content')

    <div class="container">
        
        <legend> Cadastrar novo passeio para orçamento</legend><br />

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['route'=>['passeios.updatePasseios', $passeios->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

        <div class="form-group">
            <label for="nomeCreatePasseios" class="col-md-2 control-label">Nome do Passeio <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                <input type="text" name="nome" id="nome" class="form-control" value="{{$passeios->nome}}"/>
            </div>
        </div>

        <div class="form-group">
            <label for="paisCreateVooOrc" class="col-md-2 control-label">País <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="cidades_id" id="cidades_id" value="{{$passeios->cidades->id}}" type="hidden">
                <input class="form-control" name="pais" id="pais" value="{{$passeios->cidades->codigo_pais}}" readonly>
            </div>

            <label for="cidadeidCreateVooOrc" class="col-md-2 control-label">Cidade <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="cidades" id="cidades" value="{{$passeios->cidades->nome}}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="descricaoCreatePacotes" class="col-md-2 control-label">Descrição <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control">{{$passeios->descricao}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="empresadopasseioCreatePasseios" class="col-md-2 control-label">Empresa do Passeio <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="empresa_passeio" id="empresa_passeio" value="{{$passeios->empresa_passeio}}">
            </div>

            <label for="pontodepartidaCreatePasseios" class="col-md-2 control-label">Ponto de Partida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                <input class="form-control" name="ponto_partida" id="ponto_partida" value="{{$passeios->ponto_partida}}">
            </div>
        </div>

        <div class="form-group">
            <label for="valorCreatePasseios" class="col-md-2 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input class="form-control" name="valor" id="valor" value="{{$passeios->valor}}">
            </div>
        </div>

        <div class="form-group">
            {!! Form::hidden('orcamento', 1, ['class'=>'form-control']) !!}
        </div>

        <br/>

        <div class="form-group">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            {{--{!! Form::submit('Salvar', ['class'=>'btn btn-success']) !!}--}}
            <button class="btn btn-success"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </div>
        {!! Form::close() !!}

    </div>
@endsection

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



