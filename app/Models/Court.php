<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;
    protected $fillable = [
        'venue_id',
        'nama_lapangan',
        'foto',
        'tipe_olahraga',
        'kategori_lokasi',
        'tipe_lantai',
        'harga_per_jam',
        'is_active',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
