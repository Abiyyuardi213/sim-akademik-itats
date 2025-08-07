<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        User::insert([
            [
                'id'              => (string) Str::uuid(),
                'name'            => 'Admin Satu',
                'username'        => 'admin',
                'email'           => 'admin@example.com',
                'no_telepon'      => '081234567890',
                'password'        => Hash::make('admin123'),
                'profile_picture' => null,
                'role_id'         => '5126bfd2-7eb2-4654-8d09-fd4a9a8645dc',
            ],
            [
                'id'              => (string) Str::uuid(),
                'name'            => 'R Abiyyu Ardi L P',
                'username'        => 'rdnabiyyu',
                'email'           => 'radenabiyyu213@gmail.com',
                'no_telepon'      => '0895397043901',
                'password'        => Hash::make('Abiyyu123'),
                'profile_picture' => null,
                'role_id'         => 'fc767fc4-c044-4f62-aded-bd04a4f53c8c',
            ],
            [
                'id'              => (string) Str::uuid(),
                'name'            => 'Ade Nanda Setyawan',
                'username'        => 'adenanda',
                'email'           => 'adenanda@gmail.com',
                'no_telepon'      => '083344556677',
                'password'        => Hash::make('Adenanda123'),
                'profile_picture' => null,
                'role_id'         => 'fc767fc4-c044-4f62-aded-bd04a4f53c8c',
            ],
            [
                'id'              => (string) Str::uuid(),
                'name'            => 'Csr Tambahan WR 1',
                'username'        => 'csrwr1',
                'email'           => 'csrwr1@gmail.com',
                'no_telepon'      => '083344555555',
                'password'        => Hash::make('password'),
                'profile_picture' => null,
                'role_id'         => 'fc767fc4-c044-4f62-aded-bd04a4f53c8c',
            ],
        ]);
    }
}
