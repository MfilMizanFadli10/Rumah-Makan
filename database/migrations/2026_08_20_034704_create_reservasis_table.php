<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();

            $table->string('nama_pelanggan');
            $table->string('no_hp');

            $table->foreignId('meja_id')
                ->constrained('meja')
                ->cascadeOnDelete();

            $table->date('tanggal_pesanan');
            $table->time('jam_pesanan');
            $table->integer('jumlah_orang');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};