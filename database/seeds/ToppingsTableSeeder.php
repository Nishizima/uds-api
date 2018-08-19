<?php

use Illuminate\Database\Seeder;

class ToppingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Topping::class)->create(['nome_top' => 'extra bacon', 'valor_top' => 3, 'tempo_top' => 0]);
        factory(App\Topping::class)->create(['nome_top' => 'sem cebola', 'valor_top' => 0, 'tempo_top' => 0]);
        factory(App\Topping::class)->create(['nome_top' => 'borda recheada', 'valor_top' => 5, 'tempo_top' => 5]);
    }
}
