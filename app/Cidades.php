<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidades extends Model {

    protected $fillable = [

        'nome',
        'codigo_pais',
        'distrito',
        'populacao',
    ];

    public function trens()
    {
        return $this->hasMany('App\Trens');
    }
    public function transfers()
    {
        return $this->hasMany('App\Transfers');
    }
    public function passeios()
    {
        return $this->hasMany('App\Passeios');
    }
    public function hoteis()
    {
        return $this->hasMany('App\Hoteis');
    }
    public function voos()
    {
        return $this->hasMany('App\Voos');
    }
    public function extras()
    {
        return $this->hasMany('App\Extras');
    }
    public function roteiros()
    {
        return $this->hasMany('App\Roteiros');
    }
}
