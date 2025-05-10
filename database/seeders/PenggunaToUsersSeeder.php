<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penggunas = DB::table('pengguna')->get();

        foreach ($penggunas as $p) {
            DB::table('users')->insert([
                'uuid'           => $p->id,
                'name'           => $p->nama_pengguna,
                'username'       => $p->username,
                'email'          => $p->email,
                'no_telepon'     => $p->no_telepon,
                'password'       => $p->password,
                'role_id'        => $p->role_id,
                'profile_picture'=> $p->profile_picture,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}
