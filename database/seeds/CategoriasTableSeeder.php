<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Categorias;
use Faker\Factory as Faker;

class CategoriasTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('categorias');

        $faker = Faker::create();

            Categorias::create([
                'nome'=>'1 - Categoria',
            ]);

            Categorias::create([
                'nome'=>'2 - Categoria',
            ]);
    }
}