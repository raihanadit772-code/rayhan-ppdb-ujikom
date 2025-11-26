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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran')->unique();
            $table->string('nama_lengkap');
            $table->string('nisn', 10)->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->string('asal_sekolah');
            $table->year('tahun_lulus');
            $table->integer('nilai_matematika');
            $table->integer('nilai_bahasa_indonesia');
            $table->integer('nilai_bahasa_inggris');
            $table->foreignId('pilihan_1')->constrained('jurusan');
            $table->foreignId('pilihan_2')->nullable()->constrained('jurusan');
            $table->string('no_hp');
            $table->string('email');
            $table->text('alamat');
            $table->string('ijazah_path')->nullable();
            $table->string('kartu_keluarga_path')->nullable();
            $table->string('akta_lahir_path')->nullable();
            $table->string('pas_foto_path')->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
