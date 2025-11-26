<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Verifikator - PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
                        <i class="fas fa-user-check me-2"></i>Verifikator
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link text-white active" href="{{ route('verifikator.dashboard') }}">
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
                        <h2>Dashboard Verifikator</h2>
                        <span class="text-muted">{{ now()->format('d F Y') }}</span>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="stat-icon bg-primary me-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0">{{ $stats['total'] }}</h5>
                                        <small class="text-muted">Total Pendaftaran</small>
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
                                        <h5 class="card-title mb-0">{{ $stats['belum_diverifikasi'] }}</h5>
                                        <small class="text-muted">Belum Diverifikasi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="stat-icon bg-success me-3">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0">{{ $stats['diverifikasi'] }}</h5>
                                        <small class="text-muted">Diverifikasi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="stat-icon bg-danger me-3">
                                        <i class="fas fa-times"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0">{{ $stats['ditolak'] }}</h5>
                                        <small class="text-muted">Ditolak</small>
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
                                            <a href="{{ route('verifikator.pendaftaran') }}" class="btn btn-primary w-100">
                                                <i class="fas fa-list me-2"></i>Lihat Semua Pendaftaran
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <a href="{{ route('verifikator.pendaftaran', ['status_verifikasi' => 'belum_diverifikasi']) }}" class="btn btn-warning w-100">
                                                <i class="fas fa-clock me-2"></i>Perlu Verifikasi
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <a href="{{ route('verifikator.pendaftaran', ['status_verifikasi' => 'diverifikasi']) }}" class="btn btn-success w-100">
                                                <i class="fas fa-check me-2"></i>Sudah Diverifikasi
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Registrations -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pendaftaran Terbaru</h5>
                            <a href="{{ route('verifikator.pendaftaran') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            @if($pendaftaran_terbaru->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No. Pendaftaran</th>
                                                <th>Nama</th>
                                                <th>Pilihan 1</th>
                                                <th>Status Verifikasi</th>
                                                <th>Tanggal Daftar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pendaftaran_terbaru as $item)
                                            <tr>
                                                <td>{{ $item->no_pendaftaran }}</td>
                                                <td>{{ $item->nama_lengkap }}</td>
                                                <td>{{ $item->jurusanPilihan1->nama ?? '-' }}</td>
                                                <td>
                                                    @if($item->status_verifikasi == 'belum_diverifikasi')
                                                        <span class="badge bg-warning">Belum Diverifikasi</span>
                                                    @elseif($item->status_verifikasi == 'diverifikasi')
                                                        <span class="badge bg-success">Diverifikasi</span>
                                                    @else
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <a href="{{ route('verifikator.detail', $item->id) }}" class="btn btn-sm btn-outline-primary">
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
                                    <p class="text-muted">Belum ada data pendaftaran</p>
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