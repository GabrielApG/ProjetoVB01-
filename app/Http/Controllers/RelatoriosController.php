<?php namespace App\Http\Controllers;

use App\Clientes;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class RelatoriosController extends Controller {


    public function relatorios($id)
    {
        $clientes = Clientes::find($id);
        return view('relatorios.index', compact('clientes'));
    }

    public function compra($id)
    {
        $clientes = Clientes::find($id);
        return view('relatorios.compra', compact('clientes'));
    }

    public function orcamento($id)
    {
        $clientes = Clientes::find($id);
        return view('relatorios.orcamento', compact('clientes'));
    }

    public function checklist($id)
    {
        $clientes = Clientes::find($id);
        return view('relatorios.checklist', compact('clientes'));
    }

    public function pdfCompra($id)
    {
        $clientes = Clientes::find($id);

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
                //$total = $total + $hotel->valor;
                $contHoteis++;
                $contAdultos = $hotel->qtd_adultos;
                $valorHotel = ($hotel->valor * $hotel->diarias) / $hotel->qtd_adultos + $hotel->valor_extra;
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

        $pdf = App::make('dompdf.wrapper');
        $html = '<html>
        <head>
            <style>
            input {
                line-height: normal; }

            input[type="checkbox"], input[type="radio"] {
                box-sizing: border-box;
                padding: 0; }

            input[type="number"]::-webkit-inner-spin-button, input[type="number"]::-webkit-outer-spin-button {
                height: auto; }

            input[type="search"] {
                -webkit-appearance: textfield;
                box-sizing: content-box; }

            input[type="search"]::-webkit-search-cancel-button, input[type="search"]::-webkit-search-decoration {
                -webkit-appearance: none; }

            .row {
                    margin-left: -15px;
                    margin-right: -15px; }
                .row:before, .row:after {
                    content: " ";
                    display: table; }
                .row:after {
                    clear: both; }
                .table-hover > tbody > tr:hover {
                    background-color: #f5f5f5; }

                table col[class*="col-"] {
                    position: static;
                    float: none;
                    display: table-column; }

                table td[class*="col-"], table th[class*="col-"] {
                    position: static;
                    float: none;
                    display: table-cell; }

                .table > thead > tr > td.active, .table > thead > tr > th.active, .table > thead > tr.active > td, .table > thead > tr.active > th, .table > tbody > tr > td.active, .table > tbody > tr > th.active, .table > tbody > tr.active > td, .table > tbody > tr.active > th, .table > tfoot > tr > td.active, .table > tfoot > tr > th.active, .table > tfoot > tr.active > td, .table > tfoot > tr.active > th {
                    background-color: #f5f5f5; }

                .table-hover > tbody > tr > td.active:hover, .table-hover > tbody > tr > th.active:hover, .table-hover > tbody > tr.active:hover > td, .table-hover > tbody > tr:hover > .active, .table-hover > tbody > tr.active:hover > th {
                    background-color: #e8e8e8; }

                .table > thead > tr > td.success, .table > thead > tr > th.success, .table > thead > tr.success > td, .table > thead > tr.success > th, .table > tbody > tr > td.success, .table > tbody > tr > th.success, .table > tbody > tr.success > td, .table > tbody > tr.success > th, .table > tfoot > tr > td.success, .table > tfoot > tr > th.success, .table > tfoot > tr.success > td, .table > tfoot > tr.success > th {
                    background-color: #dff0d8; }

                .table-hover > tbody > tr > td.success:hover, .table-hover > tbody > tr > th.success:hover, .table-hover > tbody > tr.success:hover > td, .table-hover > tbody > tr:hover > .success, .table-hover > tbody > tr.success:hover > th {
                    background-color: #d0e9c6; }

                .table > thead > tr > td.info, .table > thead > tr > th.info, .table > thead > tr.info > td, .table > thead > tr.info > th, .table > tbody > tr > td.info, .table > tbody > tr > th.info, .table > tbody > tr.info > td, .table > tbody > tr.info > th, .table > tfoot > tr > td.info, .table > tfoot > tr > th.info, .table > tfoot > tr.info > td, .table > tfoot > tr.info > th {
                    background-color: #d9edf7; }

                .table-hover > tbody > tr > td.info:hover, .table-hover > tbody > tr > th.info:hover, .table-hover > tbody > tr.info:hover > td, .table-hover > tbody > tr:hover > .info, .table-hover > tbody > tr.info:hover > th {
                    background-color: #c4e3f3; }

                .table > thead > tr > td.warning, .table > thead > tr > th.warning, .table > thead > tr.warning > td, .table > thead > tr.warning > th, .table > tbody > tr > td.warning, .table > tbody > tr > th.warning, .table > tbody > tr.warning > td, .table > tbody > tr.warning > th, .table > tfoot > tr > td.warning, .table > tfoot > tr > th.warning, .table > tfoot > tr.warning > td, .table > tfoot > tr.warning > th {
                    background-color: #fcf8e3; }

                .table-hover > tbody > tr > td.warning:hover, .table-hover > tbody > tr > th.warning:hover, .table-hover > tbody > tr.warning:hover > td, .table-hover > tbody > tr:hover > .warning, .table-hover > tbody > tr.warning:hover > th {
                    background-color: #faf2cc; }

                .table > thead > tr > td.danger, .table > thead > tr > th.danger, .table > thead > tr.danger > td, .table > thead > tr.danger > th, .table > tbody > tr > td.danger, .table > tbody > tr > th.danger, .table > tbody > tr.danger > td, .table > tbody > tr.danger > th, .table > tfoot > tr > td.danger, .table > tfoot > tr > th.danger, .table > tfoot > tr.danger > td, .table > tfoot > tr.danger > th {
                    background-color: #f2dede; }

                .table-hover > tbody > tr > td.danger:hover, .table-hover > tbody > tr > th.danger:hover, .table-hover > tbody > tr.danger:hover > td, .table-hover > tbody > tr:hover > .danger, .table-hover > tbody > tr.danger:hover > th {
                    background-color: #ebcccc; }

                    .table-responsive {
                        overflow-x: auto;
                        min-height: 0.01%; }

                        .table-responsive {
                            width: 100%;
                            margin-bottom: 15.75px;
                            overflow-y: hidden;
                            -ms-overflow-style: -ms-autohiding-scrollbar;
                            border: 1px solid #ddd; }
                        .table-responsive > .table {
                            margin-bottom: 0; }
                        .table-responsive > .table > thead > tr > th, .table-responsive > .table > thead > tr > td, .table-responsive > .table > tbody > tr > th, .table-responsive > .table > tbody > tr > td, .table-responsive > .table > tfoot > tr > th, .table-responsive > .table > tfoot > tr > td {
                            white-space: nowrap; }
                        .table-responsive > .table-bordered {
                            border: 0; }
                        .table-responsive > .table-bordered > thead > tr > th:first-child, .table-responsive > .table-bordered > thead > tr > td:first-child, .table-responsive > .table-bordered > tbody > tr > th:first-child, .table-responsive > .table-bordered > tbody > tr > td:first-child, .table-responsive > .table-bordered > tfoot > tr > th:first-child, .table-responsive > .table-bordered > tfoot > tr > td:first-child {
                            border-left: 0; }
                        .table-responsive > .table-bordered > thead > tr > th:last-child, .table-responsive > .table-bordered > thead > tr > td:last-child, .table-responsive > .table-bordered > tbody > tr > th:last-child, .table-responsive > .table-bordered > tbody > tr > td:last-child, .table-responsive > .table-bordered > tfoot > tr > th:last-child, .table-responsive > .table-bordered > tfoot > tr > td:last-child {
                            border-right: 0; }
                        .table-responsive > .table-bordered > tbody > tr:last-child > th, .table-responsive > .table-bordered > tbody > tr:last-child > td, .table-responsive > .table-bordered > tfoot > tr:last-child > th, .table-responsive > .table-bordered > tfoot > tr:last-child > td {
                            border-bottom: 0; }

                .col-md-4 {
        width: 33.33333%; }

                .table {
                  width: 100%;
                  max-width: 100%;
                  margin-bottom: 21px;

                }

                .table-bordered th, .table-bordered td {
                border: 1px solid #ddd !important; }
                .table-bordered {
                    border: 1px solid #ddd; }
                .table-bordered > thead > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > tfoot > tr > td {
                    border: 1px solid #ddd; }
                .table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
                    border-bottom-width: 2px; }
                border: 1px solid #ddd; }
                .table-bordered > thead > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > tfoot > tr > td {
                    border: 1px solid #ddd; }
                .table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
                    border-bottom-width: 2px; }
                border: 1px solid #ddd; }
                .table-bordered > thead > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > tfoot > tr > td {
                    border: 1px solid #ddd; }
                .table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
                    border-bottom-width: 2px; }

                .table > thead > tr > th, .table > thead > tr > td, .table > tbody > tr > th, .table > tbody > tr > td, .table > tfoot > tr > th, .table > tfoot > tr > td {
                  padding: 5px;
                  line-height: 1.4;
                  vertical-align: top;
                  border-top: 1px solid #ddd;
                  font-size: 11px;

                }
                .table > thead > tr > th {
                    vertical-align: bottom;
                    border-bottom: 2px solid #ddd;

                  }
                .table > caption + thead > tr:first-child > th, .table > caption + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > td, .table > thead:first-child > tr:first-child > th, .table > thead:first-child > tr:first-child > td {
                    border-top: 0; }
                .table > tbody + tbody {
                    border-top: 2px solid #ddd; }
                .table .table {
                    background-color: #fff; }
                    .text-right {
                      text-align: right;
                }

                .table-striped > tbody > tr:nth-of-type(odd) {
                background-color: #f9f9f9; }
                .table-striped.dataTable tbody tr.active:nth-child(odd) td,
                .table-striped.dataTable tbody tr.active:nth-child(odd) th {
                  background-color: #017ebc;
                }

                .text-center {
                    text-align: center; }

                body {
                  font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
                  font-size: 12px;
                  line-height: 1.4;
                  color: #222222;
                  background-color: #fff;

                }

                legend {
                  display: block;
                  width: 100%;
                  padding: 0;
                  margin-bottom: 20px;
                  font-size: 20px;
                  color: #333333;
                  border: 0;
                  border-bottom: 1px solid #e5e5e5;
                }
                }
                .logo {
                    position: absolute;
                    left: 0px;
                    top: -19px;
                    width: 165px;
                    height: 60px;
                    z-index: 5;
                }

            .tel {
                font-size: 9px;
                font-family: "Myriad Pro";
                color: rgb(138, 138, 138);
                line-height: 1.2;
                text-align: left;
                position: absolute;
                left: 520px;
                top: 15px;
                z-index: 4;
            }

            .titulo {
                font-size: 24px;
                font-family: "Myriad Pro";
                color: rgb(138, 138, 138);
                line-height: 1.2;
                text-align: left;
                -moz-transform: matrix( 1.20826537009271,0,0,1.30665281638077,0,0);
                -webkit-transform: matrix( 1.20826537009271,0,0,1.30665281638077,0,0);
                -ms-transform: matrix( 1.20826537009271,0,0,1.30665281638077,0,0);
                position: absolute;
                left: 245.187px;
                top: 13.756px;
                z-index: 3;
            }

            .nomeCliente{
                font-size: 15px;
                color: rgb(138, 138, 138);
            }

            th{
                 text-align: center;
            }
            td{
                text-align: center;
                background: #fff;
            }


            </style>
        </head>
        <body>

        <img src="../public/img/cabecalho.jpg" width="688" height="79">

        <legend class="nomeCliente">Nome: '.$clientes->nome.'</legend>

            <table class="table table-striped table-bordered" border="1px" cellspacing="0px">
            <tr>
                <th colspan="8">VOOS</th>
            </tr>
            <tr>
                <th class="cod">ID</th>
                <th class="nome">Voos</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Data Ida</th>
                <th>Data Volta</th>
                <th>Local Embarque</th>
                <th>Local Desembarque</th>
            </tr>';
        foreach ($clientes->voos as $v) {
            if($v->orcamento == 0){
                $html.='

           <tr>
               <td>'.$v->id.'</td>
               <td>'.$v->nome_voo .'</td>
               <td>'.$v->cidades->codigo_pais .'</td>
               <td>'.$v->cidades->nome .'</td>
               <td>'.$v->data_ida .'</td>
               <td>'.$v->data_volta .'</td>
               <td>'.$v->hora_ida .'</td>
               <td>'.$v->hora_volta .'</td>
            </tr>';
            }};
        '</table>';

        $html .= '<table class="table table-striped table-bordered" border="1px" cellspacing="0px">
            <tr>
                <th colspan="7">TRENS</th>
            </tr>
            <tr>
                <th class="cod">ID</th>
                <th class="nome">Nome</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Destino</th>
                <th>Data Saída</th>
                <th>Hora Ida</th>
            </tr>';
        foreach ($clientes->trens as $t) {
            if($t->orcamento == 0){
                $html.='
           <tr>
               <td>'.$t->id.'</td>
               <td>'.$t->nome .'</td>
               <td>'.$t->cidades->codigo_pais .'</td>
               <td>'.$t->cidades->nome .'</td>
               <td>'.$t->destino .'</td>
               <td>'.$t->data_saida .'</td>
               <td>'.$t->hora_ida .'</td>
            </tr>';
            }};
        '</table>';

        $html .= '<table class="table table-striped table-bordered" border="1px" cellspacing="0px">
            <tr>
                <th colspan="6">TRANSFERS</th>
            </tr>
            <tr>
               <th class="cod">ID</th>
                <th class="nome">Nome</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Data Ida</th>
                <th>Hora Ida</th>
            </tr>';
        foreach ($clientes->transfers as $transf) {
            if($transf->orcamento == 0){
                $html.='
           <tr>
               <td>'.$transf->id.'</td>
               <td>'.$transf->nome .'</td>
               <td>'.$transf->cidades->codigo_pais .'</td>
               <td>'.$transf->cidades->nome .'</td>
               <td>'.$transf->data_ida .'</td>
               <td>'.$transf->hora_ida .'</td>
            </tr>';
            }};
        '</table>';

        $html .= '<table class="table table-striped table-bordered" border="1px" cellspacing="0px">
            <tr>
                <th colspan="8">HOSPEDAGENS</th>
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
            </tr>';
        foreach ($clientes->hoteis as $h) {
            if($h->orcamento == 0){
                $html.='
           <tr>
               <td>'.$h->id.'</td>
               <td>'.$h->nome .'</td>
               <td>'.$h->cidades->codigo_pais .'</td>
               <td>'.$h->cidades->nome .'</td>
               <td>'.$h->data_entrada .'</td>
               <td>'.$h->data_saida .'</td>
               <td>'.$h->qtd_adultos.'</td>
               <td>'.$h->qtd_criancas.'</td>
            </tr>';
            }};
        '</table>';

        $html .= '<table class="table table-striped table-bordered" border="1px" cellspacing="0px">
            <tr>
                <th colspan="7">PASSEIOS</th>
            </tr>
            <tr>
                 <th class="cod">ID</th>
                <th class="nome">Nome</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Empresa</th>
                <th>Data Saída</th>
                <th>Hora Ida</th>
            </tr>';
        foreach ($clientes->passeios as $p) {
            if($p->orcamento == 0){
                $html.='
           <tr>
               <td>'.$p->id.'</td>
               <td>'.$p->nome .'</td>
               <td>'.$p->cidades->codigo_pais .'</td>
               <td>'.$p->cidades->nome .'</td>
               <td>'.$p->empresa_passeio .'</td>
               <td>'.$p->data_ida .'</td>
               <td>'.$p->hora_ida.'</td>
            </tr>';
            }};
        '</table>';

        $numberFormatter = new \NumberFormatter('pt_BR', \NumberFormatter::DECIMAL);

        $t = $numberFormatter->parse($total);

        $total2 = $t / 2;
        $total3 = $t / 3;
        $total5 = $t / 5;
        $total6 = $t / 6;


        $formatValorTotalPacote2 = $total2;
        $formatValorTotalPacote3 = $total3;
        $formatValorTotalPacote5 = $total5;
        $formatValorTotalPacote6 = $total6;

        //Formatação Valor Voos Principais

        $tPrincipal = $numberFormatter->parse($valorVoosPrincipais);


        $total2p = $tPrincipal / 2;
        $total3p = $tPrincipal / 3;
        $total5p = $tPrincipal / 5;
        $total10p = $tPrincipal / 6;


        $formatValorTotalPrincipal2 = $total2p;
        $formatValorTotalPrincipal3 = $total3p;
        $formatValorTotalPrincipal5 = $total5p;
        $formatValorTotalPrincipal10 = $total10p;


        $html.='
        <div class ="row">
         <div class="col-md-4 table-responsive">
            <table class="table table-striped table-bordered" border="1px" cellspacing="0px">
                <thead>
                <tr>
                    <th colspan="2">Aereo</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="checkbox" id="2A" name="2A" value="Sim">
                    </td>
                    <td>2 Vezes</td>
                    <td>'.$formatValorTotalPrincipal2.'</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" id="3A" name="3A" value="Sim">
                    </td>
                    <td>3 Vezes</td>
                    <td>'.$formatValorTotalPrincipal3.'</td>
                </tr>
                <tr>
                    <td>
                         <input type="checkbox" id="5A" name="5A" value="Sim">
                    </td>
                    <td>5 Vezes</td>
                    <td>'.$formatValorTotalPrincipal5.'</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" id="10A" name="10A" value="Sim">
                    </td>
                    <td>10 Vezes</td>
                    <td>'.$formatValorTotalPrincipal10.'</td>
                </tr>
                <tr>
                    <td>
                        Total
                    </td>
                    <td id="valorAereo" colspan="2">R$'. $valorVoosPrincipais.'</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th colspan="2">Pacote</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="checkbox" name="2P" id="2P" value="Sim">
                    </td>
                    <td>2 Vezes</td>
                    <td>R$ '.$formatValorTotalPacote2.'</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="3P" id="3P" value="Sim">
                    </td>
                    <td>3 Vezes</td>
                    <td>R$ '.$formatValorTotalPacote3.'</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="5P" id="5P" value="Sim">
                    </td>
                    <td>5 Vezes</td>
                    <td>R$ '.$formatValorTotalPacote5.'</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="6P" id="6P" value="Sim">
                    </td>
                    <td>6 Vezes</td>
                    <td>R$ '.$formatValorTotalPacote6.'</td>
                </tr>
                <tr>
                    <td>
                        Total
                    </td>
                    <td id="totalPaccote" colspan="2">R$ '.$total.'</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>';

        $html .= '</body></html>';
        $pdf->loadHTML($html);
        return $pdf->stream();
    }

    public function pdfOrcamento($id)
    {
        $clientes = Clientes::find($id);

        $total = 0;
        $contTrem = 0;
        $contVoo = 0;
        $contTransfer = 0;
        $contPasseio = 0;
        $contHoteis = 0;

        foreach($clientes->voos as $v){
            if($v->orcamento == 0){
                $total = $total + $v->valor;
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
                //$total = $total + $hotel->valor;
                $contHoteis++;
                $contAdultos = $hotel->qtd_adultos;
                $contCriancas = $hotel->qtd_criancas;
                $valorHotel = $hotel->valor;
                $valorHotel = $valorHotel * ($contAdultos + $contCriancas);
                $total = $total + $valorHotel;
            }
        }

        $pdf = App::make('dompdf.wrapper');
        $html = '
        <html><body>
        <h1>Relatórios de Compra</h1>
            <table border="1px" class="table">
            <tr>
                <th colspan="8">VOOS</th>
            <tr>
                <th class="cod">ID</th>
                <th class="nome">Voos</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Data Ida</th>
                <th>Data Volta</th>
                <th>Local Embarque</th>
                <th>Local Desembarque</th>
            </tr>';
        foreach ($clientes->voos as $v) {
            if($v->orcamento == 0){
                $html.='
           <tr>
               <td>'.$v->id.'</td>
               <td>'.$v->nome_voo .'</td>
               <td>'.$v->cidades->codigo_pais .'</td>
               <td>'.$v->cidades->nome .'</td>
               <td>'.$v->data_ida .'</td>
               <td>'.$v->data_volta .'</td>
               <td>'.$v->hora_ida .'</td>
               <td>'.$v->hora_volta .'</td>
            </tr>';
            }};
        '</table>';

        $html .= '<table border="1px">
            <tr>
                <th colspan="7">TRENS</th>
            <tr>
                <th class="cod">ID</th>
                <th class="nome">Nome</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Destino</th>
                <th>Data Saída</th>
                <th>Hora Ida</th>
            </tr>';
        foreach ($clientes->trens as $t) {
            if($t->orcamento == 0){
                $html.='
           <tr>
               <td>'.$t->id.'</td>
               <td>'.$t->nome .'</td>
               <td>'.$t->cidades->codigo_pais .'</td>
               <td>'.$t->cidades->nome .'</td>
               <td>'.$t->destino .'</td>
               <td>'.$t->data_saida .'</td>
               <td>'.$t->hora_ida .'</td>
            </tr>';
            }};
        '</table>';

        $html .= '<table border="1px">
            <tr>
                <th colspan="6">TRANSFERS</th>
            <tr>
               <th class="cod">ID</th>
                <th class="nome">Nome</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Data Ida</th>
                <th>Hora Ida</th>
            </tr>';
        foreach ($clientes->transfers as $transf) {
            if($transf->orcamento == 0){
                $html.='
           <tr>
               <td>'.$transf->id.'</td>
               <td>'.$transf->nome .'</td>
               <td>'.$transf->cidades->codigo_pais .'</td>
               <td>'.$transf->cidades->nome .'</td>
               <td>'.$transf->data_ida .'</td>
               <td>'.$transf->hora_ida .'</td>
            </tr>';
            }};
        '</table>';

        $html .= '<table border="1px">
            <tr>
                <th colspan="8">HOSPEDAGENS</th>
            <tr>
                <th class="cod">ID</th>
                <th class="nome">Hotel</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Checki in</th>
                <th>Check out</th>
                <th>Qtd. Adultos</th>
                <th>Qtd. Crianças</th>
            </tr>';
        foreach ($clientes->hoteis as $h) {
            if($h->orcamento == 0){
                $html.='
           <tr>
               <td>'.$h->id.'</td>
               <td>'.$h->nome .'</td>
               <td>'.$h->cidades->codigo_pais .'</td>
               <td>'.$h->cidades->nome .'</td>
               <td>'.$h->data_entrada .'</td>
               <td>'.$h->data_saida .'</td>
               <td>'.$h->qtd_adultos.'</td>
               <td>'.$h->qtd_criancas.'</td>
            </tr>';
            }};
        '</table>';

        $html .= '<table border="1px">
            <tr>
                <th colspan="7">PASSEIOS</th>
            <tr>
                 <th class="cod">ID</th>
                <th class="nome">Nome</th>
                <th class="pais">Pais</th>
                <th class="cidade">Cidade</th>
                <th>Empresa</th>
                <th>Data Saída</th>
                <th>Hora Ida</th>
            </tr>';
        foreach ($clientes->passeios as $p) {
            if($p->orcamento == 0){
                $html.='
           <tr>
               <td>'.$p->id.'</td>
               <td>'.$p->nome .'</td>
               <td>'.$p->cidades->codigo_pais .'</td>
               <td>'.$p->cidades->nome .'</td>
               <td>'.$p->empresa_passeio .'</td>
               <td>'.$p->data_ida .'</td>
               <td>'.$p->hora_ida.'</td>
            </tr>';
            }};
        '</table>';

        $html .= '<h3 class="text-right">Valor Total <span class="label label-default">R$'.$total.'</span> </h3>';

        $html .= '</body></html>';
        $pdf->loadHTML($html);
        return $pdf->stream();
    }

}
