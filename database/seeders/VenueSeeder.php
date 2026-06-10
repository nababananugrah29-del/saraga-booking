<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Pastikan ada Vendor untuk dikaitkan dengan Venue
        $vendors = \App\Models\User::where('role', 'vendor')->get();
        
        if ($vendors->isEmpty()) {
            $vendors = \App\Models\User::factory()->count(10)->create(['role' => 'vendor']);
        }

        $regencies = \App\Models\Regency::all();

        foreach ($regencies as $regency) {
            // Buat minimal 2 Venue per Kota
            \App\Models\Venue::factory()->count(2)->create([
                'vendor_id' => $vendors->random()->id,
                'province_id' => $regency->province_id,
                'regency_id' => $regency->id,
                'district_id' => $regency->id . '010', // Menghubungkan ke distrik dummy
                'alamat' => 'Jl. Olahraga Utama No. ' . rand(1, 100) . ', ' . $regency->name,
            ])->each(function ($venue) {
                // Buat 3 Lapangan per Venue
                \App\Models\Court::factory()->count(3)->create([
                    'venue_id' => $venue->id,
                ]);
            });
        }
    }
}
