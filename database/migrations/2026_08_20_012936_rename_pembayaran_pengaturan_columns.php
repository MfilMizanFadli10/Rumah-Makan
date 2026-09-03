<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {

            $table->renameColumn(
                'no_rekening',
                'nomor_rekening'
            );

            $table->renameColumn(
                'nama_rekening',
                'atas_nama'
            );

            $table->renameColumn(
                'foto_qris',
                'qris'
            );

        });
    }

    public function down(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {

            $table->renameColumn(
                'nomor_rekening',
                'no_rekening'
            );

            $table->renameColumn(
                'atas_nama',
                'nama_rekening'
            );

            $table->renameColumn(
                'qris',
                'foto_qris'
            );

        });
    }
};