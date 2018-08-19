<?php

use Illuminate\Database\Seeder;

class TamanhosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\Tamanho::class)->create(['nome_tam' => 'pequena', 'valor_tam' => 20, 'tempo_tam' => 15]);
        factory(\App\Tamanho::class)->create(['nome_tam' => 'média', 'valor_tam' => 30, 'tempo_tam' => 20]);
        factory(\App\Tamanho::class)->create(['nome_tam' => 'grande', 'valor_tam' => 40, 'tempo_tam' => 25]);
    }
}
