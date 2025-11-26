<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode Verifikasi OTP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 30px; }
        .otp-code { font-size: 32px; font-weight: bold; color: #007bff; text-align: center; padding: 20px; background: #f8f9fa; border-radius: 8px; margin: 20px 0; }
        .footer { margin-top: 30px; font-size: 12px; color: #666; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Kode Verifikasi OTP</h2>
            <p>Sistem PPDB Online</p>
        </div>
        
        <p>Halo,</p>
        <p>Berikut adalah kode verifikasi OTP Anda:</p>
        
        <div class="otp-code">{{ $otpCode }}</div>
        
        <p><strong>Penting:</strong></p>
        <ul>
            <li>Kode ini berlaku selama 5 menit</li>
            <li>Jangan bagikan kode ini kepada siapa pun</li>
            <li>Gunakan kode ini untuk menyelesaikan proses verifikasi</li>
        </ul>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>