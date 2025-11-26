<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran - PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -15px;
            top: 0;
            width: 2px;
            height: 100%;
            background: #dee2e6;
        }
        .timeline-item:last-child::before {
            display: none;
        }
        .timeline-icon {
            position: absolute;
            left: -25px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: white;
        }
        .timeline-icon.completed { background: #28a745; }
        .timeline-icon.active { background: #007bff; }
        .timeline-icon.pending { background: #6c757d; }
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
                        <a class="nav-link text-white" href="{{ route('siswa.upload-berkas') }}">
                            <i class="fas fa-upload me-2"></i>Upload Berkas
                        </a>
                        <a class="nav-link text-white active" href="{{ route('siswa.status-pendaftaran') }}">
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
                        <h2>Status Pendaftaran</h2>
                        <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    @if($pendaftaran)
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">Timeline Status</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline">
                                            <div class="timeline-item">
                                                <div class="timeline-icon completed">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <h6>Pendaftaran Dibuat</h6>
                                                    <p class="text-muted mb-1">{{ $pendaftaran->created_at->format('d F Y H:i') }}</p>
                                                    <small class="text-success">Selesai</small>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <div class="timeline-icon {{ $pendaftaran->status != 'draft' ? 'completed' : 'active' }}">
                                                    @if($pendaftaran->status != 'draft')
                                                        <i class="fas fa-check"></i>
                                                    @else
                                                        <i class="fas fa-clock"></i>
                                                    @endif
                                                </div>
                                                <div class="timeline-content">
                                                    <h6>Formulir Dikirim</h6>
                                                    @if($pendaftaran->status != 'draft')
                                                        <p class="text-muted mb-1">{{ $pendaftaran->updated_at->format('d F Y H:i') }}</p>
                                                        <small class="text-success">Selesai</small>
                                                    @else
                                                        <small class="text-warning">Menunggu pengiriman formulir</small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <div class="timeline-icon {{ $pendaftaran->status_verifikasi == 'diverifikasi' ? 'completed' : ($pendaftaran->status_verifikasi == 'belum_diverifikasi' ? 'active' : 'pending') }}">
                                                    @if($pendaftaran->status_verifikasi == 'diverifikasi')
                                                        <i class="fas fa-check"></i>
                                                    @elseif($pendaftaran->status_verifikasi == 'belum_diverifikasi')
                                                        <i class="fas fa-clock"></i>
                                                    @else
                                                        <i class="fas fa-times"></i>
                                                    @endif
                                                </div>
                                                <div class="timeline-content">
                                                    <h6>Verifikasi Administrasi</h6>
                                                    @if($pendaftaran->status_verifikasi == 'diverifikasi')
                                                        <p class="text-muted mb-1">{{ $pendaftaran->tanggal_verifikasi->format('d F Y H:i') }}</p>
                                                        <small class="text-success">Diverifikasi oleh {{ $pendaftaran->verifikator->name ?? 'Admin' }}</small>
                                                    @elseif($pendaftaran->status_verifikasi == 'belum_diverifikasi')
                                                        <small class="text-warning">Sedang dalam proses verifikasi</small>
                                                    @else
                                                        <small class="text-danger">Verifikasi ditolak</small>
                                                        @if($pendaftaran->catatan_verifikasi)
                                                            <br><small class="text-muted">{{ $pendaftaran->catatan_verifikasi }}</small>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <div class="timeline-icon {{ $status_final == 'diterima' ? 'completed' : ($status_final == 'menunggu_pembayaran' ? 'active' : 'pending') }}">
                                                    @if($status_final == 'diterima')
                                                        <i class="fas fa-check"></i>
                                                    @elseif($status_final == 'menunggu_pembayaran')
                                                        <i class="fas fa-clock"></i>
                                                    @else
                                                        <i class="fas fa-times"></i>
                                                    @endif
                                                </div>
                                                <div class="timeline-content">
                                                    <h6>Pembayaran</h6>
                                                    @if($status_final == 'diterima')
                                                        <small class="text-success">Pembayaran lunas</small>
                                                    @elseif($status_final == 'menunggu_pembayaran')
                                                        <small class="text-warning">Menunggu verifikasi pembayaran</small>
                                                    @elseif($status_final == 'belum_bayar')
                                                        <small class="text-info">Belum melakukan pembayaran</small>
                                                    @else
                                                        <small class="text-muted">Menunggu verifikasi berkas</small>
                                                    @endif
                                                    
                                                    @if($pembayaran->count() > 0)
                                                        <div class="mt-2">
                                                            @foreach($pembayaran as $bayar)
                                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                                    <small>{{ ucfirst(str_replace('_', ' ', $bayar->jenis_pembayaran)) }}</small>
                                                                    <span class="badge bg-{{ $bayar->status_pembayaran == 'lunas' ? 'success' : ($bayar->status_pembayaran == 'menunggu_verifikasi' ? 'warning' : 'secondary') }}">
                                                                        {{ ucfirst(str_replace('_', ' ', $bayar->status_pembayaran)) }}
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <div class="timeline-icon {{ $status_final == 'diterima' ? 'completed' : 'pending' }}">
                                                    @if($status_final == 'diterima')
                                                        <i class="fas fa-check"></i>
                                                    @else
                                                        <i class="fas fa-clock"></i>
                                                    @endif
                                                </div>
                                                <div class="timeline-content">
                                                    <h6>Cetak Kartu Peserta</h6>
                                                    @if($status_final == 'diterima')
                                                        <small class="text-success">Kartu tersedia untuk dicetak</small>
                                                        <div class="mt-2">
                                                            <a href="{{ route('siswa.cetak-kartu') }}" class="btn btn-sm btn-success">
                                                                <i class="fas fa-print"></i> Cetak Kartu
                                                            </a>
                                                        </div>
                                                    @elseif($pendaftaran->status_verifikasi == 'diverifikasi')
                                                        <small class="text-warning">Menunggu pembayaran lunas</small>
                                                    @else
                                                        <small class="text-muted">Menunggu verifikasi berkas</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Informasi Pendaftaran</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>No. Pendaftaran:</strong></td>
                                                <td>{{ $pendaftaran->no_pendaftaran }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Nama:</strong></td>
                                                <td>{{ $pendaftaran->nama_lengkap }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pilihan 1:</strong></td>
                                                <td>{{ $pendaftaran->jurusanPilihan1->nama ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pilihan 2:</strong></td>
                                                <td>{{ $pendaftaran->jurusanPilihan2->nama ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status:</strong></td>
                                                <td>
                                                    @if($pendaftaran->status == 'draft')
                                                        <span class="badge bg-secondary">Draft</span>
                                                    @elseif($pendaftaran->status == 'pending')
                                                        <span class="badge bg-warning">Menunggu</span>
                                                    @elseif($pendaftaran->status == 'diterima')
                                                        <span class="badge bg-success">Diterima</span>
                                                    @else
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>

                                        @if($status_final == 'diterima')
                                            <div class="mt-3">
                                                <a href="{{ route('siswa.cetak-kartu') }}" class="btn btn-success w-100">
                                                    <i class="fas fa-print me-2"></i>Cetak Kartu Pendaftaran
                                                </a>
                                            </div>
                                        @elseif($pendaftaran->status_verifikasi == 'diverifikasi')
                                            <div class="mt-3">
                                                <button class="btn btn-secondary w-100" disabled>
                                                    <i class="fas fa-clock me-2"></i>Menunggu Pembayaran Lunas
                                                </button>
                                            </div>
                                        @else
                                            <div class="mt-3">
                                                <button class="btn btn-secondary w-100" disabled>
                                                    <i class="fas fa-hourglass-half me-2"></i>Menunggu Verifikasi
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-clipboard-list fa-4x text-muted mb-4"></i>
                                <h4>Belum Ada Pendaftaran</h4>
                                <p class="text-muted mb-4">Silakan lengkapi formulir pendaftaran terlebih dahulu</p>
                                <a href="{{ route('siswa.formulir-pendaftaran') }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>Isi Formulir Pendaftaran
                                </a>
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