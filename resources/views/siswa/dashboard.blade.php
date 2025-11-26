<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        .step-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .step-card:hover {
            transform: translateY(-3px);
        }
        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }
        .step-completed { background: #28a745; }
        .step-active { background: #007bff; }
        .step-pending { background: #6c757d; }
        .progress-timeline {
            position: relative;
            padding-left: 30px;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -15px;
            top: 20px;
            width: 2px;
            height: 100%;
            background: #dee2e6;
        }
        .timeline-item:last-child::before {
            display: none;
        }
        .badge {
            font-size: 0.75em;
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
                        <a class="nav-link text-white active" href="{{ route('siswa.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link text-white" href="{{ route('siswa.formulir-pendaftaran') }}">
                            <i class="fas fa-edit me-2"></i>Formulir Pendaftaran
                        </a>
                        <a class="nav-link text-white" href="{{ route('siswa.upload-berkas') }}">
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
                        <div>
                            <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>
                            <p class="text-muted mb-0">Portal Penerimaan Peserta Didik Baru</p>
                        </div>
                        <div class="text-end">
                            @if($pendaftaran)
                                <div class="badge bg-primary fs-6 mb-1">{{ $pendaftaran->no_pendaftaran }}</div>
                            @endif
                            <div class="text-muted small">{{ now()->format('d F Y') }}</div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif



                    <!-- Quick Actions -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card step-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-edit fa-3x text-primary mb-3"></i>
                                    <h5>Formulir Pendaftaran</h5>
                                    <p class="text-muted small">Lengkapi data pribadi dan pilihan jurusan</p>
                                    <a href="{{ route('siswa.formulir-pendaftaran') }}" class="btn btn-primary btn-sm">
                                        {{ $pendaftaran ? 'Edit Formulir' : 'Isi Formulir' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card step-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-upload fa-3x text-success mb-3"></i>
                                    <h5>Upload Berkas</h5>
                                    <p class="text-muted small">Upload dokumen pendukung</p>
                                    <a href="{{ route('siswa.upload-berkas') }}" class="btn btn-success btn-sm">
                                        Upload Berkas
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card step-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-list-alt fa-3x text-info mb-3"></i>
                                    <h5>Status Pendaftaran</h5>
                                    <p class="text-muted small">Cek status dan timeline pendaftaran</p>
                                    <a href="{{ route('siswa.status-pendaftaran') }}" class="btn btn-info btn-sm">
                                        Lihat Status
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card step-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-credit-card fa-3x text-warning mb-3"></i>
                                    <h5>Pembayaran</h5>
                                    <p class="text-muted small">Lakukan pembayaran pendaftaran</p>
                                    <a href="{{ route('siswa.pembayaran') }}" class="btn btn-warning btn-sm">
                                        Bayar Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Summary -->
                    @if($pendaftaran)
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Ringkasan Pendaftaran</h5>
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
                                                    <td><strong>Pilihan 1:</strong></td>
                                                    <td>{{ $pendaftaran->jurusanPilihan1->nama ?? '-' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Status Pendaftaran:</strong></td>
                                                    <td>
                                                        @if($pendaftaran->status == 'draft')
                                                            <span class="badge bg-secondary">Draft</span>
                                                        @elseif($pendaftaran->status == 'pending')
                                                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                                                        @elseif($pendaftaran->status == 'diterima')
                                                            <span class="badge bg-success">Diterima</span>
                                                        @else
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Verifikasi:</strong></td>
                                                    <td>
                                                        @if($pendaftaran->status_verifikasi == 'belum_diverifikasi')
                                                            <span class="badge bg-secondary">Belum Diverifikasi</span>
                                                        @elseif($pendaftaran->status_verifikasi == 'diverifikasi')
                                                            <span class="badge bg-success">Diverifikasi</span>
                                                        @else
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tanggal Daftar:</strong></td>
                                                    <td>{{ $pendaftaran->created_at->format('d F Y') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Aksi Cepat</h5>
                                </div>
                                <div class="card-body">
                                    @php
                                        $bisa_cetak = $pendaftaran->status_verifikasi == 'diverifikasi' && 
                                                     $pembayaran->where('status_pembayaran', 'lunas')->count() > 0;
                                    @endphp
                                    @if($bisa_cetak)
                                        <a href="{{ route('siswa.cetak-kartu') }}" class="btn btn-success w-100 mb-2">
                                            <i class="fas fa-print me-2"></i>Cetak Kartu Pendaftaran
                                        </a>
                                    @elseif($pendaftaran->status_verifikasi == 'diverifikasi')
                                        <button class="btn btn-secondary w-100 mb-2" disabled>
                                            <i class="fas fa-clock me-2"></i>Menunggu Pembayaran Lunas
                                        </button>
                                    @else
                                        <button class="btn btn-secondary w-100 mb-2" disabled>
                                            <i class="fas fa-hourglass-half me-2"></i>Menunggu Verifikasi
                                        </button>
                                    @endif
                                    
                                    @if($pembayaran->where('status_pembayaran', 'lunas')->count() > 0)
                                        @foreach($pembayaran->where('status_pembayaran', 'lunas') as $bayar)
                                            <a href="{{ route('siswa.cetak-bukti-bayar', $bayar->id) }}" class="btn btn-info w-100 mb-2">
                                                <i class="fas fa-receipt me-2"></i>Cetak Bukti Bayar
                                            </a>
                                        @endforeach
                                    @endif
                                    
                                    <a href="{{ route('siswa.status-pendaftaran') }}" class="btn btn-outline-primary w-100">
                                        <i class="fas fa-eye me-2"></i>Lihat Detail Status
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center py-5">
                                    <i class="fas fa-clipboard-list fa-4x text-muted mb-4"></i>
                                    <h4>Belum Ada Pendaftaran</h4>
                                    <p class="text-muted mb-4">Silakan lengkapi formulir pendaftaran untuk memulai proses PPDB</p>
                                    <a href="{{ route('siswa.formulir-pendaftaran') }}" class="btn btn-primary btn-lg">
                                        <i class="fas fa-edit me-2"></i>Mulai Pendaftaran
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>