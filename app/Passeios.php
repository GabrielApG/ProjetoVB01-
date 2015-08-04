<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Passeios extends Model {

    protected $fillable = [
        'nome',
        'ponto_partida',
        'data_ida',
        'hora_ida',
        'descricao',
        'empresa_passeio',
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
