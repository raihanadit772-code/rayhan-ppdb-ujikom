<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
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
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-3">
                    <h5 class="text-white mb-4">
                        <i class="fas fa-user-shield me-2"></i>Admin Panel
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link text-white active" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link text-white" href="{{ route('admin.pendaftaran') }}">
                            <i class="fas fa-users me-2"></i>Monitoring Berkas
                        </a>
                        <a class="nav-link text-white" href="#" onclick="alert('Fitur Master Data segera hadir')">
                            <i class="fas fa-database me-2"></i>Master Data
                        </a>
                        <a class="nav-link text-white" href="#" onclick="alert('Fitur Peta Sebaran segera hadir')">
                            <i class="fas fa-map me-2"></i>Peta Sebaran
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
                        <h2>Dashboard Operasional</h2>
                        <span class="text-muted">{{ now()->format('d F Y') }}</span>
                    </div>

                    <!-- Ringkasan Harian -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $totalPendaftar }}</h4>
                                            <p class="mb-0">Total Pendaftar</p>
                                        </div>
                                        <i class="fas fa-users fa-2x opacity-75"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $pendaftarHariIni }}</h4>
                                            <p class="mb-0">Pendaftar Hari Ini</p>
                                        </div>
                                        <i class="fas fa-calendar-day fa-2x opacity-75"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $terverifikasi }}</h4>
                                            <p class="mb-0">Terverifikasi</p>
                                        </div>
                                        <i class="fas fa-check-circle fa-2x opacity-75"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stat-card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $terbayar }}</h4>
                                            <p class="mb-0">Terbayar</p>
                                        </div>
                                        <i class="fas fa-money-bill-wave fa-2x opacity-75"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik dan Tabel -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Grafik Pendaftaran per Jurusan</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="chartJurusan" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Ringkasan per Jurusan</h5>
                                </div>
                                <div class="card-body">
                                    @foreach($dataJurusan as $jurusan)
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <strong>{{ $jurusan->nama_jurusan }}</strong>
                                            <br><small class="text-muted">Kuota: {{ $jurusan->kuota }}</small>
                                        </div>
                                        <div class="text-end">
                                            <div class="badge bg-primary">{{ $jurusan->total_pendaftar }} pendaftar</div>
                                            <div class="badge bg-success">{{ $jurusan->terverifikasi }} terverifikasi</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Pendaftaran Terbaru -->
                    <div class="card mt-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pendaftaran Terbaru</h5>
                            <a href="{{ route('admin.pendaftaran') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No. Pendaftaran</th>
                                            <th>Nama</th>
                                            <th>Jurusan Pilihan 1</th>
                                            <th>Status Verifikasi</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendaftaranTerbaru as $item)
                                        <tr>
                                            <td>{{ $item->no_pendaftaran }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->jurusanPilihan1->nama_jurusan ?? '-' }}</td>
                                            <td>
                                                @if($item->status_verifikasi == 'diverifikasi')
                                                    <span class="badge bg-success">Diverifikasi</span>
                                                @elseif($item->status_verifikasi == 'ditolak')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                    <span class="badge bg-warning">Belum Diverifikasi</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.detail-pendaftaran', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Chart Pendaftaran per Jurusan
        const ctx = document.getElementById('chartJurusan').getContext('2d');
        const chartJurusan = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($dataJurusan as $jurusan)
                        '{{ $jurusan->nama_jurusan }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Total Pendaftar',
                    data: [
                        @foreach($dataJurusan as $jurusan)
                            {{ $jurusan->total_pendaftar }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Terverifikasi',
                    data: [
                        @foreach($dataJurusan as $jurusan)
                            {{ $jurusan->terverifikasi }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>