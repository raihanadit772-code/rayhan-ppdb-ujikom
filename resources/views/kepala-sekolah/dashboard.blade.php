<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Eksekutif - Kepala Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);
        }
        .kpi-card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        .kpi-card:hover {
            transform: translateY(-5px);
        }
        .kpi-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
        }
        .progress-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .chart-container {
            position: relative;
            height: 300px;
        }
        .metric-value {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .metric-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        .trend-up { color: #28a745; }
        .trend-down { color: #dc3545; }
        .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .bg-gradient-success { background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%); }
        .bg-gradient-warning { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .bg-gradient-info { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-3">
                    <h5 class="text-white mb-4">
                        <i class="fas fa-user-tie me-2"></i>Kepala Sekolah
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link text-white active" href="{{ route('kepala-sekolah.dashboard') }}">
                            <i class="fas fa-chart-line me-2"></i>Dashboard Eksekutif
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
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="mb-1">Dashboard Eksekutif</h2>
                            <p class="text-muted mb-0">Monitoring KPI & Indikator PPDB {{ date('Y') }}</p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-success fs-6 mb-1">Live Data</div>
                            <div class="text-muted small">{{ now()->format('d F Y, H:i') }}</div>
                        </div>
                    </div>

                    <!-- KPI Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card kpi-card bg-gradient-primary text-white">
                                <div class="card-body d-flex align-items-center">
                                    <div class="kpi-icon bg-white bg-opacity-20 me-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="metric-value">{{ number_format($kpi['total_pendaftar']) }}</div>
                                        <div class="metric-label">Total Pendaftar</div>
                                        <div class="small">
                                            Target: {{ number_format($kpi['target_pendaftar']) }}
                                            <span class="badge bg-white bg-opacity-20 ms-1">
                                                {{ $kpi['target_pendaftar'] > 0 ? round(($kpi['total_pendaftar'] / $kpi['target_pendaftar']) * 100, 1) : 0 }}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card kpi-card bg-gradient-success text-white">
                                <div class="card-body d-flex align-items-center">
                                    <div class="kpi-icon bg-white bg-opacity-20 me-3">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="metric-value">{{ $kpi['tingkat_konversi'] }}%</div>
                                        <div class="metric-label">Tingkat Konversi</div>
                                        <div class="small">{{ number_format($kpi['pendaftar_diterima']) }} dari {{ number_format($kpi['total_pendaftar']) }} pendaftar</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card kpi-card bg-gradient-warning text-white">
                                <div class="card-body d-flex align-items-center">
                                    <div class="kpi-icon bg-white bg-opacity-20 me-3">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="metric-value">{{ number_format($kpi['total_pendapatan'] / 1000000, 1) }}M</div>
                                        <div class="metric-label">Total Pendapatan</div>
                                        <div class="small">
                                            Target: {{ number_format($kpi['target_pendapatan'] / 1000000, 0) }}M
                                            <span class="badge bg-white bg-opacity-20 ms-1">
                                                {{ $kpi['target_pendapatan'] > 0 ? round(($kpi['total_pendapatan'] / $kpi['target_pendapatan']) * 100, 1) : 0 }}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card kpi-card bg-gradient-info text-white">
                                <div class="card-body d-flex align-items-center">
                                    <div class="kpi-icon bg-white bg-opacity-20 me-3">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="metric-value">{{ number_format($kpi['verifikasi_selesai']) }}</div>
                                        <div class="metric-label">Verifikasi Selesai</div>
                                        <div class="small">{{ number_format($kpi['pembayaran_lunas']) }} pembayaran lunas</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row mb-4">
                        <!-- Trend Pendaftaran -->
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Trend Pendaftaran (7 Hari Terakhir)</h5>
                                    <i class="fas fa-chart-line text-primary"></i>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="trendPendaftaranChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Trend Pembayaran -->
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Trend Pembayaran (7 Hari Terakhir)</h5>
                                    <i class="fas fa-chart-area text-success"></i>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="trendPembayaranChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status & Analytics Row -->
                    <div class="row mb-4">
                        <!-- Status Pendaftaran -->
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Status Pendaftaran</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="statusChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Verifikasi -->
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Status Verifikasi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="verifikasiChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Pembayaran -->
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Status Pembayaran</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="pembayaranChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jurusan Popularity -->
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Popularitas Jurusan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="jurusanChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Ringkasan Cepat</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span>Pendaftar Hari Ini</span>
                                        <span class="badge bg-primary">{{ \App\Models\Pendaftaran::whereDate('created_at', today())->count() }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span>Pembayaran Hari Ini</span>
                                        <span class="badge bg-success">{{ \App\Models\Pembayaran::whereDate('created_at', today())->count() }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span>Perlu Verifikasi</span>
                                        <span class="badge bg-warning">{{ \App\Models\Pendaftaran::where('status_verifikasi', 'belum_diverifikasi')->count() }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Tingkat Kelulusan</span>
                                        <span class="badge bg-info">{{ $kpi['tingkat_konversi'] }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Trend Pendaftaran Chart
        const trendPendaftaranCtx = document.getElementById('trendPendaftaranChart').getContext('2d');
        new Chart(trendPendaftaranCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($trendPendaftaran, 'date')) !!},
                datasets: [{
                    label: 'Pendaftar',
                    data: {!! json_encode(array_column($trendPendaftaran, 'count')) !!},
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Trend Pembayaran Chart
        const trendPembayaranCtx = document.getElementById('trendPembayaranChart').getContext('2d');
        new Chart(trendPembayaranCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_column($trendPembayaran, 'date')) !!},
                datasets: [{
                    label: 'Pembayaran (Rp)',
                    data: {!! json_encode(array_column($trendPembayaran, 'amount')) !!},
                    backgroundColor: 'rgba(40, 167, 69, 0.8)',
                    borderColor: '#28a745',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Status Pendaftaran Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Diterima', 'Ditolak'],
                datasets: [{
                    data: [{{ $statusBreakdown['pending'] }}, {{ $statusBreakdown['diterima'] }}, {{ $statusBreakdown['ditolak'] }}],
                    backgroundColor: ['#ffc107', '#28a745', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Status Verifikasi Chart
        const verifikasiCtx = document.getElementById('verifikasiChart').getContext('2d');
        new Chart(verifikasiCtx, {
            type: 'doughnut',
            data: {
                labels: ['Belum Diverifikasi', 'Diverifikasi', 'Ditolak'],
                datasets: [{
                    data: [{{ $verifikasiStatus['belum_diverifikasi'] }}, {{ $verifikasiStatus['diverifikasi'] }}, {{ $verifikasiStatus['ditolak'] }}],
                    backgroundColor: ['#6c757d', '#17a2b8', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Status Pembayaran Chart
        const pembayaranCtx = document.getElementById('pembayaranChart').getContext('2d');
        new Chart(pembayaranCtx, {
            type: 'doughnut',
            data: {
                labels: ['Belum Bayar', 'Menunggu Verifikasi', 'Lunas', 'Ditolak'],
                datasets: [{
                    data: [{{ $pembayaranStatus['belum_bayar'] }}, {{ $pembayaranStatus['menunggu_verifikasi'] }}, {{ $pembayaranStatus['lunas'] }}, {{ $pembayaranStatus['ditolak'] }}],
                    backgroundColor: ['#6c757d', '#ffc107', '#28a745', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Jurusan Popularity Chart
        const jurusanCtx = document.getElementById('jurusanChart').getContext('2d');
        new Chart(jurusanCtx, {
            type: 'horizontalBar',
            data: {
                labels: {!! json_encode($jurusanStats->pluck('nama')) !!},
                datasets: [{
                    label: 'Jumlah Peminat',
                    data: {!! json_encode($jurusanStats->pluck('total_peminat')) !!},
                    backgroundColor: [
                        '#667eea', '#764ba2', '#f093fb', '#f5576c', 
                        '#4facfe', '#00f2fe', '#43e97b', '#38f9d7'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    x: { beginAtZero: true },
                    y: { ticks: { maxRotation: 0 } }
                }
            }
        });
    </script>
</body>
</html>