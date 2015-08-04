<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesExtrasTable extends Migration {

    public function up()
    {
        Schema::create('clientes_extras', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('clientes_id')->unsigned();
            $table->foreign('clientes_id')->references('id')->on('clientes');
            $table->integer('extras_id')->unsigned();
            $table->foreign('extras_id')->references('id')->on('extras');
        });
    }

    public function down()
    {
        Schema::drop('clientes_extras');
    }

}
