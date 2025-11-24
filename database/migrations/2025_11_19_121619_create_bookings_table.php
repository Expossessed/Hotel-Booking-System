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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');                // BIGINT UNSIGNED primary key

            // Must match users.id (BIGINT UNSIGNED)
            $table->unsignedBigInteger('booker_id');

            // Must match rooms.room_id (INT UNSIGNED via increments)
            $table->unsignedInteger('room_id');

            $table->date('book_date');
            $table->integer('room_price');
            $table->date('end_date');
            $table->integer('num_days');
            $table->timestamps();

            // Proper foreign key definitions for SQLite & MySQL
            $table->foreign('booker_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('room_id')
                ->references('room_id')
                ->on('rooms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
