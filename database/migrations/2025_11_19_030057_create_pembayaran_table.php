<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            $table->string('kode_pembayaran')->unique();
            $table->enum('jenis_pembayaran', ['pendaftaran', 'daftar_ulang']);
            $table->decimal('jumlah', 10, 2);
            $table->enum('status_pembayaran', ['belum_bayar', 'menunggu_verifikasi', 'lunas', 'ditolak'])->default('belum_bayar');
            $table->string('bukti_pembayaran')->nullable();
            $table->text('catatan_pembayaran')->nullable();
            $table->timestamp('tanggal_bayar')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->unsignedBigInteger('verifikator_keuangan_id')->nullable();
            $table->foreign('verifikator_keuangan_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};