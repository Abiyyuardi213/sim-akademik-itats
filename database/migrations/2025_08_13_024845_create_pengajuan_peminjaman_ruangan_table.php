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
        Schema::create('pengajuan_peminjaman_ruangan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id'); // user yang mengajukan
            $table->uuid('kelas_id');
            $table->uuid('prodi_id');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_berakhir_peminjaman')->nullable();
            $table->time('waktu_peminjaman');
            $table->time('waktu_berakhir_peminjaman');
            $table->text('keperluan_peminjaman');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_peminjaman_ruangan');
    }
};
