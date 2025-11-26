<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        .payment-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .payment-card:hover {
            transform: translateY(-3px);
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
                        <a class="nav-link text-white" href="{{ route('siswa.dashboard') }}">
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
                        <a class="nav-link text-white active" href="{{ route('siswa.pembayaran') }}">
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
                        <h2>Pembayaran</h2>
                        <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
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

                    @if($pembayaran->count() > 0)
                        <div class="row">
                            @foreach($pembayaran as $bayar)
                            <div class="col-md-6 mb-4">
                                <div class="card payment-card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">{{ ucfirst(str_replace('_', ' ', $bayar->jenis_pembayaran)) }}</h5>
                                        @if($bayar->status_pembayaran == 'belum_bayar')
                                            <span class="badge bg-secondary">Belum Bayar</span>
                                        @elseif($bayar->status_pembayaran == 'dikonfirmasi')
                                            <span class="badge bg-info">Dikonfirmasi</span>
                                        @elseif($bayar->status_pembayaran == 'menunggu_verifikasi')
                                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                                        @elseif($bayar->status_pembayaran == 'lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <strong>Kode Pembayaran:</strong><br>
                                            <code>{{ $bayar->kode_pembayaran }}</code>
                                        </div>
                                        <div class="mb-3">
                                            <strong>Jumlah:</strong><br>
                                            <h4 class="text-primary">Rp {{ number_format($bayar->jumlah, 0, ',', '.') }}</h4>
                                        </div>
                                        
                                        @if($bayar->status_pembayaran == 'belum_bayar')
                                            <div class="alert alert-info">
                                                <h6>Instruksi Pembayaran:</h6>
                                                <p class="mb-2">Transfer ke rekening:</p>
                                                <p class="mb-1"><strong>Bank BCA: 1234567890</strong></p>
                                                <p class="mb-1"><strong>a.n. SMKS BAKTI NUSANTARA 666</strong></p>
                                                <small>Gunakan kode pembayaran sebagai berita transfer</small>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <button type="button" class="btn btn-success" onclick="konfirmasiPembayaran({{ $bayar->id }})">
                                                    <i class="fas fa-check me-2"></i>Konfirmasi Sudah Bayar
                                                </button>
                                            </div>
                                            
                                            <form method="POST" action="{{ route('siswa.upload-bukti-bayar', $bayar->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label">Upload Bukti Pembayaran</label>
                                                    <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-upload me-2"></i>Upload Bukti
                                                </button>
                                            </form>
                                        @elseif($bayar->status_pembayaran == 'dikonfirmasi')
                                            <div class="alert alert-warning">
                                                <i class="fas fa-clock me-2"></i>Pembayaran telah dikonfirmasi. Menunggu verifikasi dari tim keuangan.
                                            </div>
                                            @if($bayar->bukti_pembayaran)
                                                <img src="{{ asset('storage/' . $bayar->bukti_pembayaran) }}" class="img-thumbnail" style="max-width: 200px;" alt="Bukti Bayar">
                                            @endif
                                        @elseif($bayar->status_pembayaran == 'menunggu_verifikasi')
                                            <div class="alert alert-warning">
                                                <i class="fas fa-clock me-2"></i>Bukti pembayaran sedang diverifikasi oleh tim keuangan.
                                            </div>
                                            @if($bayar->bukti_pembayaran)
                                                <img src="{{ asset('storage/' . $bayar->bukti_pembayaran) }}" class="img-thumbnail" style="max-width: 200px;" alt="Bukti Bayar">
                                            @endif
                                        @elseif($bayar->status_pembayaran == 'lunas')
                                            <div class="alert alert-success">
                                                <i class="fas fa-check-circle me-2"></i>Pembayaran telah lunas dan terverifikasi.
                                            </div>
                                            <a href="{{ route('siswa.cetak-bukti-bayar', $bayar->id) }}" class="btn btn-success">
                                                <i class="fas fa-print me-2"></i>Cetak Bukti Bayar
                                            </a>
                                        @else
                                            <div class="alert alert-danger">
                                                <i class="fas fa-times-circle me-2"></i>Pembayaran ditolak.
                                                @if($bayar->catatan_pembayaran)
                                                    <br><small>Catatan: {{ $bayar->catatan_pembayaran }}</small>
                                                @endif
                                            </div>
                                            
                                            <form method="POST" action="{{ route('siswa.upload-bukti-bayar', $bayar->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label">Upload Ulang Bukti Pembayaran</label>
                                                    <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-upload me-2"></i>Upload Ulang
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-credit-card fa-4x text-muted mb-4"></i>
                                <h4>Belum Ada Tagihan Pembayaran</h4>
                                <p class="text-muted mb-4">Tagihan pembayaran akan muncul setelah pendaftaran Anda diverifikasi</p>
                                <a href="{{ route('siswa.status-pendaftaran') }}" class="btn btn-primary">
                                    <i class="fas fa-eye me-2"></i>Cek Status Pendaftaran
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function konfirmasiPembayaran(id) {
            if (confirm('Apakah Anda yakin sudah melakukan pembayaran?')) {
                fetch(`/siswa/konfirmasi-pembayaran/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan sistem');
                });
            }
        }
    </script>
</body>
</html>