<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Berkas - PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        .upload-card {
            border-radius: 15px;
            border: 2px dashed #dee2e6;
            transition: all 0.3s ease;
        }
        .upload-card:hover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }
        .upload-card.has-file {
            border-color: #28a745;
            background-color: #d4edda;
        }
        .file-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
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
                        <a class="nav-link text-white" href="{{ route('siswa.formulir-pendaftaran') }}">
                            <i class="fas fa-edit me-2"></i>Formulir Pendaftaran
                        </a>
                        <a class="nav-link text-white active" href="{{ route('siswa.upload-berkas') }}">
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
                        <h2>Upload Berkas</h2>
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
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Terdapat kesalahan:</h6>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Upload Instructions -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Petunjuk Upload Berkas</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Format File yang Diterima:</h6>
                                    <ul>
                                        <li>Pas Foto: JPG, JPEG, PNG (Max: 2MB)</li>
                                        <li>Ijazah/Rapor: PDF, JPG, JPEG, PNG (Max: 5MB)</li>
                                        <li>Kartu Keluarga: PDF, JPG, JPEG, PNG (Max: 5MB)</li>
                                        <li>Akta Lahir: PDF, JPG, JPEG, PNG (Max: 5MB)</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>Catatan Penting:</h6>
                                    <ul>
                                        <li>Pastikan file dapat dibaca dengan jelas</li>
                                        <li>Hindari foto yang buram atau gelap</li>
                                        <li>File PDF lebih direkomendasikan</li>
                                        <li>Semua berkas wajib diupload</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('siswa.simpan-berkas') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Pas Foto -->
                            <div class="col-md-6 mb-4">
                                <div class="card upload-card {{ $pendaftaran->pas_foto_path ? 'has-file' : '' }}">
                                    <div class="card-body text-center">
                                        <i class="fas fa-camera fa-3x text-primary mb-3"></i>
                                        <h5>Pas Foto</h5>
                                        <p class="text-muted">Upload pas foto terbaru (3x4)</p>
                                        
                                        @if($pendaftaran->pas_foto_path)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $pendaftaran->pas_foto_path) }}" class="file-preview" alt="Pas Foto">
                                                <div class="mt-2">
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Sudah diupload
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <input type="file" name="pas_foto" class="form-control" accept="image/*">
                                        <small class="text-muted">JPG, JPEG, PNG - Max: 2MB</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Ijazah/Rapor -->
                            <div class="col-md-6 mb-4">
                                <div class="card upload-card {{ $pendaftaran->ijazah_path ? 'has-file' : '' }}">
                                    <div class="card-body text-center">
                                        <i class="fas fa-certificate fa-3x text-success mb-3"></i>
                                        <h5>Ijazah/Rapor</h5>
                                        <p class="text-muted">Upload ijazah atau rapor terakhir</p>
                                        
                                        @if($pendaftaran->ijazah_path)
                                            <div class="mb-3">
                                                <div class="alert alert-success">
                                                    <i class="fas fa-file-alt fa-2x mb-2"></i><br>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Sudah diupload
                                                    </span>
                                                </div>
                                                <a href="{{ asset('storage/' . $pendaftaran->ijazah_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i>Lihat File
                                                </a>
                                            </div>
                                        @endif
                                        
                                        <input type="file" name="ijazah" class="form-control" accept=".pdf,image/*">
                                        <small class="text-muted">PDF, JPG, JPEG, PNG - Max: 5MB</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Kartu Keluarga -->
                            <div class="col-md-6 mb-4">
                                <div class="card upload-card {{ $pendaftaran->kartu_keluarga_path ? 'has-file' : '' }}">
                                    <div class="card-body text-center">
                                        <i class="fas fa-users fa-3x text-info mb-3"></i>
                                        <h5>Kartu Keluarga</h5>
                                        <p class="text-muted">Upload kartu keluarga</p>
                                        
                                        @if($pendaftaran->kartu_keluarga_path)
                                            <div class="mb-3">
                                                <div class="alert alert-success">
                                                    <i class="fas fa-file-alt fa-2x mb-2"></i><br>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Sudah diupload
                                                    </span>
                                                </div>
                                                <a href="{{ asset('storage/' . $pendaftaran->kartu_keluarga_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i>Lihat File
                                                </a>
                                            </div>
                                        @endif
                                        
                                        <input type="file" name="kartu_keluarga" class="form-control" accept=".pdf,image/*">
                                        <small class="text-muted">PDF, JPG, JPEG, PNG - Max: 5MB</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Akta Lahir -->
                            <div class="col-md-6 mb-4">
                                <div class="card upload-card {{ $pendaftaran->akta_lahir_path ? 'has-file' : '' }}">
                                    <div class="card-body text-center">
                                        <i class="fas fa-id-card fa-3x text-warning mb-3"></i>
                                        <h5>Akta Lahir</h5>
                                        <p class="text-muted">Upload akta kelahiran</p>
                                        
                                        @if($pendaftaran->akta_lahir_path)
                                            <div class="mb-3">
                                                <div class="alert alert-success">
                                                    <i class="fas fa-file-alt fa-2x mb-2"></i><br>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Sudah diupload
                                                    </span>
                                                </div>
                                                <a href="{{ asset('storage/' . $pendaftaran->akta_lahir_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i>Lihat File
                                                </a>
                                            </div>
                                        @endif
                                        
                                        <input type="file" name="akta_lahir" class="form-control" accept=".pdf,image/*">
                                        <small class="text-muted">PDF, JPG, JPEG, PNG - Max: 5MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Berkas -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-list-check me-2"></i>Status Berkas</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <div class="mb-2">
                                            @if($pendaftaran->pas_foto_path)
                                                <i class="fas fa-check-circle fa-2x text-success"></i>
                                            @else
                                                <i class="fas fa-times-circle fa-2x text-danger"></i>
                                            @endif
                                        </div>
                                        <small>Pas Foto</small>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="mb-2">
                                            @if($pendaftaran->ijazah_path)
                                                <i class="fas fa-check-circle fa-2x text-success"></i>
                                            @else
                                                <i class="fas fa-times-circle fa-2x text-danger"></i>
                                            @endif
                                        </div>
                                        <small>Ijazah/Rapor</small>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="mb-2">
                                            @if($pendaftaran->kartu_keluarga_path)
                                                <i class="fas fa-check-circle fa-2x text-success"></i>
                                            @else
                                                <i class="fas fa-times-circle fa-2x text-danger"></i>
                                            @endif
                                        </div>
                                        <small>Kartu Keluarga</small>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="mb-2">
                                            @if($pendaftaran->akta_lahir_path)
                                                <i class="fas fa-check-circle fa-2x text-success"></i>
                                            @else
                                                <i class="fas fa-times-circle fa-2x text-danger"></i>
                                            @endif
                                        </div>
                                        <small>Akta Lahir</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="card">
                            <div class="card-body text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-upload me-2"></i>Upload Berkas
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>