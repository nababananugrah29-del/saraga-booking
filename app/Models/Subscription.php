<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'vendor_id',
        'paket',
        'metode_pembayaran',
        'status_pembayaran',
        'price',
        'bukti_bayar',
        'expiry_date',
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
