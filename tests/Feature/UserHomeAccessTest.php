<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Rooms;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserHomeAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_is_redirected_from_user_home(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('rooms.list'))
            ->assertRedirect(route('admin.front'));
    }

    public function test_logged_in_user_view_room_shows_logout(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        // create a Room entry so view route finds it
        $room = Rooms::create([
            'room_name' => 'Test Room',
            'room_type' => 'single',
            'room_desc' => 'A nice room',
            'room_price' => 100,
            'image_link' => 'https://picsum.photos/300/200',
            'available_rooms' => 5,
            'is_available' => 1,
            'free_items' => [],
        ]);

        $response = $this->actingAs($user)->get(route('rooms.view', ['id' => $room->room_id]));
        $response->assertStatus(200);

        // Ensure the page shows Logout control (and not a plain Login link)
        $response->assertSee('Logout');
        $response->assertDontSee('href="'.route('login').'"');
    }
}
