<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Departemen;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Departemen::create([
            'kodeDepartemen'    => 'K0001',
            'namaDepartemen'    => 'Akuntasi',
        ]);

        User::create([
            'nik'           => '12345',
            'nama'          => 'Adam Zein',
            'departemen'    => 'K0001',
            'email'         => 'adamzein@gmail.com',
            'tel'           => '6281316671373',
            'tipe'          => 'karyawan',
            'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
    }
}
