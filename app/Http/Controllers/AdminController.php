<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Kontak;
use App\Models\Jurusan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPendaftar = Pendaftaran::count();
        $pendaftarHariIni = Pendaftaran::whereDate('created_at', today())->count();
        $terverifikasi = Pendaftaran::where('status_verifikasi', 'diverifikasi')->count();
        $terbayar = Pembayaran::where('status_pembayaran', 'lunas')->count();
        
        // Data per jurusan
        $dataJurusan = Jurusan::withCount([
            'pendaftaranPilihan1 as total_pendaftar',
            'pendaftaranPilihan1 as terverifikasi' => function($query) {
                $query->where('status_verifikasi', 'diverifikasi');
            }
        ])->get();
        
        $pendaftaranTerbaru = Pendaftaran::with(['jurusanPilihan1', 'jurusanPilihan2'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        return view('admin.dashboard', compact(
            'totalPendaftar', 
            'pendaftarHariIni', 
            'terverifikasi',
            'terbayar',
            'dataJurusan',
            'pendaftaranTerbaru'
        ));
    }

    public function pendaftaran()
    {
        $pendaftaran = Pendaftaran::with(['jurusanPilihan1', 'jurusanPilihan2'])->latest()->get();
        return view('admin.pendaftaran', compact('pendaftaran'));
    }

    public function kontak()
    {
        $kontak = Kontak::latest()->get();
        return view('admin.kontak', compact('kontak'));
    }

    public function detailPendaftaran($id)
    {
        $pendaftaran = Pendaftaran::with(['jurusanPilihan1', 'jurusanPilihan2'])->findOrFail($id);
        return view('admin.detail-pendaftaran', compact('pendaftaran'));
    }
}