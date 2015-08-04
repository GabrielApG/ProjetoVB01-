<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration {


	public function up()
	{
		Schema::create('transfers', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('nome');
            $table->date('data_ida');
            $table->time('hora_ida');
            $table->decimal('valor');
            $table->timestamps();
            $table->boolean('orcamento')->default(0);
            $table->integer('cidades_id')->unsigned();

		});
	}

	public function down()
	{
		Schema::drop('transfers');
	}

}
