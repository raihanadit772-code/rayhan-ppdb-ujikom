<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Keuangan - PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }
        .stat-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
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
                        <a class="nav-link text-white active" href="{{ route('keuangan.dashboard') }}">
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
                        <h2>Dashboard Keuangan</h2>
                        <span class="text-muted">{{ now()->format('d F Y') }}</span>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="stat-icon bg-primary me-3">
                                        <i class="fas fa-receipt"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0">{{ $stats['total_pembayaran'] }}</h5>
                                        <small class="text-muted">Total Pembayaran</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="stat-icon bg-info me-3">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0">{{ $stats['dikonfirmasi'] }}</h5>
                                        <small class="text-muted">Dikonfirmasi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="stat-icon bg-warning me-3">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0">{{ $stats['menunggu_verifikasi'] }}</h5>
                                        <small class="text-muted">Menunggu Verifikasi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="stat-icon bg-success me-3">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0">{{ $stats['lunas'] }}</h5>
                                        <small class="text-muted">Lunas</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="stat-icon bg-info me-3">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</h5>
                                        <small class="text-muted">Total Pendapatan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Aksi Cepat</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <a href="{{ route('keuangan.verifikasi-pembayaran') }}" class="btn btn-primary w-100">
                                                <i class="fas fa-money-check-alt me-2"></i>Verifikasi Pembayaran
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <a href="{{ route('keuangan.verifikasi-pembayaran', ['status_pembayaran' => 'dikonfirmasi']) }}" class="btn btn-info w-100">
                                                <i class="fas fa-check me-2"></i>Dikonfirmasi
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <a href="{{ route('keuangan.verifikasi-pembayaran', ['status_pembayaran' => 'menunggu_verifikasi']) }}" class="btn btn-warning w-100">
                                                <i class="fas fa-clock me-2"></i>Perlu Verifikasi
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <a href="{{ route('keuangan.rekap-pembayaran') }}" class="btn btn-success w-100">
                                                <i class="fas fa-chart-bar me-2"></i>Rekap Pembayaran
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Siswa Diverifikasi -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Siswa dengan Tagihan Otomatis</h5>
                            <span class="badge bg-info">{{ $siswa_diverifikasi->count() }} siswa</span>
                        </div>
                        <div class="card-body">
                            @if($siswa_diverifikasi->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No. Pendaftaran</th>
                                                <th>Nama Siswa</th>
                                                <th>Jurusan</th>
                                                <th>Tanggal Verifikasi</th>
                                                <th>Status Pembayaran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($siswa_diverifikasi as $siswa)
                                            <tr>
                                                <td>{{ $siswa->no_pendaftaran }}</td>
                                                <td>{{ $siswa->nama_lengkap }}</td>
                                                <td>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
                                                <td>{{ $siswa->tanggal_verifikasi ? $siswa->tanggal_verifikasi->format('d/m/Y') : '-' }}</td>
                                                <td>
                                                    @php
                                                        $pembayaran = $siswa->pembayaran->first();
                                                    @endphp
                                                    @if($pembayaran)
                                                        @if($pembayaran->status_pembayaran == 'belum_bayar')
                                                            <span class="badge bg-secondary">Belum Bayar</span>
                                                        @elseif($pembayaran->status_pembayaran == 'dikonfirmasi')
                                                            <span class="badge bg-info">Dikonfirmasi</span>
                                                        @elseif($pembayaran->status_pembayaran == 'lunas')
                                                            <span class="badge bg-success">Lunas</span>
                                                        @endif
                                                    @else
                                                        <span class="badge bg-warning">Belum Ada Tagihan</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">Otomatis setelah verifikasi</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-user-check fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada siswa yang diverifikasi</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Payments -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pembayaran Terbaru</h5>
                            <a href="{{ route('keuangan.verifikasi-pembayaran') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            @if($pembayaran_terbaru->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kode Pembayaran</th>
                                                <th>Nama Siswa</th>
                                                <th>Jenis</th>
                                                <th>Jumlah</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pembayaran_terbaru as $item)
                                            <tr>
                                                <td>{{ $item->kode_pembayaran }}</td>
                                                <td>{{ $item->pendaftaran->nama_lengkap }}</td>
                                                <td>
                                                    <span class="badge bg-secondary">
                                                        {{ ucfirst(str_replace('_', ' ', $item->jenis_pembayaran)) }}
                                                    </span>
                                                </td>
                                                <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                                <td>
                                                    @if($item->status_pembayaran == 'belum_bayar')
                                                        <span class="badge bg-secondary">Belum Bayar</span>
                                                    @elseif($item->status_pembayaran == 'dikonfirmasi')
                                                        <span class="badge bg-info">Dikonfirmasi</span>
                                                    @elseif($item->status_pembayaran == 'menunggu_verifikasi')
                                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                                                    @elseif($item->status_pembayaran == 'lunas')
                                                        <span class="badge bg-success">Lunas</span>
                                                    @else
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <a href="{{ route('keuangan.detail-pembayaran', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada data pembayaran</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>