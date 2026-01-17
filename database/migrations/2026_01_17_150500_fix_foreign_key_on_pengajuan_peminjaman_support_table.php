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
            // Drop the incorrect foreign key constraint
            // Note: The name might vary, but based on the error it is 'pengajuan_peminjaman_support_support_id_foreign'
            $table->dropForeign('pengajuan_peminjaman_support_support_id_foreign');

            // Add the correct foreign key constraint referencing 'support' table
            $table->foreign('support_id')
                ->references('id')
                ->on('support')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_peminjaman_support', function (Blueprint $table) {
            $table->dropForeign(['support_id']);

            // Revert strict reference if needed, though 'fasilitas_support' seems wrong for current context.
            // Leaving it effectively pointing to nothing or reverting to known bad state is risky.
            // But for 'down', we might try to revert to what it was if we knew 'fasilitas_support' existed.
            // Assuming we just drop the new one.
        });
    }
};
