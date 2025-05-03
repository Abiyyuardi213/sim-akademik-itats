<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('gedung_id');
            $table->foreign('gedung_id')->references('id')->on('gedung')->onDelete('cascade');
            $table->string('nama_kelas');
            $table->unsignedTinyInteger('kapasitas_mahasiswa')->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('kelas_status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
