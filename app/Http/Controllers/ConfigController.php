<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ConfigController extends Controller
{
    public function saveConfig(Request $request)
    {
        $type = $request->type;
        $value = $request->value;
        
        $envPath = base_path('.env');
        $envContent = File::get($envPath);
        
        if ($type === 'email') {
            $envContent = preg_replace('/MAIL_PASSWORD=.*/', 'MAIL_PASSWORD=' . $value, $envContent);
        } elseif ($type === 'sms') {
            $envContent = preg_replace('/SMS_API_KEY=.*/', 'SMS_API_KEY=' . $value, $envContent);
        }
        
        File::put($envPath, $envContent);
        
        // Clear config cache
        \Artisan::call('config:clear');
        
        return response()->json(['success' => true]);
    }
    
    public function checkConfig()
    {
        return response()->json([
            'email' => !empty(env('MAIL_PASSWORD')) && env('MAIL_PASSWORD') !== 'app_password_here',
            'sms' => !empty(env('SMS_API_KEY')) && env('SMS_API_KEY') !== 'fonnte_api_key_here'
        ]);
    }
}