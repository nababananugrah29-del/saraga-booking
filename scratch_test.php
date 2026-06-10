<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = new \Illuminate\Http\Request([
    'q' => 'Lapangan winardo',
    'sport' => '',
    'regency_id' => ''
]);

$query = \App\Models\Venue::with(['courts', 'regency'])
            ->where('is_active', true)
            ->where('is_verified', true);

// Filter by Venue Name or Court Name
if ($request->filled('q')) {
    $searchTerm = trim($request->q);
    $query->where(function ($q) use ($searchTerm) {
        $q->where('nama_venue', 'like', '%' . $searchTerm . '%')
          ->orWhereHas('courts', function ($courtQuery) use ($searchTerm) {
              $courtQuery->where('nama_lapangan', 'like', '%' . $searchTerm . '%');
          });
    });
}

// Filter by Regency (City)
if ($request->filled('regency_id')) {
    $query->where('regency_id', $request->regency_id);
}

// Filter by Sport Category
if ($request->filled('sport')) {
    $query->whereHas('courts', function ($q) use ($request) {
        $q->where('tipe_olahraga', $request->sport);
    });
}

$venues = $query->latest()->paginate(12);

echo "Is Empty? " . ($venues->isEmpty() ? 'Yes' : 'No') . "\n";
foreach($venues as $venue) {
    echo "Venue: " . $venue->nama_venue . "\n";
    $matchedCourts = $venue->courts->filter(function($c) use ($request) {
        return stripos($c->nama_lapangan, trim($request->q)) !== false;
    });
    echo "Matched Courts count: " . $matchedCourts->count() . "\n";
}
