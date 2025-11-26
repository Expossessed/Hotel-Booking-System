<?php

namespace Tests\Feature;

use App\Models\Rooms;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_create_room_with_non_unique_room_name(): void
    {
        Rooms::create([
            'room_name'        => 'Deluxe Suite',
            'room_type'        => 'solo',
            'room_desc'        => 'Original deluxe suite',
            'room_price'       => 200,
            'image_link'       => 'deluxe.jpg',
            'available_rooms'  => 3,
            'is_available'     => 1,
        ]);

        $response = $this->post('/admin/create', [
            'room_name'        => 'Deluxe Suite', // duplicate name
            'room_type'        => 'family',
            'room_desc'        => 'Another room with same name',
            'room_price'       => 220,
            'image_link'       => 'deluxe-2.jpg',
            'available_rooms'  => 2,
            'is_available'     => 1,
        ]);

        $response->assertSessionHasErrors('room_name');
        $this->assertDatabaseCount('rooms', 1);
    }

    public function test_cannot_update_room_name_to_non_unique_name(): void
    {
        $roomA = Rooms::create([
            'room_name'        => 'Room A',
            'room_type'        => 'solo',
            'room_desc'        => 'Room A description',
            'room_price'       => 100,
            'image_link'       => 'a.jpg',
            'available_rooms'  => 1,
            'is_available'     => 1,
        ]);

        $roomB = Rooms::create([
            'room_name'        => 'Room B',
            'room_type'        => 'family',
            'room_desc'        => 'Room B description',
            'room_price'       => 150,
            'image_link'       => 'b.jpg',
            'available_rooms'  => 1,
            'is_available'     => 1,
        ]);

        $response = $this->post("/admin/edit/{$roomB->room_id}", [
            'room_name'        => 'Room A', // try to rename B to existing name A
            'room_type'        => 'family',
            'room_desc'        => 'Updated description',
            'room_price'       => 160,
            'image_link'       => 'b-updated.jpg',
            'available_rooms'  => 1,
            'is_available'     => 1,
        ]);

        $response->assertSessionHasErrors('room_name');
        $this->assertSame('Room B', $roomB->fresh()->room_name);
    }

    public function test_cannot_create_room_with_invalid_room_type(): void
    {
        $response = $this->post('/admin/create', [
            'room_name'        => 'Invalid Type Room',
            'room_type'        => 'penthouse', // not in solo,family,deluxe_vip
            'room_desc'        => 'Invalid type',
            'room_price'       => 300,
            'image_link'       => 'invalid.jpg',
            'available_rooms'  => 1,
            'is_available'     => 1,
        ]);

        $response->assertSessionHasErrors('room_type');
        $this->assertDatabaseCount('rooms', 0);
    }
}
