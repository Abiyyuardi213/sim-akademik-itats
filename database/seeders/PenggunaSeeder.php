<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah pengguna 'admin' sudah ada
        $admin = Pengguna::where('username', 'admin')->first();

        // Jika belum ada, buat baru
        if (!$admin) {
            Pengguna::create([
                'id' => (string) Str::uuid(),
                'nama_pengguna' => 'Admin Utama',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'no_telepon' => '081234567890',
                'password' => Hash::make('password'), // hash password!
                'role_id' => '0d4270c4-bb04-4dc8-8470-b40838eaecf7',
                'profile_picture' => null,
            ]);
        }
    }
}
