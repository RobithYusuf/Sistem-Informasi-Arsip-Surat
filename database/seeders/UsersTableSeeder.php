<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Asumsi ID role: admin = 1, arsiparis = 2, pimpinan = 3
        DB::table('users')->insert([
            [
                'nama' => 'Admin User',
                'username' => 'admin',
                'password' => Hash::make('123456789'),
                'role_id' => 1
            ],
            [
                'nama' => 'Arsiparis User',
                'username' => 'arsiparis',
                'password' => Hash::make('123456789'),
                'role_id' => 2
            ],
            [
                'nama' => 'Pimpinan User',
                'username' => 'pimpinan',
                'password' => Hash::make('123456789'),
                'role_id' => 3
            ],
        ]);
    }
}
