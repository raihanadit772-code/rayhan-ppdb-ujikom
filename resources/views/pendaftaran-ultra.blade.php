<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran PPDB - Ultra Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --secondary: #8b5cf6;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1f2937;
            --light: #f8fafc;
            --glass: rgba(255, 255, 255, 0.1);
        }
        
        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .hero-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.3) 0%, transparent 50%);
            z-index: -1;
        }
        
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) { width: 80px; height: 80px; top: 10%; left: 10%; animation-delay: 0s; }
        .shape:nth-child(2) { width: 120px; height: 120px; top: 20%; right: 10%; animation-delay: 2s; }
        .shape:nth-child(3) { width: 60px; height: 60px; bottom: 20%; left: 20%; animation-delay: 4s; }
        .shape:nth-child(4) { width: 100px; height: 100px; bottom: 10%; right: 20%; animation-delay: 1s; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .main-container {
            position: relative;
            z-index: 1;
            padding: 2rem 0;
        }
        
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 
                0 32px 64px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
            position: relative;
        }
        
        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
        }
        
        .step-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
            position: relative;
        }
        
        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        
        .step-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .step-circle::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .step-circle.active::before,
        .step-circle.completed::before {
            opacity: 1;
        }
        
        .step-circle {
            background: #e5e7eb;
            color: #6b7280;
        }
        
        .step-circle.active {
            color: white;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }
        
        .step-circle.completed {
            color: white;
        }
        
        .step-label {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
            transition: color 0.3s ease;
        }
        
        .step-item.active .step-label {
            color: var(--primary);
        }
        
        .step-connector {
            position: absolute;
            top: 30px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e5e7eb;
            z-index: 1;
        }
        
        .step-progress {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 1px;
        }
        
        .form-section {
            display: none;
            padding: 2rem;
            animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .form-section.active {
            display: block;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .input-field {
            width: 100%;
            padding: 1rem 1rem 0.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }
        
        .input-field:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
        
        .input-label {
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 1rem;
            color: #6b7280;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            background: white;
            padding: 0 0.25rem;
        }
        
        .input-field:focus + .input-label,
        .input-field:not(:placeholder-shown) + .input-label {
            top: -0.5rem;
            font-size: 0.75rem;
            color: var(--primary);
            font-weight: 500;
        }
        
        .btn-modern {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 12px;
            padding: 0.875rem 2rem;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-modern:hover::before {
            left: 100%;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(99, 102, 241, 0.4);
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid #e5e7eb;
            color: #6b7280;
        }
        
        .btn-outline:hover {
            background: #f9fafb;
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .section-title h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .section-title p {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .progress-bar-container {
            background: #f1f5f9;
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 4px;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        
        .progress-bar-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .hero-text {
            text-align: center;
            color: white;
            margin-bottom: 3rem;
        }
        
        .hero-text h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #ffffff, #e0e7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-text p {
            font-size: 1.125rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }
        
        @media (max-width: 768px) {
            .hero-text h1 {
                font-size: 2rem;
            }
            
            .step-nav {
                padding: 1rem 0;
            }
            
            .step-circle {
                width: 50px;
                height: 50px;
                font-size: 1rem;
            }
            
            .form-section {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="hero-bg"></div>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="main-container">
        <div class="container">
            <div class="hero-text">
                <h1>Pendaftaran PPDB 2024</h1>
                <p>Bergabunglah dengan sekolah terdepan dan wujudkan masa depan cemerlang Anda bersama kami</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <div class="form-card">
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill" id="main-progress" style="width: 25%"></div>
                        </div>
                        
                        <div class="step-nav">
                            <div class="step-connector">
                                <div class="step-progress" id="step-progress" style="width: 0%"></div>
                            </div>
                            
                            <div class="step-item active" data-step="1">
                                <div class="step-circle active">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="step-label">Data Pribadi</div>
                            </div>
                            
                            <div class="step-item" data-step="2">
                                <div class="step-circle">
                                    <i class="fas fa-school"></i>
                                </div>
                                <div class="step-label">Data Sekolah</div>
                            </div>
                            
                            <div class="step-item" data-step="3">
                                <div class="step-circle">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="step-label">Pilihan Jurusan</div>
                            </div>
                            
                            <div class="step-item" data-step="4">
                                <div class="step-circle">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="step-label">Konfirmasi</div>
                            </div>
                        </div>
                        
                        <form id="ultra-form" action="{{ route('pendaftaran.store') }}" method="POST">
                            @csrf
                            
                            <!-- Step 1: Personal Data -->
                            <div class="form-section active" id="step-1">
                                <div class="section-title">
                                    <h3>Data Pribadi</h3>
                                    <p>Masukkan informasi pribadi Anda dengan lengkap dan benar</p>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="nama_lengkap" class="input-field" placeholder=" " required>
                                            <label class="input-label">Nama Lengkap</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="number" name="nisn" class="input-field" placeholder=" " required min="10000000" max="999999999999" oninput="validateNISN(this)">
                                            <label class="input-label">NISN</label>
                                            <div class="invalid-feedback" id="nisn-error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="tempat_lahir" class="input-field" placeholder=" " required>
                                            <label class="input-label">Tempat Lahir</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="date" name="tanggal_lahir" class="input-field" placeholder=" " required>
                                            <label class="input-label">Tanggal Lahir</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <select name="jenis_kelamin" class="input-field" required>
                                                <option value=""></option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            <label class="input-label">Jenis Kelamin</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <select name="agama" class="input-field" required>
                                                <option value=""></option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                            </select>
                                            <label class="input-label">Agama</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <textarea name="alamat" class="input-field" rows="3" placeholder=" " required></textarea>
                                            <label class="input-label">Alamat Lengkap</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn-modern" onclick="nextStep()">
                                        Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Step 2: School Data -->
                            <div class="form-section" id="step-2">
                                <div class="section-title">
                                    <h3>Data Sekolah Asal</h3>
                                    <p>Informasi tentang sekolah asal dan nilai rapor Anda</p>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="asal_sekolah" class="input-field" placeholder=" " required>
                                            <label class="input-label">Nama Sekolah Asal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="number" name="tahun_lulus" class="input-field" min="2020" max="2024" placeholder=" " required>
                                            <label class="input-label">Tahun Lulus</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="number" name="nilai_matematika" class="input-field" min="0" max="100" placeholder=" " required>
                                            <label class="input-label">Nilai Matematika</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="number" name="nilai_bahasa_indonesia" class="input-field" min="0" max="100" placeholder=" " required>
                                            <label class="input-label">Nilai B. Indonesia</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="number" name="nilai_bahasa_inggris" class="input-field" min="0" max="100" placeholder=" " required>
                                            <label class="input-label">Nilai B. Inggris</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="tel" name="no_hp" class="input-field" placeholder=" " required>
                                            <label class="input-label">No. HP/WhatsApp</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="email" name="email" class="input-field" placeholder=" " required>
                                            <label class="input-label">Email</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn-modern btn-outline" onclick="prevStep()">
                                        <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                                    </button>
                                    <button type="button" class="btn-modern" onclick="nextStep()">
                                        Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Step 3: Major Selection -->
                            <div class="form-section" id="step-3">
                                <div class="section-title">
                                    <h3>Pilihan Program Keahlian</h3>
                                    <p>Pilih program keahlian sesuai minat dan bakat Anda</p>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <select name="pilihan_1" class="input-field" required>
                                                <option value=""></option>
                                                @foreach($jurusan as $j)
                                                <option value="{{ $j->id }}">{{ $j->nama }}</option>
                                                @endforeach
                                            </select>
                                            <label class="input-label">Pilihan 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <select name="pilihan_2" class="input-field">
                                                <option value=""></option>
                                                @foreach($jurusan as $j)
                                                <option value="{{ $j->id }}">{{ $j->nama }}</option>
                                                @endforeach
                                            </select>
                                            <label class="input-label">Pilihan 2 (Opsional)</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn-modern btn-outline" onclick="prevStep()">
                                        <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                                    </button>
                                    <button type="button" class="btn-modern" onclick="nextStep()">
                                        Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Step 4: Confirmation -->
                            <div class="form-section" id="step-4">
                                <div class="section-title">
                                    <h3>Konfirmasi Pendaftaran</h3>
                                    <p>Periksa kembali data Anda sebelum mengirim pendaftaran</p>
                                </div>
                                
                                <div class="alert alert-info border-0" style="background: rgba(59, 130, 246, 0.1); border-radius: 12px;">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Pastikan semua data yang Anda masukkan sudah benar dan lengkap.
                                </div>
                                
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="agreement" required style="transform: scale(1.2);">
                                    <label class="form-check-label ms-2" for="agreement">
                                        Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan.
                                    </label>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn-modern btn-outline" onclick="prevStep()">
                                        <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                                    </button>
                                    <button type="submit" class="btn-modern" style="background: linear-gradient(135deg, var(--success), var(--accent));">
                                        <i class="fas fa-paper-plane me-2"></i>Daftar Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentStep = 1;
        const totalSteps = 4;
        
        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            const stepProgress = ((currentStep - 1) / (totalSteps - 1)) * 100;
            
            document.getElementById('main-progress').style.width = progress + '%';
            document.getElementById('step-progress').style.width = stepProgress + '%';
        }
        
        function updateSteps() {
            document.querySelectorAll('.step-item').forEach((item, index) => {
                const stepNum = index + 1;
                const circle = item.querySelector('.step-circle');
                
                item.classList.remove('active');
                circle.classList.remove('active', 'completed');
                
                if (stepNum < currentStep) {
                    circle.classList.add('completed');
                } else if (stepNum === currentStep) {
                    item.classList.add('active');
                    circle.classList.add('active');
                }
            });
            
            document.querySelectorAll('.form-section').forEach((section, index) => {
                section.classList.remove('active');
                if (index + 1 === currentStep) {
                    section.classList.add('active');
                }
            });
        }
        
        function nextStep() {
            if (currentStep < totalSteps) {
                currentStep++;
                updateSteps();
                updateProgress();
            }
        }
        
        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                updateSteps();
                updateProgress();
            }
        }
        
        // Initialize
        updateProgress();
        
        // NISN Validation
        function validateNISN(input) {
            const value = input.value;
            const errorDiv = document.getElementById('nisn-error');
            
            // Remove non-numeric characters
            input.value = value.replace(/[^0-9]/g, '');
            
            // Check length
            if (input.value.length < 8 || input.value.length > 12) {
                input.classList.add('is-invalid');
                errorDiv.textContent = 'NISN harus terdiri dari 8-12 digit angka';
                errorDiv.style.display = 'block';
                errorDiv.style.color = '#ef4444';
                errorDiv.style.fontSize = '0.875rem';
                errorDiv.style.marginTop = '0.25rem';
            } else {
                input.classList.remove('is-invalid');
                errorDiv.textContent = '';
                errorDiv.style.display = 'none';
            }
        }
        
        // Enhanced input animations
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>