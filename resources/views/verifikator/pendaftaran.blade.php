<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran - Verifikator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
                        <a class="nav-link text-white active" href="{{ route('verifikator.pendaftaran') }}">
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
                        <h2>Data Pendaftaran</h2>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Filters -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" action="{{ route('verifikator.pendaftaran') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select name="status_verifikasi" class="form-select">
                                            <option value="">Semua Status</option>
                                            <option value="belum_diverifikasi" {{ request('status_verifikasi') == 'belum_diverifikasi' ? 'selected' : '' }}>Belum Diverifikasi</option>
                                            <option value="diverifikasi" {{ request('status_verifikasi') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                            <option value="ditolak" {{ request('status_verifikasi') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="search" class="form-control" placeholder="Cari nama, no pendaftaran, atau NISN..." value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-search"></i> Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="card">
                        <div class="card-body">
                            @if($pendaftaran->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>No. Pendaftaran</th>
                                                <th>Nama Lengkap</th>
                                                <th>NISN</th>
                                                <th>Pilihan 1</th>
                                                <th>Status Verifikasi</th>
                                                <th>Verifikator</th>
                                                <th>Tanggal Daftar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pendaftaran as $item)
                                            <tr>
                                                <td>{{ $item->no_pendaftaran }}</td>
                                                <td>{{ $item->nama_lengkap }}</td>
                                                <td>{{ $item->nisn }}</td>
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
                                                <td>{{ $item->verifikator->name ?? '-' }}</td>
                                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('verifikator.detail', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $pendaftaran->appends(request()->query())->links() }}
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Tidak ada data pendaftaran</h5>
                                    <p class="text-muted">Data pendaftaran akan muncul di sini setelah ada yang mendaftar</p>
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