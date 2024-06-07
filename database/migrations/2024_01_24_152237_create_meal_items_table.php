<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meal_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_item_id');
            $table->unsignedBigInteger('meal_id');
            $table->integer('quantity');
            $table->foreign('menu_item_id')->references('id')->on('menu_items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('meal_id')->references('id')->on('meals')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_items');
    }
};
