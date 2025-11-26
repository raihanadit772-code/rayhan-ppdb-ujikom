<!DOCTYPE html>
<html>
<head>
    <title>Test OTP Email</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .message { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .otp-section { display: none; margin-top: 20px; padding: 20px; background: #f8f9fa; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Test Verifikasi OTP Email</h2>
    
    <div id="send-section">
        <div class="form-group">
            <label>Email:</label>
            <input type="email" id="email" placeholder="Masukkan email Anda" required>
        </div>
        <button onclick="sendOtp()">Kirim OTP</button>
    </div>
    
    <div id="verify-section" class="otp-section">
        <div class="form-group">
            <label>Kode OTP:</label>
            <input type="text" id="otp_code" placeholder="Masukkan 6 digit kode OTP" maxlength="6" required>
        </div>
        <button onclick="verifyOtp()">Verifikasi OTP</button>
    </div>
    
    <div id="message"></div>

    <script>
        function showMessage(message, type) {
            const messageDiv = document.getElementById('message');
            messageDiv.innerHTML = `<div class="message ${type}">${message}</div>`;
        }

        function sendOtp() {
            const email = document.getElementById('email').value;
            
            if (!email) {
                showMessage('Email harus diisi', 'error');
                return;
            }

            fetch('/otp/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage(data.message, 'success');
                    document.getElementById('verify-section').style.display = 'block';
                } else {
                    showMessage(data.message, 'error');
                }
            })
            .catch(error => {
                showMessage('Terjadi kesalahan: ' + error.message, 'error');
            });
        }

        function verifyOtp() {
            const email = document.getElementById('email').value;
            const otpCode = document.getElementById('otp_code').value;
            
            if (!otpCode || otpCode.length !== 6) {
                showMessage('Kode OTP harus 6 digit', 'error');
                return;
            }

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
                    showMessage(data.message, 'success');
                } else {
                    showMessage(data.message, 'error');
                }
            })
            .catch(error => {
                showMessage('Terjadi kesalahan: ' + error.message, 'error');
            });
        }
    </script>
</body>
</html>