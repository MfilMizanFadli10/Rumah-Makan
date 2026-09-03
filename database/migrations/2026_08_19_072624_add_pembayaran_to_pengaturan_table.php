<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->string('nama_bank')->nullable()->after('maps');
            $table->string('nomor_rekening')->nullable()->after('nama_bank');
            $table->string('atas_nama')->nullable()->after('nomor_rekening');
            $table->string('qris')->nullable()->after('atas_nama');
        });
    }

    public function down(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->dropColumn([
                'nama_bank',
                'nomor_rekening',
                'atas_nama',
                'qris',
            ]);
        });
    }
};