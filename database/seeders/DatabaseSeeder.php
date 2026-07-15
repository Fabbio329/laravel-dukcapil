<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('pelayanans')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('users')->insert([
            [
                'name' => 'Admin Dukcapil',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Warga Contoh',
                'email' => 'warga@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'warga',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('pelayanans')->insert([
            ['id' => 1, 'nama_layanan' => 'KTP', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_layanan' => 'KK', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_layanan' => 'Akta Kelahiran', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}