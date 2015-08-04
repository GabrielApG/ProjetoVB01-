<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Extras extends Model {

    protected $fillable = [

        'nome',
        'tipo',
        'destino',
        'data_saida',
        'hora_ida',
        'empresa_extra',
        'valor',
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
