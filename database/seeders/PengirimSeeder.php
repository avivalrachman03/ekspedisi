<?php

namespace Database\Seeders;

use App\Models\Pengirim;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengirimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengirim::create([
            'name' => 'Nida',
            'phone' => '08123456789',
            'address' => 'Jl. Raya Kediri'
        ]);
        Pengirim::create([
            'name' => 'Nia',
            'phone' => '081234567890',
            'address' => 'Jl. Raya Kediri'
        ]);
        Pengirim::create([
            'name' => 'Sandi',
            'phone' => '081234567891',
            'address' => 'Jl. Raya Kediri'
        ]);
    }
}
