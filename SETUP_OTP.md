# Setup OTP Email & SMS

## 1. Setup Email (Gmail)

### Langkah 1: Aktifkan 2-Factor Authentication di Gmail
1. Buka https://myaccount.google.com/security
2. Aktifkan "2-Step Verification"

### Langkah 2: Generate App Password
1. Di halaman Security, klik "App passwords"
2. Pilih "Mail" dan "Other (custom name)"
3. Masukkan nama: "PPDB Laravel"
4. Copy password yang di-generate (16 karakter)

### Langkah 3: Update .env
```
MAIL_PASSWORD=your_16_character_app_password
```

## 2. Setup SMS (Fonnte - Gratis)

### Langkah 1: Daftar di Fonnte
1. Buka https://fonnte.com
2. Daftar akun gratis
3. Verifikasi nomor WhatsApp Anda

### Langkah 2: Dapatkan API Key
1. Login ke dashboard Fonnte
2. Buka menu "API"
3. Copy API Key Anda

### Langkah 3: Update .env
```
SMS_API_KEY=your_fonnte_api_key
```

## 3. Testing

### Test Email:
```bash
php artisan tinker
```
```php
Mail::raw('Test email', function($message) {
    $message->to('your_email@gmail.com')->subject('Test');
});
```

### Test SMS:
Buka: http://127.0.0.1:8001/debug-otp
Kirim OTP dan cek apakah masuk ke HP

## 4. Troubleshooting

### Email tidak masuk:
- Cek folder spam
- Pastikan App Password benar
- Cek log: `storage/logs/laravel.log`

### SMS tidak masuk:
- Pastikan nomor HP format Indonesia (08xxx)
- Cek saldo Fonnte
- Cek log error di `storage/logs/laravel.log`

## 5. Format Nomor HP yang Didukung:
- 08123456789 ✅
- +628123456789 ✅
- 628123456789 ✅
- 8123456789 ✅