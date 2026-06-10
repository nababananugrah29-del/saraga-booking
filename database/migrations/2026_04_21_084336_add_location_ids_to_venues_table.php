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
        Schema::table('venues', function (Blueprint $table) {
            $table->char('province_id', 2)->nullable()->after('alamat');
            $table->char('regency_id', 4)->nullable()->after('province_id');
            $table->char('district_id', 7)->nullable()->after('regency_id');
            $table->enum('timezone', ['WIB', 'WITA', 'WIT'])->default('WIB')->after('district_id');

            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('set null');
            $table->foreign('regency_id')->references('id')->on('regencies')->onDelete('set null');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('venues', function (Blueprint $table) {
            //
        });
    }
};
