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
        Schema::create('rooms', function (Blueprint $table) {
            // Use room_id so it matches the foreign key in bookings
            $table->increments('room_id');
            $table->string('image_link')->nullable()->default('default.jpg');
            $table->string('room_name');
            $table->enum('room_type', ['single', 'family', 'VIP']);
            $table->string('room_desc');
            $table->integer('room_price');
            $table->string('room_image1')->nullable()->default('default.jpg');
            $table->string('room_image2')->nullable()->default('default.jpg');
            $table->string('room_image3')->nullable()->default('default.jpg');
            $table->integer('available_rooms');
            $table->boolean('is_available')->default(true); 
            $table->json('free_items')->nullable()->default(json_encode([]));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
