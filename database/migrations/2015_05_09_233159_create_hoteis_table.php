<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoteisTable extends Migration {

	public function up()
	{
		Schema::create('hoteis', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('nome');
            $table->string('num_reserva');
            $table->string('telefone');
            $table->string('cep');
            $table->string('endereco');
            $table->string('numero');
            $table->string('bairro');
            $table->string('estado');
            $table->string('status');
            $table->string('qtd_adultos');
            $table->string('qtd_criancas');
            $table->string('diarias');
            $table->date('data_entrada');
            $table->date('data_saida');
            $table->string('cafe_manha');
            $table->string('wifi');
            $table->string('site');
            $table->decimal('valor');
            $table->decimal('valor_extra');
            $table->timestamps();
            $table->boolean('orcamento')->default(0);
            $table->integer('cidades_id')->unsigned();

		});

	}

	public function down()
	{
		Schema::drop('hoteis');
	}

}
