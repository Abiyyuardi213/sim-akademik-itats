<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periode_cuti', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_periode');

            $table->enum('awal_cuti', [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ]);

            $table->enum('akhir_cuti', [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ]);

            $table->enum('bulan_her', [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ]);

            $table->boolean('periode_status'); // TRUE jika aktif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periode_cuti');
    }
};
