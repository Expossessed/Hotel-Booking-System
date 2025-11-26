<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Rooms;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_fails_when_no_rooms_are_available_for_selected_dates(): void
    {
        $user = User::factory()->create();

        $room = Rooms::create([
            'room_name'        => 'Suite 101',
            'room_type'        => 'solo',
            'room_desc'        => 'Nice single room',
            'room_price'       => 100,
            'image_link'       => 'suite-101.jpg',
            'available_rooms'  => 1,
            'is_available'     => 1,
        ]);

        // One existing booking fully overlapping the requested dates, exhausting availability
        Booking::create([
            'booker_id'  => $user->id,
            'room_id'    => $room->room_id,
            'book_date'  => '2025-11-26',
            'end_date'   => '2025-11-28',
            'room_price' => 100,
            'num_days'   => 2,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('bookings.form'))
            ->post(route('bookings.create'), [
                'room_id'   => $room->room_id,
                'book_date' => '2025-11-26',
                'num_days'  => 2,
            ]);

        $response
            ->assertRedirect(route('bookings.form'))
            ->assertSessionHasErrors([
                'room_id' => 'No rooms of this type are available for the selected dates.',
            ]);

        // Still only the original booking in the database
        $this->assertEquals(1, Booking::count());
    }

    public function test_booking_is_created_when_rooms_are_available_for_selected_dates(): void
    {
        $user = User::factory()->create();

        $room = Rooms::create([
            'room_name'        => 'Family Suite',
            'room_type'        => 'family',
            'room_desc'        => 'Spacious family room',
            'room_price'       => 150,
            'image_link'       => 'family-suite.jpg',
            'available_rooms'  => 2,
            'is_available'     => 1,
        ]);

        // One existing overlapping booking, but there are 2 available rooms total
        Booking::create([
            'booker_id'  => $user->id,
            'room_id'    => $room->room_id,
            'book_date'  => '2025-11-26',
            'end_date'   => '2025-11-28',
            'room_price' => 150,
            'num_days'   => 2,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('bookings.create'), [
                'room_id'   => $room->room_id,
                'book_date' => '2025-11-26',
                'num_days'  => 2,
                // Skip the preview step and go straight to creating the booking
                'confirm'   => '1',
            ]);

        $response
            ->assertStatus(200)
            ->assertViewIs('Booking.created')
            ->assertViewHas('booking');

        $this->assertDatabaseHas('bookings', [
            'booker_id'  => $user->id,
            'room_id'    => $room->room_id,
            'book_date'  => '2025-11-26',
            'end_date'   => '2025-11-28',
            'room_price' => 150,
            'num_days'   => 2,
        ]);
    }
}
