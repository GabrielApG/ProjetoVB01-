<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoteirosTable extends Migration {


	public function up()
	{
		Schema::create('roteiros', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nome');
            $table->text('descricao');
            $table->date('data');
            $table->boolean('orcamento')->default(0);
            $table->timestamps();
            $table->integer('cidades_id')->unsigned();
		});
	}


	public function down()
	{
		Schema::drop('roteiros');
	}

}
