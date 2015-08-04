@extends('app')
@section('content')

<div class="container">
    <legend>Editar Dependente - {{$dependentes->nome}}</legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif


    {!! Form::open(['route'=>['dependentes.update', $dependentes->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

     <legend>Dados principais</legend><br />
        <!-- Form Input -->
        <div class="form-group">
            <label class="col-md-2 control-label">Nome <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-8">
                {!! Form::text('nome', $dependentes->nome,['class'=>'form-control', 'placeholder'=>'Nome completo']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Telefone <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::text('telefone', $dependentes->telefone,['class'=>'form-control', 'placeholder'=>'(99) 99999-9999']) !!}
            </div>
           
            <label class="col-md-2 control-label">E-mail <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                {!! Form::text('email', $dependentes->email, ['class'=>'form-control', 'placeholder'=>'email@email.com.br']) !!}
            </div>
        </div>


    <legend>Dados Adicionais</legend><br />

        <div class="form-group">
            <label class="col-md-2 control-label">País </label>
            <div class="col-sm-3">
                {!! Form::text('pais', $dependentes->pais, ['class'=>'form-control']) !!}
            </div>

            <label class="col-md-2 control-label">CEP </label>
            <div class="col-sm-2">
                {!! Form::text('cep',$dependentes->cep, ['class'=>'form-control', 'placeholder'=>'99999-999']) !!}
            </div>
            <br /><br /><br />

            <label class="col-md-2 control-label">Endereço </label>
            <div class="col-sm-4">
                {!! Form::text('endereco', $dependentes->endereco, ['class'=>'form-control','placeholder'=>'Logradouro, Rua, Avenida...']) !!}
            </div>

            
            <label class="col-md-1 control-label">Número </label>
            <div class="col-sm-1">
                {!! Form::text('numero', $dependentes->numero, ['class'=>'form-control','placeholder'=>'99999']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Bairro </label>
            <div class="col-sm-4">
                {!! Form::text('bairro', $dependentes->bairro, ['class'=>'form-control', 'placeholder'=>'Bairro']) !!}
            </div>

            <label class="col-md-1 control-label">Estado </label>
            <div class="col-sm-1">
                {!! Form::text('estado', $dependentes->estado, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Cidade </label>
            <div class="col-sm-2">
                {!! Form::text('cidade', $dependentes->cidade, ['class'=>'form-control']) !!}
            </div>

            <label class="col-md-3 control-label">Data Nascimento </label>
            <div class="col-sm-2">
                {!! Form::text('data_nascimento', $dependentes->data_nasc,['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">

            <label class="col-md-2 control-label">CPF </label>
            <div class="col-sm-2">
                {!! Form::text('cpf', $dependentes->cpf, ['class'=>'form-control', 'placeholder'=>'999.999.999-99']) !!}
            </div>

            <label class="col-md-3 control-label">RG </label>
            <div class="col-sm-2">
                {!! Form::text('identidade', $dependentes->identidade, ['class'=>'form-control', 'placeholder'=>'999.999.999']) !!}
            </div>

        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Data expedição </label>
            <div class="col-sm-2">
                {!! Form::text('date', $dependentes->data_exp, ['class'=>'form-control']) !!}
            </div>

            <label class="col-md-3 control-label">Org. Emiss. </label>
            <div class="col-sm-2">
                {!! Form::text('orgao_emissor', $dependentes->orgao_emissor, ['class'=>'form-control','placeholder'=>'SSP']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Nº passaporte </label>
            <div class="col-sm-2">
                {!! Form::text('num_passaporte', $dependentes->num_passaporte, ['class'=>'form-control', 'placeholder'=>'999999999']) !!}
            </div>

            <label class="col-md-2 control-label">Dt. Emiss. Pass. </label>
            <div class="col-sm-2">
                {!! Form::text('date',$dependentes->data_emissao_passaporte,['class'=>'form-control']) !!}
            </div>

            <label class="col-md-1 control-label">Val. Pass. </label>
            <div class="col-sm-1">
                {!! Form::text('date',$dependentes->validade_passaporte, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Nome pai </label>
            <div class="col-sm-8">
                {!! Form::text('nome_pai', $dependentes->nome_pai, ['class'=>'form-control', 'placeholder'=>'Nome completo do pai']) !!}
            </div>

        </div>

        <div class="form-group">

            <label class="col-md-2 control-label">Nome mãe </label>
            <div class="col-sm-8">
                {!! Form::text('nome_mae', $dependentes->nome_mae, ['class'=>'form-control', 'placeholder'=>'Nome completo da mãe']) !!}
            </div>
            <br /><br /><br />

            <label class="col-md-2 control-label">Lembrete </label>
            <div class="col-sm-8">
                {!! Form::textArea('lembretes', $dependentes->lembretes, ['class'=>'form-control', 'placeholder'=>'Lembretes, detalhes...']) !!}
            </div>

            <div class="form-group">

                <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
                <button type="submit" class="btn btn-success" id="submit"><span class="glyphicon glyphicon-saved"></span>  Salvar</button>
            </div>

        </div>
    {!! Form::close() !!}

</div>
@endsection



