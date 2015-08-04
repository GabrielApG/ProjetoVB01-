<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyObservacoes extends Migration {


	public function up()
	{
        Schema::table('observacoes', function(Blueprint $table){
            $table->foreign('clientes_id')->references('id')->on('clientes');
        });
	}

	public function down()
	{
        Schema::table('observacoes', function(Blueprint $table){
            $table->removeColumn('clientes_id');
        });
	}

}
