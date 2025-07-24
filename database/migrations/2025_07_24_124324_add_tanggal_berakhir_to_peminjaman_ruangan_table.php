<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjaman_ruangan', function (Blueprint $table) {
            $table->date('tanggal_berakhir_peminjaman')->after('tanggal_peminjaman')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman_ruangan', function (Blueprint $table) {
            $table->dropColumn('tanggal_berakhir_peminjaman');
        });
    }
};
