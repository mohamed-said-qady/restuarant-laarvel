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
        Schema::create('table_seats', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->enum('status',['regular','kid','accessible','other']);
            $table->unsignedBigInteger('table_id');
            $table->foreign('table_id')->references('id')->on('tables')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_seats');
    }
};
