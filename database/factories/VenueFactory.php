<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = ['Elite', 'Champion', 'Pro', 'Nexus', 'Sky', 'The Cage', 'Victory', 'Prime', 'Grand', 'Olympic'];
        $types = ['Arena', 'Stadium', 'Hall', 'Center', 'Sport Club', 'Hub'];
        $sports = ['Badminton', 'Futsal', 'Basketball', 'Tennis'];

        $name = $this->faker->randomElement($names) . ' ' . $this->faker->randomElement($sports) . ' ' . $this->faker->randomElement($types);

        return [
            'vendor_id' => \App\Models\User::factory()->create(['role' => 'vendor'])->id,
            'nama_venue' => $name,
            'slug' => \Illuminate\Support\Str::slug($name . '-' . $this->faker->unique()->numberBetween(100, 999)),
            'alamat' => $this->faker->address(),
            'description' => $this->faker->paragraph(),
            'foto_venue' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800',
            'is_active' => true,
            'timezone' => $this->faker->randomElement(['WIB', 'WITA', 'WIT']),
        ];
    }
}
