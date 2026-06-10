<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VenueController;
use App\Http\Controllers\PartnershipController;

Route::get('/', [VenueController::class, 'index'])->name('home');

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/kemitraan', [PartnershipController::class, 'index'])->name('kemitraan');
Route::post('/kemitraan', [PartnershipController::class, 'store'])->name('kemitraan.store');

Route::get('/cari-lapangan', [VenueController::class, 'search'])->name('venues.search');

Route::get('/turnamen', function () {
    return view('tournaments.index');
});

Route::get('/pusat-bantuan', function () {
    return view('pusat-bantuan');
})->name('pusat-bantuan');

Route::get('/venue/{slug}', [VenueController::class, 'show'])->name('venue.show');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;

// Auth Routes
Route::middleware(['auth'])->group(function () {
    
    // User Routes
    Route::middleware(['role:user'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/pesanan', [DashboardController::class, 'pesanan'])->name('dashboard.pesanan');
        Route::get('/dashboard/favorit', [DashboardController::class, 'favorit'])->name('dashboard.favorit');
        Route::get('/dashboard/pengaturan', [DashboardController::class, 'pengaturan'])->name('dashboard.pengaturan');
        Route::post('/dashboard/pengaturan', [DashboardController::class, 'updateProfil'])->name('dashboard.pengaturan.update');
        
        Route::post('/booking/reserve', [BookingController::class, 'reserve'])->name('booking.reserve');
        Route::get('/checkout/{kode_booking}', [BookingController::class, 'checkout'])->name('checkout');
        Route::get('/checkout/payment/{kode_booking}', [BookingController::class, 'payment'])->name('booking.payment');
        Route::post('/checkout/payment/{kode_booking}', [BookingController::class, 'submitPayment'])->name('booking.payment.store');
        Route::get('/booking/success/{kode_booking}', [BookingController::class, 'success'])->name('booking.success');
    });

    // Partnership & Billing Routes (Needs Auth but not Vendor role yet)
    Route::get('/mitra/pembayaran', [PartnershipController::class, 'showPayment'])->name('mitra.pembayaran');
    Route::post('/mitra/pembayaran/konfirmasi', [PartnershipController::class, 'showConfirmation'])->name('mitra.pembayaran.konfirmasi');
    Route::post('/mitra/pembayaran', [PartnershipController::class, 'processPayment'])->name('mitra.pembayaran.store');

    // Vendor Routes
    Route::middleware(['role:vendor', 'subscription'])->group(function () {
        Route::get('/vendor/overview', [VendorController::class, 'overview'])->name('vendor.overview');
        Route::get('/vendor/analytics', [VendorController::class, 'analytics'])->name('vendor.analytics');
        Route::get('/vendor/schedule', [VendorController::class, 'schedule'])->name('vendor.schedule');
        
        Route::get('/mitra/pesanan', [VendorController::class, 'index'])->name('mitra.pesanan');
        Route::get('/mitra/inventaris', [VendorController::class, 'inventaris'])->name('mitra.inventaris');
        Route::post('/mitra/inventaris', [VendorController::class, 'storeCourt'])->name('mitra.inventaris.store');
        Route::put('/mitra/inventaris/{id}', [VendorController::class, 'updateCourt'])->name('mitra.inventaris.update');
        Route::delete('/mitra/inventaris/{id}', [VendorController::class, 'deleteCourt'])->name('mitra.inventaris.delete');
        Route::get('/mitra/keuangan', [VendorController::class, 'keuangan'])->name('mitra.keuangan');
        Route::post('/mitra/keuangan/withdraw', [VendorController::class, 'withdraw'])->name('mitra.withdraw');
        Route::get('/mitra/staf', [VendorController::class, 'staf'])->name('mitra.staf');
        Route::get('/mitra/laporan', [VendorController::class, 'laporan'])->name('mitra.laporan');
        
        Route::post('/mitra/pesanan/manual', [VendorController::class, 'storeManual'])->name('mitra.pesanan.manual');
        Route::post('/mitra/pesanan/checkin', [VendorController::class, 'checkIn'])->name('mitra.pesanan.checkin');
        Route::post('/mitra/pesanan/verifikasi', [VendorController::class, 'verifyPayment'])->name('mitra.pesanan.verifikasi');
    });

    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/venues', [AdminController::class, 'venues'])->name('admin.venues');
        Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
        
        Route::get('/admin/laporan/export', [AdminController::class, 'exportCsv'])->name('admin.export');
        
        Route::post('/admin/approve-vendor/{id}', [AdminController::class, 'approveVendor'])->name('admin.approve_vendor');
        Route::post('/admin/approve-payout/{id}', [AdminController::class, 'approvePayout'])->name('admin.approve_payout');
        Route::post('/admin/verify-venue/{id}', [AdminController::class, 'verifyVenue'])->name('admin.verify_venue');
        Route::post('/admin/users/{id}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('admin.toggle_user');
        Route::post('/admin/venues/{id}/toggle-status', [AdminController::class, 'toggleVenueStatus'])->name('admin.toggle_venue');
    });
});
