<!DOCTYPE html>
<html>
<head>
    <title>Auto Setup OTP - PPDB Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4><i class="fas fa-magic me-2"></i>Auto Setup OTP - Siap Pakai!</h4>
                    </div>
                    <div class="card-body">
                        
                        <!-- Step 1: Gmail Setup -->
                        <div class="mb-4">
                            <h5><i class="fas fa-envelope text-primary me-2"></i>Step 1: Setup Gmail</h5>
                            <div class="card border-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p><strong>Email:</strong> raihanadit771@gmail.com</p>
                                            <p class="mb-2">Untuk mendapatkan App Password:</p>
                                            <ol class="small">
                                                <li>Buka link di samping</li>
                                                <li>Aktifkan "2-Step Verification" jika belum</li>
                                                <li>Klik "App passwords"</li>
                                                <li>Pilih "Mail" dan "Other"</li>
                                                <li>Nama: "PPDB Laravel"</li>
                                                <li>Copy password 16 karakter</li>
                                                <li>Paste di form di bawah</li>
                                            </ol>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <a href="https://myaccount.google.com/apppasswords" target="_blank" class="btn btn-primary btn-lg">
                                                <i class="fas fa-external-link-alt me-2"></i>
                                                Buka Gmail<br>App Passwords
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <label class="form-label">Gmail App Password:</label>
                                        <div class="input-group">
                                            <input type="text" id="gmail_password" class="form-control" placeholder="Paste 16-character app password here">
                                            <button class="btn btn-success" onclick="saveGmailConfig()">
                                                <i class="fas fa-save me-1"></i>Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 2: SMS Setup -->
                        <div class="mb-4">
                            <h5><i class="fas fa-sms text-success me-2"></i>Step 2: Setup SMS (Fonnte - Gratis)</h5>
                            <div class="card border-success">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="mb-2">Fonnte memberikan 100 pesan gratis per bulan:</p>
                                            <ol class="small">
                                                <li>Klik tombol "Daftar Fonnte"</li>
                                                <li>Daftar dengan nomor WhatsApp Anda</li>
                                                <li>Verifikasi nomor WA</li>
                                                <li>Login ke dashboard</li>
                                                <li>Copy API Key dari dashboard</li>
                                                <li>Paste di form di bawah</li>
                                            </ol>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <a href="https://fonnte.com/register" target="_blank" class="btn btn-success btn-lg">
                                                <i class="fas fa-external-link-alt me-2"></i>
                                                Daftar Fonnte<br>(Gratis)
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <label class="form-label">Fonnte API Key:</label>
                                        <div class="input-group">
                                            <input type="text" id="fonnte_key" class="form-control" placeholder="Paste Fonnte API key here">
                                            <button class="btn btn-success" onclick="saveSmsConfig()">
                                                <i class="fas fa-save me-1"></i>Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status & Test -->
                        <div class="mb-4">
                            <h5><i class="fas fa-check-circle text-info me-2"></i>Status & Test</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Status Konfigurasi:</h6>
                                            <div id="config-status">
                                                <div class="mb-2">
                                                    <i class="fas fa-times text-danger me-2"></i>
                                                    <span>Email: Belum dikonfigurasi</span>
                                                </div>
                                                <div class="mb-2">
                                                    <i class="fas fa-times text-danger me-2"></i>
                                                    <span>SMS: Belum dikonfigurasi</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Test OTP:</h6>
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-outline-primary" onclick="testEmailOtp()" id="test-email-btn" disabled>
                                                    <i class="fas fa-envelope me-1"></i>Test Email OTP
                                                </button>
                                                <button class="btn btn-outline-success" onclick="testSmsOtp()" id="test-sms-btn" disabled>
                                                    <i class="fas fa-sms me-1"></i>Test SMS OTP
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Access -->
                        <div class="text-center">
                            <h6>Setelah setup selesai:</h6>
                            <div class="btn-group" role="group">
                                <a href="/siswa/formulir-pendaftaran" class="btn btn-primary">
                                    <i class="fas fa-edit me-1"></i>Form Pendaftaran
                                </a>
                                <a href="/debug-otp" class="btn btn-info">
                                    <i class="fas fa-bug me-1"></i>Debug OTP
                                </a>
                            </div>
                        </div>
                        
                        <div id="result" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function saveGmailConfig() {
            const password = document.getElementById('gmail_password').value;
            if (!password) {
                alert('Masukkan Gmail App Password');
                return;
            }
            
            fetch('/save-config', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    type: 'email',
                    value: password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateConfigStatus();
                    document.getElementById('result').innerHTML = 
                        '<div class="alert alert-success"><i class="fas fa-check me-2"></i>Gmail berhasil dikonfigurasi!</div>';
                } else {
                    document.getElementById('result').innerHTML = 
                        '<div class="alert alert-danger"><i class="fas fa-times me-2"></i>Gagal menyimpan konfigurasi</div>';
                }
            });
        }
        
        function saveSmsConfig() {
            const apiKey = document.getElementById('fonnte_key').value;
            if (!apiKey) {
                alert('Masukkan Fonnte API Key');
                return;
            }
            
            fetch('/save-config', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    type: 'sms',
                    value: apiKey
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateConfigStatus();
                    document.getElementById('result').innerHTML = 
                        '<div class="alert alert-success"><i class="fas fa-check me-2"></i>SMS berhasil dikonfigurasi!</div>';
                } else {
                    document.getElementById('result').innerHTML = 
                        '<div class="alert alert-danger"><i class="fas fa-times me-2"></i>Gagal menyimpan konfigurasi</div>';
                }
            });
        }
        
        function updateConfigStatus() {
            fetch('/check-config')
            .then(response => response.json())
            .then(data => {
                let html = '';
                html += `<div class="mb-2">
                    <i class="fas fa-${data.email ? 'check text-success' : 'times text-danger'} me-2"></i>
                    <span>Email: ${data.email ? 'Terkonfigurasi' : 'Belum dikonfigurasi'}</span>
                </div>`;
                html += `<div class="mb-2">
                    <i class="fas fa-${data.sms ? 'check text-success' : 'times text-danger'} me-2"></i>
                    <span>SMS: ${data.sms ? 'Terkonfigurasi' : 'Belum dikonfigurasi'}</span>
                </div>`;
                
                document.getElementById('config-status').innerHTML = html;
                
                document.getElementById('test-email-btn').disabled = !data.email;
                document.getElementById('test-sms-btn').disabled = !data.sms;
            });
        }
        
        function testEmailOtp() {
            document.getElementById('result').innerHTML = '<div class="alert alert-info"><i class="fas fa-spinner fa-spin me-2"></i>Mengirim test email...</div>';
            
            fetch('/siswa/send-otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    identifier: 'raihanadit771@gmail.com',
                    type: 'email'
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('result').innerHTML = 
                    `<div class="alert alert-${data.success ? 'success' : 'danger'}">
                        <i class="fas fa-${data.success ? 'check' : 'times'} me-2"></i>${data.message}
                        ${data.success ? '<br><small>Cek inbox email raihanadit771@gmail.com</small>' : ''}
                    </div>`;
            });
        }
        
        function testSmsOtp() {
            const phone = prompt('Masukkan nomor HP untuk test (contoh: 08123456789):');
            if (!phone) return;
            
            document.getElementById('result').innerHTML = '<div class="alert alert-info"><i class="fas fa-spinner fa-spin me-2"></i>Mengirim test SMS...</div>';
            
            fetch('/siswa/send-otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    identifier: phone,
                    type: 'sms'
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('result').innerHTML = 
                    `<div class="alert alert-${data.success ? 'success' : 'danger'}">
                        <i class="fas fa-${data.success ? 'check' : 'times'} me-2"></i>${data.message}
                        ${data.success ? '<br><small>Cek WhatsApp/SMS di nomor ' + phone + '</small>' : ''}
                    </div>`;
            });
        }
        
        // Load status on page load
        document.addEventListener('DOMContentLoaded', updateConfigStatus);
    </script>
</body>
</html>