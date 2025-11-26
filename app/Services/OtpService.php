<?php

namespace App\Services;

use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OtpService
{
    public static function sendOtp($identifier, $type = 'email')
    {
        try {
            $otp = Otp::generateOtp($identifier, $type);
            
            if ($type === 'email') {
                return self::sendEmailOtp($identifier, $otp->otp_code);
            } else {
                return self::sendSmsOtp($identifier, $otp->otp_code);
            }
        } catch (\Exception $e) {
            Log::error('OTP Send Error: ' . $e->getMessage());
            return false;
        }
    }
    

    
    private static function sendEmailOtp($email, $otpCode)
    {
        try {
            Mail::send('emails.otp', ['otpCode' => $otpCode], function ($message) use ($email) {
                $message->to($email)
                        ->subject('Kode Verifikasi OTP PPDB');
            });
            
            Log::info('Email OTP dikirim ke ' . $email . ': ' . $otpCode);
            return true;
        } catch (\Exception $e) {
            Log::error('Email OTP Error: ' . $e->getMessage());
            return false;
        }
    }
    
    private static function sendSmsOtp($phone, $otpCode)
    {
        try {
            // Format nomor HP untuk Indonesia
            $phone = self::formatPhoneNumber($phone);
            $message = "Kode verifikasi OTP PPDB: {$otpCode}. Berlaku 5 menit. Jangan bagikan kode ini.";
            
            // Simulasi SMS berhasil dikirim
            Log::info('SMS OTP dikirim ke ' . $phone . ': ' . $otpCode);
            Log::info('Pesan: ' . $message);
            
            // Simpan ke file untuk simulasi SMS masuk
            $smsFile = storage_path('logs/sms_inbox.txt');
            $timestamp = now()->format('Y-m-d H:i:s');
            $smsContent = "[{$timestamp}] SMS ke {$phone}: {$message}\n";
            file_put_contents($smsFile, $smsContent, FILE_APPEND | LOCK_EX);
            
            return true;
        } catch (\Exception $e) {
            Log::error('SMS OTP Error: ' . $e->getMessage());
            return false;
        }
    }
    
    private static function formatPhoneNumber($phone)
    {
        // Hapus karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Jika dimulai dengan 0, ganti dengan 62
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // Jika belum ada kode negara, tambahkan 62
        if (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
    
    public static function verifyOtp($identifier, $otpCode)
    {
        return Otp::verifyOtp($identifier, $otpCode);
    }
}