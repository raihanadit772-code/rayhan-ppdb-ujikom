<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SiswaAuthController extends Controller
{
    public function createAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:pendaftaran,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $pendaftaran = Pendaftaran::where('email', $request->email)->first();
        
        if (!$pendaftaran) {
            return back()->withErrors(['email' => 'Email tidak ditemukan dalam data pendaftaran']);
        }

        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return back()->withErrors(['email' => 'Akun sudah ada, silakan login']);
        }

        User::create([
            'name' => $pendaftaran->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}