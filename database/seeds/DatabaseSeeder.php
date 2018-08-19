<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SaborsTableSeeder::class);
        $this->call(TamanhosTableSeeder::class);
        $this->call(ToppingsTableSeeder::class);
    }
}
