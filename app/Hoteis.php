<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hoteis extends Model {

    protected $fillable = [

        'nome',
        'num_reserva',
        'telefone',
        'cep',
        'endereco',
        'numero',
        'bairro',
        'estado',
        'status',
        'qtd_adultos',
        'qtd_criancas',
        'data_entrada',
        'data_saida',
        'diarias',
        'cafe_manha',
        'wifi',
        'site',
        'valor',
        'valor_extra',
        'orcamento',
        'cidades_id',
    ];

    public function clientes()
    {
        return $this->belongsToMany('App\Clientes');
    }

    public function cidades()
    {
        return $this->belongsTo('App\Cidades');
    }

}
