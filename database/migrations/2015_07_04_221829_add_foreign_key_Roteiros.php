<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyRoteiros extends Migration {

	public function up()
    {
    Schema::table('roteiros', function(Blueprint $table){
        $table->foreign('cidades_id')->references('id')->on('cidades');
    });
    }

    public function down()
    {
        Schema::table('roteiros', function(Blueprint $table){
            $table->removeColumn('cidades_id');
        });
    }

}
