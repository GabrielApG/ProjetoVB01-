<html>
<head>
    <title>Relatórios</title>
</head>

<body id="corFundo">

<!-- Calcula o valores do Orçamento / conta Trens-->
<?php
$total = 0;
$contTrem = 0;
$contVoo = 0;
$contTransfer = 0;
$contPasseio = 0;
$contHoteis = 0;
$contAdultos = 0;
$contCriancas = 0;
$contExtras = 0;
$totalHotel = 0;
$valorHotel = 0;
$contRoteiros = 0;
$valorVoosPrincipais = 0;

foreach($clientes->voos as $v){
    if($v->orcamento == 0 && $v->principal == 'Não'){
        $total = $total + $v->valor;
        $contVoo++;
    }
}

foreach($clientes->voos as $v){
    if($v->orcamento == 0 && $v->principal == 'Sim'){
        $valorVoosPrincipais = $valorVoosPrincipais + $v->valor;
        $contVoo++;
    }
}
foreach($clientes->trens as $t){
    if($t->orcamento == 0){
        $total = $total + $t->valor;
        $contTrem++;
    }
}
foreach($clientes->transfers as $trans){
    if($trans->orcamento == 0){
        $total = $total + $trans->valor;
        $contTransfer++;
    }
}
foreach($clientes->passeios as $passeio){
    if($passeio->orcamento == 0){
        $total = $total + $passeio->valor;
        $contPasseio++;
    }
}
foreach($clientes->hoteis as $hotel){
    if($hotel->orcamento == 0){
        $contHoteis++;
        $contAdultos = $hotel->qtd_adultos;
        $contCriancas = $hotel->qtd_criancas;
        $valorHotel = $hotel->valor;

        $valorHotel = ($valorHotel / $hotel->qtd_adultos) * $hotel->diarias + $hotel->valor_extra;

        $total = $total + $valorHotel;
    }
}
foreach($clientes->extras as $extra){
    if($extra->orcamento == 0){
        $total = $total + $extra->valor;
        $contExtras++;
    }
}

foreach($clientes->roteiros as $roteiro){
    if($roteiro->orcamento == 0){
        $contRoteiros++;
    }
}
?>

@extends('app')
@section('content')
    <div class="container" id="corFundo2"><br/><br/><br/><br/><br/>
        <style>
            #corFundo{
                background-color: #F5F5F5;
            }
            #corFundo2{
                background-color: #FFFFFF;
            }
        </style>

    <span class="logo">&nbsp;</span>
    <span class="tel">tel:(31)9158-9472 email:viajarbaratoamericadosul@gmail.com</span>
    <span class="titulo" >Roteiro da Viagem</span>
    <legend class="nomeCliente">{{$clientes->nome}}</legend>
    <br/>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="4"><h5><strong> ROTEIROS DA VIAGEM </strong></h5></th>
        </tr>
        <tr>
            <th class="data">Data</th>
            <th class="cidade">Cidade</th>
            <th class="cidade">Nome</th>
            <th>Descrição</th>
        </tr>
        @foreach($clientes->roteiros as $r)
            <?php if($r->orcamento == 0){?>
            <tr class="text-center">
                <td class="data">{{$r->data}}</td>
                <td>{{$r->cidades->nome}}</td>
                <td>{{$r->nome}}</td>
                <td class="text-justify">{{$r->descricao}}</td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

    <a onclick="goBack()" class="btn-sm btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
    {{--<a onclick="" class="btn-sm btn-info"><span class="glyphicon glyphicon-envelope"></span> Enviar por e-mail</a>--}}
    <a href="{{ route('pdfCompra',['id'=>$clientes->id]) }}" class="btn-sm btn-danger"><span class="glyphicon glyphicon-print"></span> Gerar Pdf</a>

    <br/><br/><br/>


    </div>
</div>
@endsection
</body>
<html>
