<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Tiket;
use App\Models\Departemen;
use App\Models\DetailTiket;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'kodeDepartemen'    => 'D4562',
            'namaDepartemen'    => 'IT',
        ]);

        Departemen::create([
            'kodeDepartemen'    => 'D3212',
            'namaDepartemen'    => 'Akunting',
        ]);

        Departemen::create([
            'kodeDepartemen'    => 'D8987',
            'namaDepartemen'    => 'Personalia',
        ]);

        User::create([
            'nik'           => rand(100000000, 999999999),
            'nama'          => 'Admin',
            'departemen'    => 'D4562',
            'email'         => 'admin@gmail.com',
            'tel'           => '6281288228600',
            'tipe'          => 'admin',
            'password'      => Hash::make('ciracas24'),
        ]);

        User::create([
            'nik'           => rand(100000000, 999999999),
            'nama'          => 'Agung Maulana',
            'departemen'    => 'D3212',
            'email'         => 'AgungMaulana@gmail.com',
            'tel'           => '6281316671378',
            'tipe'          => 'pimpinan',
            'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        User::create([
            'nik'           => rand(100000000, 999999999),
            'nama'          => 'Adam Zein',
            'departemen'    => 'D4562',
            'email'         => 'adamzein@gmail.com',
            'tel'           => '6281316671373',
            'tipe'          => 'teknisi',
            'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        

        User::create([
            'nik'           => rand(100000000, 999999999),
            'nama'          => 'Indra',
            'departemen'    => 'D8987',
            'email'         => 'indra@gmail.com',
            'tel'           => '6281316671377',
            'tipe'          => 'karyawan',
            'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        

        // Tiket::create([
        //     'idTiket'           => Str::uuid(),
        //     'noTiket'           => 'CDP/IT/20/04/23/0001',
        //     'user'              => '12346',
        //     // 'teknisi'           => '12347',
        //     'permintaan'        => 'Printer Rusak',
        //     'uraianPermintaan'  => 'Hasil printer tidak jelas',
        //     // 'prioritas'         => 'B',
        //     'status'            => 'Dikirim',
        // ]);

        // DetailTiket::create([
        //     'idDetailTiket'     => Str::uuid(),
        //     'tiket'             => 'CDP/IT/20/04/23/0001',
        //     'status'            => 'Dikirim',
        // ]);

        // DetailTiket::create([
        //     'uuidTiket'         => Str::uuid(),
        //     'tiket'             => 'CDP/IT/20/04/23/0001',
        //     'status'            => 'Diterima',
        // ]);

        // DetailTiket::create([
        //     'uuidTiket'         => Str::uuid(),
        //     'tiket'             => 'CDP/IT/20/04/23/0001',
        //     'status'            => 'Dikerjakan',
        // ]);
    }
}
