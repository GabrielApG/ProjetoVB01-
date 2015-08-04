<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesVoosTable extends Migration {

    public function up()
    {
        Schema::create('clientes_voos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('clientes_id')->unsigned();
            $table->foreign('clientes_id')->references('id')->on('clientes');
            $table->integer('voos_id')->unsigned();
            $table->foreign('voos_id')->references('id')->on('voos');
        });
    }

    public function down()
    {
        Schema::drop('clientes_voos');
    }

}
