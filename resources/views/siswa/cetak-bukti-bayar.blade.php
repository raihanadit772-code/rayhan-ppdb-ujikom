<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran - {{ $pembayaran->kode_pembayaran }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table td { padding: 8px; border: 1px solid #ddd; }
        .status { padding: 5px 10px; border-radius: 5px; color: white; }
        .status.lunas { background-color: #28a745; }
        .status.menunggu { background-color: #ffc107; color: #000; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="header">
        <h2>BUKTI PEMBAYARAN PPDB</h2>
        <p>SMKS BAKTI NUSANTARA 666</p>
    </div>

    <table class="info-table">
        <tr>
            <td width="30%"><strong>Kode Pembayaran</strong></td>
            <td>{{ $pembayaran->kode_pembayaran }}</td>
        </tr>
        <tr>
            <td><strong>Nama Siswa</strong></td>
            <td>{{ $pembayaran->pendaftaran->nama_lengkap }}</td>
        </tr>
        <tr>
            <td><strong>No. Pendaftaran</strong></td>
            <td>{{ $pembayaran->pendaftaran->no_pendaftaran }}</td>
        </tr>
        <tr>
            <td><strong>Jenis Pembayaran</strong></td>
            <td>{{ ucfirst(str_replace('_', ' ', $pembayaran->jenis_pembayaran)) }}</td>
        </tr>
        <tr>
            <td><strong>Jumlah</strong></td>
            <td>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td><strong>Status</strong></td>
            <td>
                <span class="status {{ $pembayaran->status_pembayaran == 'lunas' ? 'lunas' : 'menunggu' }}">
                    {{ ucfirst(str_replace('_', ' ', $pembayaran->status_pembayaran)) }}
                </span>
            </td>
        </tr>
        <tr>
            <td><strong>Tanggal Bayar</strong></td>
            <td>{{ $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d F Y H:i') : '-' }}</td>
        </tr>
        @if($pembayaran->tanggal_verifikasi)
        <tr>
            <td><strong>Tanggal Verifikasi</strong></td>
            <td>{{ $pembayaran->tanggal_verifikasi->format('d F Y H:i') }}</td>
        </tr>
        @endif
    </table>

    <div class="no-print" style="text-align: center; margin-top: 30px;">
        <button onclick="window.print()" class="btn btn-primary">Cetak</button>
        <button onclick="window.close()" class="btn btn-secondary">Tutup</button>
    </div>
</body>
</html>