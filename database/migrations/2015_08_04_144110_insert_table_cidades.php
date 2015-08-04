<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertTableCidades extends Migration {


	public function up()
	{
        DB::statement(file_get_contents(__DIR__ . '/../scriptsql/Insert_World_Cidades.sql'));
	}

	public function down()
	{
		//
	}

}
