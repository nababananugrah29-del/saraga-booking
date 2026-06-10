<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $latestBooking = Booking::with('court.venue')
            ->where('user_id', auth()->id())
            ->whereIn('status', ['lunas', 'pending'])
            ->latest()
            ->first();

        return view('dashboard.index', compact('latestBooking'));
    }

    public function pesanan()
    {
        $bookings = Booking::with('court.venue')->where('user_id', auth()->id())->latest()->get();
        return view('dashboard.pesanan', compact('bookings'));
    }

    public function favorit()
    {
        return view('dashboard.favorit');
    }

    public function pengaturan()
    {
        return view('dashboard.pengaturan');
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        auth()->user()->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
