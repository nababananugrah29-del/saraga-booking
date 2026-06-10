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
        Schema::table('payouts', function (Blueprint $table) {
            $table->string('nama_penerima')->nullable()->after('bank_account');
            $table->string('no_hp')->nullable()->after('nama_penerima');
            $table->string('metode_penarikan')->nullable()->after('no_hp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payouts', function (Blueprint $table) {
            $table->dropColumn(['nama_penerima', 'no_hp', 'metode_penarikan']);
        });
    }
};
