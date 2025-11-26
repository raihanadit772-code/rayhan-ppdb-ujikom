<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaAuthController;
use App\Http\Controllers\VerifikatorController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KepalaSekolahController;
use App\Http\Controllers\SiswaRegisterController;
use App\Http\Controllers\OtpController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan');
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
Route::get('/pendaftaran-modern', [PendaftaranController::class, 'modern'])->name('pendaftaran.modern');
Route::get('/pendaftaran-ultra', [PendaftaranController::class, 'ultra'])->name('pendaftaran.ultra');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/test-form', function() { 
    $jurusan = App\Models\Jurusan::where('aktif', true)->get();
    return view('test-form', compact('jurusan')); 
});
Route::get('/test-otp', function() {
    return view('test-otp');
});
Route::get('/test-otp-email', function() {
    return view('test-otp-email');
});
Route::get('/debug-otp', function() {
    return view('otp-debug');
});
Route::get('/setup-otp', function() {
    return view('setup-otp');
});
Route::get('/auto-setup-otp', function() {
    return view('auto-setup-otp');
});
Route::post('/save-config', [App\Http\Controllers\ConfigController::class, 'saveConfig']);
Route::get('/check-config', [App\Http\Controllers\ConfigController::class, 'checkConfig']);
Route::get('/otp-dashboard', function() {
    return view('otp-dashboard');
});
Route::get('/sms-setup', function() {
    return view('sms-setup');
});
Route::get('/sms-inbox', function() {
    return view('sms-inbox');
});
Route::post('/clear-sms-inbox', function() {
    $smsFile = storage_path('logs/sms_inbox.txt');
    if (file_exists($smsFile)) {
        unlink($smsFile);
    }
    return response()->json(['success' => true]);
});
Route::get('/otp-ready', function() {
    return view('otp-ready');
});
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/siswa/register', [SiswaRegisterController::class, 'showRegister'])->name('siswa.register');
Route::post('/siswa/register', [SiswaRegisterController::class, 'register']);

// OTP Routes
Route::post('/otp/send', [OtpController::class, 'sendOtp'])->name('otp.send');
Route::post('/otp/verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');

// Admin Routes
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/pendaftaran', [AdminController::class, 'pendaftaran'])->name('admin.pendaftaran');
    Route::get('/pendaftaran/{id}', [AdminController::class, 'detailPendaftaran'])->name('admin.detail-pendaftaran');
    Route::get('/kontak', [AdminController::class, 'kontak'])->name('admin.kontak');
});

// Test route untuk debugging
Route::get('/test-form-siswa', function() {
    return view('test-form-siswa');
})->middleware('siswa');

// Siswa Routes
Route::prefix('siswa')->middleware('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/formulir-pendaftaran', [SiswaController::class, 'formulirPendaftaran'])->name('siswa.formulir-pendaftaran');
    Route::post('/formulir-pendaftaran', [SiswaController::class, 'simpanFormulir'])->name('siswa.simpan-formulir');
    Route::get('/upload-berkas', [SiswaController::class, 'uploadBerkas'])->name('siswa.upload-berkas');
    Route::post('/upload-berkas', [SiswaController::class, 'simpanBerkas'])->name('siswa.simpan-berkas');
    Route::get('/status-pendaftaran', [SiswaController::class, 'statusPendaftaran'])->name('siswa.status-pendaftaran');
    Route::get('/pembayaran', [SiswaController::class, 'pembayaran'])->name('siswa.pembayaran');
    Route::post('/pembayaran/{id}/upload', [SiswaController::class, 'uploadBuktiBayar'])->name('siswa.upload-bukti-bayar');
    Route::get('/cetak-kartu', [SiswaController::class, 'cetakKartu'])->name('siswa.cetak-kartu');
    Route::get('/cetak-bukti-bayar/{id}', [SiswaController::class, 'cetakBuktiBayar'])->name('siswa.cetak-bukti-bayar');
    Route::post('/konfirmasi-pembayaran/{id}', [SiswaController::class, 'konfirmasiPembayaran'])->name('siswa.konfirmasi-pembayaran');
    Route::post('/send-otp', [SiswaController::class, 'sendOtp'])->name('siswa.send-otp');
    Route::post('/verify-otp', [SiswaController::class, 'verifyOtp'])->name('siswa.verify-otp');
});

// Verifikator Routes
Route::prefix('verifikator')->middleware('verifikator')->group(function () {
    Route::get('/dashboard', [VerifikatorController::class, 'dashboard'])->name('verifikator.dashboard');
    Route::get('/pendaftaran', [VerifikatorController::class, 'pendaftaran'])->name('verifikator.pendaftaran');
    Route::get('/pendaftaran/{id}', [VerifikatorController::class, 'detail'])->name('verifikator.detail');
    Route::post('/pendaftaran/{id}/verifikasi', [VerifikatorController::class, 'verifikasi'])->name('verifikator.verifikasi');
});

// Keuangan Routes
Route::prefix('keuangan')->middleware('keuangan')->group(function () {
    Route::get('/dashboard', [KeuanganController::class, 'dashboard'])->name('keuangan.dashboard');
    Route::get('/verifikasi-pembayaran', [KeuanganController::class, 'verifikasiPembayaran'])->name('keuangan.verifikasi-pembayaran');
    Route::get('/pembayaran/{id}', [KeuanganController::class, 'detailPembayaran'])->name('keuangan.detail-pembayaran');
    Route::post('/pembayaran/{id}/verifikasi', [KeuanganController::class, 'prosesVerifikasi'])->name('keuangan.proses-verifikasi');
    Route::get('/rekap-pembayaran', [KeuanganController::class, 'rekapPembayaran'])->name('keuangan.rekap-pembayaran');

});

// Kepala Sekolah Routes
Route::prefix('kepala-sekolah')->middleware('kepala_sekolah')->group(function () {
    Route::get('/dashboard', [KepalaSekolahController::class, 'dashboard'])->name('kepala-sekolah.dashboard');
});
