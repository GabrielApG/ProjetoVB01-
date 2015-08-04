<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasseiosTable extends Migration {

	public function up()
	{
		Schema::create('passeios', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('nome',255);
            $table->string('ponto_partida',100);
            $table->date('data_ida');
            $table->time('hora_ida');
            $table->string('empresa_passeio',100);
            $table->text('descricao');
            $table->decimal('valor');
            $table->timestamps();
            $table->boolean('orcamento')->default(0);
            $table->integer('cidades_id')->unsigned();

		});
	}

	public function down()
	{
		Schema::drop('passeios');
	}

}
