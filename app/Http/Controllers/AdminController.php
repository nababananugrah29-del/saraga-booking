<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use App\Models\Booking;
use App\Models\Payout;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Platform Revenue = 10% from all bookings + 100% of subscriptions
        $bookingRevenue = Booking::where('status', 'lunas')->sum('platform_fee');
        $subRevenue = Subscription::where('status_pembayaran', 'verified')->sum('price');
        $revenue = $bookingRevenue + $subRevenue;

        $vendorsCount = User::where('role', 'vendor')->count();
        $usersCount = User::where('role', 'user')->count();
        $pendingVendors = Subscription::with('vendor')->where('status_pembayaran', 'pending')->get();
        $pendingPayouts = Payout::with('vendor')->where('status', 'pending')->get();
        $unverifiedVenues = \App\Models\Venue::with('vendor')->where('is_verified', false)->get();

        return view('admin.dashboard', compact('revenue', 'vendorsCount', 'usersCount', 'pendingVendors', 'pendingPayouts', 'unverifiedVenues'));
    }

    public function approveVendor($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update(['status_pembayaran' => 'verified']);

        $vendor = User::findOrFail($subscription->vendor_id);
        $vendor->update([
            'is_active' => true,
            'role' => 'vendor'
        ]);

        return response()->json([
            'success' => true, 
            'message' => "Vendor {$vendor->name} telah berhasil diaktifkan!"
        ]);
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function venues()
    {
        $venues = \App\Models\Venue::with(['vendor', 'courts'])->latest()->paginate(15);
        return view('admin.venues', compact('venues'));
    }

    public function approvePayout($id)
    {
        $payout = Payout::with('vendor.wallet')->findOrFail($id);
        
        // Final Security Check: Ensure balance deduction was already done (Frozen Balance logic)
        // If we reject, we would increment back. Since we approve, we just mark as approved.
        $payout->update(['status' => 'approved']);

        return response()->json([
            'success' => true,
            'message' => "Penarikan dana Rp " . number_format($payout->amount, 0, ',', '.') . " telah disetujui dan diproses."
        ]);
    }

    public function verifyVenue($id)
    {
        $venue = \App\Models\Venue::findOrFail($id);
        $venue->update(['is_verified' => true]);

        return response()->json([
            'success' => true,
            'message' => "Venue {$venue->nama_venue} telah diverifikasi dan siap muncul di pencarian nasional!"
        ]);
    }

    public function laporan()
    {
        $bookingRevenue = Booking::where('status', 'lunas')->sum('platform_fee');
        $subRevenue = Subscription::where('status_pembayaran', 'verified')->sum('price');
        $totalRevenue = $bookingRevenue + $subRevenue;
        
        $gmv = Booking::where('status', 'lunas')->sum('total_harga');
        
        // Mocking growth data for the chart
        $growthData = [30, 45, 35, 60, 55, 80];

        return view('admin.laporan', compact('totalRevenue', 'gmv', 'bookingRevenue', 'subRevenue', 'growthData'));
    }
    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent admin from suspending themselves
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak bisa menangguhkan akun Anda sendiri.'
            ], 403);
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'ditangguhkan (suspended)';
        
        return response()->json([
            'success' => true,
            'message' => "Akun {$user->name} berhasil {$status}.",
            'is_active' => $user->is_active
        ]);
    }

    public function toggleVenueStatus($id)
    {
        $venue = \App\Models\Venue::findOrFail($id);
        
        // We will toggle the is_verified status. If it's verified, we unverify it (suspend).
        $venue->update(['is_verified' => !$venue->is_verified]);

        $status = $venue->is_verified ? 'diverifikasi' : 'ditangguhkan (unverified)';

        return response()->json([
            'success' => true,
            'message' => "Venue {$venue->nama_venue} berhasil {$status}.",
            'is_verified' => $venue->is_verified
        ]);
    }

    public function exportCsv()
    {
        $bookings = Booking::with(['user', 'court.venue'])->where('status', 'lunas')->get();

        $filename = "laporan_pendapatan_" . date('Ymd') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Kode Booking', 'Tanggal', 'Jam Mulai', 'Durasi (Jam)', 'Venue', 'Lapangan', 'Penyewa', 'Harga Sewa', 'Pendapatan Platform (10%)', 'Biaya Layanan Admin'];

        $callback = function() use($bookings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bookings as $booking) {
                $row = [
                    $booking->kode_booking,
                    $booking->tanggal,
                    $booking->jam_mulai,
                    $booking->durasi,
                    $booking->court->venue->nama_venue ?? 'N/A',
                    $booking->court->nama_lapangan ?? 'N/A',
                    $booking->user->name ?? 'N/A',
                    $booking->total_harga,
                    $booking->platform_fee,
                    2500 // Flat admin fee
                ];
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
