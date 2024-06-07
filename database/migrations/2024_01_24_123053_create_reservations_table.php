++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++6-<?php

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

        Schema::create('reservations',function ( Blueprint $table ){
            $table->id();
            $table->timestamp('reservation_time')->nullable();
            $table->integer('people_count');
            $table->enum('status',['requested','pending','confirmed','checkedin','canceled','abandoned']);
            $table->text('note')->nullable();
            $table->timestamp('checkin_time')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

    }
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
