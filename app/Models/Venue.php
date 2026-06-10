<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id',
        'owner_name',
        'whatsapp',
        'nama_venue',
        'slug',
        'alamat',
        'province_id',
        'regency_id',
        'district_id',
        'timezone',
        'description',
        'foto_venue',
        'is_active',
        'is_verified',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_verified' => 'boolean',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function courts()
    {
        return $this->hasMany(Court::class);
    }
}
