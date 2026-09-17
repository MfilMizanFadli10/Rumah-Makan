<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimoni', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['pesanan_id']);

            // Hapus unique index
            $table->dropUnique('testimoni_pesanan_id_unique');

            // Pasang kembali foreign key tanpa unique
            $table->foreign('pesanan_id')
                  ->references('id')
                  ->on('pesanan')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('testimoni', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['pesanan_id']);

            // Kembalikan unique
            $table->unique('pesanan_id');

            // Pasang kembali foreign key
            $table->foreign('pesanan_id')
                  ->references('id')
                  ->on('pesanan')
                  ->cascadeOnDelete();
        });
    }
};