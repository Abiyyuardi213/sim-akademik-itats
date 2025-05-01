<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legalisir', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tanggal');
            $table->string('no_legalisir');
            $table->string('nama');
            $table->string('npm')->unique();
            $table->unsignedTinyInteger('jumlah_ijazah')->nullable();
            $table->unsignedTinyInteger('jumlah_transkip')->nullable();
            $table->unsignedTinyInteger('jumlah_lain')->nullable();
            $table->unsignedTinyInteger('jumlah_total')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legalisir');
    }
};
