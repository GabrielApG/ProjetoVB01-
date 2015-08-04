<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Situacoes extends Model {

    protected $fillable = [
        'nome',
    ];

    public function clientes()
    {
        return $this->hasMany('App\Clientes');
    }

}
