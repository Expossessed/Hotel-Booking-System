<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ReviewsSchemaTest extends TestCase
{
    use RefreshDatabase;

    public function test_room_reviews_table_does_not_exist(): void
    {
        // After running migrations, the legacy 'room_reviews' table should not exist.
        $this->assertFalse(Schema::hasTable('room_reviews'));
    }
}
