<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Tiket;
use App\Models\Departemen;
use App\Models\DetailTiket;
use Illuminate\Support\Str;
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
            'kodeDepartemen'    => 'D0001',
            'namaDepartemen'    => 'IT',
        ]);

        Departemen::create([
            'kodeDepartemen'    => 'D0002',
            'namaDepartemen'    => 'Akutansi',
        ]);

        User::create([
            'nik'           => '12345',
            'nama'          => 'Adam Zein',
            'departemen'    => 'D0001',
            'email'         => 'adamzein@gmail.com',
            'tel'           => '6281316671373',
            'tipe'          => 'admin',
            'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        User::create([
            'nik'           => '12346',
            'nama'          => 'Jamal',
            'departemen'    => 'D0002',
            'email'         => 'jamal@gmail.com',
            'tel'           => '6281316671374',
            'tipe'          => 'karyawan',
            'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        Tiket::create([
            'noTiket'           => 'CDP/IT/20/04/23/0001',
            'user'              => '12346',
            'permintaan'        => 'Printer Rusak',
            'uraianPermintaan'  => 'Hasil printer tidak jelas',
            'prioritas'         => 'B'
        ]);

        DetailTiket::create([
            'uuidTiket'         => Str::uuid(),
            'tiket'             => 'CDP/IT/20/04/23/0001',
            'status'            => 'Terkirim',
        ]);

        DetailTiket::create([
            'uuidTiket'         => Str::uuid(),
            'tiket'             => 'CDP/IT/20/04/23/0001',
            'status'            => 'Diterima',
        ]);
    }
}
