<html>
<head>
    <title>Relatórios</title>
</head>

<body>

@extends('app')
@section('content')
<div class="container">
    <legend><span class="glyphicon glyphicon-file"></span> RELATÓRIOS - {{$clientes->nome}}</legend><br />
    <ul class="nav nav-tabs">
        {{--<li role="presentation"><a href="{{ route('clientes.orcamento',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-usd"></span> Orçamento</a></li>--}}
        <li role="presentation"><a href="{{ route('clientes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-tasks"></span> Pacote</a></li>
        <li role="presentation"><a href="{{ route('clientes.detalhesClientes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span> Inf. Pessoais</a></li>
        <li role="presentation"><a href="{{ route('dependentes.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span> Dep.</a></li>
        <li role="presentation" class="active"><a href="{{ route('relatorios',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-file"></span> Rel.</a></li>
        <li role="presentation"><a href="{{ route('voos.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-plane"></span> Voos</a></li>
        <li role="presentation"><a href="{{ route('trens.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-bed"></span> Trens</a></li>
        <li role="presentation"><a href="{{ route('transfers.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-road"></span> Transfer</a></li>
        <li role="presentation"><a href="{{ route('passeios.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-grain"></span> Passeios</a></li>
        <li role="presentation"><a href="{{ route('hoteis.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-king"></span> Hoteis</a></li>
        <li role="presentation"><a href="{{route('extras.detalhes',['id'=>$clientes->id])}}"><span class="glyphicon glyphicon-king"></span> Extras</a></li>
        <li role="presentation"><a href="{{ route('roteiros.detalhes',['id'=>$clientes->id]) }}"><span class="glyphicon glyphicon-screenshot"></span> Roteiros</a></li>
    </ul>

    <br/><br/><br/>

    <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row"> RELATÓRIO DE COMPRA
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-list fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('compra',['id'=>$clientes->id]) }}">
                    <div class="panel-footer">
                        <span class="pull-left"> Ver Detalhes</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row"> ROTEIROS
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-list fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <a href="">
                    <div class="panel-footer">
                        <span class="pull-left"> Ver Detalhes</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        {{--<div class="col-lg-3 col-md-6">--}}
            {{--<div class="panel panel-danger">--}}
                {{--<div class="panel-heading">--}}
                    {{--<div class="row"> CHECK LIST--}}
                        {{--<div class="col-xs-3">--}}
                            {{--<i class="glyphicon glyphicon-list fa-3x"></i>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-9 text-right">--}}
                            {{--<div class="huge"></div>--}}
                            {{--<div></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<a href="{{ route('checklist',['id'=>$clientes->id]) }}">--}}
                    {{--<div class="panel-footer">--}}
                        {{--<span class="pull-left"> Ver Detalhes</span>--}}
                        {{--<span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>--}}

                        {{--<div class="clearfix"></div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-lg-3 col-md-6">--}}
            {{--<div class="panel panel-warning">--}}
                {{--<div class="panel-heading">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-xs-3">--}}
                            {{--<i class="glyphicon glyphicon-user fa-3x"></i>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-9 text-right">--}}
                            {{--<div class="huge"></div>--}}
                            {{--<div></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<a href="">--}}
                    {{--<div class="panel-footer">--}}
                        {{--<span class="pull-left"> Ver Detalhes</span>--}}
                        {{--<span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>--}}

                        {{--<div class="clearfix"></div>--}}
                    {{--</div>--}}
                {{--</a>--}}


</div>
@endsection

</body>
<html>
