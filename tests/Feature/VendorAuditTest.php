<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Venue;
use App\Models\Court;
use App\Models\Booking;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VendorAuditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_vendor_cannot_access_dashboard_without_active_subscription()
    {
        $vendor = User::factory()->create(['role' => 'vendor']);
        
        $this->actingAs($vendor)
            ->get(route('mitra.pesanan'))
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('error');
    }

    /** @test */
    public function test_vendor_can_only_see_their_own_venue_bookings()
    {
        // 1. Create two vendors
        $vendorA = User::factory()->create(['role' => 'vendor']);
        $vendorB = User::factory()->create(['role' => 'vendor']);

        // 2. Give them active subscriptions
        Subscription::create([
            'vendor_id' => $vendorA->id,
            'status_pembayaran' => 'verified',
            'paket' => 'Bulanan',
            'price' => 250000,
            'expires_at' => now()->addMonth(),
        ]);
        Subscription::create([
            'vendor_id' => $vendorB->id,
            'status_pembayaran' => 'verified',
            'paket' => 'Bulanan',
            'price' => 250000,
            'expires_at' => now()->addMonth(),
        ]);

        // 3. Create venues and bookings for each
        $venueA = Venue::factory()->create(['vendor_id' => $vendorA->id]);
        $courtA = Court::factory()->create(['venue_id' => $venueA->id]);
        $bookingA = Booking::factory()->create(['court_id' => $courtA->id, 'kode_booking' => 'VND-A']);

        $venueB = Venue::factory()->create(['vendor_id' => $vendorB->id]);
        $courtB = Court::factory()->create(['venue_id' => $venueB->id]);
        $bookingB = Booking::factory()->create(['court_id' => $courtB->id, 'kode_booking' => 'VND-B']);

        // 4. Act as Vendor A and check isolation
        $response = $this->actingAs($vendorA)->get(route('mitra.pesanan'));
        
        $response->assertStatus(200);
        $response->assertSee('VND-A');
        $response->assertDontSee('VND-B');
    }

    /** @test */
    public function test_vendor_withdrawal_is_limited_to_once_per_week()
    {
        $vendor = User::factory()->create(['role' => 'vendor']);
        $wallet = \App\Models\Wallet::create(['vendor_id' => $vendor->id, 'balance' => 500000]);

        // 1. Create a payout from 2 days ago
        auth()->login($vendor);
        $vendor->payouts()->create([
            'amount' => 100000,
            'bank_account' => 'BCA 123',
            'status' => 'pending',
            'created_at' => now()->subDays(2)
        ]);

        // 2. Try to withdraw again
        $response = $this->post(route('mitra.withdraw'), [
            'amount' => 100000,
            'bank_account' => 'BCA 123'
        ]);

        $response->assertSessionHas('error');
        $this->assertEquals(500000, $vendor->wallet->fresh()->balance); // Balance not deducted
    }

    /** @test */
    public function test_search_results_only_show_verified_and_active_venues()
    {
        $province = \App\Models\Province::create(['id' => 1, 'name' => 'Sumatera Utara']);
        $regency = \App\Models\Regency::create(['id' => 1, 'name' => 'Medan', 'province_id' => $province->id]);

        $verifiedVenue = Venue::factory()->create(['is_verified' => true, 'is_active' => true, 'nama_venue' => 'Verified Venue', 'regency_id' => $regency->id]);
        $unverifiedVenue = Venue::factory()->create(['is_verified' => false, 'is_active' => true, 'nama_venue' => 'Unverified Venue', 'regency_id' => $regency->id]);
        $inactiveVenue = Venue::factory()->create(['is_verified' => true, 'is_active' => false, 'nama_venue' => 'Inactive Venue', 'regency_id' => $regency->id]);

        $response = $this->get(route('home'));
        
        $response->assertSee('Verified Venue');
        $response->assertDontSee('Unverified Venue');
        $response->assertDontSee('Inactive Venue');
    }
}
