<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran - Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }
        .bukti-preview {
            max-width: 300px;
            max-height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }
        .verification-card {
            border-left: 4px solid #28a745;
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
                        <i class="fas fa-calculator me-2"></i>Keuangan
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link text-white" href="{{ route('keuangan.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link text-white" href="{{ route('keuangan.verifikasi-pembayaran') }}">
                            <i class="fas fa-money-check-alt me-2"></i>Verifikasi Pembayaran
                        </a>
                        <a class="nav-link text-white" href="{{ route('keuangan.rekap-pembayaran') }}">
                            <i class="fas fa-chart-bar me-2"></i>Rekap Pembayaran
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
                        <h2>Detail Pembayaran</h2>
                        <a href="{{ route('keuangan.verifikasi-pembayaran') }}" class="btn btn-secondary">
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
                        <!-- Payment Details -->
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Informasi Pembayaran</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Kode Pembayaran:</strong></td>
                                                    <td>{{ $pembayaran->kode_pembayaran }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Jenis Pembayaran:</strong></td>
                                                    <td>
                                                        <span class="badge bg-secondary">
                                                            {{ ucfirst(str_replace('_', ' ', $pembayaran->jenis_pembayaran)) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Jumlah:</strong></td>
                                                    <td><strong class="text-success">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status:</strong></td>
                                                    <td>
                                                        @if($pembayaran->status_pembayaran == 'belum_bayar')
                                                            <span class="badge bg-secondary">Belum Bayar</span>
                                                        @elseif($pembayaran->status_pembayaran == 'menunggu_verifikasi')
                                                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                                                        @elseif($pembayaran->status_pembayaran == 'lunas')
                                                            <span class="badge bg-success">Lunas</span>
                                                        @else
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Tanggal Bayar:</strong></td>
                                                    <td>{{ $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d F Y H:i') : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tanggal Verifikasi:</strong></td>
                                                    <td>{{ $pembayaran->tanggal_verifikasi ? $pembayaran->tanggal_verifikasi->format('d F Y H:i') : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Diverifikasi oleh:</strong></td>
                                                    <td>{{ $pembayaran->verifikatorKeuangan->name ?? '-' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Student Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Informasi Siswa</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>No. Pendaftaran:</strong></td>
                                                    <td>{{ $pembayaran->pendaftaran->no_pendaftaran }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Nama Lengkap:</strong></td>
                                                    <td>{{ $pembayaran->pendaftaran->nama_lengkap }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>NISN:</strong></td>
                                                    <td>{{ $pembayaran->pendaftaran->nisn }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Email:</strong></td>
                                                    <td>{{ $pembayaran->pendaftaran->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>No. HP:</strong></td>
                                                    <td>{{ $pembayaran->pendaftaran->no_hp }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Proof -->
                            @if($pembayaran->bukti_pembayaran)
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Bukti Pembayaran</h5>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" class="bukti-preview img-thumbnail" alt="Bukti Pembayaran">
                                    <br><br>
                                    <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-outline-primary">
                                        <i class="fas fa-external-link-alt me-2"></i>Lihat Full Size
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Verification Panel -->
                        <div class="col-md-4">
                            <div class="card verification-card">
                                <div class="card-header">
                                    <h5 class="mb-0">Verifikasi Pembayaran</h5>
                                </div>
                                <div class="card-body">
                                    @if($pembayaran->catatan_pembayaran)
                                    <div class="mb-3">
                                        <strong>Catatan Sebelumnya:</strong><br>
                                        <div class="alert alert-info">{{ $pembayaran->catatan_pembayaran }}</div>
                                    </div>
                                    @endif

                                    <form method="POST" action="{{ route('keuangan.proses-verifikasi', $pembayaran->id) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Status Pembayaran</label>
                                            <select name="status_pembayaran" class="form-select" required>
                                                <option value="">Pilih Status</option>
                                                <option value="lunas" {{ $pembayaran->status_pembayaran == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                                <option value="ditolak" {{ $pembayaran->status_pembayaran == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Catatan</label>
                                            <textarea name="catatan_pembayaran" class="form-control" rows="4" placeholder="Berikan catatan verifikasi pembayaran...">{{ $pembayaran->catatan_pembayaran }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="fas fa-check me-2"></i>Simpan Verifikasi
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Payment History -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Riwayat Status</h5>
                                </div>
                                <div class="card-body">
                                    <div class="timeline">
                                        <div class="timeline-item">
                                            <i class="fas fa-plus-circle text-primary"></i>
                                            <div class="timeline-content">
                                                <h6>Pembayaran Dibuat</h6>
                                                <small class="text-muted">{{ $pembayaran->created_at->format('d F Y H:i') }}</small>
                                            </div>
                                        </div>
                                        @if($pembayaran->tanggal_bayar)
                                        <div class="timeline-item">
                                            <i class="fas fa-money-bill text-warning"></i>
                                            <div class="timeline-content">
                                                <h6>Bukti Pembayaran Diunggah</h6>
                                                <small class="text-muted">{{ $pembayaran->tanggal_bayar->format('d F Y H:i') }}</small>
                                            </div>
                                        </div>
                                        @endif
                                        @if($pembayaran->tanggal_verifikasi)
                                        <div class="timeline-item">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <div class="timeline-content">
                                                <h6>Diverifikasi</h6>
                                                <small class="text-muted">{{ $pembayaran->tanggal_verifikasi->format('d F Y H:i') }}</small>
                                                <br><small class="text-muted">oleh {{ $pembayaran->verifikatorKeuangan->name }}</small>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-item i {
            position: absolute;
            left: -35px;
            top: 0;
            font-size: 16px;
        }
        .timeline-content h6 {
            margin: 0;
            font-size: 14px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>