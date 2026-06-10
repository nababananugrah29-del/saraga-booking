<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Booking;
use App\Models\Venue;
use App\Models\Payout;
use App\Models\Wallet;
use Illuminate\Support\Str;

class AdminSimulationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure we have a Vendor with a Wallet and balance
        $vendor = User::where('role', 'vendor')->first() ?? User::factory()->create(['role' => 'vendor', 'name' => 'Mitra Simulasi']);
        
        $wallet = $vendor->wallet()->firstOrCreate([], ['balance' => 0]);
        $wallet->increment('balance', 5000000); // 5 Million IDR

        // 2. Create a PENDING Payout Request
        Payout::create([
            'vendor_id' => $vendor->id,
            'amount' => 1500000,
            'bank_account' => 'BCA - 8923012930 - a/n ' . $vendor->name,
            'status' => 'pending',
            'admin_note' => 'Penarikan hasil minggu pertama'
        ]);

        // 3. Create an UNVERIFIED Venue
        Venue::create([
            'vendor_id' => $vendor->id,
            'nama_venue' => 'Gelora Bung Karno (KW)',
            'slug' => 'gbk-kw',
            'alamat' => 'Samping Senayan, Jakarta',
            'province_id' => 31, // DKI Jakarta
            'regency_id' => 3171, // Jakarta Pusat
            'district_id' => 3171010, // Tanah Abang
            'foto_venue' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800',
            'is_verified' => false,
            'is_active' => true,
            'timezone' => 'WIB'
        ]);

        // 4. Create some diverse users for the User Management table
        if (User::count() < 10) {
            User::factory()->count(5)->create(['role' => 'user']);
            User::factory()->count(2)->create(['role' => 'vendor']);
        }
    }
}
