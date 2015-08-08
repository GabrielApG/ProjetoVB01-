<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidadesTable extends Migration {


	public function up()
	{
		Schema::create('cidades', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nome',100);
            $table->string('codigo_pais',50);
            $table->string('distrito',100);
            $table->integer('populacao');
		});
	}


	public function down()
	{
		Schema::drop('cidades');
	}

}
