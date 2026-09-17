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
        Schema::create('mahidangs', function (Blueprint $table) {
    $table->id();

    $table->string('kode_mahidang')->unique();

    $table->string('nama_pelanggan');

    $table->string('no_hp');

    $table->foreignId('meja_id')
        ->constrained('meja')
        ->cascadeOnDelete();

    $table->text('catatan')->nullable();

    $table->enum('status', [
        'menunggu',
        'sudah_duduk',
        'sedang_makan',
        'selesai_makan',
        'dihitung',
        'menunggu_pembayaran',
        'lunas'
    ])->default('menunggu');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahidangs');
    }
};