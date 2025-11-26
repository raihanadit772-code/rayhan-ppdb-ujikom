<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran PPDB - Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .hero-section {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="%23ffffff" fill-opacity="0.1" points="0,1000 1000,0 1000,1000"/></svg>');
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: float 20s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
        
        .form-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .step.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            transform: scale(1.1);
        }
        
        .step.completed {
            background: #28a745;
            color: white;
        }
        
        .step::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 100%;
            width: 20px;
            height: 2px;
            background: #e9ecef;
            transform: translateY(-50%);
        }
        
        .step:last-child::after {
            display: none;
        }
        
        .form-section {
            display: none;
            animation: fadeInUp 0.5s ease;
        }
        
        .form-section.active {
            display: block;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-modern {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            color: white;
        }
        
        .floating-label {
            position: relative;
            margin-bottom: 20px;
        }
        
        .floating-label input,
        .floating-label select {
            width: 100%;
            padding: 15px 15px 5px 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            background: transparent;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .floating-label label {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 16px;
            color: #6c757d;
            transition: all 0.3s ease;
            pointer-events: none;
        }
        
        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label,
        .floating-label select:focus + label,
        .floating-label select:not([value=""]) + label {
            top: 5px;
            font-size: 12px;
            color: #667eea;
            font-weight: 500;
        }
        
        .floating-label input:focus,
        .floating-label select:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .progress-bar-custom {
            height: 6px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 3px;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Pendaftaran PPDB 2024</h1>
                    <p class="lead mb-4">Wujudkan masa depan cemerlang bersama kami. Daftar sekarang dan raih kesempatan terbaik!</p>
                    <div class="d-flex justify-content-center gap-4 mb-4">
                        <div class="text-center">
                            <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                            <div>Pendaftaran Dibuka</div>
                            <small>1 Juni - 30 Juni 2024</small>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-users fa-2x mb-2"></i>
                            <div>Kuota Tersedia</div>
                            <small>500 Siswa</small>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-graduation-cap fa-2x mb-2"></i>
                            <div>Program Keahlian</div>
                            <small>8 Jurusan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-container p-5">
                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-muted">Progress Pendaftaran</small>
                                <small class="text-muted"><span id="progress-text">25%</span></small>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar-custom" id="progress-bar" style="width: 25%"></div>
                            </div>
                        </div>

                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            <div class="step active" data-step="1">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="step" data-step="2">
                                <i class="fas fa-school"></i>
                            </div>
                            <div class="step" data-step="3">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="step" data-step="4">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>

                        <form id="registration-form" action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Step 1: Data Pribadi -->
                            <div class="form-section active" id="step-1">
                                <h4 class="mb-4 text-center">Data Pribadi</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <input type="text" name="nama_lengkap" placeholder=" " required>
                                            <label>Nama Lengkap</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <input type="number" name="nisn" placeholder=" " required min="10000000" max="999999999999" oninput="validateNISN(this)">
                                            <label>NISN</label>
                                            <div class="invalid-feedback" id="nisn-error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <input type="text" name="tempat_lahir" placeholder=" " required>
                                            <label>Tempat Lahir</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <input type="date" name="tanggal_lahir" placeholder=" " required>
                                            <label>Tanggal Lahir</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <select name="jenis_kelamin" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            <label>Jenis Kelamin</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <select name="agama" required>
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                            </select>
                                            <label>Agama</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="floating-label">
                                            <textarea name="alamat" rows="3" placeholder=" " required></textarea>
                                            <label>Alamat Lengkap</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-modern" onclick="nextStep()">Selanjutnya <i class="fas fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>

                            <!-- Step 2: Data Sekolah -->
                            <div class="form-section" id="step-2">
                                <h4 class="mb-4 text-center">Data Sekolah Asal</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <input type="text" name="asal_sekolah" placeholder=" " required>
                                            <label>Nama Sekolah Asal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <input type="number" name="tahun_lulus" min="2020" max="2024" placeholder=" " required>
                                            <label>Tahun Lulus</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="floating-label">
                                            <input type="number" name="nilai_matematika" min="0" max="100" placeholder=" " required>
                                            <label>Nilai Matematika</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="floating-label">
                                            <input type="number" name="nilai_bahasa_indonesia" min="0" max="100" placeholder=" " required>
                                            <label>Nilai B. Indonesia</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="floating-label">
                                            <input type="number" name="nilai_bahasa_inggris" min="0" max="100" placeholder=" " required>
                                            <label>Nilai B. Inggris</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <input type="tel" name="no_hp" placeholder=" " required>
                                            <label>No. HP/WhatsApp</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <input type="email" name="email" placeholder=" " required>
                                            <label>Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-secondary" onclick="prevStep()"><i class="fas fa-arrow-left me-2"></i>Sebelumnya</button>
                                    <button type="button" class="btn btn-modern" onclick="nextStep()">Selanjutnya <i class="fas fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>

                            <!-- Step 3: Pilihan Jurusan -->
                            <div class="form-section" id="step-3">
                                <h4 class="mb-4 text-center">Pilihan Program Keahlian</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <select name="pilihan_1" required>
                                                <option value="">Pilih Program Keahlian</option>
                                                @foreach($jurusan as $j)
                                                <option value="{{ $j->id }}">{{ $j->nama }}</option>
                                                @endforeach
                                            </select>
                                            <label>Pilihan 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="floating-label">
                                            <select name="pilihan_2">
                                                <option value="">Pilih Program Keahlian</option>
                                                @foreach($jurusan as $j)
                                                <option value="{{ $j->id }}">{{ $j->nama }}</option>
                                                @endforeach
                                            </select>
                                            <label>Pilihan 2 (Opsional)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-secondary" onclick="prevStep()"><i class="fas fa-arrow-left me-2"></i>Sebelumnya</button>
                                    <button type="button" class="btn btn-modern" onclick="nextStep()">Selanjutnya <i class="fas fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>

                            <!-- Step 4: Konfirmasi -->
                            <div class="form-section" id="step-4">
                                <h4 class="mb-4 text-center">Konfirmasi Pendaftaran</h4>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Pastikan semua data yang Anda masukkan sudah benar sebelum mengirim pendaftaran.
                                </div>
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="agreement" required>
                                    <label class="form-check-label" for="agreement">
                                        Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan.
                                    </label>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-secondary" onclick="prevStep()"><i class="fas fa-arrow-left me-2"></i>Sebelumnya</button>
                                    <button type="submit" class="btn btn-modern btn-lg"><i class="fas fa-paper-plane me-2"></i>Daftar Sekarang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentStep = 1;
        const totalSteps = 4;
        
        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progress-bar').style.width = progress + '%';
            document.getElementById('progress-text').textContent = Math.round(progress) + '%';
        }
        
        function updateSteps() {
            document.querySelectorAll('.step').forEach((step, index) => {
                const stepNumber = index + 1;
                step.classList.remove('active', 'completed');
                
                if (stepNumber < currentStep) {
                    step.classList.add('completed');
                } else if (stepNumber === currentStep) {
                    step.classList.add('active');
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
            } else {
                input.classList.remove('is-invalid');
                errorDiv.textContent = '';
            }
        }
        
        // Floating label animation
        document.querySelectorAll('.floating-label select').forEach(select => {
            select.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.value !== '') {
                    label.style.top = '5px';
                    label.style.fontSize = '12px';
                    label.style.color = '#667eea';
                } else {
                    label.style.top = '15px';
                    label.style.fontSize = '16px';
                    label.style.color = '#6c757d';
                }
            });
        });
    </script>
</body>
</html>