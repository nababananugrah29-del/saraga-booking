<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Venue;
use App\Models\Court;
use App\Models\Province;
use App\Models\Regency;

class VenueController extends Controller
{
    /**
     * Display a listing of the venues (Landing Page / Main List).
     */
    public function index()
    {
        // Optimized with Eager Loading to prevent N+1 queries
        $courts = Court::with(['venue.regency'])
            ->where('is_active', true)
            ->whereHas('venue', function($q) {
                $q->where('is_active', true)->where('is_verified', true);
            })
            ->latest()
            ->paginate(9);

        $provinces = Province::all();
        $regencies = Regency::all();
        
        // Comprehensive list of sports to make the filter look rich
        $popularSports = [
            'Badminton', 'Futsal', 'Basketball', 'Tennis', 
            'Mini Soccer', 'Volley', 'Swimming', 'Table Tennis', 
            'Gym', 'Billiards', 'Yoga', 'Zumba'
        ];
        
        $dbSports = \App\Models\Court::distinct()->pluck('tipe_olahraga')->toArray();
        $sports = array_unique(array_merge($popularSports, $dbSports));
        sort($sports);

        return view('index', compact('courts', 'provinces', 'regencies', 'sports'));
    }

    /**
     * Handle smart filtering and search.
     */
    public function search(Request $request)
    {
        $regencies = Regency::all();
        $sports = [
            'Futsal', 'Badminton', 'Basketball', 'Tennis', 'Volleyball',
            'Mini Soccer', 'Billiard', 'Table Tennis', 'Gym', 'Swimming'
        ];

        // Mulai dari Court yang aktif
        $query = Court::with(['venue.regency'])
            ->where('is_active', true)
            ->whereHas('venue', function($q) {
                // Pastikan venue induknya juga aktif dan terverifikasi
                $q->where('is_active', true)->where('is_verified', true);
            });

        // Filter by Venue Name or Court Name
        if ($request->filled('q')) {
            $searchTerm = trim($request->q);
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_lapangan', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('venue', function ($venueQuery) use ($searchTerm) {
                      $venueQuery->where('nama_venue', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Filter by Regency (City) via Venue
        if ($request->filled('regency_id')) {
            $query->whereHas('venue', function ($venueQuery) use ($request) {
                $venueQuery->where('regency_id', $request->regency_id);
            });
        }

        // Filter by Sport Category on Court
        if ($request->filled('sport')) {
            $query->where('tipe_olahraga', $request->sport);
        }

        // Pagination untuk Court
        $courts = $query->latest()->paginate(12);

        // Fallback Rekomendasi (jika tidak ada hasil)
        $recommendations = null;
        if ($courts->isEmpty()) {
            $recommendations = Court::with(['venue.regency'])
                ->where('is_active', true)
                ->whereHas('venue', function($q) {
                    $q->where('is_active', true)->where('is_verified', true);
                })
                ->inRandomOrder()
                ->take(6)
                ->get();
        }

        return view('venues.index', compact('courts', 'recommendations', 'regencies', 'sports'));
    }

    /**
     * Display the specified venue detail by slug (SEO Friendly).
     */
    public function show(Request $request, $slug)
    {
        $venue = Venue::with(['courts', 'regency.province', 'district'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Fix #5: Guard against venue with no courts
        if ($venue->courts->isEmpty()) {
            return redirect()->route('home')->with('error', 'Venue ini belum memiliki lapangan yang terdaftar.');
        }

        // Selected court (default to first court) — safe because we checked above
        $selectedCourtId = $request->input('court_id', $venue->courts->first()->id);
        $court = $venue->courts->where('id', $selectedCourtId)->first();

        // If invalid court_id was passed, fallback to first court
        if (!$court) {
            $court = $venue->courts->first();
            $selectedCourtId = $court->id;
        }

        // Generate next 7 days for the date selector
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $date = now()->addDays($i);
            $dates[] = [
                'full' => $date->toDateString(),
                'day' => $date->translatedFormat('D'),
                'date' => $date->format('d'),
                'month' => $date->translatedFormat('M'),
                'is_weekend' => $date->isWeekend(),
            ];
        }

        // Available time slots (08:00 to 23:00)
        $timeSlots = [];
        for ($hour = 8; $hour <= 23; $hour++) {
            $timeSlots[] = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
        }

        // Fetch existing bookings for the selected court in the next 7 days
        $existingBookings = \App\Models\Booking::where('court_id', $selectedCourtId)
            ->whereBetween('tanggal', [now()->toDateString(), now()->addDays(7)->toDateString()])
            ->whereIn('status', ['pending', 'lunas'])
            ->get()
            ->groupBy('tanggal');

        return view('lapangan.detail', compact('venue', 'court', 'dates', 'timeSlots', 'existingBookings'));
    }
}
