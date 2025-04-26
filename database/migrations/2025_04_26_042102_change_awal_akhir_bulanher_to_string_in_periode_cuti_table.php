<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('periode_cuti', function (Blueprint $table) {
            $table->string('awal_cuti')->change();
            $table->string('akhir_cuti')->change();
            $table->string('bulan_her')->change();
        });
    }

    public function down(): void
    {
        Schema::table('periode_cuti', function (Blueprint $table) {
            $table->enum('awal_cuti', [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ])->change();

            $table->enum('akhir_cuti', [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ])->change();

            $table->enum('bulan_her', [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ])->change();
        });
    }
};
