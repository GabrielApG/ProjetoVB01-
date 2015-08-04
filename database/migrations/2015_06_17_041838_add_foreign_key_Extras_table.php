<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyExtrasTable extends Migration {


	public function up()
	{
        Schema::table('extras', function(Blueprint $table){
            $table->foreign('cidades_id')->references('id')->on('cidades');
        });
	}

	public function down()
	{
        Schema::table('extras', function(Blueprint $table){
            $table->removeColumn('cidades_id');
        });
	}

}
