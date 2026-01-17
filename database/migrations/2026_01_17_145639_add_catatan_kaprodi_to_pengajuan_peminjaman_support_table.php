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
        Schema::table('pengajuan_peminjaman_support', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_peminjaman_support', 'catatan_kaprodi')) {
                $table->text('catatan_kaprodi')->nullable()->after('catatan_admin');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_peminjaman_support', function (Blueprint $table) {
            if (Schema::hasColumn('pengajuan_peminjaman_support', 'catatan_kaprodi')) {
                $table->dropColumn('catatan_kaprodi');
            }
        });
    }
};
