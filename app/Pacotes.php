<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacotes extends Model {

    protected $fillable = [

        'nome',
        'descricao',
        'valor',
        'categorias_id',
    ];

    public function clientes()
    {
        return $this->hasMany('App\Clientes');
    }

    public function categorias()
    {
        return $this->belongsTo('App\Categorias');
    }

}
