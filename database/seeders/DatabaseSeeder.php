<?php

namespace Database\Seeders;

use create;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
// use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'ardi@admin.com',
            'password' => 'adminku'
        ]);
        $role = Role::create(['name' => 'Admin']);
        $user->assignRole($role);
        $this->call([
            ProvinceSeeder::class,
            RegencySeeder::class,
            VendorSeeder::class,
            // PengirimSeeder::class,
        ]);
    }
}
