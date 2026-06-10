<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Court;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Start reservation process (Race Condition Prevention).
     */
    public function reserve(Request $request)
    {
        $request->validate([
            'court_id' => 'required|exists:courts,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'durasi' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
        ]);

        return DB::transaction(function () use ($request) {
            // 1. Calculate requested slots
            $requestedSlots = [];
            $startHour = (int) substr($request->time, 0, 2);
            for ($i = 0; $i < $request->durasi; $i++) {
                $requestedSlots[] = str_pad($startHour + $i, 2, '0', STR_PAD_LEFT) . ':00';
            }

            // 2. Atomic Check for Availability (Lock for update)
            $existingBookings = Booking::where('court_id', $request->court_id)
                ->where('tanggal', $request->date)
                ->whereIn('status', ['pending', 'lunas'])
                ->lockForUpdate() // Prevent other transactions from reading/writing this slot
                ->get();

            $isBooked = false;
            foreach ($existingBookings as $b) {
                $bStart = (int) substr($b->jam_mulai, 0, 2);
                for ($i = 0; $i < $b->durasi; $i++) {
                    $bTime = str_pad($bStart + $i, 2, '0', STR_PAD_LEFT) . ':00';
                    if (in_array($bTime, $requestedSlots)) {
                        $isBooked = true;
                        break 2; // Break both loops if any overlap found
                    }
                }
            }

            if ($isBooked) {
                return back()->with('error', 'Maaf, sebagian dari waktu yang Anda pilih baru saja dipesan orang lain. Silakan pilih jadwal baru.');
            }

            // 3. Create Pending Booking
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'court_id' => $request->court_id,
                'kode_booking' => 'SRG-' . strtoupper(Str::random(7)),
                'tanggal' => $request->date,
                'jam_mulai' => $request->time,
                'durasi' => $request->durasi,
                'total_harga' => $request->total_price,
                'status' => 'pending',
            ]);

            return redirect()->route('checkout', $booking->kode_booking);
        });
    }

    /**
     * Show checkout page for a specific booking.
     */
    public function checkout($kode_booking)
    {
        // Fix #11: Tambahkan user_id check agar user hanya bisa akses booking miliknya
        $booking = Booking::with(['court.venue'])
            ->where('kode_booking', $kode_booking)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // If already paid, redirect to success
        if ($booking->status === 'lunas') {
            return redirect()->route('booking.success', $booking->kode_booking);
        }

        // Calculate time left (15 minutes limit)
        $expiryTime = $booking->created_at->addMinutes(15);
        $timeLeft = now()->diffInSeconds($expiryTime, false);
        
        if ($timeLeft <= 0 && $booking->status === 'pending') {
            $booking->update(['status' => 'batal']);
            return redirect()->route('venue.show', $booking->court->venue->slug)->with('error', 'Waktu pembayaran telah habis.');
        }

        return view('booking.checkout', compact('booking', 'timeLeft'));
    }

    public function payment($kode_booking)
    {
        $booking = Booking::with(['court.venue'])
            ->where('kode_booking', $kode_booking)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($booking->status !== 'pending') {
            return redirect()->route('booking.success', $booking->kode_booking);
        }

        return view('booking.payment', compact('booking'));
    }

    public function submitPayment(Request $request, $kode_booking)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $booking = Booking::where('kode_booking', $kode_booking)
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        $path = $request->file('bukti_pembayaran')->store('payment-proofs', 'public');

        $booking->update([
            'bukti_pembayaran' => '/storage/' . $path,
            'status' => 'menunggu_verifikasi'
        ]);

        return redirect()->route('booking.success', $booking->kode_booking);
    }

    public function success($kode_booking)
    {
        $booking = Booking::with('court.venue.vendor.wallet')
            ->where('kode_booking', $kode_booking)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('booking.success', compact('booking'));
    }
}
