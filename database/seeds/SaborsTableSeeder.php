<?php

use Illuminate\Database\Seeder;

class SaborsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Sabor::class)->create(['nome_sab' => 'calabresa', 'valor_sab' => 0, 'tempo_sab' => 0]);
        factory(\App\Sabor::class)->create(['nome_sab' => 'marguerita', 'valor_sab' => 0, 'tempo_sab' => 0]);
        factory(\App\Sabor::class)->create(['nome_sab' => 'portuguesa', 'valor_sab' => 0, 'tempo_sab' => 5]);
    }
}
