<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefones extends Model {

    protected $fillable = [
        'tel_residencial',
        'tel_celular',
        'tel_comercial',
        'clientes_id',
    ];

    public function clientes()
    {
        return $this->belongsTo('App\Clientes');
    }

}
