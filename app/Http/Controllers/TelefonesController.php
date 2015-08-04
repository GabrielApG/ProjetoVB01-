<?php
namespace App\Http\Controllers;

use App\Clientes;
use App\Http\Controllers;
use App\Telefones;
use Illuminate\Http\Request;
use App\Http\Requests\SituacoesRequest;

class TelefonesController extends Controller
{

    public function index()
    {
        return view('teste.index');
    }

}
