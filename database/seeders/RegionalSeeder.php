<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            ['id' => '11', 'name' => 'ACEH'], ['id' => '12', 'name' => 'SUMATERA UTARA'], ['id' => '13', 'name' => 'SUMATERA BARAT'],
            ['id' => '14', 'name' => 'RIAU'], ['id' => '15', 'name' => 'JAMBI'], ['id' => '16', 'name' => 'SUMATERA SELATAN'],
            ['id' => '17', 'name' => 'BENGKULU'], ['id' => '18', 'name' => 'LAMPUNG'], ['id' => '19', 'name' => 'KEP. BANGKA BELITUNG'],
            ['id' => '21', 'name' => 'KEPULAUAN RIAU'], ['id' => '31', 'name' => 'DKI JAKARTA'], ['id' => '32', 'name' => 'JAWA BARAT'],
            ['id' => '33', 'name' => 'JAWA TENGAH'], ['id' => '34', 'name' => 'DI YOGYAKARTA'], ['id' => '35', 'name' => 'JAWA TIMUR'],
            ['id' => '36', 'name' => 'BANTEN'], ['id' => '51', 'name' => 'BALI'], ['id' => '52', 'name' => 'NUSA TENGGARA BARAT'],
            ['id' => '53', 'name' => 'NUSA TENGGARA TIMUR'], ['id' => '61', 'name' => 'KALIMANTAN BARAT'], ['id' => '62', 'name' => 'KALIMANTAN TENGAH'],
            ['id' => '63', 'name' => 'KALIMANTAN SELATAN'], ['id' => '64', 'name' => 'KALIMANTAN TIMUR'], ['id' => '65', 'name' => 'KALIMANTAN UTARA'],
            ['id' => '71', 'name' => 'SULAWESI UTARA'], ['id' => '72', 'name' => 'SULAWESI TENGAH'], ['id' => '73', 'name' => 'SULAWESI SELATAN'],
            ['id' => '74', 'name' => 'SULAWESI TENGGARA'], ['id' => '75', 'name' => 'GORONTALO'], ['id' => '76', 'name' => 'SULAWESI BARAT'],
            ['id' => '81', 'name' => 'MALUKU'], ['id' => '82', 'name' => 'MALUKU UTARA'], ['id' => '91', 'name' => 'PAPUA'],
            ['id' => '92', 'name' => 'PAPUA BARAT'], ['id' => '93', 'name' => 'PAPUA SELATAN'], ['id' => '94', 'name' => 'PAPUA TENGAH'],
            ['id' => '95', 'name' => 'PAPUA PEGUNUNGAN'], ['id' => '96', 'name' => 'PAPUA BARAT DAYA'],
        ];

        \App\Models\Province::insert($provinces);

        $regencies = [
            ['id' => '1171', 'province_id' => '11', 'name' => 'KOTA BANDA ACEH'],
            ['id' => '1271', 'province_id' => '12', 'name' => 'KOTA MEDAN'],
            ['id' => '1371', 'province_id' => '13', 'name' => 'KOTA PADANG'],
            ['id' => '3171', 'province_id' => '31', 'name' => 'KOTA JAKARTA PUSAT'],
            ['id' => '3174', 'province_id' => '31', 'name' => 'KOTA JAKARTA SELATAN'],
            ['id' => '3273', 'province_id' => '32', 'name' => 'KOTA BANDUNG'],
            ['id' => '3374', 'province_id' => '33', 'name' => 'KOTA SEMARANG'],
            ['id' => '3578', 'province_id' => '35', 'name' => 'KOTA SURABAYA'],
            ['id' => '5171', 'province_id' => '51', 'name' => 'KOTA DENPASAR'],
            ['id' => '6471', 'province_id' => '64', 'name' => 'KOTA BALIKPAPAN'],
            ['id' => '7371', 'province_id' => '73', 'name' => 'KOTA MAKASSAR'],
            ['id' => '9171', 'province_id' => '91', 'name' => 'KOTA JAYAPURA'],
            // ... (Dapat ditambahkan lebih banyak di loop VenueSeeder untuk skala nasional demi efisiensi)
        ];

        \App\Models\Regency::insert($regencies);

        // Tambahkan minimal 1 distrik per kota untuk integritas data
        foreach($regencies as $reg) {
            \App\Models\District::insert([
                ['id' => $reg['id'] . '010', 'regency_id' => $reg['id'], 'name' => 'Kecamatan Pusat ' . $reg['name']],
            ]);
        }
    }
}
