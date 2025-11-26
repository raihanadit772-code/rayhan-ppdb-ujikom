<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class VerifikatorController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total' => Pendaftaran::count(),
            'belum_diverifikasi' => Pendaftaran::where('status_verifikasi', 'belum_diverifikasi')->count(),
            'diverifikasi' => Pendaftaran::where('status_verifikasi', 'diverifikasi')->count(),
            'ditolak' => Pendaftaran::where('status_verifikasi', 'ditolak')->count(),
        ];
        
        $pendaftaran_terbaru = Pendaftaran::with(['jurusanPilihan1', 'jurusanPilihan2'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        return view('verifikator.dashboard', compact('stats', 'pendaftaran_terbaru'));
    }
    
    public function pendaftaran(Request $request)
    {
        $query = Pendaftaran::with(['jurusanPilihan1', 'jurusanPilihan2', 'verifikator']);
        
        if ($request->status_verifikasi) {
            $query->where('status_verifikasi', $request->status_verifikasi);
        }
        
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('no_pendaftaran', 'like', '%' . $request->search . '%')
                  ->orWhere('nisn', 'like', '%' . $request->search . '%');
            });
        }
        
        $pendaftaran = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('verifikator.pendaftaran', compact('pendaftaran'));
    }
    
    public function detail($id)
    {
        $pendaftaran = Pendaftaran::with(['jurusanPilihan1', 'jurusanPilihan2', 'verifikator'])->findOrFail($id);
        return view('verifikator.detail', compact('pendaftaran'));
    }
    
    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:diverifikasi,ditolak',
            'catatan_verifikasi' => 'nullable|string|max:1000'
        ]);
        
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status_verifikasi' => $request->status_verifikasi,
            'catatan_verifikasi' => $request->catatan_verifikasi,
            'tanggal_verifikasi' => now(),
            'verifikator_id' => Auth::id()
        ]);
        
        // Jika diverifikasi (diterima), buat tagihan pembayaran otomatis
        if ($request->status_verifikasi === 'diverifikasi') {
            // Cek apakah sudah ada pembayaran
            if (!$pendaftaran->pembayaran()->exists()) {
                // Buat pembayaran pendaftaran
                Pembayaran::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'kode_pembayaran' => 'PAY-' . date('Ymd') . '-' . str_pad($pendaftaran->id, 4, '0', STR_PAD_LEFT),
                    'jenis_pembayaran' => 'pendaftaran',
                    'jumlah' => 500000, // Biaya pendaftaran
                    'status_pembayaran' => 'belum_bayar',
                    'tanggal_jatuh_tempo' => now()->addDays(7)
                ]);
            }
        }
        
        return redirect()->back()->with('success', 'Verifikasi berhasil disimpan');
    }
}