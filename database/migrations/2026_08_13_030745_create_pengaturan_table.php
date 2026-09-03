<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rumah_makan');
            $table->text('alamat')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('tagline')->nullable();
            $table->string('banner')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->text('maps')->nullable();

            // Pembayaran
            $table->string('nama_bank')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->string('atas_nama')->nullable();
            $table->string('qris')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};