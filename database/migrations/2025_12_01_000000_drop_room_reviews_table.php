<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop legacy table if it somehow exists in older databases.
        Schema::dropIfExists('room_reviews');
    }

    public function down(): void
    {
        // Intentionally left blank: the legacy table should not be recreated.
    }
};
