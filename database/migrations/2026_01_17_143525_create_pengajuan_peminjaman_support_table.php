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
        // Check if table exists to avoid error if previous migration ran
        if (!Schema::hasTable('pengajuan_peminjaman_support')) {
            Schema::create('pengajuan_peminjaman_support', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignUuid('support_id')->constrained('support')->onDelete('cascade');
                $table->foreignUuid('prodi_id')->constrained('prodi')->onDelete('cascade');
                $table->date('tanggal_peminjaman');
                $table->date('tanggal_berakhir_peminjaman')->nullable();
                $table->time('waktu_peminjaman');
                $table->time('waktu_berakhir_peminjaman');
                $table->text('keperluan_peminjaman');
                $table->enum('status', ['pending', 'pending_kaprodi', 'pending_admin', 'disetujui', 'ditolak', 'batal', 'selesai'])->default('pending_kaprodi');
                $table->text('catatan_admin')->nullable();
                $table->text('catatan_kaprodi')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_peminjaman_support');
    }
};
