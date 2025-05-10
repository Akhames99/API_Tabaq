<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->decimal('ingredients_cost', 10, 2)->comment('Total cost of ingredients only + $30 delivery fee');
            $table->integer('recipe_quantity')->default(0);
            $table->integer('ingredients_quantity')->default(0);
            $table->decimal('total_price', 10, 2)->comment('Recipe price + $30 delivery fee');
            $table->boolean('is_ingredients_only')->default(false)->comment('When true, ingredients_cost goes to payment; when false, total_price goes to payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}