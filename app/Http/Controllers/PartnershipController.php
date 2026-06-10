<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Subscription;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PartnershipController extends Controller
{
    /**
     * Show the partnership status or registration form.
     */
    public function index()
    {
        $user = Auth::user();
        
        $regencies = \App\Models\Regency::all();
        
        // If not logged in, show the default landing
        if (!$user) {
            return view('kemitraan', ['status' => 'guest', 'regencies' => $regencies]);
        }

        // Check for existing venue registration
        $venue = Venue::where('vendor_id', $user->id)->first();
        
        if (!$venue) {
            return view('kemitraan', ['status' => 'unregistered', 'regencies' => $regencies]);
        }

        if (!$venue->is_verified) {
            return view('kemitraan', ['status' => 'pending_audit', 'venue' => $venue]);
        }

        // Check for subscription status
        $subscription = Subscription::where('vendor_id', $user->id)->latest()->first();

        if (!$subscription || $subscription->status_pembayaran === 'rejected') {
            return view('kemitraan', ['status' => 'approved_waiting_payment', 'venue' => $venue]);
        }

        if ($subscription->status_pembayaran === 'pending') {
            return view('kemitraan', ['status' => 'payment_pending', 'venue' => $venue]);
        }

        // If verified, they should go to the vendor dashboard
        return redirect()->route('mitra.pesanan');
    }

    /**
     * Store a new partnership request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'nama_gedung' => 'required|string|max:255',
            'regency_id' => 'required|exists:regencies,id',
            'alamat' => 'required|string',
            'whatsapp' => 'required|string',
        ]);

        $user = Auth::user();

        // Create the Venue record as the "Application"
        Venue::create([
            'vendor_id' => $user->id,
            'owner_name' => $request->nama_pemilik,
            'whatsapp' => $request->whatsapp,
            'nama_venue' => $request->nama_gedung,
            'slug' => Str::slug($request->nama_gedung) . '-' . Str::random(5),
            'regency_id' => $request->regency_id,
            'alamat' => $request->alamat,
            'is_verified' => false,
            'is_active' => true,
        ]);

        return back()->with('success', 'Pendaftaran Anda telah diterima dan sedang dalam proses audit.');
    }

    /**
     * Show payment selection page.
     */
    public function showPayment()
    {
        $user = Auth::user();
        $venue = Venue::where('vendor_id', $user->id)->where('is_verified', true)->firstOrFail();
        
        return view('mitra.pembayaran', compact('venue'));
    }

    /**
     * Show payment confirmation page with dummy payment info based on method.
     */
    public function showConfirmation(Request $request)
    {
        $request->validate([
            'paket' => 'required|in:bulanan,tahunan',
            'metode' => 'required|in:qris,bank,credit',
        ]);

        $user = Auth::user();
        $venue = Venue::where('vendor_id', $user->id)->where('is_verified', true)->firstOrFail();

        $prices = [
            'bulanan' => 150000,
            'tahunan' => 1500000
        ];

        $paket = $request->paket;
        $metode = $request->metode;
        $harga = $prices[$paket];

        return view('mitra.konfirmasi-pembayaran', compact('venue', 'paket', 'metode', 'harga'));
    }

    /**
     * Handle the subscription payment with bukti bayar upload.
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'paket' => 'required|in:bulanan,tahunan',
            'metode' => 'required|in:qris,bank,credit',
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $prices = [
            'bulanan' => 150000,
            'tahunan' => 1500000
        ];

        // Upload bukti bayar
        $buktiPath = $request->file('bukti_bayar')->store('bukti-bayar', 'public');

        Subscription::create([
            'vendor_id' => Auth::id(),
            'paket' => $request->paket,
            'metode_pembayaran' => $request->metode,
            'status_pembayaran' => 'pending',
            'price' => $prices[$request->paket],
            'bukti_bayar' => $buktiPath,
            'expiry_date' => $request->paket === 'bulanan' ? now()->addMonth() : now()->addYear(),
        ]);

        return redirect()->route('kemitraan')->with('success', 'Bukti pembayaran telah dikirim. Menunggu verifikasi admin.');
    }
}
