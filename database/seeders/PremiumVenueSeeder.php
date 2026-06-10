<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venue;
use App\Models\Court;
use App\Models\User;
use Illuminate\Support\Str;

class PremiumVenueSeeder extends Seeder
{
    public function run(): void
    {
        $vendorId = User::where('role', 'vendor')->first()->id ?? 1;

        $venues = [
            [
                'name' => 'Arena Futsal Grand Slam',
                'regency_id' => '3174', // Jakarta Selatan
                'price' => 150000,
                'img' => 'https://images.unsplash.com/photo-1541534741688-6078c64b52d3?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Elite Basketball Hub',
                'regency_id' => '3171', // Jakarta Pusat (Exist)
                'price' => 250000,
                'img' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Volley & Tennis Central',
                'regency_id' => '3273', // Bandung
                'price' => 120000,
                'img' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Badminton Pro Suite',
                'regency_id' => '3578', // Surabaya
                'price' => 80000,
                'img' => 'https://images.unsplash.com/photo-1626225967045-9c76db7b3f4c?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Blue Court Arena',
                'regency_id' => '3374', // Semarang
                'price' => 110000,
                'img' => 'https://images.unsplash.com/photo-1541534440691-ef1215bb4303?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'The Shuttle Hub',
                'regency_id' => '1271', // Medan
                'price' => 95000,
                'img' => 'https://images.unsplash.com/photo-1626225967045-9c76db7b3f4c?auto=format&fit=crop&q=80&w=800'
            ]
        ];

        foreach ($venues as $v) {
            $slug = Str::slug($v['name']);
            
            // Create the Venue
            $venue = Venue::updateOrCreate(
                ['slug' => $slug],
                [
                    'vendor_id' => $vendorId,
                    'nama_venue' => $v['name'],
                    'regency_id' => $v['regency_id'],
                    'province_id' => substr($v['regency_id'], 0, 2),
                    'foto_venue' => $v['img'],
                    'alamat' => 'Alamat ' . $v['name'],
                    'timezone' => 'WIB',
                    'description' => 'Deskripsi untuk ' . $v['name'],
                    'is_active' => true,
                    'is_verified' => true
                ]
            );

            // Create at least one Court so it shows price/availability
            Court::updateOrCreate(
                ['venue_id' => $venue->id],
                [
                   'nama_lapangan' => 'Court A',
                   'tipe_olahraga' => 'Umum',
                   'harga_per_jam' => $v['price'],
                   'is_active' => true
                ]
            );
        }
    }
}
