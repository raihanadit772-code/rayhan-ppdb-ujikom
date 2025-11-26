<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_pembayaran' => Pembayaran::count(),
            'dikonfirmasi' => Pembayaran::where('status_pembayaran', 'dikonfirmasi')->count(),
            'menunggu_verifikasi' => Pembayaran::where('status_pembayaran', 'menunggu_verifikasi')->count(),
            'lunas' => Pembayaran::where('status_pembayaran', 'lunas')->count(),
            'total_pendapatan' => Pembayaran::where('status_pembayaran', 'lunas')->sum('jumlah'),
        ];
        
        $pembayaran_terbaru = Pembayaran::with(['pendaftaran', 'verifikatorKeuangan'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Siswa yang sudah diverifikasi dengan tagihan otomatis
        $siswa_diverifikasi = Pendaftaran::with(['jurusan', 'pembayaran'])
            ->where('status_verifikasi', 'diverifikasi')
            ->whereHas('pembayaran')
            ->orderBy('tanggal_verifikasi', 'desc')
            ->limit(10)
            ->get();
            
        return view('keuangan.dashboard', compact('stats', 'pembayaran_terbaru', 'siswa_diverifikasi'));
    }
    
    public function verifikasiPembayaran(Request $request)
    {
        $query = Pembayaran::with(['pendaftaran', 'verifikatorKeuangan']);
        
        if ($request->status_pembayaran) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }
        
        if ($request->jenis_pembayaran) {
            $query->where('jenis_pembayaran', $request->jenis_pembayaran);
        }
        
        if ($request->search) {
            $query->whereHas('pendaftaran', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('no_pendaftaran', 'like', '%' . $request->search . '%');
            })->orWhere('kode_pembayaran', 'like', '%' . $request->search . '%');
        }
        
        $pembayaran = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('keuangan.verifikasi-pembayaran', compact('pembayaran'));
    }
    
    public function detailPembayaran($id)
    {
        $pembayaran = Pembayaran::with(['pendaftaran', 'verifikatorKeuangan'])->findOrFail($id);
        return view('keuangan.detail-pembayaran', compact('pembayaran'));
    }
    
    public function prosesVerifikasi(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:lunas,ditolak',
            'catatan_pembayaran' => 'nullable|string|max:1000'
        ]);
        
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'status_pembayaran' => $request->status_pembayaran,
            'catatan_pembayaran' => $request->catatan_pembayaran,
            'tanggal_verifikasi' => now(),
            'verifikator_keuangan_id' => Auth::id()
        ]);
        
        return redirect()->back()->with('success', 'Verifikasi pembayaran berhasil disimpan');
    }
    
    public function rekapPembayaran(Request $request)
    {
        $query = Pembayaran::with(['pendaftaran', 'verifikatorKeuangan']);
        
        if ($request->tanggal_mulai && $request->tanggal_selesai) {
            $query->whereBetween('tanggal_verifikasi', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }
        
        if ($request->jenis_pembayaran) {
            $query->where('jenis_pembayaran', $request->jenis_pembayaran);
        }
        
        if ($request->status_pembayaran) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }
        
        $pembayaran = $query->orderBy('tanggal_verifikasi', 'desc')->paginate(15);
        
        // Summary statistics
        $summary = [
            'total_transaksi' => $query->count(),
            'total_pendapatan' => $query->where('status_pembayaran', 'lunas')->sum('jumlah'),
            'pendaftaran' => $query->where('jenis_pembayaran', 'pendaftaran')->where('status_pembayaran', 'lunas')->sum('jumlah'),
            'daftar_ulang' => $query->where('jenis_pembayaran', 'daftar_ulang')->where('status_pembayaran', 'lunas')->sum('jumlah'),
        ];
        
        return view('keuangan.rekap-pembayaran', compact('pembayaran', 'summary'));
    }
    

}