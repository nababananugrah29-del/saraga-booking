<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Booking;
use App\Models\Court;
use App\Models\User;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    public function index()
    {
        // SCOPE: Strictly filter bookings for venues owned by the currently logged-in vendor
        $orders = Booking::whereHas('court.venue', function($q) {
            $q->where('vendor_id', auth()->id());
        })
        ->with('user', 'court.venue')
        ->latest()
        ->get();

        return view('mitra.pesanan', compact('orders'));
    }

    /**
     * Fix #8: Validasi input ditambahkan.
     * Fix #9: Verifikasi kepemilikan court ditambahkan.
     * Fix #6: Reward poin dihapus untuk booking offline (vendor bukan customer).
     */
    public function storeManual(Request $request)
    {
        // Fix #8: Tambah validasi input
        $request->validate([
            'court_id' => 'required|exists:courts,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'durasi' => 'required|integer|min:1|max:8',
            'total_harga' => 'required|numeric|min:0',
        ]);

        // Fix #9: Verifikasi bahwa court milik venue yang dimiliki vendor ini
        $court = Court::whereHas('venue', function ($q) {
            $q->where('vendor_id', auth()->id());
        })->where('id', $request->court_id)->first();

        if (!$court) {
            return back()->with('error', 'Lapangan tidak ditemukan atau bukan milik Anda.');
        }

        // Anti-Double Booking Check (Basic overlap check)
        $exists = Booking::where('court_id', $request->court_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam_mulai', $request->jam_mulai)
            ->whereIn('status', ['lunas', 'sedang_main'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Jadwal tersebut sudah terisi!');
        }

        $booking = Booking::create([
            'user_id' => auth()->id(), // Admin/Vendor acts as proxy
            'court_id' => $request->court_id,
            'kode_booking' => 'SRG-' . strtoupper(Str::random(8)),
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'durasi' => $request->durasi,
            'total_harga' => $request->total_harga,
            'status' => 'lunas',
            'is_offline' => true
        ]);

        // Fix #6: Poin reward tidak diberikan untuk booking walk-in/offline
        // Reward poin hanya untuk pelanggan online yang bayar melalui platform

        return back()->with('success', 'Booking manual berhasil dicatat!');
    }

    /**
     * Secure Check-in: Validates unique booking code and ensures one-time use.
     */
    public function checkIn(Request $request)
    {
        $request->validate([
            'kode_booking' => 'required|string',
            'booking_id' => 'required|exists:bookings,id'
        ]);

        $booking = Booking::where('id', $request->booking_id)
            ->whereHas('court.venue', function($q) {
                $q->where('vendor_id', auth()->id());
            })
            ->firstOrFail();

        // 1. Case-Sensitive Match Check
        if ($booking->kode_booking !== $request->kode_booking) {
            return response()->json([
                'success' => false,
                'message' => 'Kode Booking tidak valid (Case-Sensitive)!'
            ], 422);
        }

        // 2. Status & Double Check-in Check
        if ($booking->status !== 'lunas') {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan belum dibayar!'
            ], 422);
        }

        if ($booking->is_checked_in) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket ini sudah pernah digunakan!'
            ], 422);
        }

        // 3. Mark as Checked In
        $booking->update([
            'is_checked_in' => true,
            'status' => 'sedang_main'
        ]);

        return response()->json([
            'success' => true, 
            'message' => "Check-in berhasil! Selamat bertanding."
        ]);
    }

    public function verifyPayment(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'action' => 'required|in:approve,reject',
            'alasan_penolakan' => 'nullable|string'
        ]);

        $booking = Booking::with('court.venue.vendor.wallet')->find($request->booking_id);

        // Security check: Make sure this booking belongs to the current vendor
        if ($booking->court->venue->vendor_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        if ($booking->status !== 'menunggu_verifikasi') {
            return response()->json(['success' => false, 'message' => 'Status pesanan tidak valid'], 422);
        }

        DB::transaction(function () use ($booking, $request) {
            $booking = Booking::lockForUpdate()->find($booking->id);

            if ($request->action === 'approve') {
                $adminFee = $booking->total_harga * 0.10;
                $vendorShare = $booking->total_harga - $adminFee;

                $booking->update([
                    'status' => 'lunas',
                    'platform_fee' => $adminFee,
                    'vendor_share' => $vendorShare
                ]);

                $vendor = $booking->court->venue->vendor;
                if ($vendor) {
                    $wallet = $vendor->wallet()->firstOrCreate([], ['balance' => 0]);
                    $wallet->increment('balance', $vendorShare);
                }

                // Reward Points: 1 poin untuk setiap kelipatan Rp 10.000
                $earnedPoints = floor($booking->total_harga / 10000);
                if ($earnedPoints > 0) {
                    $booking->user()->increment('points_balance', $earnedPoints);
                }
            } else {
                $booking->update([
                    'status' => 'batal',
                    'catatan_penolakan' => $request->alasan_penolakan ?? 'Ditolak oleh Mitra'
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => $request->action === 'approve' ? 'Pembayaran berhasil dikonfirmasi.' : 'Pesanan telah dibatalkan.'
        ]);
    }

    public function inventaris()
    {
        $vendor_id = auth()->id();
        $courts = Court::whereHas('venue', function($q) use ($vendor_id) {
            $q->where('vendor_id', $vendor_id);
        })->get();

        return view('mitra.inventaris', compact('courts'));
    }

    public function storeCourt(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'nama_lapangan' => 'required|string|max:255',
            'tipe_olahraga' => 'required|string|max:100',
            'kategori_lokasi' => 'required|in:Indoor,Outdoor',
            'tipe_lantai' => 'required|string|max:100',
            'harga_per_jam' => 'required|numeric|min:0',
            'status' => 'required|in:1,0',
        ]);

        $venue = auth()->user()->venues->first();
        if (!$venue) {
            return back()->with('error', 'Venue tidak ditemukan. Pastikan profil kemitraan diisi.');
        }

        $file = $request->file('foto');
        $vendor_id = auth()->id();
        $filename = time() . '_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = "venues/{$vendor_id}";
        
        $file->storeAs($path, $filename, 'public');
        $savedPath = $path . '/' . $filename;

        Court::create([
            'venue_id' => $venue->id,
            'nama_lapangan' => $request->nama_lapangan,
            'foto' => $savedPath,
            'tipe_olahraga' => $request->tipe_olahraga,
            'kategori_lokasi' => $request->kategori_lokasi,
            'tipe_lantai' => $request->tipe_lantai,
            'harga_per_jam' => $request->harga_per_jam,
            'is_active' => $request->status == '1' ? true : false,
        ]);

        return back()->with('success', 'Lapangan baru berhasil ditambahkan ke inventaris!');
    }

    public function updateCourt(Request $request, $id)
    {
        $court = Court::whereHas('venue', function($q) {
            $q->where('vendor_id', auth()->id());
        })->findOrFail($id);

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'nama_lapangan' => 'required|string|max:255',
            'tipe_olahraga' => 'required|string|max:100',
            'kategori_lokasi' => 'required|in:Indoor,Outdoor',
            'tipe_lantai' => 'required|string|max:100',
            'harga_per_jam' => 'required|numeric|min:0',
            'status' => 'required|in:1,0',
        ]);

        $data = [
            'nama_lapangan' => $request->nama_lapangan,
            'tipe_olahraga' => $request->tipe_olahraga,
            'kategori_lokasi' => $request->kategori_lokasi,
            'tipe_lantai' => $request->tipe_lantai,
            'harga_per_jam' => $request->harga_per_jam,
            'is_active' => $request->status == '1' ? true : false,
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $vendor_id = auth()->id();
            $filename = time() . '_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = "venues/{$vendor_id}";
            
            $file->storeAs($path, $filename, 'public');
            $data['foto'] = $path . '/' . $filename;
        }

        $court->update($data);

        return back()->with('success', 'Lapangan berhasil diperbarui!');
    }

    public function deleteCourt($id)
    {
        $court = Court::whereHas('venue', function($q) {
            $q->where('vendor_id', auth()->id());
        })->findOrFail($id);

        $court->delete();

        return back()->with('success', 'Lapangan berhasil dihapus!');
    }

    public function keuangan()
    {
        $wallet = auth()->user()->wallet()->firstOrCreate([], ['balance' => 0]);
        $payouts = auth()->user()->payouts()->latest()->get();

        return view('mitra.keuangan', compact('wallet', 'payouts'));
    }

    /**
     * Fix #15: Tambah lockForUpdate untuk mencegah race condition pada penarikan dana.
     */
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100000',
            'metode_penarikan' => 'required|in:DANA,BANK',
            'bank_account' => 'required|string',
            'nama_penerima' => 'required|string',
            'no_hp' => 'required|string',
        ]);

        // 1. Withdrawal Limit: Max 1x per 7 days
        $lastPayout = auth()->user()->payouts()->latest()->first();
        if ($lastPayout && $lastPayout->created_at->gt(now()->subDays(7))) {
            $nextAvailable = $lastPayout->created_at->addDays(7)->diffForHumans();
            return back()->with('error', "Batas penarikan dana adalah 1x seminggu. Anda dapat menarik dana kembali pada $nextAvailable.");
        }

        return DB::transaction(function () use ($request) {
            // Fix #15: Lock wallet row sebelum cek saldo agar tidak ada race condition
            $wallet = auth()->user()->wallet()->lockForUpdate()->first();

            if (!$wallet || $wallet->balance < $request->amount) {
                return back()->with('error', 'Saldo tidak mencukupi untuk penarikan ini.');
            }

            // 2. LOCKING: Instant deduction (Frozen Balance)
            $wallet->decrement('balance', $request->amount);

            // 3. Create Payout Request
            auth()->user()->payouts()->create([
                'amount' => $request->amount,
                'metode_penarikan' => $request->metode_penarikan,
                'bank_account' => $request->bank_account,
                'nama_penerima' => $request->nama_penerima,
                'no_hp' => $request->no_hp,
                'status' => 'pending'
            ]);

            return back()->with('success', 'Permintaan penarikan dana Rp ' . number_format($request->amount, 0, ',', '.') . ' telah dikirim dan saldo Anda telah dikunci (Frozen) hingga disetujui Admin.');
        });
    }

    public function staf()
    {
        return view('mitra.staf');
    }

    public function laporan()
    {
        return view('mitra.laporan');
    }

    public function overview()
    {
        $vendor_id = auth()->id();
        
        $orders = Booking::whereHas('court.venue', function($q) use ($vendor_id) {
            $q->where('vendor_id', $vendor_id);
        })->latest()->take(5)->get();

        $totalPesanan = Booking::whereHas('court.venue', function($q) use ($vendor_id) {
            $q->where('vendor_id', $vendor_id);
        })->count();

        $pendapatanBulanIni = Booking::whereHas('court.venue', function($q) use ($vendor_id) {
            $q->where('vendor_id', $vendor_id);
        })->whereMonth('tanggal', now()->month)
          ->where('status', 'lunas')
          ->sum('total_harga');

        // Dummy occupancy calculation (can be adjusted later)
        $persentaseOkupansi = 45; 

        return view('vendor.overview', compact('orders', 'totalPesanan', 'pendapatanBulanIni', 'persentaseOkupansi'));
    }

    public function analytics()
    {
        $vendor_id = auth()->id();
        
        $courts = Court::whereHas('venue', function($q) use ($vendor_id) {
            $q->where('vendor_id', $vendor_id);
        })->withCount('bookings')->get();

        return view('vendor.analytics', compact('courts'));
    }

    public function schedule()
    {
        $vendor_id = auth()->id();
        
        $bookings = Booking::whereHas('court.venue', function($q) use ($vendor_id) {
            $q->where('vendor_id', $vendor_id);
        })->whereDate('tanggal', now()->toDateString())->get();
        
        $courts = Court::whereHas('venue', function($q) use ($vendor_id) {
            $q->where('vendor_id', $vendor_id);
        })->get();

        return view('vendor.schedule', compact('bookings', 'courts'));
    }
}
