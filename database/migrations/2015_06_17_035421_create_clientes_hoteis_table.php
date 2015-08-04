<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesHoteisTable extends Migration {

    public function up()
    {
        Schema::create('clientes_hoteis', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('clientes_id')->unsigned();
            $table->foreign('clientes_id')->references('id')->on('clientes');
            $table->integer('hoteis_id')->unsigned();
            $table->foreign('hoteis_id')->references('id')->on('hoteis');
        });
    }

    public function down()
    {
        Schema::drop('clientes_hoteis');
    }

}
