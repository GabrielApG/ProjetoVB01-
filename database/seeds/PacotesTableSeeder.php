<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Pacotes;
use Faker\Factory as Faker;

class PacotesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('pacotes');

        $faker = Faker::create();

            Pacotes::create([
                'nome'=>'1 - Pacote',
                'descricao'=>'decrição 1',
                'valor' => '150,00',
                'categorias_id'=>1,
            ]);

             Pacotes::create([
                'nome'=>'2 - Pacote',
                'descricao'=>'descrição 2',
                'valor' => '280,00',
                'categorias_id'=>2,
            ]);
    }
}