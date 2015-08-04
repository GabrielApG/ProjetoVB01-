@extends('app')
@section('content')

    <div class="container">
    <legend>Editando Voo para - {{ $clientes->nome }}

        {!! Form::open(['route'=>['voos.update', $voo->id], 'class'=>'form-horizontal', 'method'=>'put']) !!}

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Voo <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
                <input class="form-control" name="nome_voo" id="nome_voo" readonly value="{{$voo->nome_voo}}">
            </div>
        </div>

        <!-- Campos Oculto -->
        {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
        {!! Form::hidden('orcamento', 0, ['class'=>'form-control']) !!}
        <input name="cidades_id" id="cidades_id" class="form-control" value="{{$voo->cidades->id}}"type="hidden">


        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Local de Embarque <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="local_emb" id="local_emb" class="form-control" value="{{$voo->local_emb}}">
            </div>

            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Local de Desembarque <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="local_des" id="local_emb" class="form-control" value="{{$voo->local_des}}">
            </div>
        </div>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Data Ida<span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
             <input name="data_ida" id="data_ida" class="form-control" value="{{$voo->data_ida}}">
        </div>


             <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Data Volta<span class="campo_obrigatorio">*</span></label>
             <div class="col-sm-2">
                <input name="data_volta" id="data_volta" class="form-control" value="{{$voo->data_volta}}">
             </div>
        </div>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Hora Ida<span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                 <input name="hora_ida" id="hora_ida" class="form-control" value="{{$voo->hora_ida}}">
            </div>

                <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Hora Volta<span class="campo_obrigatorio">*</span></label>
                <div class="col-sm-2">
                    <input name="hora_volta" id="hora_volta" class="form-control" value="{{$voo->hora_volta}}">
                </div>
        </div>

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Empresa do Voo <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
            <input name="empresa_voo" id="empresa_voo" class="form-control" value="{{$voo->empresa_voo}}">
        </div>
        </div>

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Num. Bilhete <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="num_bilhete" id="num_bilhete" class="form-control" value="{{$voo->num_bilhete}}">
            </div>

            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Poltrona <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="poltrona" id="poltrona" class="form-control" value="{{$voo->poltrona}}">
           </div>
        </div>

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Num. Voo <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="num_voo" id="num_voo" class="form-control" value="{{$voo->num_voo}}">
            </div>
        </div>

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Escalas <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
                 <input name="escalas" id="escalas" class="form-control" value="{{$voo->escalas}}">
            </div>
        </div>

        <div class="form-group">
            <label for="destinoCreateTremCliente" class="col-md-2 control-label">Escalas <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-6">
            <input name="observacao" id="observacao" class="form-control" value="{{$voo->observacao}}">
        </div>
        </div>

        <div class="form-group">
            <label for="datasaidaCreateTremCliente" class="col-md-2 control-label">Valor <span class="campo_obrigatorio">*</span></label>
            <div class="col-sm-2">
                <input name="valor" id="valor" class="form-control" value="{{$voo->valor}}">
            </div>

            <div class="col-sm-2">
                <div class="checkbox">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="principal" id="principal" value="Sim"> Voo Principal
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group-xs">
            <a onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
            <button class="btn btn-success" name="submit" id="submit"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </div>
        {!! Form::close() !!}


     </legend><br />

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

</div>

@section('post-script')
    <script type="text/javascript">

       var p = '{{$voo->principal}}';

        if(p == 'Sim'){
            $("#principal").attr("checked",true);
        }

    </script>
@endsection
@endsection

