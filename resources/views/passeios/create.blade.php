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

        {!! Form::open(['route'=>'passeios.store', 'class'=>'form-horizontal']) !!}

        <div class="form-group">
            <label for="nomeCreatePasseios" class="col-md-2 control-label">Nome do Passeio <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                {!! Form::text('nome', null, ['class'=>'form-control', 'id'=>'nomeCreatePasseios']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="paisCreatePasseios" class="col-md-2 control-label">País <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('pais', $paises, null, ['class'=>'form-control', 'id'=>'paisCreatePasseios']) !!}
            </div>

            <label for="cidadesidCreatePasseios" class="col-md-2 control-label">Cidade <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('cidades_id', [], null, ['class'=>'form-control', 'id'=>'cidadesidCreatePasseios']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="descricaoCreatePacotes" class="col-md-2 control-label">Descrição <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                {!! Form::textArea('descricao',null, ['class'=>'form-control', 'id'=>'descricaoCreatePacotes']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="empresadopasseioCreatePasseios" class="col-md-2 control-label">Empresa do Passeio <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('empresa_passeio', null, ['class'=>'form-control', 'id'=>'empresadopasseioCreatePasseio']) !!}
            </div>



            <label for="pontodepartidaCreatePasseios" class="col-md-2 control-label">Ponto de Partida <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                {!! Form::text('ponto_partida', null, ['class'=>'form-control', 'id'=>'pontodepartidaCreatePasseios']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="valorCreatePasseios" class="col-md-2 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('valor', null, ['class'=>'form-control', 'id'=>'valorCreatePasseios']) !!}
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



