<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration {

	public function up()
	{
		Schema::create('clientes', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('nome', 100);
            $table->integer('telefone');
            $table->date('data_nasc');
            $table->string('email', 100);
            $table->string('cep', 100);
            $table->string('endereco', 100);
            $table->string('numero', 100);
            $table->string('bairro', 100);
            $table->string('cidade', 100);
            $table->string('estado', 100);
            $table->string('pais',100);
            $table->string('cpf',11);
            $table->string('identidade',9);
            $table->string('orgao_emissor', 15);
            $table->date('data_exp');
            $table->string('num_passaporte', 8);
            $table->date('data_emissao_passaporte');
            $table->date('validade_passaporte');
            $table->string('nome_pai', 100);
            $table->string('nome_mae', 100);
            $table->text('lembretes');
            $table->integer('situacoes_id')->unsigned();
            $table->integer('categorias_id')->unsigned();
            $table->integer('pacotes_id')->unsigned();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('clientes');
	}

}
