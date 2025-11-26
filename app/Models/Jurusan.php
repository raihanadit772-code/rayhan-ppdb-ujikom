<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'prospek_kerja',
        'kuota',
        'aktif'
    ];

    protected $casts = [
        'prospek_kerja' => 'array',
        'aktif' => 'boolean'
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'pilihan_1');
    }

    public function pendaftaranPilihan1()
    {
        return $this->hasMany(Pendaftaran::class, 'pilihan_1');
    }

    public function pendaftaranPilihan2()
    {
        return $this->hasMany(Pendaftaran::class, 'pilihan_2');
    }
}
