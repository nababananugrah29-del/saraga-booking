<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@saraga.id',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
            'is_active' => true,
        ]);

        // 2. Create Active Vendor
        $mitra1 = User::create([
            'name' => 'Bambang Sudjatmiko',
            'email' => 'bambang@elitearena.com',
            'password' => bcrypt('password'),
            'role' => 'vendor',
            'is_active' => true,
        ]);

        $venue1 = \App\Models\Venue::create([
            'vendor_id' => $mitra1->id,
            'nama_venue' => 'Elite Arena Futsal',
            'slug' => 'elite-arena-futsal',
            'alamat' => 'Jl. Kebon Jeruk No. 12, Jakarta',
            'description' => 'Lapangan futsal standar FIFA dengan rumput sintetis terbaik.',
            'foto_venue' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800',
        ]);

        $court1 = \App\Models\Court::create([
            'venue_id' => $venue1->id,
            'nama_lapangan' => 'Lapangan A (Sintetis)',
            'tipe_olahraga' => 'Futsal',
            'harga_per_jam' => 150000,
        ]);

        \App\Models\Subscription::create([
            'vendor_id' => $mitra1->id,
            'paket' => 'tahunan',
            'status_pembayaran' => 'verified',
            'price' => 1500000,
            'expiry_date' => now()->addYear(),
        ]);

        // 3. Create Pending Vendor (belum disetujui)
        $mitra2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@badmintonhub.id',
            'password' => bcrypt('password'),
            'role' => 'user',
            'is_active' => true,
        ]);

        \App\Models\Subscription::create([
            'vendor_id' => $mitra2->id,
            'paket' => 'bulanan',
            'status_pembayaran' => 'pending',
            'price' => 150000,
        ]);

        // 4. Create Users
        $user1 = User::create([
            'name' => 'Anugrah Nababan',
            'email' => 'anugrah@user.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'points_balance' => 25000,
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@user.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // 5. Create Sample Bookings
        \App\Models\Booking::create([
            'user_id' => $user1->id,
            'court_id' => $court1->id,
            'kode_booking' => 'SRG-B672H92',
            'tanggal' => now()->toDateString(),
            'jam_mulai' => '19:00:00',
            'durasi' => 2,
            'total_harga' => 300000,
            'status' => 'lunas',
        ]);

        \App\Models\Booking::create([
            'user_id' => $user1->id,
            'court_id' => $court1->id,
            'kode_booking' => 'SRG-X821K90',
            'tanggal' => now()->addDay()->toDateString(),
            'jam_mulai' => '20:00:00',
            'durasi' => 1,
            'total_harga' => 150000,
            'status' => 'pending',
        ]);
    }
}
