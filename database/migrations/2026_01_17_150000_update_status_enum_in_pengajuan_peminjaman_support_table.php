<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modifying ENUM is platform specific. For MySQL:
        DB::statement("ALTER TABLE pengajuan_peminjaman_support MODIFY COLUMN status ENUM('pending', 'pending_kaprodi', 'pending_admin', 'disetujui', 'ditolak', 'batal', 'selesai') NOT NULL DEFAULT 'pending_kaprodi'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original if possible. NOTE: This might fail if data 'pending_kaprodi' exists.
        // We generally don't revert enum extensions strictly in dev.
        // DB::statement("ALTER TABLE pengajuan_peminjaman_support MODIFY COLUMN status ENUM('pending', 'disetujui', 'ditolak') NOT NULL DEFAULT 'pending'");
    }
};
