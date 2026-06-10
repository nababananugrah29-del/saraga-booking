<?php

namespace Database\Factories;

use App\Models\Court;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Court>
 */
class CourtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sports = [
            'Badminton', 'Futsal', 'Basketball', 'Tennis', 
            'Mini Soccer', 'Volley', 'Swimming', 'Table Tennis', 
            'Gym', 'Billiards', 'Yoga', 'Zumba'
        ];
        $sport = $this->faker->randomElement($sports);
        
        return [
            'venue_id' => \App\Models\Venue::factory(),
            'nama_lapangan' => 'Court ' . $this->faker->numberBetween(1, 5),
            'tipe_olahraga' => $sport,
            'harga_per_jam' => $this->faker->randomElement([50000, 75000, 100000, 150000, 200000, 250000]),
        ];
    }
}
