<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacoes extends Model {

    protected $fillable = [

        'observacao',
        'clientes_id',

        ];

    public function clientes()
    {
        return $this->belongsTo('App\Clientes');
    }

}
