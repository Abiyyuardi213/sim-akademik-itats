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
        Schema::create('laboratorium', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('gedung_id')->constrained('gedung')->onDelete('cascade');
            $table->string('nama_laboratorium');
            $table->integer('kapasitas');
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorium');
    }
};
