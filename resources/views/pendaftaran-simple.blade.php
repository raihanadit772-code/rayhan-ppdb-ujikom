@extends('layout.main')

@section('title', 'Pendaftaran - PPDB SMK')

@section('content')

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

<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $error)
          <div>{{ $error }}</div>
          @endforeach
        </div>
        @endif

        <div class="card">
          <div class="card-header">
            <h4>Form Pendaftaran PPDB 2026</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('pendaftaran.store') }}">
              @csrf
              
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Nama Lengkap *</label>
                  <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">NISN *</label>
                  <input type="number" name="nisn" class="form-control" placeholder="8-12 digit" required min="10000000" max="999999999999" oninput="validateNISN(this)">
                  <div class="invalid-feedback" id="nisn-error"></div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Tempat Lahir *</label>
                  <input type="text" name="tempat_lahir" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Tanggal Lahir *</label>
                  <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Jenis Kelamin *</label>
                  <select name="jenis_kelamin" class="form-select" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Agama *</label>
                  <select name="agama" class="form-select" required>
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

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Asal Sekolah *</label>
                  <input type="text" name="asal_sekolah" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Tahun Lulus *</label>
                  <input type="number" name="tahun_lulus" class="form-control" min="2020" max="2024" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label">Nilai Matematika *</label>
                  <input type="number" name="nilai_matematika" class="form-control" min="0" max="100" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Nilai B. Indonesia *</label>
                  <input type="number" name="nilai_bahasa_indonesia" class="form-control" min="0" max="100" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Nilai B. Inggris *</label>
                  <input type="number" name="nilai_bahasa_inggris" class="form-control" min="0" max="100" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Pilihan Jurusan 1 *</label>
                  <select name="pilihan_1" class="form-select" required>
                    <option value="">Pilih Jurusan</option>
                    @foreach($jurusan as $j)
                    <option value="{{ $j->id }}">{{ $j->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Pilihan Jurusan 2 (Opsional)</label>
                  <select name="pilihan_2" class="form-select">
                    <option value="">Pilih Jurusan</option>
                    @foreach($jurusan as $j)
                    <option value="{{ $j->id }}">{{ $j->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">No. HP/WhatsApp *</label>
                  <input type="text" name="no_hp" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Email *</label>
                  <input type="email" name="email" class="form-control" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Alamat Lengkap *</label>
                <textarea name="alamat" class="form-control" rows="3" required></textarea>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="pernyataan" required>
                <label class="form-check-label" for="pernyataan">
                  Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan.
                </label>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">
                  <i class="fas fa-paper-plane"></i> Daftar Sekarang
                </button>
              </div>
            </form>
          </div>
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
</script>

@endsection