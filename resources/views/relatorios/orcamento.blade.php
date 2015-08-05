<html>
<head>
    <title>Relatórios</title>
</head>

<body>

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
    <div class="container"><br/><br/><br/><br/><br/>

        <span class="logo">&nbsp;</span>

        <span class="tel">tel:(31)9158-9472 email:viajarbaratoamericadosul@gmail.com</span>

        <span class="titulo" >Orçamento</span>

        <legend class="nomeCliente">{{$clientes->nome}}</legend>
        <br/>

        <!-- Voos -->
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <th colspan="11">VOOS
                    <div class="pull-right">
                        <div class="pull-right">
                            <span class="badge">{{$contVoo}}</span>
                        </div>
                    </div>
                </th>
            <tr>
                <th class="cod">ID</th>
                <th class="nome">Voos</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Data Ida</th>
                <th>Data Volta</th>
                <th>Hora Ida</th>
                <th>Hora Volta</th>
                <th>Local Embarque</th>
                <th>Local Desembarque</th>
                <th>Principal</th>
            </tr>
            @foreach($clientes->voos as $voo)
                <?php if($voo->orcamento == 0){?>
                <tr class="text-center">
                    <td class="cod">{{$voo->id}}</td>
                    <td class="nome">{{$voo->nome_voo}}</td>
                    <td class="pais">{{$voo->cidades->codigo_pais}}</td>
                    <td class="cidade">{{$voo->cidades->nome}}</td>
                    <td>{{$voo->data_ida}}</td>
                    <td>{{$voo->data_volta}}</td>
                    <td>{{$voo->hora_ida}}</td>
                    <td>{{$voo->hora_volta}}</td>
                    <td>{{$voo->local_emb}}</td>
                    <td>{{$voo->local_des}}</td>
                    <td>{{$voo->principal}}</td>
                </tr>
                <?php } ?>
            @endforeach
        </table>

        <!-- Trens -->
        <table class="table table-striped table-bordered table-hover">
            <th colspan="7">TRENS
                <div class="pull-right">
                    <div class="pull-right">
                        <span class="badge">{{$contTrem}}</span>
                    </div>
                </div>
            </th>
            <tr>
                <th class="cod">ID</th>
                <th class="nome">Nome</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Destino</th>
                <th>Data Ida</th>
                <th>Hora Ida</th>
            </tr>

            @foreach($clientes->trens as $trem)
                <?php if($trem->orcamento == 0){?>
                <tr class="text-center">
                    <td class="cod">{{$trem->id}}</td>
                    <td class="nome">{{$trem->nome}}</td>
                    <td class="pais">{{$trem->cidades->codigo_pais}}</td>
                    <td class="cidade">{{$trem->cidades->nome}}</td>
                    <td>{{$trem->destino}}</td>
                    <td>{{$trem->data_saida}}</td>
                    <td>{{$trem->hora_ida}}</td>
                </tr>
                <?php } ?>
            @endforeach
        </table>

        <!-- Transfer -->
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <th colspan="6">TRANSFERS
                    <div class="pull-right">
                        <div class="pull-right">
                            <span class="badge">{{$contTransfer}}</span>
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th class="cod">ID</th>
                <th class="nome">Nome</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Data Ida</th>
                <th>Hora Ida</th>
            </tr>
            @foreach($clientes->transfers as $transf)
                <?php if($transf->orcamento == 0){?>
                <tr class="text-center">
                    <td class="cod">{{$transf->id}}</td>
                    <td class="nome">{{$transf->nome}}</td>
                    <td class="pais">{{$transf->cidades->codigo_pais}}</td>
                    <td class="cidade">{{$transf->cidades->nome}}</td>
                    <td>{{$transf->data_ida}}</td>
                    <td>{{$transf->hora_ida}}</td>
                </tr>
                <?php } ?>
            @endforeach
        </table>

        <!-- Hospedagens -->
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <th colspan="8">HOSPEDAGENS
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
                <th>Checki in</th>
                <th>Check out</th>
                <th>Qtd. Adultos</th>
                <th>Qtd. Crianças</th>
            </tr>
            @foreach($clientes->hoteis as $h)
                <?php if($h->orcamento == 0){?>
                <tr class="text-center" style="font-size:11px;">
                    <td class="cod">{{$h->id}}</td>
                    <td class="nome">{{$h->nome}}</td>
                    <td class="pais">{{$h->cidades->codigo_pais}}</td>
                    <td class="cidade">{{$h->cidades->nome}}</td>
                    <td>{{$h->data_entrada}}</td>
                    <td>{{$h->data_saida}}</td>
                    <td>{{$h->qtd_adultos}}</td>
                    <td>{{$h->qtd_criancas}}</td>
                </tr>
                <?php } ?>
            @endforeach
        </table>

        <!-- Passeios -->
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <th colspan="7">PASSEIOS
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
                <th>Descrição</th>
                <th>Data Saída</th>
                <th>Hora Ida</th>
            </tr>
            @foreach($clientes->passeios as $p)
                <?php if($p->orcamento == 0){?>
                <tr class="text-center">
                    <td class="cod">{{$p->id}}</td>
                    <td class="nome">{{$p->nome}}</td>
                    <td class="pais">{{$p->cidades->codigo_pais}}</td>
                    <td class="cidade">{{$p->cidades->nome}}</td>
                    <td>{{$p->empresa_passeio}}</td>
                    <td>{{$p->descricao}}</td>
                    <td>{{$p->data_ida}}</td>
                    <td>{{$p->hora_ida}}</td>
                </tr>
                <?php } ?>
            @endforeach
        </table>

        <!-- Extras-->
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <th colspan="6"> EXTRAS  <div class="pull-right">
                        <div class="pull-right">
                            <span class="badge">{{$contExtras}}</span>
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th>ID</th>
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
                    <td>{{ $e->id }}</td>
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
