<?php namespace App\Http\Controllers;

use App\Cidades;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CidadesController extends Controller {

    private $paisModel;

    public function __construct(Cidades $paises)
    {
        $this->paisModel = $paises;
    }

    public function index()
    {
        $paises = $this->paisModel->lists('codigo_pais','codigo_pais');
        return view('cidades.cidade', compact('paises'));
    }

    public function getCidades($idPais)
    {
        $cidades = DB::table('cidades')->where('codigo_pais','=',$idPais)->orderby('nome')->get();
        return Response::json($cidades);
    }

}
