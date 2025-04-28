<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa_cuti', function (Blueprint $table) {
            $table->uuid('periode_id')->nullable()->after('prodi_id');
            $table->foreign('periode_id')->references('id')->on('periode_cuti')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa_cuti', function (Blueprint $table) {
            $table->dropForeign(['periode_id']);
            $table->dropColumn('periode_id');
        });
    }
};
