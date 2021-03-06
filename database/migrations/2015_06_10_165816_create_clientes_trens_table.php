<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTrensTable extends Migration {

	public function up()
    {
        Schema::create('clientes_trens', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('clientes_id')->unsigned();
            $table->foreign('clientes_id')->references('id')->on('clientes');
            $table->integer('trens_id')->unsigned();
            $table->foreign('trens_id')->references('id')->on('trens');
        });
    }

    public function down()
    {
        Schema::drop('clientes_trens');
    }

}
