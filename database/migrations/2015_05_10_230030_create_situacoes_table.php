<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSituacoesTable extends Migration {


	public function up()
	{
		Schema::create('situacoes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nome',100);
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('situacoes');
	}

}
