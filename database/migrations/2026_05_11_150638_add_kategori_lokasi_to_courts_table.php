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
        Schema::table('courts', function (Blueprint $table) {
            $table->string('kategori_lokasi')->nullable()->after('tipe_olahraga'); // Indoor/Outdoor
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courts', function (Blueprint $table) {
            $table->dropColumn('kategori_lokasi');
        });
    }
};
