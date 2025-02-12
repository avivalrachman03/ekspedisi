<?php

namespace Database\Seeders;

use App\Models\Regency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // provinsi 1
        Regency::create([
            'province_id' => 1,
            'name' => 'JAKARTA BARAT',
            'code' => 'JKB',
            'harga' => 10000
        ]);
        Regency::create([
            'province_id' => 1,
            'name' => 'JAKARTA UTARA',
            'code' => 'JKU',
            'harga' => 10000
        ]);
        Regency::create([
            'province_id' => 1,
            'name' => 'JAKARTA TIMUR',
            'code' => 'JKT',
            'harga' => 10000
        ]);
        Regency::create([
            'province_id' => 1,
            'name' => 'JAKARTA SELATAN',
            'code' => 'JKS',
            'harga' => 10000
        ]);
        Regency::create([
            'province_id' => 1,
            'name' => 'BOGOR',
            'code' => 'BGR',
            'harga' => 10000
        ]);
        Regency::create([
            'province_id' => 1,
            'name' => 'DEPOK',
            'code' => 'DPK',
            'harga' => 10000
        ]);
        Regency::create([
            'province_id' => 1,
            'name' => 'TANGGERANG',
            'code' => 'TGR',
            'harga' => 10000
        ]);
        // Provinsi 2
        Regency::create([
            'province_id' => 2,
            'name' => 'DENPASAR',
            'code' => 'DPS',
            'harga' => 10000
        ]);
        Regency::create([
            'province_id' => 2,
            'name' => 'BADUNG',
            'code' => 'BDG',
            'harga' => 10000
        ]);
        Regency::create([
            'province_id' => 2,
            'name' => 'GIANYAR',
            'code' => 'GNY',
            'harga' => 10000
        ]);
        // Provinsi 3
        Regency::create([
            'province_id' => 3,
            'name' => 'LOMBOK BARAT',
            'code' => 'LBB',
            'harga' => 10000
        ]);
        Regency::create([
            'province_id' => 3,
            'name' => 'LOMBOK TENGAH',
            'code' => 'LBG',
            'harga' => 10000
        ]);
        Regency::create([
            'province_id' => 3,
            'name' => 'LOMBOK TIMUR',
            'code' => 'LBT',
            'harga' => 10000
        ]);
    }
}
