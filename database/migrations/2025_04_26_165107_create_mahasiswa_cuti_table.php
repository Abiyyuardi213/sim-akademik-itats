<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa_cuti', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_mahasiswa');
            $table->string('npm')->unique()->index();
            $table->uuid('prodi_id');
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('cascade');
            $table->string('nomor_cuti')->unique()->index();
            $table->text('keterangan')->nullable();
            $table->boolean('surat_status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_cuti');
    }
};
