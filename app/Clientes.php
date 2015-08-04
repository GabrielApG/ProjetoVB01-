<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model {

    protected $fillable = [
        'nome',
        'telefone',
        'data_nasc',
        'email',
        'cep',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'pais',
        'cpf',
        'identidade',
        'orgao_emissor',
        'data_exp',
        'num_passaporte',
        'data_emissao_passaporte',
        'validade_passaporte',
        'nome_pai',
        'nome_mae',
        'lembretes',
        'situacoes_id',
        'categorias_id',
        'pacotes_id',
    ];

    //Relacionamentos hasMany da tabela cliente com outras tabelas
    public function dependentes()
    {
        return $this->hasMany('App\Dependentes');
    }
    public function telefones()
    {
        return $this->hasMany('App\Telefones');
    }
    public function observacoes()
    {
        return $this->hasMany('App\Observacoes');
    }

    // Relacionamentos Pertence  Á
    public function situacoes()
    {
        return $this->belongsTo('App\Situacoes');
    }
    public function categorias()
    {
        return $this->belongsTo('App\Categorias');
    }
    public function pacotes()
    {
        return $this->belongsTo('App\Pacotes');
    }


    // Relacionamentos ManyToMany
    public function trens()
    {
        return $this->belongsToMany('App\Trens');
    }
    public function voos()
    {
        return $this->belongsToMany('App\Voos');
    }
    public function transfers()
    {
        return $this->belongsToMany('App\Transfers');
    }
    public function passeios()
    {
        return $this->belongsToMany('App\Passeios');
    }
    public function hoteis()
    {
        return $this->belongsToMany('App\Hoteis');
    }
    public function extras()
    {
        return $this->belongsToMany('App\Extras');
    }
    public function roteiros()
    {
        return $this->belongsToMany('App\Roteiros');
    }

}
