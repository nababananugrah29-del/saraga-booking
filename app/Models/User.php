<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'points_balance',
        'is_active',
    ];

    const SARAGA_FEE = 0.10; // 10% platform fee

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'points_balance' => 'integer',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'superadmin' || $this->role === 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }

    public function isVendor()
    {
        return $this->role === 'vendor';
    }

    public function venues()
    {
        return $this->hasMany(Venue::class, 'vendor_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'vendor_id');
    }

    /**
     * Ambil subscription aktif terbaru.
     */
    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class, 'vendor_id')
            ->where('status_pembayaran', 'verified')
            ->where('expiry_date', '>', now())
            ->latest();
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'vendor_id');
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class, 'vendor_id');
    }
}
