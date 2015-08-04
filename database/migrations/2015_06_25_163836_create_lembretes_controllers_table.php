<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLembretesControllersTable extends Migration {


	public function up()
	{
		Schema::create('lembretes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('titulo');
            $table->text('descricao');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('lembretes');
	}

}
