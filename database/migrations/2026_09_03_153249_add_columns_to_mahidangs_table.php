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
        Schema::table('mahidangs', function (Blueprint $table) {
            $table->string('kode_mahidang')->unique()->after('id');
            $table->string('nama_pelanggan')->after('kode_mahidang');
            $table->string('no_hp', 20)->after('nama_pelanggan');
            $table->foreignId('meja_id')
                ->after('no_hp')
                ->constrained('meja')
                ->cascadeOnDelete();
            $table->text('catatan')->nullable()->after('meja_id');
            $table->enum('status', [
                'menunggu',
                'sudah_duduk',
                'sedang_makan',
                'selesai_makan',
                'dihitung',
                'menunggu_pembayaran',
                'lunas'
            ])->default('menunggu')->after('catatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahidangs', function (Blueprint $table) {
            $table->dropForeign(['meja_id']);

            $table->dropColumn([
                'kode_mahidang',
                'nama_pelanggan',
                'no_hp',
                'meja_id',
                'catatan',
                'status',
            ]);
        });
    }
};