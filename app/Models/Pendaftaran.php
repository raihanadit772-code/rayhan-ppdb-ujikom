<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'no_pendaftaran',
        'nama_lengkap',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'asal_sekolah',
        'tahun_lulus',
        'nilai_matematika',
        'nilai_bahasa_indonesia',
        'nilai_bahasa_inggris',
        'pilihan_1',
        'pilihan_2',
        'no_hp',
        'email',
        'alamat',
        'ijazah_path',
        'kartu_keluarga_path',
        'akta_lahir_path',
        'pas_foto_path',
        'status',
        'status_verifikasi',
        'catatan_verifikasi',
        'tanggal_verifikasi',
        'verifikator_id',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'alamat_orangtua',
        'no_hp_orangtua',
        'kartu_dicetak',
        'tanggal_cetak_kartu'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_verifikasi' => 'datetime',
        'kartu_dicetak' => 'boolean',
        'tanggal_cetak_kartu' => 'datetime'
    ];

    public function jurusanPilihan1()
    {
        return $this->belongsTo(Jurusan::class, 'pilihan_1');
    }

    public function jurusanPilihan2()
    {
        return $this->belongsTo(Jurusan::class, 'pilihan_2');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator_id');
    }
    
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
    
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'pilihan_1');
    }
}
