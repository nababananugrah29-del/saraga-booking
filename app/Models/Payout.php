<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = [
        'vendor_id',
        'amount',
        'bank_account',
        'nama_penerima',
        'no_hp',
        'metode_penarikan',
        'status',
        'admin_note',
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
