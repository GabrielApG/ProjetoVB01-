<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtrasTable extends Migration {


	public function up()
	{
		Schema::create('extras', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('nome',255);
            $table->string('tipo',255);
            $table->string('destino',255);
            $table->date('data_saida');
            $table->time('hora_ida');
            $table->string('empresa_extra',100);
            $table->decimal('valor');
            $table->boolean('orcamento')->default(0);
            $table->timestamps();
            $table->integer('cidades_id')->unsigned();
		});
	}


	public function down()
	{
		Schema::drop('extras');
	}

}
