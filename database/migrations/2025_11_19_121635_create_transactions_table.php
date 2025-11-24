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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');            // primary key

            // Must match users.id (BIGINT UNSIGNED)
            $table->unsignedBigInteger('booker_id');

            // Must match rooms.room_id (INT UNSIGNED via increments)
            $table->unsignedInteger('room_id');
            $table->integer('price_paid');
            $table->date('book_date');
            $table->date('end_date');
            $table->timestamps();


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
        Schema::dropIfExists('transactions');
    }
};
