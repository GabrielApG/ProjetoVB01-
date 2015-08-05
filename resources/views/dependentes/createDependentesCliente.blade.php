@extends('app')

@section('content')

<div class="container">
    <legend><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span> Cadastro de Dependente - {{$clientes->nome}}</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

        {!! Form::open(['route'=>'dependentes.store', 'class'=>'form-horizontal']) !!}
        
            {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
            {!! Form::hidden('situacoes_id', $clientes->situacoes->id, ['class'=>'form-control']) !!}
            {!! Form::hidden('pacotes_id', $clientes->pacotes->id, ['class'=>'form-control']) !!}
            {!! Form::hidden('categorias_id', $clientes->categorias->id, ['class'=>'form-control']) !!}

    <legend>Dados principais</legend><br />
        <!-- Form Input -->
        <div class="form-group">
            <label class="col-md-2 control-label">Nome <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                {!! Form::text('nome', null, ['class'=>'form-control', 'placeholder'=>'Nome completo']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Telefone <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('telefone', null, ['class'=>'form-control', 'id'=>'telefone','placeholder'=>'(99) 99999-9999']) !!}
            </div>
           
            <label class="col-md-2 control-label">E-mail <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                {!! Form::text('email','',['class'=>'form-control', 'placeholder'=>'email@email.com.br']) !!}
            </div>
        </div>


    <legend>Dados Adicionais</legend><br />

    <div class="form-group">
        <label class="col-md-2 control-label">País </label>
        <div class="col-sm-3">
            {!! Form::text('pais', null, ['class'=>'form-control']) !!}
        </div>

        <label class="col-md-2 control-label">CEP </label>
        <div class="col-sm-2">
            {!! Form::text('cep', null, ['class'=>'form-control', 'id'=>'cep','placeholder'=>'99999-999']) !!}
        </div>
        <br /><br /><br />

        <label class="col-md-2 control-label">Endereço </label>
        <div class="col-sm-4">
            {!! Form::text('endereco', null, ['class'=>'form-control','placeholder'=>'Logradouro, Rua, Avenida...']) !!}
        </div>

        
        <label class="col-md-1 control-label">Número </label>
        <div class="col-sm-1">
            {!! Form::text('numero', null, ['class'=>'form-control','placeholder'=>'99999']) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Bairro </label>
        <div class="col-sm-4">
            {!! Form::text('bairro', null, ['class'=>'form-control', 'placeholder'=>'Bairro']) !!}
        </div>

        <label class="col-md-1 control-label">Estado </label>
        <div class="col-sm-1">
            {!! Form::text('estado', null, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Cidade </label>
        <div class="col-sm-2">
            {!! Form::text('cidade', null, ['class'=>'form-control']) !!}
        </div>

        <label class="col-md-3 control-label">Data Nascimento </label>
        <div class="col-sm-2">
            {!! Form::input('date','data_nasc','',['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="form-group">

        <label class="col-md-2 control-label">CPF </label>
        <div class="col-sm-2">
            {!! Form::text('cpf', null, ['class'=>'form-control','id'=>'cpf','placeholder'=>'999.999.999-99']) !!}
        </div>

        <label class="col-md-3 control-label">RG </label>
        <div class="col-sm-2">
            {!! Form::text('identidade', null, ['class'=>'form-control','id'=>'rg', 'placeholder'=>'999.999.999']) !!}
        </div>

    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Data expedissão </label>
        <div class="col-sm-2">
            {!! Form::input('date','data_exp', null, ['class'=>'form-control']) !!}
        </div>

        <label class="col-md-3 control-label">Org. Emiss. </label>
        <div class="col-sm-2">
            {!! Form::text('orgao_emissor', null, ['class'=>'form-control','placeholder'=>'SSP']) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Nº passaporte </label>
        <div class="col-sm-2">
            {!! Form::text('num_passaporte', null, ['class'=>'form-control', 'placeholder'=>'999999999']) !!}
        </div>

        <label class="col-md-2 control-label">Dt. Emiss. Pass. </label>
        <div class="col-sm-2">
            {!! Form::input('date','data_emissao_passaporte','',['class'=>'form-control']) !!}
        </div>

        <label class="col-md-1 control-label">Val. Pass. </label>
        <div class="col-sm-1">
            {!! Form::input('date','validade_passaporte','',['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Nome pai </label>
        <div class="col-sm-8">
            {!! Form::text('nome_pai', null, ['class'=>'form-control', 'placeholder'=>'Nome completo do pai']) !!}
        </div>

    </div>

    <div class="form-group">

        <label class="col-md-2 control-label">Nome mãe </label>
        <div class="col-sm-8">
            {!! Form::text('nome_mae', null, ['class'=>'form-control', 'placeholder'=>'Nome completo da mãe']) !!}
        </div>
        <br /><br /><br />

        <label class="col-md-2 control-label">Lembrete </label>
        <div class="col-sm-8">
            {!! Form::textArea('lembretes', null, ['class'=>'form-control', 'placeholder'=>'Lembretes, detalhes...']) !!}
        </div>

    </div>

    <div class="form-group">
        
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
    </div>

</div>

    {!! Form::close() !!}

</div>
@endsection




