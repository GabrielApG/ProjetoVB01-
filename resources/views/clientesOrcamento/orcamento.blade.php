@extends('app')
@section('content')

@if ($errors->any())
    <ul class="alert alert-info">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

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
    $contRoteiros = 0;
    $valorVoosPrincipais = 0;

    foreach($clientes->voos as $v){
        if($v->orcamento == 2 && $v->principal == 'Não'){
            $total = $total + $v->valor;
            $contVoo++;
        }
    }
    foreach($clientes->voos as $v){
        if($v->orcamento == 2 && $v->principal == 'Sim'){
            $valorVoosPrincipais = $valorVoosPrincipais + $v->valor;
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
            $valorHotel = $valorHotel * $hotel->diarias / ($contAdultos + $contCriancas);

            $total = $total + $valorHotel;
        }
    }
    foreach($clientes->extras as $extra){
        if($extra->orcamento == 1){
            $total = $total + $extra->valor;
            $contExtras++;
        }
    }
foreach($clientes->roteiros as $roteiro){
    if($roteiro->orcamento == 1){
        $contRoteiros++;
    }
}
?>

{{--  Div dos Menus  --}}
<div class="container">
    <legend><span class="glyphicon glyphicon-usd"></span> ORÇAMENTO - {{$clientes->nome}}</legend><br />
    <ul class="nav nav-tabs">
        {{--<li role="presentation" class="active"><a href="{{ route('clientes.orcamento',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-usd"></span> Orçamento</a></li>--}}
        <li role="presentation"><a href="{{ route('clientes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-tasks"></span> Pacote</a></li>
        <li role="presentation"><a href="{{ route('clientes.detalhesClientes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span> Inf. Pessoais</a></li>
        <li role="presentation"><a href="{{ route('dependentes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span> Dep.</a></li>
        <li role="presentation"><a href="{{ route('relatorios',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-file"></span> Rel.</a></li>
        <li role="presentation"><a href="{{ route('voos.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{ route('transfers.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{ route('passeios.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{route('hoteis.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{route('extras.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
    </ul>
    <br />

    <!-- Situação Categoria e Pacotes -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Situação <a href="#situacao" rel="modal" class="btn-xs btn-warning" role="group" data-toggle="modal" data-target="#situacao" data-whatever="@mdo" ><span class="glyphicon glyphicon-modal-window"></span></a></th>
            <th>Categoria
            </th>
            <th>Pacote <a href="#pacote" rel="modal" class="btn-xs btn-warning" role="group" data-toggle="modal" data-target="#pacote" data-whatever="@mdo" ><span class="glyphicon glyphicon-modal-window"></span></a></th>
            <th>Valor Orçamento</th>
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
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

    <!-- Voos -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="9">VOOS
                <a href="#voos" rel="modal" class="btn-group" role="group" data-toggle="modal" data-target="#voos" data-whatever="@mdo" >
                    <span class="glyphicon glyphicon-plus-sign"></span> Adicionar</a>
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
            <th class="valores">Principal</th>
            <th class="valores">Valor Voo:</th>
            <th class="acoes" colspan="2">Ações</th>
        </tr>
        @foreach($clientes->voos as $v)
            <?php if($v->orcamento == 2){?>
            <tr class="text-center">
                <td class="cod">{{$v->id}}</td>
                <td class="nome">{{$v->nome_voo}}</td>
                <td class="pais">{{$v->cidades->codigo_pais}}</td>
                <td class="cidade">{{$v->cidades->nome}}</td>
                <td>{{$v->local_des}}</td>
                <td>{{$v->principal}}</td>
                <td class="valores">{{$v->valor}}</td>
                <td class="acoes">
                    <a href="{{ route('voos.editVooOrcamento',['id'=>$v->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td align="center" class="acoes">
                    <a href="{{ route('voos.storeDetachOrcamento',['id'=>$v->id]) }}" name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
                <?php } ?>
        @endforeach
    </table>

    <!-- Trens -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="8">TRENS
                <a href="#trens" rel="modal"  class="btn-group" role="group" data-toggle="modal" data-target="#trens" data-whatever="@mdo" >
                    <span class="glyphicon glyphicon-plus-sign"></span> Adicionar</a>
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
            <th class="valores">Valor trem:</th>
            <th class="acoes" colspan="2">Ações</th>
        </tr>

        @foreach($clientes->trens as $t)
            <?php if($t->orcamento == 1){?>
             <tr class="text-center">
                <td class="cod">{{$t->id}}</td>
                <td class="nome">{{$t->nome}}</td>
                <td class="pais">{{$t->cidades->codigo_pais}}</td>
                <td class="cidade">{{$t->cidades->nome}}</td>
                <td>{{$t->destino}}</td>
                <td class="valores">{{$t->valor}}</td>
                 <td class="acoes">
                     <a href="{{ route('trens.editTremOrcamento',['id'=>$t->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                 </td>
                <td align="center" class="acoes">
                    <a href="{{ route('trens.storeDetachOrcamento',['id'=>$t->id]) }}" name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
            <?php } ?>
        @endforeach

    </table>

    <!-- Transfer-->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="7">TRANSFERS
                <a href="#transfer" rel="modal"  class="btn-group" role="group" data-toggle="modal" data-target="#transfer" data-whatever="@mdo" >
                    <span class="glyphicon glyphicon-plus-sign"></span> Adicionar</a>
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
            <th class="valores">Valor:</th>
            <th class="acoes" colspan="2">Ações</th>
        </tr>
        @foreach($clientes->transfers as $transf)
            <?php if($transf->orcamento == 1){?>
            <tr class="text-center">
                <td class="cod">{{$transf->id}}</td>
                <td class="nome">{{$transf->nome}}</td>
                <td class="pais">{{$transf->cidades->codigo_pais}}</td>
                <td>{{$transf->cidades->nome}}</td>
                <td class="valores">{{$transf->valor}}</td>
                <td class="acoes">
                    <a href="{{ route('transfers.editTransferOrcamento',['id'=>$transf->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td class="acoes">
                    <a href="{{ route('transfers.storeDetachOrcamento',['id'=>$transf->id]) }}" name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
                <?php }?>
        @endforeach
    </table>

    <!-- Hospedagens-->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="11"> HOSPEDAGENS
                <a href="#hotel" rel="modal"  class="btn-group" role="group" data-toggle="modal" data-target="#hotel" data-whatever="@mdo" >
                    <span class="glyphicon glyphicon-plus-sign"></span> Adicionar</a>
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
            <th>Valor da Diária R$</th>
            <th class="valores">Valor Total R$</th>
            <th class="acoes" colspan="2">Ações</th>
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
                <td class="valores">R$ {{$h->valor}}</td>
                <td class="valores">R$
                    <?php
                    if($h->qtd_criancas == 0 || $h->qtd_criancas == null){
                        echo $h->valor / $h->qtd_adultos * $h->diarias;
                    }else{
                        echo $h->valor / $h->qtd_adultos * $h->qtd_criancas * $h->diarias;
                    }
                ?></td>
                    <td class="acoes">
                        <a href="{{ route('hoteis.editHotelOrcamento',['id'=>$h->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                    </td>
                <td class="acoes">
                    <a href="{{ route('hoteis.storeDetachOrcamento',['id'=>$h->id]) }}" name="excluir"  class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

    <!-- Passeios -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="8">PASSEIOS
                <a href="#passeio" rel="modal"  class="btn-group" role="group" data-toggle="modal" data-target="#passeio" data-whatever="@mdo" >
                    <span class="glyphicon glyphicon-plus-sign"></span> Adicionar</a>
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
            <th class="valores">Valor</th>
            <th class="acoes" colspan="2">Ações</th>
        </tr>
        @foreach($clientes->passeios as $p)
            <?php if($p->orcamento == 1){?>
            <tr class="text-center">
                <td class="cod">{{$p->id}}</td>
                <td class="nome">{{$p->nome}}</td>
                <td class="pais">{{$p->cidades->codigo_pais}}</td>
                <td class="cidade">{{$p->cidades->nome}}</td>
                <td>{{$p->empresa_passeio}}</td>
                <td class="valores">{{$p->valor}}</td>
                <td class="acoes">
                    <a disabled href="{{ route('passeios.editPasseiosOrcamento',['id'=>$p->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td class="acoes"><a href="{{ route('passeios.storeDetachOrcamento',['id'=>$p->id]) }}"  name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
                </td>
            </tr>
            <?php } ?>
        @endforeach
    </table>

        <!-- Extras -->
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="7">EXTRAS
                <a href="#extra" rel="modal"  class="btn-group" role="group" data-toggle="modal" data-target="#extra" data-whatever="@mdo" >
                    <span class="glyphicon glyphicon-plus-sign"></span> Adicionar</a>
                <div class="pull-right">
                    <div class="pull-right">
                        <span class="badge">{{$contExtras}}</span>
                    </div>
                </div>
            </th>
        </tr>
        <tr>
            <th class="cod">ID</th>
            <th class="nome">Nome</th>
            <th class="pais">Pais</th>
            <th class="cidade">Cidade</th>
            <th class="valores">Valor</th>
            <th class="acoes" colspan="2">Ações</th>
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
                <td class="valores">{{$e->valor}}</td>
                <td class="acoes">
                    <a href="{{ route('extras.editExtraOrcamento',['id'=>$e->id,'idCliente'=>$clientes->id]) }}" name="edit" class="btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td class="acoes"><a href="{{ route('extras.storeDetachOrcamento',['id'=>$e->id]) }}"  name="excluir" class="btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
            </tr>
            <?php } ?>
        @endforeach
    </table>

{{-- Roteiros--}}
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="6"> ROTEIRO DA VIAGEM PARA ORÇAMENTO
                <a href="#roteiro" rel="modal"  class="btn-group" role="group" data-toggle="modal" data-target="#roteiro" data-whatever="@mdo" ><span class="glyphicon glyphicon-plus-sign"></span> Adicionar</a>
                <div class="pull-right">
                    <div class="pull-right">
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
            <th>Ações</th>
        </tr>
        @foreach($clientes->roteiros as $r)
            <?php if($r->orcamento == 1){?>
            <tr class="text-center">
                <td>{{$r->id}}</td>
                <td>{{$r->nome}}</td>
                <td>{{$r->cidades->codigo_pais}}</td>
                <td>{{$r->cidades->nome}}</td>
                <td>{{$r->descricao}}</td>
                <td class="acoes">
                    <a href="{{route('roteiros.storeDetachOrcamento',['roteiros_id'=>$r->id])}}" name="excluir" class="btn-xs btn-danger"> <span class="glyphicon glyphicon-trash"></span> </a>
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

                {!! Form::open(['route'=>['roteiros.storeAttachOrcamento'],'class'=>'form-horizontal', 'method'=>'post']) !!}

                <div>
                    <label >Transfers Disponíveis <span class="campo_obrigatorio">*</span></label>
                    <div>
                        {!! Form::select('roteiros_id', array('0' => 'Selecione') + $roteiros, '0', ['class'=>'form-control','id'=>'roteiros_id'])!!}
                    </div>
                </div>

                {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                <input name="nome" id="nome" class="form-control" type="hidden" readonly >

                <div>
                    <label>Nome</label>
                    <div>
                        <input name="nome" id="nome" class="form-control" readonly>
                    </div>
                </div>

                <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
                <div >
                    <label>Descrição <span class="campo_obrigatorio">*</span></label>
                    <div>
                        <textarea name="descricao" id="descricao" readonly class="form-control"></textarea>
                    </div>
                </div>
                <br/><br/>

                <div class="form-group">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
                </div>
                {!! Form::close() !!}
            </div>
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

                {!! Form::open(['route'=>['extras.storeAttachOrcamento'],'method'=>'post']) !!}

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
                    <input name="valor" id="valor" class="form-control" readonly>
                </div>

                <div class="form-group">
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

                {!! Form::open(['route'=>['hoteis.storeAttachOrcamento'], 'method'=>'post']) !!}

                <div class="form-group-xs">
                    {!! Form::label('hoteis_id', 'Hoteis Disponíveis:') !!}
                    {!! Form::select('hoteis_id', array('0' => 'Selecione') + $hoteis, '0', ['class'=>'form-control','id'=>'hoteis_id'])!!}
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                    <input name="nome" id="nome" class="form-control" type="hidden" readonly >
                </div>

                <div class="form-group-xs">
                    <label name="qtd_adultos" id="qtd_adultos">Qtd. Adultos:</label>
                    <input name="qtd_adultos" id="qtd_adultos" class="form-control">
                </div>

                <div class="form-group-xs">
                    <label name="qtd_criancas" id="qtd_criancas">Qtd. Crianças:</label>
                    <input name="qtd_criancas" id="qtd_criancas" class="form-control">
                </div>

                <div class="form-group-xs">
                    <label name="diarias" id="diarias">Diárias:</label>
                    <input name="diarias" id="diarias" class="form-control">
                </div>

                <div class="form-group-xs">
                    <label name="preco" id="preco">Valor R$: </label>
                    <input name="valor" id="valor" class="form-control">
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
                    {!! Form::hidden('orcamento', 2, ['class'=>'form-control']) !!}
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

                {!! Form::open(['route'=>['passeios.storeAttachOrcamento'], 'method'=>'post']) !!}

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
                    <input name="ponto_partida" id="ponto_partida" class="form-control" readonly>
                </div>

                <div class="form-group-xs">
                    <label name="preco" id="preco">Valor R$: </label>
                    <input name="valor" id="valor" class="form-control" readonly>
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
                </div>

                <div class="form-group-xs">
                    <label name="empresa_passeio" id="empresa_passeio">Empresa:(Obrigatório)</label>
                    <input name="empresa_passeio" id="empresa_passeio" class="form-control" readonly>
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

<!-- Transfers-->
<div class="modal fade" id="transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione o Transfer:</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=>['transfers.storeAttachOrcamento'], 'method'=>'post']) !!}

                <div class="form-group-xs">
                    {!! Form::label('transfers_id', 'Transfers Disponíveis:') !!}
                    {{--{!! Form::select('trens_id', $trem, null, ['class'=>'form-control']) !!}--}}
                    {!! Form::select('transfers_id', array('0' => 'Selecione') + $transfers, '0', ['class'=>'form-control','id'=>'transfers_id'])!!}
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                    <input name="nome" id="nome" class="form-control" type="hidden" readonly >
                </div>

                <div class="form-group-xs">
                    <label name="preco" id="preco">Valor R$: </label>
                    <input name="valor" id="valor" class="form-control" readonly>
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

<!-- Voos-->
<div class="modal fade" id="voos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Selecione o Voo:</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=>['voos.storeAttachOrcamento'], 'method'=>'post']) !!}
                <div class="form-group-xs">
                    {!! Form::label('voos_id', 'Voos Disponíveis:') !!}
                    {!! Form::select('voos_id', array('0' => 'Selecione') + $voo, '0', ['class'=>'form-control','id'=>'voos_id'])!!}
                </div>

                <div class="form-group-xs"> <!-- Campo Oculto -->
                    {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                    {!! Form::hidden('orcamento', 2, ['class'=>'form-control']) !!}
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
                    {!! Form::text('valor', null, ['class'=>'form-control']) !!}
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

<!-- Trens-->
<div class="modal fade" id="trens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Selecione o Trem:</h4>
                </div>
                <div class="modal-body">
                        {!! Form::open(['route'=>['trens.storeAttachOrcamento'], 'method'=>'post']) !!}
                    <div class="form-group"> <!-- Campo Oculto -->
                        {!! Form::hidden('clientes_id', $clientes->id, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('trens', 'Trens Disponíveis:') !!}
                        {!! Form::select('trens_id', array('0' => 'Selecione') + $trem, '0', ['class'=>'form-control'])!!}
                    </div>
                    <div class="form-group">
                        <label>Preço: </label>
                        <input name="valor" id="valor" class="form-control" readonly>
                        <input name="nome" id="nome" class="form-control" type="hidden">
                    </div>
                    <div class="form-group">
                        <label>Destino: </label>
                        <input name="destino" id="destino" class="form-control" readonly>
                        <input name="cidades_id" id="cidades_id" class="form-control" type="hidden">
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

<!-- Java Script para efeito MODAL -->
@section('post-script')
<script type="text/javascript">

        $('a[name=excluir]').on("click", function () {
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
    $('input[name=valor]').empty();
    $('input[name=destino]').empty();
    $('input[name=cidades_id]').empty();
    $('input[name=nome]').empty();
    $.get('/get-valor/' + idTrem, function (valor) {
        $.each(valor, function (key, value) {
            $('input[name=valor]').val(value.valor);
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
        $("input[name=nome_voo]").val('');
        $('input[name=cidades_id]').val('');
        $('input[name=valor]').val('');
        $('input[name=local_emb]').val('');
        $('input[name=local_des]').val('');
    }else{ // Mostra Btn Submit
        $("#submit").show();
    }
    var idVoo = $(this).val();

    $.get('/get-voo/' + idVoo, function (valor) {
        $.each(valor, function (key, value) {
            $("input[name=nome_voo]").val(value.nome_voo);
            $('input[name=cidades_id]').val(value.cidades_id);
            $('input[name=valor]').val(value.valor);
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
        $('input[name=valor]').val('');
        $('input[name=cidades_id]').val('');
        $("input[name=nome]").val('');
    }else{ // Mostra Btn Submit
        $("#submit").show();
    }
    var idTransfer = $(this).val();
    $.get('/get-transf/' + idTransfer, function (valor) {
        $.each(valor, function (key, value) {

            $('input[name=valor]').val(value.valor);
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
        $('input[name=valor]').val('');
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
            $('input[name=valor]').val(value.valor);
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
        $('input[name=valor]').val('');
        $('input[name=cidades_id]').val('');
        $('input[name=destino]').val('');
        $("input[name=nome]").val('');
    }else{ // Mostra Btn Submit
        $("#submit").show();
    }
    var idHotel = $(this).val();

    $.get('/get-hot/' + idHotel, function (valor) {
        $.each(valor, function (key, value) {

            $('input[name=valor]').val(value.valor);
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
        $('input[name=valor]').val('');
        $('input[name=cidades_id]').val('');
        $("input[name=nome]").val('');
    }else{ // Mostra Btn Submit
        $("#submit").show();
    }
    var idExtra = $(this).val();

    $.get('/get-extra/' + idExtra, function (valor) {
        $.each(valor, function (key, value) {
            $('input[name=valor]').val(value.valor);
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