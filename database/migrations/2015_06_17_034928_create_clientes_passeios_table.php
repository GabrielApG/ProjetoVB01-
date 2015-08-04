<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesPasseiosTable extends Migration {

    public function up()
    {
        Schema::create('clientes_passeios', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('clientes_id')->unsigned();
            $table->foreign('clientes_id')->references('id')->on('clientes');
            $table->integer('passeios_id')->unsigned();
            $table->foreign('passeios_id')->references('id')->on('passeios');
        });
    }

    public function down()
    {
        Schema::drop('clientes_passeios');
    }

}
