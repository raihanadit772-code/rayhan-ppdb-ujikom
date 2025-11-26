@extends('layout.main')

@section('title', 'Pendaftaran - PPDB SMK')

@section('content')

<!-- Page Title -->
<div class="page-title" data-aos="fade">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1>Pendaftaran PPDB</h1>
          <p class="mb-0">Daftar sekarang dan wujudkan masa depan cemerlang bersama kami</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Info Pendaftaran -->
<section id="info-pendaftaran" class="section">
  <div class="container">
    
    <!-- Jadwal Pendaftaran -->
    <div class="row mb-5">
      <div class="col-12" data-aos="fade-up">
        <div class="alert alert-primary">
          <h4><i class="fas fa-calendar-alt"></i> Jadwal Pendaftaran PPDB 2026</h4>
          <div class="row">
            <div class="col-md-6">
              <p><strong>Pendaftaran Online:</strong><br>
              1 Juni - 30 Juni 2026</p>
            </div>
            <div class="col-md-6">
              <p><strong>Pengumuman Hasil:</strong><br>
              15 Juli 2026</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Syarat Pendaftaran -->
    <div class="section-title" data-aos="fade-up">
      <h2>Syarat Pendaftaran</h2>
      <p>Pastikan Anda memenuhi semua persyaratan berikut sebelum mendaftar</p>
    </div>

    <div class="row gy-4 mb-5">
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-user-graduate text-primary"></i> Persyaratan Umum</h5>
            <ul>
              <li>Lulusan SMP/MTs atau sederajat</li>
              <li>Usia maksimal 16 tahun pada 1 Juli 2026</li>
              <li>Sehat jasmani dan rohani</li>
              <li>Tidak buta warna (untuk jurusan tertentu)</li>
              <li>Berkelakuan baik</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-file-alt text-primary"></i> Dokumen yang Diperlukan</h5>
            <ul>
              <li>Ijazah SMP/MTs (asli dan fotokopi)</li>
              <li>SKHUN SMP/MTs (asli dan fotokopi)</li>
              <li>Kartu Keluarga (fotokopi)</li>
              <li>Akta Kelahiran (fotokopi)</li>
              <li>Pas foto 3x4 (3 lembar)</li>
              <li>Surat keterangan sehat dari dokter</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Alur Pendaftaran -->
    <div class="section-title" data-aos="fade-up">
      <h2>Alur Pendaftaran</h2>
      <p>Ikuti langkah-langkah berikut untuk mendaftar</p>
    </div>

    <div class="row gy-4 mb-5">
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="service-item position-relative text-center">
          <div class="icon">
            <span class="badge bg-primary fs-3">1</span>
          </div>
          <h4>Registrasi Online</h4>
          <p>Daftar akun di website PPDB dan lengkapi data diri</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="service-item position-relative text-center">
          <div class="icon">
            <span class="badge bg-primary fs-3">2</span>
          </div>
          <h4>Upload Dokumen</h4>
          <p>Unggah semua dokumen persyaratan dalam format PDF/JPG</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="service-item position-relative text-center">
          <div class="icon">
            <span class="badge bg-primary fs-3">3</span>
          </div>
          <h4>Pilih Jurusan</h4>
          <p>Pilih maksimal 2 program keahlian sesuai minat</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
        <div class="service-item position-relative text-center">
          <div class="icon">
            <span class="badge bg-primary fs-3">4</span>
          </div>
          <h4>Submit & Cetak</h4>
          <p>Submit pendaftaran dan cetak kartu peserta</p>
        </div>
      </div>
    </div>

    <!-- Form Pendaftaran -->
    <div class="section-title" data-aos="fade-up">
      <h2>Form Pendaftaran Online</h2>
      <p>Isi form berikut untuk memulai proses pendaftaran</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
        <form action="{{ route('pendaftaran.store') }}" method="post" class="php-email-form" enctype="multipart/form-data">
          @csrf
          
          <!-- Data Pribadi -->
          <div class="card mb-4">
            <div class="card-header">
              <h5><i class="fas fa-user"></i> Data Pribadi</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="nama_lengkap">Nama Lengkap *</label>
                  <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="nisn">NISN *</label>
                  <input type="number" class="form-control" name="nisn" id="nisn" placeholder="Masukkan NISN (8-12 digit)" required min="10000000" max="999999999999" oninput="validateNISN(this)">
                  <div class="invalid-feedback" id="nisn-error"></div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group mt-3">
                  <label for="tempat_lahir">Tempat Lahir *</label>
                  <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" required>
                </div>
                <div class="col-md-6 form-group mt-3">
                  <label for="tanggal_lahir">Tanggal Lahir *</label>
                  <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group mt-3">
                  <label for="jenis_kelamin">Jenis Kelamin *</label>
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="col-md-6 form-group mt-3">
                  <label for="agama">Agama *</label>
                  <select name="agama" id="agama" class="form-select" required>
                    <option value="">Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Sekolah Asal -->
          <div class="card mb-4">
            <div class="card-header">
              <h5><i class="fas fa-school"></i> Data Sekolah Asal</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="asal_sekolah">Nama Sekolah Asal *</label>
                  <input type="text" name="asal_sekolah" class="form-control" id="asal_sekolah" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="tahun_lulus">Tahun Lulus *</label>
                  <input type="number" class="form-control" name="tahun_lulus" id="tahun_lulus" min="2020" max="2024" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 form-group mt-3">
                  <label for="nilai_matematika">Nilai Matematika *</label>
                  <input type="number" name="nilai_matematika" class="form-control" id="nilai_matematika" min="0" max="100" required>
                </div>
                <div class="col-md-4 form-group mt-3">
                  <label for="nilai_bahasa_indonesia">Nilai Bahasa Indonesia *</label>
                  <input type="number" class="form-control" name="nilai_bahasa_indonesia" id="nilai_bahasa_indonesia" min="0" max="100" required>
                </div>
                <div class="col-md-4 form-group mt-3">
                  <label for="nilai_bahasa_inggris">Nilai Bahasa Inggris *</label>
                  <input type="number" class="form-control" name="nilai_bahasa_inggris" id="nilai_bahasa_inggris" min="0" max="100" required>
                </div>
              </div>
            </div>
          </div>

          <!-- Pilihan Jurusan -->
          <div class="card mb-4">
            <div class="card-header">
              <h5><i class="fas fa-graduation-cap"></i> Pilihan Program Keahlian</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="pilihan_1">Pilihan 1 *</label>
                  <select name="pilihan_1" id="pilihan_1" class="form-select" required>
                    <option value="">Pilih Program Keahlian</option>
                    @foreach($jurusan as $j)
                    <option value="{{ $j->id }}">{{ $j->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="pilihan_2">Pilihan 2 (Opsional)</label>
                  <select name="pilihan_2" id="pilihan_2" class="form-select">
                    <option value="">Pilih Program Keahlian</option>
                    @foreach($jurusan as $j)
                    <option value="{{ $j->id }}">{{ $j->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Kontak -->
          <div class="card mb-4">
            <div class="card-header">
              <h5><i class="fas fa-phone"></i> Data Kontak</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="no_hp">No. HP/WhatsApp *</label>
                  <input type="tel" name="no_hp" class="form-control" id="no_hp" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="email">Email *</label>
                  <div class="input-group">
                    <input type="email" class="form-control" name="email" id="email" required>
                    <button type="button" class="btn btn-outline-primary" id="sendOtpBtn" onclick="sendOtp()">
                      <i class="fas fa-paper-plane"></i> Kirim OTP
                    </button>
                  </div>
                </div>
              </div>
              <div class="row" id="otpSection" style="display: none;">
                <div class="col-md-6 form-group mt-3">
                  <label for="otp_code">Kode OTP *</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="otp_code" id="otp_code" placeholder="Masukkan 6 digit kode OTP" maxlength="6">
                    <button type="button" class="btn btn-outline-success" id="verifyOtpBtn" onclick="verifyOtp()">
                      <i class="fas fa-check"></i> Verifikasi
                    </button>
                  </div>
                  <small class="text-muted">Cek email Anda untuk mendapatkan kode OTP</small>
                </div>
                <div class="col-md-6 form-group mt-3">
                  <div class="alert alert-info" id="otpStatus" style="display: none;">
                    <span id="otpMessage"></span>
                  </div>
                </div>
              </div>
              <div class="form-group mt-3">
                <label for="alamat">Alamat Lengkap *</label>
                <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
              </div>
            </div>
          </div>

          <!-- Upload Dokumen -->
          <div class="card mb-4">
            <div class="card-header">
              <h5><i class="fas fa-upload"></i> Upload Dokumen (Opsional)</h5>
            </div>
            <div class="card-body">
              <p class="text-muted">Dokumen dapat diupload nanti setelah pendaftaran berhasil.</p>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="ijazah">Ijazah/SKL (PDF/JPG, Max 2MB)</label>
                  <input type="file" name="ijazah" class="form-control" id="ijazah" accept=".pdf,.jpg,.jpeg">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="kartu_keluarga">Kartu Keluarga (PDF/JPG, Max 2MB)</label>
                  <input type="file" class="form-control" name="kartu_keluarga" id="kartu_keluarga" accept=".pdf,.jpg,.jpeg">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group mt-3">
                  <label for="akta_lahir">Akta Kelahiran (PDF/JPG, Max 2MB)</label>
                  <input type="file" name="akta_lahir" class="form-control" id="akta_lahir" accept=".pdf,.jpg,.jpeg">
                </div>
                <div class="col-md-6 form-group mt-3">
                  <label for="pas_foto">Pas Foto 3x4 (JPG, Max 1MB)</label>
                  <input type="file" class="form-control" name="pas_foto" id="pas_foto" accept=".jpg,.jpeg">
                </div>
              </div>
            </div>
          </div>

          @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          
          @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <!-- Pernyataan -->
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="pernyataan" required>
            <label class="form-check-label" for="pernyataan">
              Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan. 
              Apabila dikemudian hari terbukti data yang saya berikan tidak benar, maka saya bersedia menerima sanksi sesuai ketentuan yang berlaku.
            </label>
          </div>

          <div class="text-center">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Pendaftaran berhasil dikirim! Silakan cek email untuk konfirmasi.</div>
            <button type="submit" class="btn btn-primary btn-lg">
              <i class="fas fa-paper-plane"></i> Daftar Sekarang
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Info Tambahan -->
    <div class="row mt-5">
      <div class="col-12" data-aos="fade-up">
        <div class="alert alert-warning">
          <h5><i class="fas fa-exclamation-triangle"></i> Informasi Penting:</h5>
          <ul class="mb-0">
            <li>Pastikan semua data yang diisi sudah benar sebelum submit</li>
            <li>Simpan nomor pendaftaran yang akan diberikan setelah submit</li>
            <li>Cek email secara berkala untuk informasi lebih lanjut</li>
            <li>Untuk bantuan, hubungi panitia PPDB di nomor: <strong>0812-3456-7890</strong></li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
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

function showOtpMessage(message, type) {
    const statusDiv = document.getElementById('otpStatus');
    const messageSpan = document.getElementById('otpMessage');
    
    statusDiv.className = `alert alert-${type}`;
    messageSpan.textContent = message;
    statusDiv.style.display = 'block';
}

function sendOtp() {
    const email = document.getElementById('email').value;
    const sendBtn = document.getElementById('sendOtpBtn');
    
    if (!email) {
        showOtpMessage('Email harus diisi terlebih dahulu', 'danger');
        return;
    }
    
    // Validate email format
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showOtpMessage('Format email tidak valid', 'danger');
        return;
    }
    
    sendBtn.disabled = true;
    sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
    
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
            showOtpMessage(data.message, 'success');
            document.getElementById('otpSection').style.display = 'block';
        } else {
            showOtpMessage(data.message, 'danger');
        }
    })
    .catch(error => {
        showOtpMessage('Terjadi kesalahan: ' + error.message, 'danger');
    })
    .finally(() => {
        sendBtn.disabled = false;
        sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim OTP';
    });
}

function verifyOtp() {
    const email = document.getElementById('email').value;
    const otpCode = document.getElementById('otp_code').value;
    const verifyBtn = document.getElementById('verifyOtpBtn');
    
    if (!otpCode || otpCode.length !== 6) {
        showOtpMessage('Kode OTP harus 6 digit', 'danger');
        return;
    }
    
    verifyBtn.disabled = true;
    verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifikasi...';
    
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
            showOtpMessage('✓ ' + data.message, 'success');
            document.getElementById('email').readOnly = true;
            document.getElementById('otp_code').readOnly = true;
            document.getElementById('sendOtpBtn').style.display = 'none';
            verifyBtn.innerHTML = '<i class="fas fa-check"></i> Terverifikasi';
            verifyBtn.disabled = true;
            verifyBtn.className = 'btn btn-success';
        } else {
            showOtpMessage(data.message, 'danger');
        }
    })
    .catch(error => {
        showOtpMessage('Terjadi kesalahan: ' + error.message, 'danger');
    })
    .finally(() => {
        if (!document.getElementById('otp_code').readOnly) {
            verifyBtn.disabled = false;
            verifyBtn.innerHTML = '<i class="fas fa-check"></i> Verifikasi';
        }
    });
}
</script>

@endsection