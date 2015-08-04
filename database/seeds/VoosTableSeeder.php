<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Voos;
use Faker\Factory as Faker;

class VoosTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('voos');

        $faker = Faker::create();
        $n = 123456789;

        foreach(range(1,150) as $i)
        {
            Voos::create([
                'nome_voo'=>$faker->name,
                'local_emb'=>$faker->word,
                'local_des'=>$faker->word,
                'data_ida'=>$faker->date(),
                'data_volta'=>$faker->date(),
                'hora_ida'=>$faker->time(),
                'hora_volta'=>$faker->time(),
                'empresa_voo'=>$faker->name,
                'num_bilhete'=>$faker->randomNumber(6),
                'escalas'=>$faker->sentence(),
                'observacao'=>$faker->sentence(),
                'valor_voo'=>$faker->randomNumber(5),
                'clientes_id'=>$faker->numberBetween(1, 150),
                'cidades_id'=>$faker->numberBetween(1, 150),
            ]);
        }
    }
}