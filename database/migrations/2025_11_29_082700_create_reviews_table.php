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
        Schema::create('room_reviews', function (Blueprint $table) {
            $table->id();

            // Match the type of rooms.room_id (integer primary key)
            $table->integer('room_id')->unsigned();
            $table->unsignedBigInteger('user_id');

            $table->unsignedTinyInteger('rating'); // 1–255 range
            $table->text('comment')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('room_id')
                  ->references('room_id')->on('rooms')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_reviews');
    }
};