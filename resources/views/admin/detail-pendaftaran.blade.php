@extends('admin.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Detail Pendaftaran</h1>
        <a href="{{ route('admin.pendaftaran') }}" class="btn btn-secondary mb-3">Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Data Pendaftar</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="200"><strong>No. Pendaftaran</strong></td>
                        <td>: {{ $pendaftaran->no_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Lengkap</strong></td>
                        <td>: {{ $pendaftaran->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td><strong>NISN</strong></td>
                        <td>: {{ $pendaftaran->nisn }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tempat, Tanggal Lahir</strong></td>
                        <td>: {{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Kelamin</strong></td>
                        <td>: {{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Agama</strong></td>
                        <td>: {{ $pendaftaran->agama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Asal Sekolah</strong></td>
                        <td>: {{ $pendaftaran->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tahun Lulus</strong></td>
                        <td>: {{ $pendaftaran->tahun_lulus }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>: {{ $pendaftaran->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>No. HP</strong></td>
                        <td>: {{ $pendaftaran->no_hp }}</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat</strong></td>
                        <td>: {{ $pendaftaran->alamat }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">
                <h5>Nilai Rapor</h5>
            </div>
            <div class="card-body">
                <p><strong>Matematika:</strong> {{ $pendaftaran->nilai_matematika }}</p>
                <p><strong>Bahasa Indonesia:</strong> {{ $pendaftaran->nilai_bahasa_indonesia }}</p>
                <p><strong>Bahasa Inggris:</strong> {{ $pendaftaran->nilai_bahasa_inggris }}</p>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5>Pilihan Jurusan</h5>
            </div>
            <div class="card-body">
                <p><strong>Pilihan 1:</strong> {{ $pendaftaran->jurusanPilihan1->nama ?? '-' }}</p>
                <p><strong>Pilihan 2:</strong> {{ $pendaftaran->jurusanPilihan2->nama ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection