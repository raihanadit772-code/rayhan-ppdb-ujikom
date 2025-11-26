<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        // Get some pendaftaran records
        $pendaftaranIds = Pendaftaran::pluck('id')->take(5);
        
        if ($pendaftaranIds->count() > 0) {
            foreach ($pendaftaranIds as $index => $pendaftaranId) {
                // Create pendaftaran payment
                Pembayaran::create([
                    'pendaftaran_id' => $pendaftaranId,
                    'kode_pembayaran' => 'PAY-' . date('Ymd') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                    'jenis_pembayaran' => 'pendaftaran',
                    'jumlah' => 150000,
                    'status_pembayaran' => $index % 3 == 0 ? 'menunggu_verifikasi' : ($index % 3 == 1 ? 'lunas' : 'belum_bayar'),
                    'tanggal_bayar' => $index % 3 != 2 ? now()->subDays(rand(1, 10)) : null,
                    'tanggal_verifikasi' => $index % 3 == 1 ? now()->subDays(rand(1, 5)) : null,
                    'verifikator_keuangan_id' => $index % 3 == 1 ? 3 : null, // Assuming keuangan user has ID 3
                ]);
                
                // Create daftar ulang payment for some
                if ($index < 3) {
                    Pembayaran::create([
                        'pendaftaran_id' => $pendaftaranId,
                        'kode_pembayaran' => 'DU-' . date('Ymd') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                        'jenis_pembayaran' => 'daftar_ulang',
                        'jumlah' => 500000,
                        'status_pembayaran' => $index == 0 ? 'lunas' : 'belum_bayar',
                        'tanggal_bayar' => $index == 0 ? now()->subDays(rand(1, 5)) : null,
                        'tanggal_verifikasi' => $index == 0 ? now()->subDays(rand(1, 3)) : null,
                        'verifikator_keuangan_id' => $index == 0 ? 3 : null,
                    ]);
                }
            }
        }
    }
}