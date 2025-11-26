<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pendaftaran - Verifikator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .document-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .verification-card {
            border-left: 4px solid #007bff;
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
                        <i class="fas fa-user-check me-2"></i>Verifikator
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link text-white" href="{{ route('verifikator.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link text-white" href="{{ route('verifikator.pendaftaran') }}">
                            <i class="fas fa-file-alt me-2"></i>Data Pendaftaran
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
                        <h2>Detail Pendaftaran</h2>
                        <a href="{{ route('verifikator.pendaftaran') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Data Pribadi -->
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Data Pribadi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>No. Pendaftaran:</strong></td>
                                                    <td>{{ $pendaftaran->no_pendaftaran }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Nama Lengkap:</strong></td>
                                                    <td>{{ $pendaftaran->nama_lengkap }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>NISN:</strong></td>
                                                    <td>{{ $pendaftaran->nisn }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tempat, Tanggal Lahir:</strong></td>
                                                    <td>{{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir->format('d F Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Jenis Kelamin:</strong></td>
                                                    <td>{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Agama:</strong></td>
                                                    <td>{{ $pendaftaran->agama }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Asal Sekolah:</strong></td>
                                                    <td>{{ $pendaftaran->asal_sekolah }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tahun Lulus:</strong></td>
                                                    <td>{{ $pendaftaran->tahun_lulus }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>No. HP:</strong></td>
                                                    <td>{{ $pendaftaran->no_hp }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Email:</strong></td>
                                                    <td>{{ $pendaftaran->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Alamat:</strong></td>
                                                    <td>{{ $pendaftaran->alamat }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Nilai dan Pilihan Jurusan -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Nilai dan Pilihan Jurusan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Nilai Rapor</h6>
                                            <table class="table table-sm">
                                                <tr>
                                                    <td>Matematika</td>
                                                    <td><span class="badge bg-primary">{{ $pendaftaran->nilai_matematika }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Bahasa Indonesia</td>
                                                    <td><span class="badge bg-primary">{{ $pendaftaran->nilai_bahasa_indonesia }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Bahasa Inggris</td>
                                                    <td><span class="badge bg-primary">{{ $pendaftaran->nilai_bahasa_inggris }}</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Pilihan Jurusan</h6>
                                            <table class="table table-sm">
                                                <tr>
                                                    <td>Pilihan 1</td>
                                                    <td>{{ $pendaftaran->jurusanPilihan1->nama ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pilihan 2</td>
                                                    <td>{{ $pendaftaran->jurusanPilihan2->nama ?? '-' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dokumen -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Dokumen Pendukung</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @if($pendaftaran->pas_foto_path)
                                        <div class="col-md-3 mb-3">
                                            <h6>Pas Foto</h6>
                                            <img src="{{ asset('storage/' . $pendaftaran->pas_foto_path) }}" class="document-preview img-thumbnail" alt="Pas Foto">
                                        </div>
                                        @endif
                                        @if($pendaftaran->ijazah_path)
                                        <div class="col-md-3 mb-3">
                                            <h6>Ijazah</h6>
                                            <img src="{{ asset('storage/' . $pendaftaran->ijazah_path) }}" class="document-preview img-thumbnail" alt="Ijazah">
                                        </div>
                                        @endif
                                        @if($pendaftaran->kartu_keluarga_path)
                                        <div class="col-md-3 mb-3">
                                            <h6>Kartu Keluarga</h6>
                                            <img src="{{ asset('storage/' . $pendaftaran->kartu_keluarga_path) }}" class="document-preview img-thumbnail" alt="KK">
                                        </div>
                                        @endif
                                        @if($pendaftaran->akta_lahir_path)
                                        <div class="col-md-3 mb-3">
                                            <h6>Akta Lahir</h6>
                                            <img src="{{ asset('storage/' . $pendaftaran->akta_lahir_path) }}" class="document-preview img-thumbnail" alt="Akta">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Verifikasi -->
                        <div class="col-md-4">
                            <div class="card verification-card">
                                <div class="card-header">
                                    <h5 class="mb-0">Status Verifikasi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Status Saat Ini:</strong><br>
                                        @if($pendaftaran->status_verifikasi == 'belum_diverifikasi')
                                            <span class="badge bg-warning fs-6">Belum Diverifikasi</span>
                                        @elseif($pendaftaran->status_verifikasi == 'diverifikasi')
                                            <span class="badge bg-success fs-6">Diverifikasi</span>
                                        @else
                                            <span class="badge bg-danger fs-6">Ditolak</span>
                                        @endif
                                    </div>

                                    @if($pendaftaran->verifikator)
                                    <div class="mb-3">
                                        <strong>Diverifikasi oleh:</strong><br>
                                        {{ $pendaftaran->verifikator->name }}<br>
                                        <small class="text-muted">{{ $pendaftaran->tanggal_verifikasi->format('d F Y H:i') }}</small>
                                    </div>
                                    @endif

                                    @if($pendaftaran->catatan_verifikasi)
                                    <div class="mb-3">
                                        <strong>Catatan:</strong><br>
                                        <div class="alert alert-info">{{ $pendaftaran->catatan_verifikasi }}</div>
                                    </div>
                                    @endif

                                    <form method="POST" action="{{ route('verifikator.verifikasi', $pendaftaran->id) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Status Verifikasi</label>
                                            <select name="status_verifikasi" class="form-select" required>
                                                <option value="">Pilih Status</option>
                                                <option value="diverifikasi" {{ $pendaftaran->status_verifikasi == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                                <option value="ditolak" {{ $pendaftaran->status_verifikasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Catatan</label>
                                            <textarea name="catatan_verifikasi" class="form-control" rows="4" placeholder="Berikan catatan verifikasi...">{{ $pendaftaran->catatan_verifikasi }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-save me-2"></i>Simpan Verifikasi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>