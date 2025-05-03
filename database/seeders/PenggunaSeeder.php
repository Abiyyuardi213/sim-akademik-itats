<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengguna::insert([
            'id' => Str::uuid(),
            'nama_pengguna' => 'Admin Utama',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'no_telepon' => '081234567890',
            'password' => Hash::make('password'), // Ganti dengan password yang kuat
            'role_id' => '1',
            'profile_picture' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
