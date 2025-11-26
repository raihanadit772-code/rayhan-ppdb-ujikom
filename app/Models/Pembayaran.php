<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'pendaftaran_id',
        'kode_pembayaran',
        'jenis_pembayaran',
        'jumlah',
        'status_pembayaran',
        'bukti_pembayaran',
        'catatan_pembayaran',
        'tanggal_bayar',
        'tanggal_verifikasi',
        'tanggal_jatuh_tempo',
        'verifikator_keuangan_id'
    ];

    protected $casts = [
        'tanggal_bayar' => 'datetime',
        'tanggal_verifikasi' => 'datetime',
        'tanggal_jatuh_tempo' => 'datetime',
        'jumlah' => 'decimal:2'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function verifikatorKeuangan()
    {
        return $this->belongsTo(User::class, 'verifikator_keuangan_id');
    }
}