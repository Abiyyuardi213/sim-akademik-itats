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
        Schema::create('fasilitas_support', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('gedung_id');
            $table->foreign('gedung_id')->references('id')->on('gedung')->onDelete('cascade');
            $table->string('nama_fasilitas');
            $table->unsignedTinyInteger('kapasitas')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('fasilitas_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_support');
    }
};
