<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Jurusan;
use Illuminate\Support\Facades\DB;

class KepalaSekolahController extends Controller
{
    public function dashboard()
    {
        // KPI Metrics
        $kpi = [
            'total_pendaftar' => Pendaftaran::count(),
            'target_pendaftar' => 500, // Target tahunan
            'pendaftar_diterima' => Pendaftaran::where('status', 'diterima')->count(),
            'tingkat_konversi' => Pendaftaran::count() > 0 ? round((Pendaftaran::where('status', 'diterima')->count() / Pendaftaran::count()) * 100, 1) : 0,
            'total_pendapatan' => Pembayaran::where('status_pembayaran', 'lunas')->sum('jumlah'),
            'target_pendapatan' => 250000000, // Target tahunan
            'verifikasi_selesai' => Pendaftaran::where('status_verifikasi', 'diverifikasi')->count(),
            'pembayaran_lunas' => Pembayaran::where('status_pembayaran', 'lunas')->count(),
        ];
        
        // Trend data (last 7 days)
        $trendPendaftaran = [];
        $trendPembayaran = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $trendPendaftaran[] = [
                'date' => now()->subDays($i)->format('d/m'),
                'count' => Pendaftaran::whereDate('created_at', $date)->count()
            ];
            $trendPembayaran[] = [
                'date' => now()->subDays($i)->format('d/m'),
                'amount' => Pembayaran::whereDate('created_at', $date)->where('status_pembayaran', 'lunas')->sum('jumlah')
            ];
        }
        
        // Jurusan popularity
        $jurusanStats = Jurusan::withCount(['pendaftaranPilihan1 as total_peminat'])
            ->orderBy('total_peminat', 'desc')
            ->get();
            
        // Status breakdown
        $statusBreakdown = [
            'pending' => Pendaftaran::where('status', 'pending')->count(),
            'diterima' => Pendaftaran::where('status', 'diterima')->count(),
            'ditolak' => Pendaftaran::where('status', 'ditolak')->count(),
        ];
        
        // Verification status
        $verifikasiStatus = [
            'belum_diverifikasi' => Pendaftaran::where('status_verifikasi', 'belum_diverifikasi')->count(),
            'diverifikasi' => Pendaftaran::where('status_verifikasi', 'diverifikasi')->count(),
            'ditolak' => Pendaftaran::where('status_verifikasi', 'ditolak')->count(),
        ];
        
        // Payment status
        $pembayaranStatus = [
            'belum_bayar' => Pembayaran::where('status_pembayaran', 'belum_bayar')->count(),
            'menunggu_verifikasi' => Pembayaran::where('status_pembayaran', 'menunggu_verifikasi')->count(),
            'lunas' => Pembayaran::where('status_pembayaran', 'lunas')->count(),
            'ditolak' => Pembayaran::where('status_pembayaran', 'ditolak')->count(),
        ];
        
        return view('kepala-sekolah.dashboard', compact(
            'kpi', 'trendPendaftaran', 'trendPembayaran', 'jurusanStats', 
            'statusBreakdown', 'verifikasiStatus', 'pembayaranStatus'
        ));
    }
}