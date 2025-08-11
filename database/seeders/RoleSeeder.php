<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            [
                'id' => (string) Str::uuid(),
                'role_name' => 'admin',
                'role_description' => 'pengelola',
                'role_status' => 1,
            ],
            [
                'id' => (string) Str::uuid(),
                'role_name' => 'dosen',
                'role_description' => 'pengajar',
                'role_status' => 1,
            ],
            [
                'id' => (string) Str::uuid(),
                'role_name' => 'CSR',
                'role_description' => 'Tata Usaha Bag Akademik',
                'role_status' => 1,
            ],
            [
                'id' => (string) Str::uuid(),
                'role_name' => 'guest',
                'role_description' => 'Peminjam ruangan',
                'role_status' => 1,
            ],
        ]);
    }
}
