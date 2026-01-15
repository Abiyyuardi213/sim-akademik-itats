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
        $roles = [
            [
                'id' => '5126bfd2-7eb2-4654-8d09-fd4a9a8645dc', // Admin
                'role_name' => 'admin',
                'role_description' => 'pengelola',
                'role_status' => 1,
            ],
            [
                'id' => (string) Str::uuid(), // Dosen
                'role_name' => 'dosen',
                'role_description' => 'pengajar',
                'role_status' => 1,
            ],
            [
                'id' => 'fc767fc4-c044-4f62-aded-bd04a4f53c8c', // CSR / Staff
                'role_name' => 'CSR',
                'role_description' => 'Tata Usaha Bag Akademik',
                'role_status' => 1,
            ],
            [
                'id' => '5bc94b64-7d35-4973-97fe-db0e2a528741', // Guest
                'role_name' => 'guest',
                'role_description' => 'Peminjam ruangan',
                'role_status' => 1,
            ],
            [
                'id' => (string) Str::uuid(), // Kaprodi
                'role_name' => 'Kaprodi',
                'role_description' => 'Kepala Program Studi',
                'role_status' => 1,
            ],
        ];

        foreach ($roles as $role) {
            if (!DB::table('role')->where('role_name', $role['role_name'])->exists()) {
                DB::table('role')->insert($role);
            }
        }
    }
}
