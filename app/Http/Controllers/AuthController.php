<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
            'role' => 'required|in:admin,verifikator,keuangan,kepala_sekolah,calon_siswa',
        ]);

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $loginField => $request->login,
            'password' => $request->password
        ];
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check if user's role matches selected role
            if ($user->role !== $request->role) {
                Auth::logout();
                return back()->withErrors(['role' => 'Role yang dipilih tidak sesuai dengan akun Anda']);
            }
            
            // Redirect based on role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'verifikator':
                    return redirect()->route('verifikator.dashboard');
                case 'keuangan':
                    return redirect()->route('keuangan.dashboard');
                case 'kepala_sekolah':
                    return redirect()->route('kepala-sekolah.dashboard');
                case 'calon_siswa':
                    return redirect()->route('siswa.dashboard');
                default:
                    return redirect()->route('home');
            }
        }

        return back()->withErrors(['login' => 'Username/Email atau password salah']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'calon_siswa',
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}