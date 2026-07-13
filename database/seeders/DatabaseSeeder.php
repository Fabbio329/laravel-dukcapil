<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Isi langsung menggunakan Query Builder untuk menghindari proteksi model
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin Dukcapil',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Warga Contoh',
                'email' => 'warga@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Isi master data pelayanan
        DB::table('pelayanans')->insert([
            ['id' => 1, 'nama_layanan' => 'KTP', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_layanan' => 'KK', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_layanan' => 'Akta Kelahiran', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}