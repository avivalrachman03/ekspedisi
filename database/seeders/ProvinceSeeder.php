<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Province::create([
            'name' => 'JABODETABEK'
        ]);
        Province::create([
            'name' => 'BALI'
        ]);
        Province::create([
            'name' => 'LOMBOK'
        ]);
        Province::create([
            'name' => 'JAWA TIMUR'
        ]);
        Province::create([
            'name' => 'JAWA TENGAH'
        ]);
    }
}
