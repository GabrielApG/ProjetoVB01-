<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();

        $this->call('SituacoesTableSeeder');
        $this->call('CategoriasTableSeeder');
        $this->call('PacotesTableSeeder');
        $this->call('ClientesTableSeeder');
       // $this->call('VoosTableSeeder');
	}

}
