@extends('app')

@section('content')


    <div class="container">
        <legend>Editar Cliente</legend><br />

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['route'=>['clientes.update', $cliente->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

        <legend>Dados principais</legend><br />
        <!-- Form Input -->
        <div class="form-group">
            <label class="col-md-2 control-label">Nome <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                {!! Form::text('nome', $cliente->nome, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Telefone <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('telefone', $cliente->telefone, ['class'=>'form-control', 'placeholder'=>'(xx) 00000-0000']) !!}
            </div>

            <label class="col-md-2 control-label">E-mail <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                {!! Form::text('email',$cliente->email, ['class'=>'form-control', 'placeholder'=>'email@email.com.br']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Categoria <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('categorias_id', $categorias, $cliente->categorias->id, ['class'=>'form-control']) !!}
            </div>


            <label class="col-md-2 control-label">Pacotes <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                {!! Form::select('pacotes_id',$pacotes, $cliente->pacotes->id, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Situação <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('situacoes_id',$situacoes, $cliente->situacoes->id, ['class'=>'form-control']) !!}
            </div>
        </div>

        <legend>Dados Adicionais</legend><br />

        <div class="form-group">
            <label class="col-md-2 control-label">País </label>
            <div class="col-sm-3">
                {!! Form::text('pais', $cliente->pais, ['class'=>'form-control']) !!}
            </div>

            <label class="col-md-2 control-label">CEP </label>
            <div class="col-sm-2">
                {!! Form::text('cep', $cliente->cep, ['class'=>'form-control']) !!}
            </div>
            <br /><br /><br />

            <label class="col-md-2 control-label">Endereço </label>
            <div class="col-sm-4">
                {!! Form::text('endereco', $cliente->endereco, ['class'=>'form-control']) !!}
            </div>


            <label class="col-md-1 control-label">Número </label>
            <div class="col-sm-1">
                {!! Form::text('numero', $cliente->numero, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Bairro </label>
            <div class="col-sm-4">
                {!! Form::text('bairro', $cliente->bairro, ['class'=>'form-control']) !!}
            </div>

            <label class="col-md-1 control-label">Estado </label>
            <div class="col-sm-1">
                {!! Form::text('estado', $cliente->estado, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Cidade </label>
            <div class="col-sm-2">
                {!! Form::text('cidade', $cliente->cidade, ['class'=>'form-control']) !!}
            </div>

            <label class="col-md-3 control-label">Data Nascimento </label>
            <div class="col-sm-2">
                {!! Form::text('data_nasc', $cliente->data_nasc, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">

            <label class="col-md-2 control-label">CPF </label>
            <div class="col-sm-2">
                {!! Form::text('cpf', $cliente->cpf, ['class'=>'form-control']) !!}
            </div>

            <label class="col-md-3 control-label">RG </label>
            <div class="col-sm-2">
                {!! Form::text('identidade', $cliente->identidade, ['class'=>'form-control']) !!}
            </div>

        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Data expedissão </label>
            <div class="col-sm-2">
                {!! Form::text('orgao_emissor', $cliente->orgao_emissor, ['class'=>'form-control']) !!}
            </div>

            <label class="col-md-3 control-label">Org. Emiss. </label>
            <div class="col-sm-2">
                {!! Form::text('data_exp', $cliente->data_exp, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Nº passaporte </label>
            <div class="col-sm-3">
                {!! Form::text('num_passaporte', $cliente->num_passaporte, ['class'=>'form-control']) !!}
            </div>

            <label class="col-md-2 control-label">Data Emiss. Pass. </label>
            <div class="col-sm-3">
                {!! Form::text('data_emissao_passaporte', $cliente->data_emissao_passaporte, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Val. Pass. </label>
            <div class="col-sm-2">
                {!! Form::text('validade_passaporte', $cliente->validade_passaporte, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Nome pai </label>
            <div class="col-sm-8">
                {!! Form::text('nome_pai', $cliente->nome_pai, ['class'=>'form-control']) !!}
            </div>

        </div>

        <div class="form-group">

            <label class="col-md-2 control-label">Nome mãe </label>
            <div class="col-sm-8">
                {!! Form::text('nome_mae', $cliente->nome_mae, ['class'=>'form-control']) !!}
            </div>
            <br /><br /><br />

            <label class="col-md-2 control-label">Lembrete </label>
            <div class="col-sm-8">
                {!! Form::textArea('lembretes', $cliente->lembretes, ['class'=>'form-control']) !!}
            </div>

        </div>

        <div class="form-group">

            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
        </div>

    </div>

    {!! Form::close() !!}

    </div>

@section('post-script')
    <script type="text/javascript">

        $('select[name=pacotes_id]').attr("disabled", true);

        $('select[name=categorias_id]').change(function () {
            var idCategoria = $(this).val();

            $.get('/get-pacotes/' + idCategoria, function (pacotes_id) {
                $('select[name=pacotes_id]').empty();
                $.each(pacotes_id, function (key, value) {
                    $('select[name=pacotes_id]').attr("disabled", false);
                    $('select[name=pacotes_id]').append('<option value=' + value.id + '>' + value.nome + '</option>');
                });
            });
        });

    </script>
@endsection
@endsection