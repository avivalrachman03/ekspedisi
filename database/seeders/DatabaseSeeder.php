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

        $admin = User::factory()->create(
            [
                'name' => 'Admin',
                'email' => 'ardi@admin.com',
                'password' => 'adminku'
            ]
            
        );
        $karyawan = User::factory()->create(
            [
                'name' => 'Karyawan',
                'email' => 'karyawan@user.com',
                'password' => 'karyawanku'
            ]
            );
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Karyawan']);
        $admin->assignRole($role1);
        $karyawan->assignRole($role2);
        // $this->call([
        //     ProvinceSeeder::class,
        //     RegencySeeder::class,
        //     VendorSeeder::class,
        //     // PengirimSeeder::class,
        // ]);
    }
}
