<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'court_id',
        'kode_booking',
        'tanggal',
        'jam_mulai',
        'durasi',
        'total_harga',
        'status',
        'is_checked_in',
        'payment_method',
        'bukti_pembayaran',
        'catatan_penolakan',
        'is_offline',
    ];
    protected $casts = [
        'tanggal' => 'date',
        'is_checked_in' => 'boolean',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }
}
