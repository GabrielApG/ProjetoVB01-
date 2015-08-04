<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Situacoes;
use Faker\Factory as Faker;

class SituacoesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('situacoes');

        $faker = Faker::create();

            Situacoes::create([
                'nome'=>'1 - Situação',
            ]);

            Situacoes::create([
                'nome'=>'2 - Situação',
            ]);

            Situacoes::create([
                'nome'=>'3 - Situação',
            ]);

    }
}