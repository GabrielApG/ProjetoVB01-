<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyHoteis extends Migration {

	public function up()
	{

        Schema::table('telefones', function(Blueprint $table){
            $table->foreign('clientes_id')->references('id')->on('clientes');
        });

        Schema::table('dependentes', function(Blueprint $table){
            $table->foreign('clientes_id')->references('id')->on('clientes');
        });

        Schema::table('pacotes', function(Blueprint $table){
            $table->foreign('categorias_id')->references('id')->on('categorias');
        });

        Schema::table('voos', function(Blueprint $table){
            $table->foreign('cidades_id')->references('id')->on('cidades');
        });

        Schema::table('hoteis', function(Blueprint $table){
            $table->foreign('cidades_id')->references('id')->on('cidades');
        });

        Schema::table('trens', function(Blueprint $table){
            $table->foreign('cidades_id')->references('id')->on('cidades');
        });

        Schema::table('transfers', function(Blueprint $table){
            $table->foreign('cidades_id')->references('id')->on('cidades');
        });

        Schema::table('passeios', function(Blueprint $table){
            $table->foreign('cidades_id')->references('id')->on('cidades');
        });

	}


	public function down()
	{
        Schema::table('telefones', function(Blueprint $table){
            $table->removeColumn('clientes_id');
        });

        Schema::table('dependentes', function(Blueprint $table){
            $table->removeColumn('clientes_id');
        });

        Schema::table('pacotes', function(Blueprint $table){
            $table->removeColumn('categoria_id');
        });

        Schema::table('voos', function(Blueprint $table){
            $table->removeColumn('cidades_id');
        });

        Schema::table('hoteis', function(Blueprint $table){
            $table->removeColumn('cidades_id');
        });

        Schema::table('trens', function(Blueprint $table){
            $table->removeColumn('cidades_id');
        });

        Schema::table('transfers', function(Blueprint $table){
            $table->removeColumn('cidades_id');
        });

        Schema::table('passeios', function(Blueprint $table){
            $table->removeColumn('cidades_id');
        });

	}

}
