<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrensTable extends Migration {

	public function up()
	{
		Schema::create('trens', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('nome',255);
            $table->string('destino',100);
            $table->date('data_saida');
            $table->time('hora_ida');
            $table->string('empresa_trem',100);
            $table->decimal('valor');
            $table->string('numero',20); // Acrescentado dia 16/06
            $table->string('vagao',20); // 16-06
            $table->string('poltrona',10); // 16-16

            $table->boolean('orcamento')->default(0);
            $table->timestamps();
            $table->integer('cidades_id')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trens');
	}

}
