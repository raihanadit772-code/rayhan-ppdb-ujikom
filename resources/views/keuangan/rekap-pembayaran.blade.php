<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Pembayaran - Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }
        .summary-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        @media print {
            .sidebar, .no-print { display: none !important; }
            .col-md-9, .col-lg-10 { width: 100% !important; }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0 no-print">
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
                        <a class="nav-link text-white active" href="{{ route('keuangan.rekap-pembayaran') }}">
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
                    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
                        <h2>Rekap Pembayaran</h2>
                        <button onclick="window.print()" class="btn btn-success">
                            <i class="fas fa-print me-2"></i>Cetak Laporan
                        </button>
                    </div>

                    <!-- Filters -->
                    <div class="card mb-4 no-print">
                        <div class="card-body">
                            <form method="GET" action="{{ route('keuangan.rekap-pembayaran') }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Tanggal Selesai</label>
                                        <input type="date" name="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Jenis</label>
                                        <select name="jenis_pembayaran" class="form-select">
                                            <option value="">Semua</option>
                                            <option value="pendaftaran" {{ request('jenis_pembayaran') == 'pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                                            <option value="daftar_ulang" {{ request('jenis_pembayaran') == 'daftar_ulang' ? 'selected' : '' }}>Daftar Ulang</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Status</label>
                                        <select name="status_pembayaran" class="form-select">
                                            <option value="">Semua</option>
                                            <option value="lunas" {{ request('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                            <option value="ditolak" {{ request('status_pembayaran') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-filter"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card summary-card bg-primary text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-receipt fa-2x mb-2"></i>
                                    <h4>{{ $summary['total_transaksi'] }}</h4>
                                    <small>Total Transaksi</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card summary-card bg-success text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-money-bill-wave fa-2x mb-2"></i>
                                    <h5>Rp {{ number_format($summary['total_pendapatan'], 0, ',', '.') }}</h5>
                                    <small>Total Pendapatan</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card summary-card bg-info text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-plus fa-2x mb-2"></i>
                                    <h5>Rp {{ number_format($summary['pendaftaran'], 0, ',', '.') }}</h5>
                                    <small>Biaya Pendaftaran</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card summary-card bg-warning text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-graduation-cap fa-2x mb-2"></i>
                                    <h5>Rp {{ number_format($summary['daftar_ulang'], 0, ',', '.') }}</h5>
                                    <small>Daftar Ulang</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Report Header for Print -->
                    <div class="d-none d-print-block mb-4">
                        <div class="text-center">
                            <h3>LAPORAN REKAP PEMBAYARAN</h3>
                            <h4>PPDB SEKOLAH</h4>
                            <p>Periode: {{ request('tanggal_mulai') ? date('d F Y', strtotime(request('tanggal_mulai'))) : 'Semua' }} - {{ request('tanggal_selesai') ? date('d F Y', strtotime(request('tanggal_selesai'))) : 'Semua' }}</p>
                            <hr>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Detail Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            @if($pembayaran->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kode Pembayaran</th>
                                                <th>Nama Siswa</th>
                                                <th>Jenis</th>
                                                <th>Jumlah</th>
                                                <th>Status</th>
                                                <th class="no-print">Verifikator</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pembayaran as $index => $item)
                                            <tr>
                                                <td>{{ $pembayaran->firstItem() + $index }}</td>
                                                <td>{{ $item->tanggal_verifikasi ? $item->tanggal_verifikasi->format('d/m/Y') : '-' }}</td>
                                                <td>{{ $item->kode_pembayaran }}</td>
                                                <td>{{ $item->pendaftaran->nama_lengkap }}</td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $item->jenis_pembayaran)) }}</td>
                                                <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                                <td>
                                                    @if($item->status_pembayaran == 'lunas')
                                                        <span class="badge bg-success">Lunas</span>
                                                    @elseif($item->status_pembayaran == 'ditolak')
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge bg-warning">{{ ucfirst(str_replace('_', ' ', $item->status_pembayaran)) }}</span>
                                                    @endif
                                                </td>
                                                <td class="no-print">{{ $item->verifikatorKeuangan->name ?? '-' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="table-light">
                                            <tr>
                                                <th colspan="5" class="text-end">Total Pendapatan:</th>
                                                <th>Rp {{ number_format($pembayaran->where('status_pembayaran', 'lunas')->sum('jumlah'), 0, ',', '.') }}</th>
                                                <th colspan="2"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4 no-print">
                                    {{ $pembayaran->appends(request()->query())->links() }}
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Tidak ada data pembayaran</h5>
                                    <p class="text-muted">Silakan ubah filter untuk melihat data pembayaran</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Print Footer -->
                    <div class="d-none d-print-block mt-4">
                        <div class="row">
                            <div class="col-6">
                                <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
                            </div>
                            <div class="col-6 text-end">
                                <p>Petugas Keuangan</p>
                                <br><br>
                                <p>{{ Auth::user()->name }}</p>
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