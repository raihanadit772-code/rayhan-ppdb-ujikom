<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['belum_diverifikasi', 'diverifikasi', 'ditolak'])->default('belum_diverifikasi');
            $table->text('catatan_verifikasi')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->unsignedBigInteger('verifikator_id')->nullable();
            $table->foreign('verifikator_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropForeign(['verifikator_id']);
            $table->dropColumn(['status_verifikasi', 'catatan_verifikasi', 'tanggal_verifikasi', 'verifikator_id']);
        });
    }
};