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
        // Change enum to string first to allow new values
        DB::statement("ALTER TABLE pengajuan_peminjaman_ruangan MODIFY COLUMN status VARCHAR(50) DEFAULT 'pending_kaprodi'");

        // Update data
        DB::statement("UPDATE pengajuan_peminjaman_ruangan SET status = 'pending_kaprodi' WHERE status = 'pending'");

        Schema::table('pengajuan_peminjaman_ruangan', function (Blueprint $table) {
            $table->text('catatan_kaprodi')->nullable()->after('catatan_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_peminjaman_ruangan', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
            $table->dropColumn('catatan_kaprodi');
        });
    }
};
