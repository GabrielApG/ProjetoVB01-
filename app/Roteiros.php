<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Roteiros extends Model {

    protected $fillable = [

        'nome',
        'descricao',
        'orcamento',
        'data',
        'cidades_id',
    ];

    public function cidades()
    {
        return $this->belongsTo('App\Cidades');
    }

    // Relacionamento Many to Many
    public function clientes()
    {
        return $this->belongsToMany('App\Clientes');
    }

}
