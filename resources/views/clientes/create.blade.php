@extends('app')

@section('content')

    <?php
    $contSituacao = 0;
    $contCompra = 0;
    $contViagem = 0;
    ?>
    @foreach($clientesAll as $c)
        <?php
        if($c->situacoes->id == 1){
            $contSituacao++;
        }
        if($c->situacoes->id == 2){
            $contCompra++;
        }
        if($c->situacoes->id == 3){
            $contViagem++;
        }
        ?>
    @endforeach

    <div class="container containerTelaInicial">
        <legend>Novo Cliente</legend><br />
        <ul class="nav nav-tabs">
            <li role="presentation"><a href="{{route('clientes')}}">
                    <span class="glyphicon glyphicon-list-alt"></span> Todos Clientes</a></li>
            <li role="presentation"><a href="{{ route('clientes.pedidosOrcamento')}}">
                    <span class="glyphicon glyphicon-arrow-down"></span> Pedidos de Orçamento <span class="badge"><?php echo $contSituacao; ?></span></a></li>
            <li role="presentation"><a href="{{ route('clientes.compraConfirmada')}}"><span class="glyphicon glyphicon-warning-sign">
                </span> Compra Confirmada <span class="badge"><?php echo $contCompra; ?></span></a></li>
            <li role="presentation"><a href="{{route('clientes.emViajem')}}"><span class="glyphicon glyphicon-plane">
                </span> Em Viagem <span class="badge"><?php echo $contViagem; ?></span></a></li>
            <li role="presentation" class="active"><a href="{{ route('clientes.create')}}">
                    <span class="glyphicon glyphicon-plus-sign"></span> Cadastrar</a></li>
        </ul>

    <br />
    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    {!! Form::open(['route'=>'clientes.store', 'class'=>'form-horizontal']) !!}
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
                {!! Form::text('telefone', null, ['class'=>'form-control', 'id'=>'telefone', 'placeholder'=>'(99) 99999-9999']) !!}
            </div>
           
            <label class="col-md-2 control-label">E-mail <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                {!! Form::text('email','',['class'=>'form-control', 'placeholder'=>'email@email.com.br']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Categoria <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('categorias_id',  array('0' => 'Selecione') + $categoria, null, ['class'=>'form-control']) !!}
            </div>

            <label class="col-md-2 control-label">Pacotes <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-4">
                {!! Form::select('pacotes_id', [], null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Situação <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                {!! Form::select('situacoes_id', array('0' => 'Selecione') +  $situacao, null, ['class'=>'form-control']) !!}
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
            {!! Form::text('cpf', null, ['class'=>'form-control', 'id'=>'cpf', 'placeholder'=>'999.999.999-99']) !!}
        </div>

        <label class="col-md-3 control-label">RG </label>
        <div class="col-sm-2">
            {!! Form::text('identidade', null, ['class'=>'form-control', 'id'=>'rg','placeholder'=>'999.999.999']) !!}
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
        <div class="col-sm-3">
            {!! Form::text('num_passaporte', null, ['class'=>'form-control', 'placeholder'=>'999999']) !!}
        </div>

        <label class="col-md-2 control-label">Data Emiss. Pass. </label>
        <div class="col-sm-3">
            {!! Form::input('date','data_emissao_passaporte','',['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Val. Pass. </label>
        <div class="col-sm-2">
            {!! Form::input('date','validade_passaporte','',['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Nome pai </label>
        <div class="col-sm-8">
            {!! Form::text('nome_pai', null, ['class'=>'form-control', 'placeholder'=>'Nome completo do Pai']) !!}
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


@section('post-script')
<script type="text/javascript">

    $('select[name=categorias_id]').change(function () {
        var idCategoria = $(this).val();

        $.get('/get-pacotes/' + idCategoria, function (pacotes_id) {
            $('select[name=pacotes_id]').empty();
            $.each(pacotes_id, function (key, value) {
                $('select[name=pacotes_id]').append('<option value=' + value.id + '>' + value.nome + '</option>');
            });
        });
    });

</script>
@endsection
@endsection

