<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .login-header h3 {
            margin: 0;
            font-weight: 600;
        }
        .login-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
        }
        .login-body {
            padding: 2rem;
        }
        .form-floating {
            margin-bottom: 1rem;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .role-icon {
            width: 20px;
            text-align: center;
            margin-right: 8px;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .back-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .back-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <i class="fas fa-graduation-cap fa-2x mb-2"></i>
                <h3>Selamat Datang</h3>
                <p>Silakan login untuk melanjutkan</p>
            </div>
            
            <div class="login-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="form-floating mb-3">
                        <select name="role" id="role" class="form-select" required>
                            <option value="">Pilih Role</option>
                            <option value="admin">
                                <i class="fas fa-user-shield role-icon"></i>Admin
                            </option>
                            <option value="verifikator">
                                <i class="fas fa-user-check role-icon"></i>Verifikator
                            </option>
                            <option value="keuangan">
                                <i class="fas fa-calculator role-icon"></i>Keuangan
                            </option>
                            <option value="kepala_sekolah">
                                <i class="fas fa-user-tie role-icon"></i>Kepala Sekolah
                            </option>
                            <option value="calon_siswa">
                                <i class="fas fa-user-graduate role-icon"></i>Calon Siswa
                            </option>
                        </select>
                        <label for="role">
                            <i class="fas fa-users me-2"></i>Role
                        </label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" name="login" id="login" class="form-control" placeholder="Username atau Email" required value="{{ old('login') }}">
                        <label for="login">
                            <i class="fas fa-user me-2"></i>Username atau Email
                        </label>
                    </div>
                    
                    <div class="form-floating mb-4">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        <label for="password">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-login w-100 mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </form>
                
                <div class="text-center">
                    <p class="mb-2">Belum punya akun siswa? 
                        <a href="{{ route('siswa.register') }}" class="back-link">Buat akun disini</a>
                    </p>
                    <a href="{{ route('home') }}" class="back-link">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Website
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add role icons dynamically
        document.getElementById('role').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const label = document.querySelector('label[for="role"]');
            
            const roleIcons = {
                'admin': 'fas fa-user-shield',
                'verifikator': 'fas fa-user-check', 
                'keuangan': 'fas fa-calculator',
                'kepala_sekolah': 'fas fa-user-tie',
                'calon_siswa': 'fas fa-user-graduate'
            };
            
            if (this.value && roleIcons[this.value]) {
                label.innerHTML = `<i class="${roleIcons[this.value]} me-2"></i>Role`;
            } else {
                label.innerHTML = '<i class="fas fa-users me-2"></i>Role';
            }
        });
    </script>
</body>
</html>