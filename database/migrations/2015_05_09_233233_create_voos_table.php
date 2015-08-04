<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoosTable extends Migration {


	public function up()
	{
		Schema::create('voos', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('nome_voo');
            $table->string('local_emb');
            $table->string('local_des');
            $table->date('data_ida');
            $table->date('data_volta');
            $table->time('hora_ida');
            $table->time('hora_volta');
            $table->string('empresa_voo');
            $table->string('num_bilhete');
            $table->string('poltrona',10);
            $table->string('num_voo');
            $table->string('escalas');
            $table->string('observacao');
            $table->decimal('valor');
            $table->string('principal',3)->default('Não');
            $table->boolean('orcamento')->default(0);
            $table->integer('cidades_id')->unsigned();
            $table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('voos');
	}

}
