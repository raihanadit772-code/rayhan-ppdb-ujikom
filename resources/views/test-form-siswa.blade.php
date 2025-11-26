<!DOCTYPE html>
<html>
<head>
    <title>Test Form Siswa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Test Form Pendaftaran Siswa</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
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
        
        <form method="POST" action="{{ route('siswa.simpan-formulir') }}">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="Test User" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>NISN *</label>
                    <input type="number" name="nisn" class="form-control" value="12345678" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tempat Lahir *</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="Jakarta" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tanggal Lahir *</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="2008-01-01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Jenis Kelamin *</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="L">Laki-laki</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Agama *</label>
                    <select name="agama" class="form-select" required>
                        <option value="Islam">Islam</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Asal Sekolah *</label>
                    <input type="text" name="asal_sekolah" class="form-control" value="SMP Test" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tahun Lulus *</label>
                    <input type="number" name="tahun_lulus" class="form-control" value="2024" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Nilai Matematika *</label>
                    <input type="number" name="nilai_matematika" class="form-control" value="85" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Nilai Bahasa Indonesia *</label>
                    <input type="number" name="nilai_bahasa_indonesia" class="form-control" value="80" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Nilai Bahasa Inggris *</label>
                    <input type="number" name="nilai_bahasa_inggris" class="form-control" value="75" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Pilihan 1 *</label>
                    <select name="pilihan_1" class="form-select" required>
                        <option value="1">Jurusan 1</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Pilihan 2</label>
                    <select name="pilihan_2" class="form-select">
                        <option value="">Tidak ada</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>No. HP *</label>
                    <input type="text" name="no_hp" class="form-control" value="081234567890" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email OTP *</label>
                    <input type="email" name="email_otp" class="form-control" value="test@example.com" required>
                </div>
                <div class="col-12 mb-3">
                    <label>Alamat *</label>
                    <textarea name="alamat" class="form-control" required>Jl. Test No. 123</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Nama Ayah *</label>
                    <input type="text" name="nama_ayah" class="form-control" value="Ayah Test" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Pekerjaan Ayah *</label>
                    <input type="text" name="pekerjaan_ayah" class="form-control" value="Pegawai" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Nama Ibu *</label>
                    <input type="text" name="nama_ibu" class="form-control" value="Ibu Test" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Pekerjaan Ibu *</label>
                    <input type="text" name="pekerjaan_ibu" class="form-control" value="Ibu Rumah Tangga" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Nama Wali</label>
                    <input type="text" name="nama_wali" class="form-control" value="">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Pekerjaan Wali</label>
                    <input type="text" name="pekerjaan_wali" class="form-control" value="">
                </div>
                <div class="col-md-6 mb-3">
                    <label>No. HP Orang Tua *</label>
                    <input type="text" name="no_hp_orangtua" class="form-control" value="081234567891" required>
                </div>
                <div class="col-12 mb-3">
                    <label>Alamat Orang Tua *</label>
                    <textarea name="alamat_orangtua" class="form-control" required>Jl. Test Ortu No. 456</textarea>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="submit" name="action" value="draft" class="btn btn-secondary">Simpan Draft</button>
                <button type="submit" name="action" value="kirim" class="btn btn-primary">Kirim Pendaftaran</button>
            </div>
        </form>
    </div>
</body>
</html>