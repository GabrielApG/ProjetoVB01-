@extends('app')
@section('content')

    @if ($errors->any())
        <ul class="alert alert-info">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

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

<div class="container">
    <legend><span class="glyphicon glyphicon-tasks"></span> PACOTE - {{$clientes->nome}}</legend><br />
    <ul class="nav nav-tabs">
        {{--<li role="presentation"><a href="{{ route('clientes.orcamento',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-usd"></span> Orçamento</a></li>--}}
        <li role="presentation" class="active"><a href="{{ route('clientes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-tasks"></span> Pacote</a></li>
        <li role="presentation"><a href="{{ route('clientes.detalhesClientes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span> Inf. Pessoais</a></li>
        <li role="presentation"><a href="{{ route('dependentes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span> Dep.</a></li>
        <li role="presentation"><a href="{{ route('relatorios',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-file"></span> Rel.</a></li>
        <li role="presentation"><a href="{{ route('voos.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{ route('transfers.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{ route('passeios.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{ route('hoteis.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{ route('extras.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
        <li role="presentation"><a href="{{ route('observacao.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-book"></span> Observações</a></li>
    </ul>
    <br />

    <!-- Situação Categoria e Pacotes -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Situação <a href="#situacao" rel="modal" class="btn-xs btn-warning" role="group" data-toggle="modal" data-target="#situacao" data-whatever="@mdo" ><span class="glyphicon glyphicon-modal-window"></span></a></th>
            <th>Categoria
            </th>
            <th>Pacote <a href="#pacote" rel="modal" class="btn-xs btn-warning" role="group" data-toggle="modal" data-target="#pacote" data-whatever="@mdo" ><span class="glyphicon glyphicon-modal-window"></span></a></th>
            <th>Valor da Compra</th>
            <th>Valor Voos Principais</th>
        </tr>
        <tr class="text-center">
            <td>{{$clientes->situacoes->nome}}</td>
            <td>{{ $clientes->categorias->nome }}</td>
            <td>{{ $clientes->pacotes->nome }}</td>
            <td><strong>R$ {{$total}}</strong></td>
            <td><strong>R$ {{$valorVoosPrincipais}}</strong></td>
        </tr>
    </table>

    <!-- Lembrete -->
    <div>
        <label><b>Lembrete</b><a href="#lembrete" rel="modal" class="btn-xs btn-warning" role="group" data-toggle="modal" data-target="#lembrete" data-whatever="@mdo" ><span class="glyphicon glyphicon-comment"></span></a></label>
            <textarea name="lembretes" id="lembretes" cols="15" rows="2" readonly="readonly" class="table table-striped table-bordered table-hover">{{$clientes->lembretes}}
            </textarea>
    </div>

    {{--<table class="table table-striped table-bordered table-hover">--}}
        {{--<th colspan="7"> RESUMO</th>--}}
        {{--<tr>--}}
            {{--<th>Total Voos</th>--}}
            {{--<th>Total Voos Principais</th>--}}
            {{--<th>Total Trens</th>--}}
            {{--<th>Total Transfers</th>--}}
            {{--<th>Total Hospedagens</th>--}}
            {{--<th>Total Passeios</th>--}}
            {{--<th>Total Extras</th>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td></td>--}}
            {{--<td></td>--}}
            {{--<td></td>--}}
            {{--<td></td>--}}
            {{--<td></td>--}}
            {{--<td></td>--}}
            {{--<td></td>--}}
        {{--</tr>--}}
    {{--</table>--}}

    <style>
        #td{
            font-size: 9px; }
    </style>

    <!-- Voos -->
     <table class="table table-striped table-bordered table-hover">
         <tr>
             <th colspan="14">VOOS
                 <div class="pull-right">
                     <div class="pull-right">
                         <a href="#voos" rel="modal" class="linkadicionadetalhe" role="group" data-toggle="modal" data-target="#voos" data-whatever="@mdo" >
                         {{--<a class="linkadicionadetalhe" href="{{ route('voos.createVooCliente',['id'=>$clientes->id]) }}">--}}
                             <span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
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
            <th class="valores">V. Voo R$</th>
            <th class="acoes" colspan="2">Ações</th>
        </tr>
         @foreach($clientes->voos as $v)
             <?php if($v->orcamento == 0){?>
             <tr class="text-center">
                 <td class="cod" id="td">{{$v->id}}</td>
                 <td class="nome">{{$v->nome_voo}}</td>
                 <td class="pais">{{$v->cidades->codigo_pais}}</td>
                 <td class="cidade">{{$v->cidades->nome}}</td>
                 <td>{{$v->data_ida}}</td>
                 <td>{{$v->data_volta}}</td>
                 <td>{{$v->hora_ida}}</td>
                 <td>{{$v->hora_volta}}</td>
                 <td>{{$v->local_emb}}</td>
                 <td>{{$v->local_des}}</td>
                 <td>{{$v->principal}}</td>
                 <td class="valores">R$ {{$v->valor}}</td>
                 <td class="acoes">
                     <a href="{{ route('voos.editVooCliente',['id'=>$v->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                 </td>
                 <td class="acoes">
                     <a href="{{ route('voos.storeDetach',['id'=>$v->id]) }}" name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
                 </td>
             </tr>
                 <?php } ?>
         @endforeach
    </table>

    <!-- Trens -->
    <table class="table table-striped table-bordered table-hover">
        <th colspan="10">TRENS
            <div class="pull-right">
                <div class="pull-right">
                    <a href="#trens" rel="modal"  class="btn-group" role="group" data-toggle="modal" data-target="#trens" data-whatever="@mdo" >
                        <span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
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
            <th class="valores">V. Trem R$</th>
            <th class="acoes" colspan="2">Ações</th>
        </tr>

        @foreach($clientes->trens as $t)
            <?php if($t->orcamento == 0){?>
            <tr class="text-center">
                <td class="cod">{{$t->id}}</td>
                <td class="nome">{{$t->nome}}</td>
                <td class="pais">{{$t->cidades->codigo_pais}}</td>
                <td class="cidade">{{$t->cidades->nome}}</td>
                <td>{{$t->destino}}</td>
                <td>{{$t->data_saida}}</td>
                <td>{{$t->hora_ida}}</td>
                <td class="valores">R$ {{$t->valor}}</td>
                <td class="acoes">
                    <a href="{{ route('trens.editTremCliente',['id'=>$t->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td align="center" class="acoes">
                    <a href="{{ route('trens.storeDetach',['id'=>$t->id]) }}" name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

    <!-- Transfer -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="9">TRANSFERS
                <div class="pull-right">
                    <div class="pull-right">
                        <a href="#transfer" rel="modal" class="linkadicionadetalhe" role="group" data-toggle="modal" data-target="#transfer" data-whatever="@mdo" >
                            <span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
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
            <th class="valores">V. Transfer R$</th>
            <th class="acoes" colspan="2">Ações</th>
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
                <td class="valores">R$ {{$transf->valor}}</td>
                <td class="acoes">
                    <a href="{{ route('transfers.editTransferCliente',['id'=>$transf->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td class="acoes">
                    <a href="{{ route('transfers.storeDetachOrcamento',['id'=>$transf->id]) }}" name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
                <?php } ?>
        @endforeach
    </table>

    <!-- Hospedagens -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="14">HOSPEDAGENS
                <div class="pull-right">
                    <div class="pull-right">
                        <a href="#hotel" rel="modal" class="linkadicionadetalhe" role="group" data-toggle="modal" data-target="#hotel" data-whatever="@mdo" >
                            <span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
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
            <th>Diárias</th>
            <th>V. Diária R$</th>
            <th class="valores">V. Total R$</th>
            <th class="valores">V. Extra R$</th>
            <th class="acoes" colspan="2">Ações</th>
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
            <td>{{$h->diarias}}</td>
            <td class="valores">R$ {{$h->valor}}</td>
            <td class="valores">R$
                <?php

                    if($h->diarias == 0 || $h->qtd_adultos == 0 || $h->qtd_adultos == 0){

                    }else if($h->diarias == 0){

                        echo ($h->valor / $h->qtd_adultos) + $h->valor_extra;

                    }else if($h->qtd_adultos == 0){

                        echo ($h->valor / $h->qtd_adultos) * $h->diarias;
                    }
                    else if($h->valor_extra == 0){

                        echo ($h->valor / $h->qtd_adultos) * $h->diarias;
                    }
                    else{
                         echo ($h->valor / $h->qtd_adultos) * $h->diarias + $h->valor_extra;
                    }
                ?>
            </td>
            <td>{{$h->valor_extra}}</td>
            <td class="acoes">
                <a href="{{ route('hoteis.editHotelCliente',['id'=>$h->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
            </td>
            <td class="acoes">
                <a href="{{ route('hoteis.storeDetachOrcamento',['id'=>$h->id]) }}" name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
            </td>
        </tr>
       <?php } ?>
        @endforeach
    </table>

    <!-- Passeios -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="11">PASSEIOS
                <div class="pull-right">
                    <div class="pull-right">
                        <a href="#passeio" rel="modal" class="linkadicionadetalhe" role="group" data-toggle="modal" data-target="#passeio" data-whatever="@mdo" >
                            <span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
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
            <th class="valores">Valor R$</th>
            <th class="acoes" colspan="2">Ações</th>
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
                <td class="valores">R$ {{$p->valor}}</td>
                <td class="acoes">
                    <a href="{{ route('passeios.editPasseiosCliente',['id'=>$p->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td class="acoes"><a href="{{ route('passeios.storeDetachOrcamento',['id'=>$p->id]) }}" name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

    <!-- Extras -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="9">EXTRAS
                <div class="pull-right">
                    <div class="pull-right">
                        <a href="#extra" rel="modal" class="linkadicionadetalhe" role="group" data-toggle="modal" data-target="#extra" data-whatever="@mdo" >
                            <span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
                        <span class="badge">{{$contExtras}}</span>
                    </div>
                </div>
            </th>
        </tr>
        </tr>
        <tr>
            <th class="cod">ID</th>
            <th class="nome">Nome</th>
            <th class="pais">País</th>
            <th class="cidade">Cidade</th>
            <th>Data Saída</th>
            <th>Hora Ida</th>
            <th class="valores">Valor R$</th>
            <th class="acoes" colspan="2">Ações</th>
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
                <td class="valores">{{ $e->valor }}</td>
                <td class="acoes">
                    <a href="{{ route('extras.editExtraCliente',['id'=>$e->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td class="acoes">
                    <a href="{{route('extras.storeDetach',['extras_id'=>$e->id])}}" name="excluir" class="btn-xs btn-danger"> <span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

    <!-- Roteiros -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="7">ROTEIRO
                <div class="pull-right">
                    <div class="pull-right">
                        <a href="#roteiro" rel="modal" class="linkadicionadetalhe" role="group" data-toggle="modal" data-target="#roteiro" data-whatever="@mdo" >
                            <span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
                        <span class="badge">{{$contRoteiros}}</span>
                    </div>
                </div>
            </th>
        </tr>
        <tr>
            <th class="cod">ID</th>
            <th class="nome">Nome</th>
            <th class="pais">Pais</th>
            <th class="cidade">Cidade</th>
            <th>Descrição</th>
            <th colspan="2">Ações</th>
        </tr>
        @foreach($clientes->roteiros as $r)
            <?php if($r->orcamento == 0){?>
            <tr class="text-center">
                <td>{{$r->id}}</td>
                <td>{{$r->nome}}</td>
                <td>{{$r->cidades->codigo_pais}}</td>
                <td>{{$r->cidades->nome}}</td>
                <td class="text-justify" id="td">{{$r->descricao}}</td>
                <td class="acoes">
                    <a href="{{route('roteiros.edit',['roteiros_id'=>$r->id])}}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td class="acoes">
                    <a href="{{route('roteiros.storeDetach',['roteiros_id'=>$r->id])}}" name="excluir" class="btn-xs btn-danger"> <span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

</div>

<!-- Roteiros-->
<div class="modal fade" id="roteiro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione o Roteiro:</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=>['roteiros.storeAttach'], 'method'=>'post']) !!}

                <div class="form-group">
                    <label for="transfersdispCreateTransfers">Roteiros Disponíveis <span class="campo_obrigatorio">*</span></label>
                    {!! Form::select('roteiros_id', array('0' => 'Selecione') + $roteiros, '0', ['class'=>'form-control','id'=>'roteiros_id'])!!}
                </div>

                {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                <input name="nome" id="nome" class="form-control" type="hidden" readonly>

                <div class="form-group">
                    <label>Nome</label>
                    <div>
                        <input name="nome" id="nome" class="form-control">
                    </div>
                </div>

                <input name="cidades_id" id="cidades_id" class="form-group" type="hidden">

                <div class="form-group">
                    <label for="descricao">Descrição:<span class="campo_obrigatorio">*</span></label>
                    <textarea name="descricao" id="descricao" class="form-control"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!-- Extra-->
<div class="modal fade" id="extra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione o Extra:</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=>['extras.storeAttach'],'method'=>'post']) !!}

                <div class="form-group">
                    <label for="transfersdispCreateTransfers">Extras Disponíveis <span class="campo_obrigatorio">*</span></label>
                    {!! Form::select('extras_id', array('0' => 'Selecione') + $extras, '0', ['class'=>'form-control','id'=>'transfersdispCreateTransferCliente'])!!}
                </div>

                {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                <input name="nome" id="nome" class="form-control" type="hidden" readonly >

                <div class="form-group">
                    <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
                    <input name="nome" id="nome" class="form-control" type="hidden" readonly >
                </div>

                <div class="form-group">
                    <label name="preco" id="preco">Preço R$: </label>
                    <input name="valor" id="valorExtra" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

<!-- Hoteis-->
<div class="modal fade" id="hotel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione o Hotel:</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=>['hoteis.storeAttach'], 'method'=>'post']) !!}

                <div class="form-group-xs">
                    {!! Form::label('hoteis_id', 'Hoteis Disponíveis:') !!}
                    {!! Form::select('hoteis_id', array('0' => 'Selecione') + $hoteis, '0', ['class'=>'form-control','id'=>'hoteis_id'])!!}
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                    <input name="nome" id="nome" class="form-control" type="hidden" readonly >
                </div>

                <div class="form-group-xs">
                    {!! Form::label('qtd_adultos', 'Qtd. Adultos:') !!}
                    <input name="qtd_adultos" id="qtd_adultos" class="form-control">
                </div>

                <div class="form-group-xs">
                    {!! Form::label('qtd_criancas', 'Qtd Crianças:') !!}
                    <input name="qtd_criancas" id="qtd_criancas" class="form-control">
                </div>

                <div class="form-group-xs">
                    {!! Form::label('diarias', 'Diárias:') !!}
                    <input name="diarias" id="diarias" class="form-control">
                </div>

                <div class="form-group-xs">
                    {!! Form::label('valor', 'Valor R$:') !!}
                    <input name="valor" id="valorHotel" class="form-control">
                </div>

                <div class="form-group-xs"><span class="campo_obrigatorio">
                    {!! Form::label('valor_extra', 'Valor Extra R$:') !!}</span>
                    <input name="valor_extra" id="valor_extra" class="form-control">
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
                    {!! Form::hidden('orcamento', 0, ['class'=>'form-control']) !!}
                </div>
                <br/>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

<!-- Passeios-->
<div class="modal fade" id="passeio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione o Passeio:</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=>['passeios.storeAttach'], 'method'=>'post']) !!}

                <div class="form-group-xs">
                    {!! Form::label('passeios', 'Passeios Disponíveis:') !!}
                    {!! Form::select('passeios_id', array('0' => 'Selecione') + $passeios, '0', ['class'=>'form-control','id'=>'passeios_id'])!!}
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                    <input name="nome" id="nome" class="form-control" type="hidden" readonly >
                </div>

                <div class="form-group-xs">
                    <label name="ponto_partida" id="ponto_partida">Ponto Partida: </label> <!-- Campo Oculto -->
                    <input name="ponto_partida" id="ponto_partida" class="form-control">
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
                </div>

                <div class="form-group-xs">
                    <label name="empresa_passeio" id="empresa_passeio">Empresa:(Obrigatório)</label>
                    <input name="empresa_passeio" id="empresa_passeio" class="form-control">
                </div>

                <div class="form-group-xs">
                    <label name="preco" id="preco">Valor R$: </label>
                    <input name="valor" id="valorPasseio" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

<!-- Transfers-->
<div class="modal fade" id="transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione o Transfer:</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=>['transfers.storeAttach'], 'method'=>'post']) !!}

                <div class="form-group-xs">
                    {!! Form::label('transfers_id', 'Transfers Disponíveis:') !!}
                    {!! Form::select('transfers_id', array('0' => 'Selecione') + $transfers, '0', ['class'=>'form-control','id'=>'transfers_id'])!!}
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                    <input name="nome" id="nome" class="form-control" type="hidden" readonly >
                </div>

                <div class="form-group-xs">
                    <label name="preco" id="preco">Valor R$: </label>
                    <input name="valor" id="valorTransfer" class="form-control">
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
                </div>

                <br/>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

<!-- Trens-->
<div class="modal fade" id="trens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione o Trem:</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['trens.storeAttach'], 'method'=>'post']) !!}
                <div class="form-group"> <!-- Campo Oculto -->
                    {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('trens', 'Trens Disponíveis:') !!}
                    {!! Form::select('trens_id', array('0' => 'Selecione') + $trem, '0', ['class'=>'form-control'])!!}
                </div>

                <div class="form-group">
                    <label>Destino: </label>
                    <input name="destino" id="destino" class="form-control">
                    <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
                </div>

                <div class="form-group">
                    <label>Preço: </label>
                    <input name="valor" id="valorTrem" class="form-control">
                    <input name="nome" id="nome" class="form-control" type="hidden">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!-- Voos-->
<div class="modal fade" id="voos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione o Voo:</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=>['voos.storeAttach'], 'class'=>'form-horizontal', 'method'=>'post']) !!}
                <div class="form-group-xs">
                    {!! Form::label('voos_id', 'Voos Disponíveis:') !!}
                    {!! Form::select('voos_id', array('0' => 'Selecione') + $voo, '0', ['class'=>'form-control','id'=>'voos_id'])!!}
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                    {!! Form::hidden('orcamento', 0, ['class'=>'form-control']) !!}
                    <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
                </div>

                <div class="form-group-xs">
                    {!! Form::label('origem', 'Origem:') !!}
                    <input name="local_emb" id="local_emb" class="form-control">
                </div>

                <div class="form-group-xs">
                    {!! Form::label('local_des', 'Destino:') !!}
                    <input name="local_des" id="local_des" class="form-control">
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    <input name="nome_voo" id="nome_voo" class="form-control" type="hidden">
                </div>

                <div class="form-group-xs">
                    {!! Form::label('valor', 'Valor:(Obrigatório)') !!}
                    <input name="valor" id="valorVoo" class="form-control">
                </div>
                <br/>

                <div class="checkbox">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="principal" id="principal" value="Sim"> Voo Principal
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!-- Pacotes-->
<div class="modal fade" id="pacote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione o Pacote:</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['clientes.updateSituacao', $clientes->id], 'method'=>'put']) !!}

                <div class="form-group">
                    {!! Form::label('categoria', 'Categorias:') !!}
                    {!! Form::select('categorias_id', $categoria, $clientes->categorias->id, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('pacote', 'Pacote:') !!}
                    {!! Form::select('pacotes_id',$pacote, $clientes->pacotes->id, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::submit('Alterar Pacote', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!-- Situação-->
<div class="modal fade" id="situacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione a Situação:</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['clientes.updateSituacao', $clientes->id], 'method'=>'put']) !!}
                <div class="form-group">
                    {!! Form::label('situacao', 'Situacao:') !!}
                    {!! Form::select('situacoes_id',$situacao, $clientes->situacoes->id, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::submit('Alterar Situação', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!-- Lembrete-->
<div class="modal fade" id="lembrete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione a Situação:</h4>
            </div>
            <div class="modal-body">
                 {!! Form::open(['route'=>['clientes.updateLembrete', $clientes->id], 'method'=>'put']) !!}
                <div>
                    <label for="">Lembretes:</label>
                    <textarea name="lembretes" id="lembretes" cols="30" rows="3" class="table table-striped table-bordered table-hover">{{$clientes->lembretes}}
                </textarea>
                </div>
                <div class="form-group" align="right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::submit('Salvar lembrete', ['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


<!-- Java Script para efeito MODAL -->
@section('post-script')
<script type="text/javascript">

    trocaBackground();

        $('a[name=excluir]').on('click', function () {
            $('a[name=excluir]').confirmation();
        });

    $('select[name=categorias_id]').change(function () {
        var idCategoria = $(this).val();

        $.get('/get-pacotes/' + idCategoria, function (pacotes_id) {
            $('select[name=pacotes_id]').empty();
            $.each(pacotes_id, function (key, value) {
                $('select[name=pacotes_id]').append('<option value=' + value.id + '>' + value.nome + '</option>');
            });
        });
    });

    // TREM
    $('select[name=trens_id]').change(function () {
        var idTrem = $(this).val();
        $('#valorTrem').empty();
        $('input[name=destino]').empty();
        $('input[name=cidades_id]').empty();
        $('input[name=nome]').empty();
        $.get('/get-valor/' + idTrem, function (valor) {
            $.each(valor, function (key, value) {
                $('#valorTrem').val(value.valor);
                $('input[name=destino]').val(value.destino);
                $('input[name=cidades_id]').val(value.cidades_id);
                $('input[name=nome]').val(value.nome);
            });
        });
    });

    // VOO
    $('select[name=voos_id]').change(function () {
        var t = $('#voos_id').val();
        if(t == 0){ // Oculta Btn Submit
            //alert('Selecione um Trem Válido!');
            $("#submit").hide();
            $('input[name=nome_voo]').val('');
            $('input[name=cidades_id]').val('');
            $('#valorVoo').val('');
            $('input[name=local_emb]').val('');
            $('input[name=local_des]').val('');
        }else{ // Mostra Btn Submit
            $("#submit").show();
        }
        var idVoo = $(this).val();

        $.get('/get-voo/' + idVoo, function (valor) {
            $.each(valor, function (key, value) {
                $('input[name=nome_voo]').val(value.nome_voo);
                $('input[name=cidades_id]').val(value.cidades_id);
                $('#valorVoo').val(value.valor);
                $('input[name=local_emb]').val(value.local_emb);
                $('input[name=local_des]').val(value.local_des);
            });
        });
    });


    //TRANSFERS
    $('select[name=transfers_id]').change(function () {

        var t = $('#transfers_id ').val();
        if(t == 0){ // Oculta Btn Submit
            //alert('Selecione um Trem Válido!');
            $("#submit").hide();
            $('#valorTransfer').val('');
            $('input[name=cidades_id]').val('');
            $("input[name=nome]").val('');
        }else{ // Mostra Btn Submit
            $("#submit").show();
        }
        var idTransfer = $(this).val();
        $.get('/get-transf/' + idTransfer, function (valor) {
            $.each(valor, function (key, value) {

                $('#valorTransfer').val(value.valor);
                $('input[name=cidades_id]').val(value.cidades_id);
                $('input[name=destino]').val(value.destino);
                $("input[name=nome]").val(value.nome);
            });
        });
    });

    //PASSEIOS
    $('select[name=passeios_id]').change(function () {

        var t = $('#passeios_id').val();

        if(t == 0){ // Oculta Btn Submit
            //alert('Selecione um Trem Válido!');
            $("#submit").hide();
            $('#valorPasseio').val('');
            $('input[name=cidades_id]').val('');
            $('input[name=ponto_partida]').val('');
            $("input[name=nome]").val('');
            $("input[name=empresa_passeio]").val('');
        }else{ // Mostra Btn Submit
            $("#submit").show();
        }
        var idPasseio = $(this).val();

        $.get('/get-pass/' + idPasseio, function (valor) {
            $.each(valor, function (key, value) {
                $('#valorPasseio').val(value.valor);
                $('input[name=cidades_id]').val(value.cidades_id);
                $('input[name=ponto_partida]').val(value.ponto_partida);
                $("input[name=nome]").val(value.nome);
                $("input[name=empresa_passeio]").val(value.empresa_passeio);
            });
        });
    });

    //HOTEIS
    $('select[name=hoteis_id]').change(function () {

        var t = $('#hoteis_id').val();

        if(t == 0){ // Oculta Btn Submit
            //alert('Selecione um Trem Válido!');
            $("#submit").hide();
            $('#valorHotel').val('');
            $('input[name=cidades_id]').val('');
            $('input[name=destino]').val('');
            $("input[name=nome]").val('');
        }else{ // Mostra Btn Submit
            $("#submit").show();
        }
        var idHotel = $(this).val();

        $.get('/get-hot/' + idHotel, function (valor) {
            $.each(valor, function (key, value) {

                $('#valorHotel').val(value.valor);
                $('input[name=cidades_id]').val(value.cidades_id);
                $('input[name=destino]').val(value.destino);
                $("input[name=nome]").val(value.nome);
            });
        });
    });

    //Extras
    $('select[name=extras_id]').change(function () {

        var t = $('#extras_id ').val();
        if(t == 0){ // Oculta Btn Submit
            //alert('Selecione um Trem Válido!');
            $("#submit").hide();
            $('#valorExtra').val('');
            $('input[name=cidades_id]').val('');
            $("input[name=nome]").val('');
        }else{ // Mostra Btn Submit
            $("#submit").show();
        }
        var idExtra = $(this).val();

        $.get('/get-extra/' + idExtra, function (valor) {
            $.each(valor, function (key, value) {
                $('#valorExtra').val(value.valor);
                $('input[name=cidades_id]').val(value.cidades_id);
                $('input[name=destino]').val(value.destino);
                $("input[name=nome]").val(value.nome);
            });
        });
    });

    // ROTEIROS
    $('select[name=roteiros_id]').change(function () {

        var t = $('#roteiros_id ').val();
        if(t == 0){ // Oculta Btn Submit
            //alert('Selecione um Trem Válido!');
            $("#submit").hide();
            $('input[name=cidades_id]').val('');
            $("input[name=nome]").val('');
            $("textarea[name=descricao]").val('');
        }else{ // Mostra Btn Submit
            $("#submit").show();
        }
        var idRoteiro = $(this).val();

        $.get('/get-roteiro/' + idRoteiro, function (valor) {
            $.each(valor, function (key, value) {
                $('input[name=cidades_id]').val(value.cidades_id);
                $("input[name=nome]").val(value.nome);
                $("textarea[name=descricao]").val(value.descricao);
            });
        });
    });

</script>
@endsection
@endsection