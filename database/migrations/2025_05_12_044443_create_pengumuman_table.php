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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul');
            $table->text('isi');
            $table->dateTime('tanggal_dibuat')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('tanggal_diperbarui')->nullable()->default(null)->useCurrentOnUpdate();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->uuid('author_id');
            $table->foreign('author_id', 'author_relation')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
