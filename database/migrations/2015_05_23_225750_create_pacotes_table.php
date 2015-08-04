<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacotesTable extends Migration {


	public function up()
	{
		Schema::create('pacotes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nome',255);
            $table->text('descricao');
            $table->decimal('valor');
            $table->timestamps();
            $table->integer('categorias_id')->unsigned();
    });
	}


	public function down()
	{
		Schema::drop('pacotes');
	}

}
