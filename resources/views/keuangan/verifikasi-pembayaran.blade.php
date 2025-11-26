<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pembayaran - Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
                        <a class="nav-link text-white active" href="{{ route('keuangan.verifikasi-pembayaran') }}">
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
                        <h2>Verifikasi Pembayaran</h2>
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
                            <form method="GET" action="{{ route('keuangan.verifikasi-pembayaran') }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select name="status_pembayaran" class="form-select">
                                            <option value="">Semua Status</option>
                                            <option value="dikonfirmasi" {{ request('status_pembayaran') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                                            <option value="menunggu_verifikasi" {{ request('status_pembayaran') == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                            <option value="lunas" {{ request('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                            <option value="ditolak" {{ request('status_pembayaran') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="jenis_pembayaran" class="form-select">
                                            <option value="">Semua Jenis</option>
                                            <option value="pendaftaran" {{ request('jenis_pembayaran') == 'pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                                            <option value="daftar_ulang" {{ request('jenis_pembayaran') == 'daftar_ulang' ? 'selected' : '' }}>Daftar Ulang</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="search" class="form-control" placeholder="Cari nama siswa atau kode pembayaran..." value="{{ request('search') }}">
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
                            @if($pembayaran->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Kode Pembayaran</th>
                                                <th>Nama Siswa</th>
                                                <th>Jenis Pembayaran</th>
                                                <th>Jumlah</th>
                                                <th>Status</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Verifikator</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pembayaran as $item)
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
                                                <td>{{ $item->tanggal_bayar ? $item->tanggal_bayar->format('d/m/Y H:i') : '-' }}</td>
                                                <td>{{ $item->verifikatorKeuangan->name ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ route('keuangan.detail-pembayaran', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
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
                                    {{ $pembayaran->appends(request()->query())->links() }}
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Tidak ada data pembayaran</h5>
                                    <p class="text-muted">Data pembayaran akan muncul di sini setelah ada yang melakukan pembayaran</p>
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