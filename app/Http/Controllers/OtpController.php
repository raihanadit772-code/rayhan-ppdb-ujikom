<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Services\OtpService;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $result = OtpService::sendOtp($request->email, 'email');
        
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'OTP berhasil dikirim ke email ' . $request->email
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengirim OTP'
        ], 500);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|string|size:6'
        ]);

        $result = OtpService::verifyOtp($request->email, $request->otp_code);
        
        if ($result) {
            // Store verification in session
            session(['otp_verified_' . $request->email => true]);
            
            return response()->json([
                'success' => true,
                'message' => 'OTP berhasil diverifikasi'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Kode OTP tidak valid atau sudah kadaluarsa'
        ]);
    }
}