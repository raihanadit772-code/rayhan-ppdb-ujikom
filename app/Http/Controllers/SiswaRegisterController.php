<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SiswaRegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register-siswa');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        $email = filter_var($request->username, FILTER_VALIDATE_EMAIL) 
            ? $request->username 
            : $request->username . '@siswa.local';
            
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $email,
            'password' => Hash::make($request->password),
            'role' => 'calon_siswa',
        ]);
        
        Auth::login($user);
        
        return redirect()->route('siswa.dashboard')->with('success', 'Akun berhasil dibuat! Silakan lengkapi formulir pendaftaran.');
    }
}