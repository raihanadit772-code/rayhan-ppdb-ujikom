<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Formulir Pendaftaran - PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        .form-section {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-3">
                    <h5 class="text-white mb-4">
                        <i class="fas fa-user-graduate me-2"></i>Portal Siswa
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link text-white" href="{{ route('siswa.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link text-white active" href="{{ route('siswa.formulir-pendaftaran') }}">
                            <i class="fas fa-edit me-2"></i>Formulir Pendaftaran
                        </a>
                        <a class="nav-link text-white" href="{{ route('siswa.upload-berkas') }}">
                            <i class="fas fa-upload me-2"></i>Upload Berkas
                        </a>
                        <a class="nav-link text-white" href="{{ route('siswa.status-pendaftaran') }}">
                            <i class="fas fa-list-alt me-2"></i>Status Pendaftaran
                        </a>
                        <a class="nav-link text-white" href="{{ route('siswa.pembayaran') }}">
                            <i class="fas fa-credit-card me-2"></i>Pembayaran
                        </a>
                        <a class="nav-link text-white" href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Formulir Pendaftaran</h2>
                        <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Terdapat kesalahan:</h6>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('siswa.simpan-formulir') }}">
                        @csrf
                        @if($pendaftaran)
                            <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">
                        @endif

                        <!-- Data Pribadi -->
                        <div class="card form-section">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Data Pribadi</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Lengkap *</label>
                                        <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">NISN *</label>
                                        <input type="text" name="nisn" class="form-control {{ $errors->has('nisn') ? 'is-invalid' : '' }}" value="{{ old('nisn', $pendaftaran->nisn ?? '') }}" maxlength="10" pattern="[0-9]{10}" required>
                                        @error('nisn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">10 digit angka</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tempat Lahir *</label>
                                        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Lahir *</label>
                                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenis Kelamin *</label>
                                        <select name="jenis_kelamin" class="form-select" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Agama *</label>
                                        <select name="agama" class="form-select" required>
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" {{ old('agama', $pendaftaran->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen" {{ old('agama', $pendaftaran->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                            <option value="Katolik" {{ old('agama', $pendaftaran->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                            <option value="Hindu" {{ old('agama', $pendaftaran->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Buddha" {{ old('agama', $pendaftaran->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Konghucu" {{ old('agama', $pendaftaran->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No. HP *</label>
                                        <input type="text" name="no_hp" class="form-control {{ $errors->has('no_hp') ? 'is-invalid' : '' }}" value="{{ old('no_hp', $pendaftaran->no_hp ?? '') }}" placeholder="081234567890" required>
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Format: 08xxxxxxxxxx</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email Login</label>
                                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                        <small class="text-muted">Email yang digunakan untuk login</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email untuk Verifikasi OTP *</label>
                                        <div class="input-group">
                                            <input type="email" name="email_otp" id="email_otp" class="form-control {{ $errors->has('email_otp') ? 'is-invalid' : '' }}" placeholder="Masukkan email untuk menerima OTP" value="{{ old('email_otp', $pendaftaran->email ?? '') }}" required>
                                            <button type="button" class="btn btn-outline-primary" onclick="sendOtp()" id="btn-otp-email">
                                                <i class="fas fa-envelope me-1"></i>Kirim OTP
                                            </button>
                                        </div>
                                        @error('email_otp')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Email untuk menerima kode OTP verifikasi</small>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Alamat Domisili *</label>
                                        <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $pendaftaran->alamat ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="row" id="otp-email-section" style="display: none;">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kode OTP Email *</label>
                                        <div class="input-group">
                                            <input type="text" id="otp_email" class="form-control" placeholder="Masukkan 6 digit kode OTP" maxlength="6">
                                            <button type="button" class="btn btn-success" onclick="verifyOtp()">
                                                <i class="fas fa-check me-1"></i>Verifikasi
                                            </button>
                                        </div>
                                        <small class="text-muted">Cek email Anda untuk mendapatkan kode OTP (berlaku 5 menit)</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div id="email-verified" class="alert alert-success" style="display: none;">
                                            <i class="fas fa-check-circle me-1"></i>Email berhasil diverifikasi
                                        </div>
                                        <div id="otp-status" class="alert" style="display: none;">
                                            <span id="otp-message"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Sekolah -->
                        <div class="card form-section">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-school me-2"></i>Data Sekolah Asal</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Asal Sekolah *</label>
                                        <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah', $pendaftaran->asal_sekolah ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tahun Lulus *</label>
                                        <input type="number" name="tahun_lulus" class="form-control" value="{{ old('tahun_lulus', $pendaftaran->tahun_lulus ?? '') }}" min="2020" max="{{ date('Y') + 1 }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Nilai Matematika *</label>
                                        <input type="number" name="nilai_matematika" class="form-control" value="{{ old('nilai_matematika', $pendaftaran->nilai_matematika ?? '') }}" min="0" max="100" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Nilai Bahasa Indonesia *</label>
                                        <input type="number" name="nilai_bahasa_indonesia" class="form-control" value="{{ old('nilai_bahasa_indonesia', $pendaftaran->nilai_bahasa_indonesia ?? '') }}" min="0" max="100" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Nilai Bahasa Inggris *</label>
                                        <input type="number" name="nilai_bahasa_inggris" class="form-control" value="{{ old('nilai_bahasa_inggris', $pendaftaran->nilai_bahasa_inggris ?? '') }}" min="0" max="100" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Orang Tua -->
                        <div class="card form-section">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-users me-2"></i>Data Orang Tua/Wali</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Ayah *</label>
                                        <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $pendaftaran->nama_ayah ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pekerjaan Ayah *</label>
                                        <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Ibu *</label>
                                        <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $pendaftaran->nama_ibu ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pekerjaan Ibu *</label>
                                        <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Wali</label>
                                        <input type="text" name="nama_wali" class="form-control" value="{{ old('nama_wali', $pendaftaran->nama_wali ?? '') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pekerjaan Wali</label>
                                        <input type="text" name="pekerjaan_wali" class="form-control" value="{{ old('pekerjaan_wali', $pendaftaran->pekerjaan_wali ?? '') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No. HP Orang Tua *</label>
                                        <input type="text" name="no_hp_orangtua" class="form-control {{ $errors->has('no_hp_orangtua') ? 'is-invalid' : '' }}" value="{{ old('no_hp_orangtua', $pendaftaran->no_hp_orangtua ?? '') }}" placeholder="081234567890" required>
                                        @error('no_hp_orangtua')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Format: 08xxxxxxxxxx</small>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Alamat Orang Tua *</label>
                                        <textarea name="alamat_orangtua" class="form-control" rows="3" required>{{ old('alamat_orangtua', $pendaftaran->alamat_orangtua ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pilihan Jurusan -->
                        <div class="card form-section">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Pilihan Jurusan</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pilihan 1 *</label>
                                        <select name="pilihan_1" class="form-select" required>
                                            <option value="">Pilih Jurusan</option>
                                            @foreach($jurusan as $j)
                                                <option value="{{ $j->id }}" {{ old('pilihan_1', $pendaftaran->pilihan_1 ?? '') == $j->id ? 'selected' : '' }}>
                                                    {{ $j->nama }} (Kuota: {{ $j->kuota }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pilihan 2</label>
                                        <select name="pilihan_2" class="form-select">
                                            <option value="">Pilih Jurusan</option>
                                            @foreach($jurusan as $j)
                                                <option value="{{ $j->id }}" {{ old('pilihan_2', $pendaftaran->pilihan_2 ?? '') == $j->id ? 'selected' : '' }}>
                                                    {{ $j->nama }} (Kuota: {{ $j->kuota }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" name="action" value="draft" class="btn btn-secondary">
                                        <i class="fas fa-save me-2"></i>Simpan Draft
                                    </button>
                                    <button type="submit" name="action" value="kirim" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pendaftaran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Format NISN input
        document.addEventListener('DOMContentLoaded', function() {
            const nisnInput = document.querySelector('input[name="nisn"]');
            if (nisnInput) {
                nisnInput.addEventListener('input', function(e) {
                    e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 10);
                });
            }
            
            // Format phone numbers
            document.querySelectorAll('input[name="no_hp"], input[name="no_hp_orangtua"]').forEach(function(input) {
                input.addEventListener('input', function(e) {
                    e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 13);
                });
            });
        });
        
        let otpTimer;
        
        function showOtpMessage(message, type) {
            const statusDiv = document.getElementById('otp-status');
            const messageSpan = document.getElementById('otp-message');
            
            statusDiv.className = `alert alert-${type}`;
            messageSpan.textContent = message;
            statusDiv.style.display = 'block';
        }
        
        function sendOtp() {
            const email = document.getElementById('email_otp').value;
            const button = document.getElementById('btn-otp-email');
            
            if (!email) {
                showOtpMessage('Silakan isi email untuk verifikasi OTP terlebih dahulu', 'danger');
                return;
            }
            
            // Validate email format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showOtpMessage('Format email tidak valid', 'danger');
                return;
            }
            
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Mengirim...';
            
            fetch('/otp/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    email: email
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('otp-email-section').style.display = 'block';
                    showOtpMessage(data.message, 'success');
                    startOtpTimer(button);
                } else {
                    showOtpMessage(data.message, 'danger');
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-envelope me-1"></i>Kirim OTP';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showOtpMessage('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-envelope me-1"></i>Kirim OTP';
            });
        }
        
        function verifyOtp() {
            const email = document.getElementById('email_otp').value;
            const otpCode = document.getElementById('otp_email').value;
            const verifyBtn = event.target;
            
            if (!otpCode || otpCode.length !== 6) {
                showOtpMessage('Kode OTP harus 6 digit', 'danger');
                return;
            }
            
            verifyBtn.disabled = true;
            verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Verifikasi...';
            
            fetch('/otp/verify', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    email: email,
                    otp_code: otpCode
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('otp-email-section').style.display = 'none';
                    document.getElementById('email-verified').style.display = 'block';
                    document.getElementById('btn-otp-email').innerHTML = '<i class="fas fa-check me-1"></i>Terverifikasi';
                    document.getElementById('btn-otp-email').className = 'btn btn-success';
                    document.getElementById('btn-otp-email').disabled = true;
                    document.getElementById('email_otp').readOnly = true;
                    showOtpMessage('✓ ' + data.message, 'success');
                } else {
                    showOtpMessage(data.message, 'danger');
                    verifyBtn.disabled = false;
                    verifyBtn.innerHTML = '<i class="fas fa-check me-1"></i>Verifikasi';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showOtpMessage('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                verifyBtn.disabled = false;
                verifyBtn.innerHTML = '<i class="fas fa-check me-1"></i>Verifikasi';
            });
        }
        
        function startOtpTimer(button) {
            let timeLeft = 300; // 5 minutes
            
            otpTimer = setInterval(() => {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                
                button.innerHTML = `<i class="fas fa-clock me-1"></i>Kirim Ulang (${minutes}:${seconds.toString().padStart(2, '0')})`;
                
                if (timeLeft <= 0) {
                    clearInterval(otpTimer);
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-envelope me-1"></i>Kirim OTP';
                }
                
                timeLeft--;
            }, 1000);
        }
    </script>
</body>
</html>