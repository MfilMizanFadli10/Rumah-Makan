<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();

            $table->string('kode_pesanan')->unique();
            $table->string('nama_pelanggan');
            $table->string('no_hp')->nullable();

            $table->foreignId('meja_id')
                  ->constrained('meja')
                  ->restrictOnDelete();

            $table->date('tanggal_pesanan');
            $table->time('jam_pesanan');
            $table->integer('jumlah_orang');

            $table->decimal('total_harga', 12, 2)->default(0);

            $table->string('status')->default('menunggu');

            $table->string('metode_pembayaran')->nullable();

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};