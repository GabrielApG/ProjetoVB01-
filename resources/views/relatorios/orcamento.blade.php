<html>
<head>
    <title>Relatórios</title>
</head>

<body>

<!-- Calcula o valor do Orçamento-->
<?php
$total = 0;
$contTrem = 0;
$contVoo = 0;
$contTransfer = 0;
$contPasseio = 0;
$contHoteis = 0;
$valorHotel = 0;
$contExtras = 0;

foreach($clientes->voos as $v){
    if($v->orcamento == 2){
        $total = $total + $v->valor;
        $contVoo++;
    }
}
foreach($clientes->trens as $t){
    if($t->orcamento == 1){
        $total = $total + $t->valor;
        $contTrem++;
    }
}
foreach($clientes->transfers as $trans){
    if($trans->orcamento == 1){
        $total = $total + $trans->valor;
        $contTransfer++;
    }
}
foreach($clientes->passeios as $passeio){
    if($passeio->orcamento == 1){
        $total = $total + $passeio->valor;
        $contPasseio++;
    }
}
foreach($clientes->hoteis as $hotel){
    if($hotel->orcamento == 2){
        $contHoteis++;
        $contAdultos = $hotel->qtd_adultos;
        $contCriancas = $hotel->qtd_criancas;
        $valorHotel = $hotel->valor;
        $valorHotel = $valorHotel * ($contAdultos + $contCriancas);

        $total = $total + $valorHotel;
    }
}
foreach($clientes->extras as $extra){
    if($extra->orcamento == 1){
        $total = $total + $extra->valor;
        $contExtras++;
    }
}
?>

@extends('app')
@section('content')
    <div class="container">
        <legend>Relatório de Orçamento</legend><br />

        <a onclick="goBack()" class="btn-sm btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
        <a onclick="" class="btn-sm btn-info"><span class="glyphicon glyphicon-envelope"></span> Enviar por e-mail</a>
        <a href="{{ route('pdfOrcamento',['id'=>$clientes->id]) }}" class="btn-sm btn-danger"><span class="glyphicon glyphicon-print"></span> Gerar Pdf</a>

        <br/><br/><br/>


<!-- Voos -->
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th colspan="5">VOOS
            <div class="pull-right">
                <div class="pull-right">
                    <span class="badge">{{$contVoo}}</span>
                </div>
            </div>
    </tr>
    <tr>
        <th class="cod">ID</th>
        <th class="nome">Voos:</th>
        <th class="pais">Pais:</th>
        <th class="cidade">Cidade:</th>
        <th>Destino:</th>
    </tr>
    @foreach($clientes->voos as $v)
        <?php if($v->orcamento == 2){?>
        <tr class="text-center">
            <td class="cod">{{$v->id}}</td>
            <td class="nome">{{$v->nome_voo}}</td>
            <td class="pais">{{$v->cidades->codigo_pais}}</td>
            <td class="cidade">{{$v->cidades->nome}}</td>
            <td>{{$v->local_des}}</td>
        </tr>
        <?php } ?>
    @endforeach
</table>

<!-- Trens -->
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th colspan="5">TRENS
            <div class="pull-right">
                <div class="pull-right">
                    <span class="badge">{{$contTrem}}</span>
                </div>
            </div>
        </th>
    </tr>
    <tr>
        <th class="cod">ID</th>
        <th class="nome">Nome:</th>
        <th class="pais">Pais:</th>
        <th class="cidade">Cidade:</th>
        <th>Destino:</th>
    </tr>

    @foreach($clientes->trens as $t)
        <?php if($t->orcamento == 1){?>
        <tr class="text-center">
            <td class="cod">{{$t->id}}</td>
            <td class="nome">{{$t->nome}}</td>
            <td class="pais">{{$t->cidades->codigo_pais}}</td>
            <td class="cidade">{{$t->cidades->nome}}</td>
            <td>{{$t->destino}}</td>
        </tr>
        <?php } ?>
    @endforeach

</table>

<!-- Transfer-->
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th colspan="4">TRANSFERS
            <div class="pull-right">
                <div class="pull-right">
                    <span class="badge">{{$contTransfer}}</span>
                </div>
            </div>
        </th>
    </tr>
    <tr>
        <th class="cod">ID</th>
        <th class="nome">Nome:</th>
        <th class="pais">Pais</th>
        <th>Cidade</th>
    </tr>
    @foreach($clientes->transfers as $transf)
        <?php if($transf->orcamento == 1){?>
        <tr class="text-center">
            <td class="cod">{{$transf->id}}</td>
            <td class="nome">{{$transf->nome}}</td>
            <td class="pais">{{$transf->cidades->codigo_pais}}</td>
            <td>{{$transf->cidades->nome}}</td>
        </tr>
        <?php }?>
    @endforeach
</table>

<!-- Hospedagens-->
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th colspan="7"> HOSPEDAGENS
            <div class="pull-right">
                <div class="pull-right">
                    <span class="badge">{{$contHoteis}}</span>
                </div>
            </div>
    </tr>
    <tr>
        <th class="cod">ID</th>
        <th class="nome">Hotel</th>
        <th class="pais">Pais</th>
        <th class="cidade">Cidade</th>
        <th>Qtd. Adultos</th>
        <th>Qtd. Crianças</th>
        <th>Diárias</th>
    </tr>

    @foreach($clientes->hoteis as $h)
        <?php if($h->orcamento == 2){  ?>

        <tr class="text-center">
            <td class="cod">{{$h->id}}</td>
            <td class="nome">{{$h->nome}}</td>
            <td class="pais">{{$h->cidades->codigo_pais}}</td>
            <td class="cidade">{{$h->cidades->nome}}</td>
            <td>{{$h->qtd_adultos}}</td>
            <td>{{$h->qtd_criancas}}</td>
            <td>{{$h->diarias}}</td>
        </tr>
        <?php } ?>
    @endforeach
</table>

<!-- Passeios -->
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th colspan="5">PASSEIOS
            <div class="pull-right">
                <div class="pull-right">
                    <span class="badge">{{$contPasseio}}</span>
                </div>
            </div>
        </th>
    </tr>
    <tr>
        <th class="cod">ID</th>
        <th class="nome">Nome</th>
        <th class="pais">Pais</th>
        <th class="cidade">Cidade</th>
        <th>Empresa</th>
    </tr>
    @foreach($clientes->passeios as $p)
        <?php if($p->orcamento == 1){?>
        <tr class="text-center">
            <td class="cod">{{$p->id}}</td>
            <td class="nome">{{$p->nome}}</td>
            <td class="pais">{{$p->cidades->codigo_pais}}</td>
            <td class="cidade">{{$p->cidades->nome}}</td>
            <td>{{$p->empresa_passeio}}</td>
        </tr>
        <?php } ?>
    @endforeach
</table>

<!-- Extras -->
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th colspan="4"> EXTRAS  <div class="pull-right">
                <div class="pull-right">
                    <span class="badge">{{$contExtras}}</span>
                </div>
            </div>
        </th>
    </tr>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Pais</th>
        <th>Cidade</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clientes->extras as $e)
        <?php if($e->orcamento == 1){?>
        <tr class="text-center">
            <td>{{$e->id}}</td>
            <td>{{$e->nome}}</td>
            <td>{{$e->cidades->codigo_pais}}</td>
            <td>{{$e->cidades->nome}}</td>
        </tr>
        <?php } ?>
    @endforeach
</table>




<h3 class="text-right">Valor Total <span class="label label-default">R$ {{$total}}</span> </h3>

</div>

</div>
@endsection

</body>
<html>