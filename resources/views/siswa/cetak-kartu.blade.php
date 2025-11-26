<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Peserta - {{ $pendaftaran->no_pendaftaran }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .kartu { width: 400px; height: 250px; border: 2px solid #000; margin: 0 auto; padding: 20px; position: relative; background: white; }
        .header { text-align: center; border-bottom: 1px solid #000; padding-bottom: 10px; margin-bottom: 15px; }
        .foto { width: 90px; height: 110px; border: 1px solid #000; float: right; margin-left: 15px; background: #f5f5f5; display: flex; align-items: center; justify-content: center; font-size: 10px; }
        .info { font-size: 13px; line-height: 1.5; }
        .info strong { display: inline-block; width: 90px; }
        .footer { position: absolute; bottom: 10px; right: 15px; font-size: 10px; }
        @media print { .no-print { display: none; } body { margin: 0; } }
    </style>
</head>
<body>
    <div class="kartu">
        <div class="header">
            <h3 style="margin: 0; font-size: 14px;">KARTU PESERTA PPDB</h3>
            <p style="margin: 5px 0; font-size: 12px;">SMK Negeri 1 Jakarta</p>
        </div>
        
        <div class="foto">
            @if($pendaftaran->pas_foto_path)
                <img src="{{ asset('storage/' . $pendaftaran->pas_foto_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                Pas Foto
            @endif
        </div>
        
        <div class="info">
            <p><strong>No. Peserta:</strong> {{ $pendaftaran->no_pendaftaran }}</p>
            <p><strong>Nama:</strong> {{ $pendaftaran->nama_lengkap }}</p>
            <p><strong>NISN:</strong> {{ $pendaftaran->nisn }}</p>
            <p><strong>Tempat/Tgl Lahir:</strong> {{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir->format('d/m/Y') }}</p>
            <p><strong>Jurusan:</strong> {{ $pendaftaran->jurusanPilihan1->nama_jurusan ?? '-' }}</p>
            <p><strong>Status:</strong> 
                @if($pendaftaran->status_verifikasi == 'diverifikasi' && $pembayaran_lunas)
                    <span style="color: green; font-weight: bold;">DITERIMA</span>
                @else
                    <span style="color: orange;">PROSES</span>
                @endif
            </p>
        </div>
        
        <div class="footer">
            Dicetak: {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 30px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Cetak Kartu</button>
        <button onclick="history.back()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">Tutup</button>
    </div>
</body>
</html>