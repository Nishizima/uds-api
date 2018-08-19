<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePizzaToppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizza_topping', function (Blueprint $table) {
            $table->unsignedInteger('pizza_id');
            $table->unsignedInteger('topping_id');
            $table->foreign('pizza_id')->references('id')->on('pizzas');

            $table->foreign('topping_id')->references('id')->on('toppings');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizza_topping');
    }
}
