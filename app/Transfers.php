<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfers extends Model {

    protected $fillable = [

        'nome',
        'data_ida',
        'hora_ida',
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
