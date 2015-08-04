<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyClientes extends Migration {

    public function up()
    {
        Schema::table('clientes', function(Blueprint $table){
            $table->foreign('situacoes_id')->references('id')->on('situacoes');
            $table->foreign('categorias_id')->references('id')->on('categorias');
            $table->foreign('pacotes_id')->references('id')->on('pacotes');
        });

        Schema::table('dependentes', function(Blueprint $table){
            $table->foreign('situacoes_id')->references('id')->on('situacoes');
            $table->foreign('categorias_id')->references('id')->on('categorias');
            $table->foreign('pacotes_id')->references('id')->on('pacotes');
        });
    }


    public function down()
    {
        Schema::table('clientes', function(Blueprint $table){
            $table->removeColumn('situacoes_id');
            $table->removeColumn('categorias_id');
            $table->removeColumn('pacotes_id');
        });

        Schema::table('dependentes', function(Blueprint $table){
            $table->removeColumn('situacoes_id');
            $table->removeColumn('categorias_id');
            $table->removeColumn('pacotes_id');
        });
    }

}
