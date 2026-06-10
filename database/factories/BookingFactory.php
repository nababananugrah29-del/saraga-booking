<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'court_id' => \App\Models\Court::factory(),
            'kode_booking' => 'SRG-' . strtoupper($this->faker->bothify('??##')),
            'tanggal' => now()->addDays(rand(1, 10))->toDateString(),
            'jam_mulai' => '10:00:00',
            'durasi' => 2,
            'total_harga' => 200000,
            'status' => 'pending',
            'payment_method' => 'midtrans',
            'is_offline' => false,
        ];
    }
}
