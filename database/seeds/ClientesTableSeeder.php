<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Clientes;
use Faker\Factory as Faker;

class ClientesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('clientes');

        $faker = Faker::create();
        $n = 123456789;

        // Inserção do Cliente Default

        Clientes::create([
            'nome'=>'Default',
            'telefone'=>123456789,
            'data_nasc'=>$faker->date(),
            'email'=>$faker->email,
            'cep'=>$faker->randomNumber($n = null),
            'endereco'=>$faker->streetAddress,
            'numero'=>$faker->randomDigit,
            'bairro'=>$faker->word,
            'cidade'=>$faker->city,
            'estado'=>$faker->word,
            'pais'=>$faker->word,
            'cpf'=>$faker->randomNumber($n = null),
            'identidade'=>$faker->randomNumber($n = null),
            'orgao_emissor'=>$faker->numerify('ssp'),
            'data_exp'=>$faker->date(),
            'num_passaporte'=>$faker->randomNumber($n = null),
            'data_emissao_passaporte'=>$faker->date(),
            'validade_passaporte'=>$faker->date(),
            'nome_pai'=>$faker->name,
            'nome_mae'=>$faker->name,
            'lembretes'=>$faker->word,
            'situacoes_id'=>1,
            'categorias_id'=>1,
            'pacotes_id'=>1,
        ]);

        foreach(range(2,50) as $i)
        {
            Clientes::create([
                'nome'=>$faker->name,
                'telefone'=>$faker->randomNumber($n = null),
                'data_nasc'=>$faker->date(),
                'email'=>$faker->email,
                'cep'=>$faker->randomNumber($n = null),
                'endereco'=>$faker->streetAddress,
                'numero'=>$faker->randomDigit,
                'bairro'=>$faker->word,
                'cidade'=>$faker->city,
                'estado'=>$faker->word,
                'pais'=>$faker->word,
                'cpf'=>$faker->randomNumber($n = null),
                'identidade'=>$faker->randomNumber($n = null),
                'orgao_emissor'=>$faker->numerify('ssp'),
                'data_exp'=>$faker->date(),
                'num_passaporte'=>$faker->randomNumber($n = null),
                'data_emissao_passaporte'=>$faker->date(),
                'validade_passaporte'=>$faker->date(),
                'nome_pai'=>$faker->name,
                'nome_mae'=>$faker->name,
                'lembretes'=>$faker->word,
                'situacoes_id'=>$faker->numberBetween(1, 2, 3),
                'categorias_id'=>$faker->numberBetween(1, 2),
                'pacotes_id'=>$faker->numberBetween(1, 2),
             ]);
        }


    }
}