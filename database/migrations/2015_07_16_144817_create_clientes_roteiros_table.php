<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesRoteirosTable extends Migration {

    public function up()
    {
        Schema::create('clientes_roteiros', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('clientes_id')->unsigned();
            $table->foreign('clientes_id')->references('id')->on('clientes');
            $table->integer('roteiros_id')->unsigned();
            $table->foreign('roteiros_id')->references('id')->on('roteiros');
        });
    }

    public function down()
    {
        Schema::drop('clientes_roteiros');
    }

}
