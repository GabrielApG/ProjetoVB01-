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
    <span class="titulo" >Check List Viagem</span>
    <legend class="nomeCliente">{{$clientes->nome}}</legend>
    <br/>

   <style>
        #tableVoo {
            font-size: 9px; }
        #tableTrem {
            font-size: 9px; }
        #tableHotel {
            font-size: 9px; }

    </style>

    <!-- Voos -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="16">VOOS</th>
        <tr>
            <th>Nome</th>
            <th>Pais</th>
            <th>Cidade</th>
            <th>Emb.</th>
            <th>Des.</th>
            <th>D. Ida</th>
            <th>D. Volta</th>
            <th>H. Ida</th>
            <th>H. Volta</th>
            <th>Emp.</th>
            <th>N. Bilhete</th>
            <th>Poltrona</th>
            <th>N. Voo</th>
            <th>Escalas</th>
            <th>Obs.</th>
            <th>Principal</th>
        </tr>
        @foreach($clientes->voos as $voo)
            <?php if($voo->orcamento == 0){?>
            <tr class="text-center">
                <td id="tableVoo">{{ $v->nome_voo }}</td>
                <td id="tableVoo">{{ $v->cidades->codigo_pais}}</td>
                <td id="tableVoo">{{ $v->cidades->nome}}</td>
                <td id="tableVoo">{{ $v->local_emb }}</td>
                <td id="tableVoo">{{ $v->local_des }}</td>
                <td id="tableVoo">{{ $v->data_ida}}</td>
                <td id="tableVoo">{{ $v->data_volta}}</td>
                <td id="tableVoo">{{ $v->hora_ida}}</td>
                <td id="tableVoo">{{ $v->hora_volta }}</td>
                <td id="tableVoo">{{ $v->empresa_voo }}</td>
                <td id="tableVoo">{{$v->num_bilhete}}</td>
                <td id="tableVoo">{{$v->poltrona}}</td>
                <td id="tableVoo">{{$v->num_voo}}</td>
                <td id="tableVoo">{{$v->escalas}}</td>
                <td id="tableVoo">{{$v->observacao}}</td>
                <td id="tableVoo">{{$v->principal}}</td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

    <!-- Trens -->
    <table class="table table-striped table-bordered table-hover">
        <th colspan="10">TRENS</th>
        <tr>
            <th>Nome</th>
            <th>País</th>
            <th>Cidade Origem</th>
            <th>Destino</th>
            <th>Empresa</th>
            <th>Numero</th>
            <th>Vagão</th>
            <th>Poltrona</th>
            <th>Data Saída</th>
            <th>Hora Ida</th>
        </tr>

        @foreach($clientes->trens as $trem)
            <?php if($trem->orcamento == 0){?>
            <tr class="text-center">
                <td id="tableTrem">{{ $trem->nome }}</td>
                <td id="tableTrem">{{ $trem->cidades->codigo_pais}}</td>
                <td id="tableTrem">{{ $trem->cidades->nome}}</td>
                <td id="tableTrem">{{ $trem->destino }}</td>
                <td id="tableTrem">{{ $trem->empresa_trem }}</td>
                <td id="tableTrem">{{$trem->numero}}</td>
                <td id="tableTrem">{{$trem->vagao}}</td>
                <td id="tableTrem">{{$trem->poltrona}}</td>
                <td id="tableTrem">{{ $trem->data_saida }}</td>
                <td id="tableTrem">{{ $trem->hora_ida }}</td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

    <!-- Transfer -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="5">TRANSFERS</th>
        </tr>
        <tr>
            <th>Nome</th>
            <th>País</th>
            <th>Cidade</th>
            <th>Data Saída</th>
            <th>Hora Ida</th>
         </tr>
        @foreach($clientes->transfers as $transf)
            <?php if($transf->orcamento == 0){?>
            <tr class="text-center">
                <td>{{ $t->nome }}</td>
                <td>{{ $t->cidades->codigo_pais}}</td>
                <td>{{ $t->cidades->nome}}</td>
                <td>{{ $t->data_ida }}</td>
                <td>{{ $t->hora_ida }}</td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

    <!-- Hospedagens -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="17">HOSPEDAGENS</tr>
        <tr>
            <th>Hotel</th>
            <th>N. Reserva</th>
            <th>Telefone</th>
            <th>CEP</th>
            <th>Endereço</th>
            <th>Numero</th>
            <th>Bairro</th>
            <th>Estado</th>
            <th>Status</th>
            <th>Qtd. Adultos</th>
            <th>Qtd. Crianças</th>
            <th>Data Entrada</th>
            <th>Data Saída</th>
            <th>Café Manhã</th>
            <th>Wifi</th>
            <th>Site</th>
            <th>Diárias</th>
        </tr>
        @foreach($clientes->hoteis as $h)
            <?php if($h->orcamento == 0){?>
            <tr class="text-center" style="font-size:11px;">
                <td id="tableHotel">{{$h->nome}}</td>
                <td id="tableHotel">{{$h->num_reserva}}</td>
                <td id="tableHotel">{{$h->telefone}}</td>
                <td id="tableHotel">{{$h->cep}}</td>
                <td id="tableHotel">{{$h->endereco}}</td>
                <td id="tableHotel">{{$h->numero}}</td>
                <td id="tableHotel">{{$h->bairro}}</td>
                <td id="tableHotel">{{$h->estado}}</td>
                <td id="tableHotel">{{$h->status}}</td>
                <td id="tableHotel">{{$h->qtd_adultos}}</td>
                <td id="tableHotel">{{$h->qtd_criancas}}</td>
                <td id="tableHotel">{{$h->data_entrada}}</td>
                <td id="tableHotel">{{$h->data_saida}}</td>
                <td id="tableHotel">{{$h->cafe_manha}}</td>
                <td id="tableHotel">{{$h->wifi}}</td>
                <td id="tableHotel">{{$h->site}}</td>
                <td id="tableHotel">{{$h->diarias}}</td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

    <!-- Passeios -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="8">PASSEIOS</th>
        </tr>
        <tr>
            <th>Nome</th>
            <th>Pais</th>
            <th>Cidade</th>
            <th>Ponto Partida</th>
            <th>Empresa</th>
            <th>Descrição</th>
            <th>Data Saída</th>
            <th>Hora Ida</th>
        </tr>
        @foreach($clientes->passeios as $p)
            <?php if($p->orcamento == 0){?>
            <tr class="text-center">
                <td>{{ $p->nome }}</td>
                <td>{{ $p->cidades->codigo_pais}}</td>
                <td>{{ $p->cidades->nome}}</td>
                <td>{{ $p->ponto_partida }}</td>
                <td>{{ $p->empresa_passeio }}</td>
                <td>{{ $p->descricao }}</td>
                <td>{{ $p->data_ida }}</td>
                <td>{{ $p->hora_ida }}</td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

    <!-- Extras-->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="5"> EXTRAS</th>
        </tr>
        <tr>
            <th>Nome</th>
            <th>País</th>
            <th>Cidade</th>
            <th>Data Saída</th>
            <th>Hora Ida</th>
        </tr>
        </thead>
        <tbody>

        @foreach($clientes->extras as $e)
            <?php if($e->orcamento == 0){?>
            <tr class="text-center">
                <td>{{ $e->nome }}</td>
                <td>{{ $e->cidades->codigo_pais}}</td>
                <td>{{ $e->cidades->nome}}</td>
                <td>{{ $e->data_saida }}</td>
                <td>{{ $e->hora_ida }}</td>
            </tr>
            <?php } ?>
        @endforeach
    </table>
    <br/><br/>

    <div class ="row">
        <div class="col-md-4 table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th>Valor do Aereo Principal</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="checkbox" id="2A" name="2A" value="Sim">
                    </td>
                    <td>2 Vezes</td>
                    <td><input name="valor2V" id="valor2V" class="text-center" readonly/></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" id="3A" name="3A" value="Sim">
                    </td>
                    <td>3 Vezes</td>
                    <td><input name="valor3V" id="valor3V" class="text-center" readonly/></td>
                </tr>
                <tr>
                    <td>
                         <input type="checkbox" id="5A" name="5A" value="Sim">
                    </td>
                    <td>5 Vezes</td>
                    <td><input name="valor5V" id="valor5V" class="text-center" readonly/></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" id="10A" name="10A" value="Sim">
                    </td>
                    <td>10 Vezes</td>
                    <td><input name="valor10V" id="valor10V" class="text-center" readonly/></td>
                </tr>
                <tr>
                    <td>
                        Total
                    </td>
                    <td id="valorAereo" colspan="2"><input name="valorV" id="valorV" class="text-center" readonly/></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th>Valor do Pacote</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="checkbox" name="2P" id="2P" value="Sim">
                    </td>
                    <td>2 Vezes</td>
                    <td><input name="valor2" id="valor2" class="text-center" readonly/></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="3P" id="3P" value="Sim">
                    </td>
                    <td>3 Vezes</td>
                    <td><input name="valor3" id="valor3" class="text-center" readonly/></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="5P" id="5P" value="Sim">
                    </td>
                    <td>5 Vezes</td>
                    <td><input name="valor5" id="valor5" class="text-center" readonly/></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="6P" id="6P" value="Sim">
                    </td>
                    <td>6 Vezes</td>
                    <td><input name="valor6" id="valor6" class="text-center" readonly/></td>
                </tr>
                <tr>
                    <td>
                        Total
                    </td>
                    <td id="totalPacote" colspan="2"><input name="valor" id="valor" class="text-center" readonly/></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <a onclick="goBack()" class="btn-sm btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
    {{--<a onclick="" class="btn-sm btn-info"><span class="glyphicon glyphicon-envelope"></span> Enviar por e-mail</a>--}}
    <a href="{{ route('pdfCompra',['id'=>$clientes->id]) }}" class="btn-sm btn-danger"><span class="glyphicon glyphicon-print"></span> Gerar Pdf</a>

    <br/><br/><br/>


    </div>
</div>

@section('post-script')
    <script type="text/javascript">

        $('#2A').on('click',function(e){
            $("#3A").attr("checked",false);
            $("#5A").attr("checked",false);
            $("#10A").attr("checked",false);

        });
        $('#3A').on('click',function(e){
            $("#2A").attr("checked",false);
            $("#5A").attr("checked",false);
            $("#10A").attr("checked",false);
        });
        $('#5A').on('click',function(e){
            $("#3A").attr("checked",false);
            $("#2A").attr("checked",false);
            $("#10A").attr("checked",false);
        });
        $('#10A').on('click',function(e){
            $("#3A").attr("checked",false);
            $("#5A").attr("checked",false);
            $("#2A").attr("checked",false);
        });

        /* Parte do Pacotes*/

        $('#2P').on('click',function(e){
            $("#3P").attr("checked",false);
            $("#5P").attr("checked",false);
            $("6P").attr("checked",false);

        });
        $('#3P').on('click',function(e){
            $("#2P").attr("checked",false);
            $("#5P").attr("checked",false);
            $("#6P").attr("checked",false);

        });
        $('#5P').on('click',function(e){
            $("#3P").attr("checked",false);
            $("#2P").attr("checked",false);
            $("#6P").attr("checked",false);
        });
        $('#6P').on('click',function(e){
            $("#3P").attr("checked",false);
            $("#5P").attr("checked",false);
            $("#2P").attr("checked",false);

        });


        var test = 'R$ 1500';
        function getMoney( num )
        {
            var str = num.toString();

            return parseInt( str.replace(/[\D]+/g,'') );
        }

        function formatReal(mixed) {
            var int = parseInt(mixed.toFixed(2).toString().replace(/[^\d]+/g, ''));
            var tmp = int + '';
            tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
            if (tmp.length > 6)
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

            return tmp;
        }

        var int = getMoney( test );
        //alert( int );

//        console.log( formatReal( 1000 ) );
//        console.log( formatReal( 19990020 ) );
//        console.log( formatReal( 12006 ) );
//        console.log( formatReal( 111090 ) );
//        console.log( formatReal( 1111 ) );
//        console.log( formatReal( 120090 ) );
//        console.log( formatReal( int ) );

        var valorTotal = <?php echo $total; ?>

        $('input[name=valor]').val('R$ '+formatReal(valorTotal));
        $('input[name=valor2]').val('R$ '+formatReal(valorTotal / 2));
        $('input[name=valor3]').val('R$ '+formatReal(valorTotal / 3));
        $('input[name=valor5]').val('R$ '+formatReal(valorTotal / 5));
        $('input[name=valor6]').val('R$ '+formatReal(valorTotal / 6));

        var valorVoosPrin = <?php echo $valorVoosPrincipais; ?>

        $('input[name=valorV]').val('R$ '+formatReal(valorVoosPrin));
        $('input[name=valor2V]').val('R$ '+formatReal(valorVoosPrin / 2));
        $('input[name=valor3V]').val('R$ '+formatReal(valorVoosPrin / 3));
        $('input[name=valor5V]').val('R$ '+formatReal(valorVoosPrin / 5));
        $('input[name=valor10V]').val('R$ '+formatReal(valorVoosPrin / 10));


    </script>
@endsection
@endsection
</body>
<html>
