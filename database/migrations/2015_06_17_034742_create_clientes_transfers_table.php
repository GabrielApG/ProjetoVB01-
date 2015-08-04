<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTransfersTable extends Migration {

    public function up()
    {
        Schema::create('clientes_transfers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('clientes_id')->unsigned();
            $table->foreign('clientes_id')->references('id')->on('clientes');
            $table->integer('transfers_id')->unsigned();
            $table->foreign('transfers_id')->references('id')->on('transfers');
        });
    }

    public function down()
    {
        Schema::drop('clientes_transfers');
    }

}
