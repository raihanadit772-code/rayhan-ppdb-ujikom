<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Jurusan;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::with(['jurusanPilihan1', 'jurusanPilihan2'])
            ->where('email', $user->email)
            ->first();
            
        $pembayaran = $pendaftaran ? Pembayaran::where('pendaftaran_id', $pendaftaran->id)->get() : collect();
        
        return view('siswa.dashboard', compact('pendaftaran', 'pembayaran'));
    }
    
    public function formulirPendaftaran()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('email', $user->email)->first();
        $jurusan = Jurusan::where('aktif', true)->get();
        
        return view('siswa.formulir-pendaftaran', compact('pendaftaran', 'jurusan'));
    }
    
    public function simpanFormulir(Request $request)
    {
        $user = Auth::user();
        $existingPendaftaran = Pendaftaran::where('email', $user->email)->first();
        
        // Validasi
        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|size:10|unique:pendaftaran,nisn' . ($existingPendaftaran ? ',' . $existingPendaftaran->id : ''),
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'asal_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'nilai_matematika' => 'required|integer|min:0|max:100',
            'nilai_bahasa_indonesia' => 'required|integer|min:0|max:100',
            'nilai_bahasa_inggris' => 'required|integer|min:0|max:100',
            'pilihan_1' => 'required|exists:jurusan,id',
            'pilihan_2' => 'nullable|exists:jurusan,id|different:pilihan_1',
            'no_hp' => 'required|string|regex:/^08[0-9]{8,11}$/',
            'alamat' => 'required|string|min:10',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'alamat_orangtua' => 'required|string|min:10',
            'no_hp_orangtua' => 'required|string|regex:/^08[0-9]{8,11}$/',
            'email_otp' => 'required|email'
        ];
        
        if ($request->action === 'kirim') {
            $rules['email_otp'] = 'required|email';
        }
        
        $request->validate($rules, [
            'nisn.size' => 'NISN harus 10 digit',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
            'no_hp.regex' => 'Format nomor HP tidak valid (contoh: 081234567890)',
            'no_hp_orangtua.regex' => 'Format nomor HP orang tua tidak valid',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'alamat_orangtua.min' => 'Alamat orang tua minimal 10 karakter'
        ]);
        
        $data = $request->only([
            'nama_lengkap', 'nisn', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
            'agama', 'asal_sekolah', 'tahun_lulus', 'nilai_matematika', 'nilai_bahasa_indonesia',
            'nilai_bahasa_inggris', 'pilihan_1', 'pilihan_2', 'no_hp', 'alamat',
            'nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu', 'nama_wali',
            'pekerjaan_wali', 'alamat_orangtua', 'no_hp_orangtua'
        ]);
        
        $data['email'] = $user->email; // Always use logged in user email
        
        try {
            if ($existingPendaftaran) {
                $existingPendaftaran->update($data);
                $pendaftaran = $existingPendaftaran;
            } else {
                $data['no_pendaftaran'] = 'REG-' . date('Ymd') . '-' . str_pad(Pendaftaran::count() + 1, 4, '0', STR_PAD_LEFT);
                $data['status'] = 'pending';
                $data['status_verifikasi'] = 'belum_diverifikasi';
                $pendaftaran = Pendaftaran::create($data);
            }
            
            // Auto-submit after saving - no draft mode
            if ($request->action === 'kirim') {
                if (!session('otp_verified_' . $request->email_otp)) {
                    return back()->withErrors(['email_otp' => 'Silakan verifikasi email dengan OTP terlebih dahulu'])->withInput();
                }
            }
            
            // Always set as submitted and ready for verification
            $pendaftaran->update([
                'status' => 'pending', 
                'status_verifikasi' => 'belum_diverifikasi',
                'tanggal_submit' => now()
            ]);
            
            if ($request->action === 'kirim') {
                session()->forget('otp_verified_' . $request->email_otp);
            }
            
            return redirect()->route('siswa.dashboard')->with('success', 'Pendaftaran berhasil disimpan dan dikirim untuk verifikasi!');
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }
    
    public function uploadBerkas()
    {
        $user = Auth::user();
        // Find pendaftaran by user email or recent submissions for this user session
        $pendaftaran = Pendaftaran::where('email', $user->email)
            ->orWhere('created_at', '>=', now()->subHours(2))
            ->orderBy('created_at', 'desc')
            ->first();
        
        if (!$pendaftaran) {
            return redirect()->route('siswa.formulir-pendaftaran')
                ->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }
        
        return view('siswa.upload-berkas', compact('pendaftaran'));
    }
    
    public function simpanBerkas(Request $request)
    {
        $user = Auth::user();
        // Find pendaftaran by user email or recent submissions for this user session
        $pendaftaran = Pendaftaran::where('email', $user->email)
            ->orWhere('created_at', '>=', now()->subHours(2))
            ->orderBy('created_at', 'desc')
            ->first();
        
        if (!$pendaftaran) {
            return redirect()->route('siswa.formulir-pendaftaran')
                ->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }
        
        $request->validate([
            'pas_foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'ijazah' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:5120',
            'kartu_keluarga' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:5120',
            'akta_lahir' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:5120',
        ], [
            '*.max' => 'Ukuran file terlalu besar',
            'pas_foto.image' => 'Pas foto harus berupa gambar',
            '*.mimes' => 'Format file tidak didukung'
        ]);
        
        $data = [];
        $uploadedFiles = [];
        
        foreach (['pas_foto', 'ijazah', 'kartu_keluarga', 'akta_lahir'] as $field) {
            if ($request->hasFile($field)) {
                // Delete old file
                if ($pendaftaran->{$field . '_path'}) {
                    Storage::disk('public')->delete($pendaftaran->{$field . '_path'});
                }
                
                // Store new file in organized folder
                $fileName = $pendaftaran->id . '_' . $field . '_' . time() . '.' . $request->file($field)->getClientOriginalExtension();
                $path = $request->file($field)->storeAs('berkas/' . $pendaftaran->id, $fileName, 'public');
                $data[$field . '_path'] = $path;
                $uploadedFiles[] = ucfirst(str_replace('_', ' ', $field));
            }
        }
        
        if (empty($data)) {
            return back()->with('error', 'Pilih minimal satu berkas untuk diupload.');
        }
        
        $pendaftaran->update($data);
        
        return back()->with('success', 'Berkas berhasil diupload: ' . implode(', ', $uploadedFiles));
    }
    
    public function statusPendaftaran()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::with(['jurusanPilihan1', 'jurusanPilihan2', 'verifikator'])
            ->where('email', $user->email)->first();
        $pembayaran = $pendaftaran ? Pembayaran::where('pendaftaran_id', $pendaftaran->id)->orderBy('created_at', 'desc')->get() : collect();
        
        // Update status berdasarkan pembayaran
        if ($pendaftaran && $pendaftaran->status_verifikasi == 'diverifikasi') {
            $pembayaran_lunas = $pembayaran->where('status_pembayaran', 'lunas')->count();
            $total_pembayaran = $pembayaran->count();
            
            if ($pembayaran_lunas > 0 && $pembayaran_lunas == $total_pembayaran) {
                $status_final = 'diterima';
            } elseif ($pembayaran->where('status_pembayaran', 'menunggu_verifikasi')->count() > 0) {
                $status_final = 'menunggu_pembayaran';
            } else {
                $status_final = 'belum_bayar';
            }
        } else {
            $status_final = 'menunggu_verifikasi';
        }
        
        return view('siswa.status-pendaftaran', compact('pendaftaran', 'pembayaran', 'status_final'));
    }
    
    public function pembayaran()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('email', $user->email)->first();
        
        if (!$pendaftaran) {
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }
        
        // Create payment if not exists
        $pembayaran = Pembayaran::where('pendaftaran_id', $pendaftaran->id)->get();
        if ($pembayaran->isEmpty()) {
            Pembayaran::create([
                'pendaftaran_id' => $pendaftaran->id,
                'kode_pembayaran' => 'PAY-' . date('Ymd') . '-' . str_pad($pendaftaran->id, 4, '0', STR_PAD_LEFT),
                'jenis_pembayaran' => 'pendaftaran',
                'jumlah' => 500000,
                'status_pembayaran' => 'belum_bayar',
                'tanggal_jatuh_tempo' => now()->addDays(7)
            ]);
            $pembayaran = Pembayaran::where('pendaftaran_id', $pendaftaran->id)->get();
        }
        
        return view('siswa.pembayaran', compact('pendaftaran', 'pembayaran'));
    }
    
    public function uploadBuktiBayar(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);
        
        $pembayaran = Pembayaran::findOrFail($id);
        
        if ($pembayaran->bukti_pembayaran) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }
        
        $path = $request->file('bukti_pembayaran')->store('bukti-bayar', 'public');
        
        $pembayaran->update([
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'menunggu_verifikasi',
            'tanggal_bayar' => now()
        ]);
        
        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload!');
    }
    
    public function cetakKartu()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::with(['jurusanPilihan1', 'jurusanPilihan2'])
            ->where('email', $user->email)
            ->first();
        
        if (!$pendaftaran) {
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Data pendaftaran tidak ditemukan.');
        }
        
        $pembayaran = Pembayaran::where('pendaftaran_id', $pendaftaran->id)->get();
        $pembayaran_lunas = $pembayaran->where('status_pembayaran', 'lunas')->count();
        $total_pembayaran = $pembayaran->count();
        
        // Cek apakah bisa cetak kartu - remove strict verification requirement
        $bisa_cetak = $pendaftaran && $total_pembayaran > 0;
        
        if (!$bisa_cetak) {
            return redirect()->route('siswa.status-pendaftaran')
                ->with('error', 'Kartu belum bisa dicetak. Silakan lakukan pembayaran terlebih dahulu.');
        }
        
        // Mark as printed
        $pendaftaran->update(['kartu_dicetak' => true, 'tanggal_cetak_kartu' => now()]);
        
        return view('siswa.cetak-kartu', compact('pendaftaran', 'pembayaran_lunas'));
    }
    
    public function cetakBuktiBayar($id)
    {
        $pembayaran = Pembayaran::with('pendaftaran')->findOrFail($id);
        
        $pdf = Pdf::loadView('siswa.cetak-bukti-bayar', compact('pembayaran'));
        return $pdf->download('bukti-bayar-' . $pembayaran->kode_pembayaran . '.pdf');
    }
    
    public function konfirmasiPembayaran($id)
    {
        try {
            $user = Auth::user();
            $pembayaran = Pembayaran::whereHas('pendaftaran', function($q) use ($user) {
                $q->where('email', $user->email);
            })->find($id);
            
            if (!$pembayaran) {
                return response()->json(['success' => false, 'message' => 'Pembayaran tidak ditemukan']);
            }
            
            if ($pembayaran->status_pembayaran !== 'belum_bayar') {
                return response()->json(['success' => false, 'message' => 'Pembayaran sudah dikonfirmasi sebelumnya']);
            }
            
            $pembayaran->update([
                'status_pembayaran' => 'dikonfirmasi',
                'tanggal_bayar' => now()
            ]);
            
            return response()->json(['success' => true, 'message' => 'Pembayaran berhasil dikonfirmasi']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }
    
    public function sendOtp(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'type' => 'required|in:email,sms'
        ]);
        
        $success = OtpService::sendOtp($request->identifier, $request->type);
        
        if ($success) {
            return response()->json([
                'success' => true, 
                'message' => 'Kode OTP berhasil dikirim ke ' . ($request->type === 'email' ? 'email' : 'nomor HP') . ' Anda'
            ]);
        }
        
        return response()->json([
            'success' => false, 
            'message' => 'Gagal mengirim kode OTP. Silakan coba lagi.'
        ]);
    }
    
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'otp_code' => 'required|string|size:6'
        ]);
        
        $verified = OtpService::verifyOtp($request->identifier, $request->otp_code);
        
        if ($verified) {
            session(['otp_verified_' . $request->identifier => true]);
            return response()->json([
                'success' => true, 
                'message' => 'Kode OTP berhasil diverifikasi'
            ]);
        }
        
        return response()->json([
            'success' => false, 
            'message' => 'Kode OTP tidak valid atau sudah kadaluarsa'
        ]);
    }
}