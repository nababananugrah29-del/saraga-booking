<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('court_id')->constrained('courts')->onDelete('cascade');
            $table->string('kode_booking')->unique();
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->integer('durasi'); // in hours
            $table->decimal('total_harga', 12, 2);
            $table->string('status')->default('pending'); // pending, lunas, sedang_main, selesai
            $table->string('payment_method')->nullable();
            $table->boolean('is_offline')->default(false); // for manual walk-in bookings
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
