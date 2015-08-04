<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Voos extends Model {

    protected $fillable = [

        'nome_voo',
        'local_emb',
        'local_des',
        'data_ida',
        'data_volta',
        'hora_ida',
        'hora_volta',
        'empresa_voo',
        'num_bilhete',
        'poltrona',
        'num_voo',
        'escalas',
        'observacao',
        'valor',
        'orcamento',
        'principal',
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
