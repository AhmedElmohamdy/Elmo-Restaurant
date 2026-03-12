<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_make_booking(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('home.saveBooking'), [
            'name'           => 'John Doe',
            'phoneNumber'    => '01234567890',
            'email'          => 'john@gmail.com',
            'NumberOfPerson' => 2,
            'date'           => now()->addDay()->format('Y-m-d'),
            'booking_time'   => '18:00',
        ]);

        $response->assertRedirect(route('home.index'));
        $this->assertDatabaseHas('books', ['email' => 'john@gmail.com']);
    }

    public function test_guest_cannot_make_booking(): void
    {
        $response = $this->post(route('home.saveBooking'), []);
        $response->assertRedirect(route('login'));
    }
}
