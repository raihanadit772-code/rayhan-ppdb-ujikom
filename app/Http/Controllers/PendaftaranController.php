<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::where('aktif', true)->get();
        return view('pendaftaran-simple', compact('jurusan'));
    }
    
    public function modern()
    {
        $jurusan = Jurusan::where('aktif', true)->get();
        return view('pendaftaran-modern', compact('jurusan'));
    }
    
    public function ultra()
    {
        $jurusan = Jurusan::where('aktif', true)->get();
        return view('pendaftaran-ultra', compact('jurusan'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'nisn' => 'required|numeric|digits_between:8,12',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'agama' => 'required|string',
                'asal_sekolah' => 'required|string|max:255',
                'tahun_lulus' => 'required|integer|min:2020|max:2024',
                'nilai_matematika' => 'required|integer|min:0|max:100',
                'nilai_bahasa_indonesia' => 'required|integer|min:0|max:100',
                'nilai_bahasa_inggris' => 'required|integer|min:0|max:100',
                'pilihan_1' => 'required|exists:jurusan,id',
                'pilihan_2' => 'nullable|exists:jurusan,id',
                'no_hp' => 'required|string|max:15',
                'email' => 'required|email|max:255',
                'alamat' => 'required|string'
            ]);

            $noPendaftaran = 'PPDB' . date('Y') . str_pad(Pendaftaran::count() + 1, 4, '0', STR_PAD_LEFT);

            $pendaftaran = Pendaftaran::create([
                'no_pendaftaran' => $noPendaftaran,
                'nama_lengkap' => $validated['nama_lengkap'],
                'nisn' => $validated['nisn'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'agama' => $validated['agama'],
                'asal_sekolah' => $validated['asal_sekolah'],
                'tahun_lulus' => $validated['tahun_lulus'],
                'nilai_matematika' => $validated['nilai_matematika'],
                'nilai_bahasa_indonesia' => $validated['nilai_bahasa_indonesia'],
                'nilai_bahasa_inggris' => $validated['nilai_bahasa_inggris'],
                'pilihan_1' => $validated['pilihan_1'],
                'pilihan_2' => $validated['pilihan_2'],
                'no_hp' => $validated['no_hp'],
                'email' => $validated['email'],
                'alamat' => $validated['alamat']
            ]);

            return redirect()->back()->with('success', 'Pendaftaran berhasil! Nomor pendaftaran: ' . $noPendaftaran . '. Silakan simpan nomor ini untuk keperluan login nanti.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}