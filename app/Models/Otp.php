<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Otp extends Model
{
    protected $table = 'otp';
    
    protected $fillable = [
        'identifier',
        'otp_code',
        'type',
        'expires_at',
        'is_verified'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_verified' => 'boolean'
    ];

    public function isExpired()
    {
        return $this->expires_at < now();
    }
    
    public static function generateOtp($identifier, $type = 'email')
    {
        // Delete old OTPs for this identifier
        self::where('identifier', $identifier)->delete();
        
        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $otp = self::create([
            'identifier' => $identifier,
            'otp_code' => $otpCode,
            'type' => $type,
            'expires_at' => Carbon::now()->addMinutes(5),
            'is_verified' => false
        ]);
        
        // Set the otp_code property for return
        $otp->otp_code = $otpCode;
        return $otp;
    }
    
    public static function verifyOtp($identifier, $otpCode)
    {
        $otp = self::where('identifier', $identifier)
                  ->where('otp_code', $otpCode)
                  ->where('is_verified', false)
                  ->first();
                  
        if (!$otp || $otp->isExpired()) {
            return false;
        }
        
        $otp->update(['is_verified' => true]);
        return true;
    }
}