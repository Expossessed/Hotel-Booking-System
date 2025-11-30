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
        // Migration intentionally left blank so we don't create the legacy
        // `room_reviews` table. The application uses `reviews` table instead.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op: we intentionally do not re-create the legacy room_reviews table.
    }
};