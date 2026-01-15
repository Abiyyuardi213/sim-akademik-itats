<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Prodi;

class KaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first available prodi or create one if none exist
        $prodi = Prodi::first();
        if (!$prodi) {
            $prodi = Prodi::create([
                'nama_prodi' => 'Informatika',
                'nama_kaprodi' => 'Dr. Kaprodi Informatika',
                'nip_kaprodi' => '123456789',
                'kode_prodi' => 'IF',
                'alias_prodi' => 'INF',
                'prodi_description' => 'Jurusan Teknik Informatika',
                'prodi_status' => 1
            ]);
        }

        // Create Kaprodi Account linked to this prodi
        DB::table('kaprodis')->insert([
            'username' => 'kaprodi_if',
            'password' => Hash::make('password'),
            'prodi_id' => $prodi->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Kaprodi account seeded: kaprodi_if / password');
    }
}
