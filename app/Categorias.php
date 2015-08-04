<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model {

    protected $fillable = [
        'nome',
    ];

    public function clientes()
    {
        return $this->hasMany('App\Clientes');
    }

    public function pacotes()
    {
        return $this->hasMany('App\Pacotes');
    }
}