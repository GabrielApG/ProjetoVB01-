<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trens extends Model {

    protected $fillable = [

        'nome',
        'destino',
        'data_saida',
        'hora_ida',
        'empresa_trem',
        'valor',
        'numero', // Acrescentado dia 16/06
        'vagao', // 16/06
        'poltrona', //16/06
        'cidades_id',
        'orcamento',
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
