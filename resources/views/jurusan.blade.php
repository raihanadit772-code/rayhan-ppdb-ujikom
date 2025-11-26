@extends('layout.main')

@section('title', 'Program Keahlian - SMK Bakti Nusantara 666')

@section('styles')
<style>
.hero-jurusan {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 100px 0;
}
.jurusan-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
}
.jurusan-card:hover {
    transform: translateY(-10px);
}
.jurusan-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin: 0 auto 1rem;
}
</style>
@endsection

@section('content')

<section class="hero-jurusan">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-4" data-aos="fade-up">Program Keahlian</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="200">Pilih program keahlian sesuai minat dan bakatmu</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="jurusan-card">
                    <div class="p-4 text-center">
                        <div class="jurusan-icon bg-primary">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h4 class="fw-bold mb-3">PPLG</h4>
                        <p class="text-muted mb-3">Pengembangan Perangkat Lunak dan Gim - Mempelajari pemrograman, web development, dan game development</p>
                        <div class="d-flex justify-content-between text-sm">
                            <span><i class="fas fa-users me-1"></i>Kuota: 72</span>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="jurusan-card">
                    <div class="p-4 text-center">
                        <div class="jurusan-icon bg-success">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <h4 class="fw-bold mb-3">DKV</h4>
                        <p class="text-muted mb-3">Desain Komunikasi Visual - Mempelajari desain grafis, branding, dan komunikasi visual</p>
                        <div class="d-flex justify-content-between text-sm">
                            <span><i class="fas fa-users me-1"></i>Kuota: 36</span>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="jurusan-card">
                    <div class="p-4 text-center">
                        <div class="jurusan-icon bg-warning">
                            <i class="fas fa-video"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Animasi</h4>
                        <p class="text-muted mb-3">Animasi 2D dan 3D - Mempelajari pembuatan animasi, motion graphics, dan multimedia</p>
                        <div class="d-flex justify-content-between text-sm">
                            <span><i class="fas fa-users me-1"></i>Kuota: 36</span>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="jurusan-card">
                    <div class="p-4 text-center">
                        <div class="jurusan-icon bg-info">
                            <i class="fas fa-store"></i>
                        </div>
                        <h4 class="fw-bold mb-3">BDP</h4>
                        <p class="text-muted mb-3">Bisnis Daring dan Pemasaran - Mempelajari e-commerce, digital marketing, dan bisnis online</p>
                        <div class="d-flex justify-content-between text-sm">
                            <span><i class="fas fa-users me-1"></i>Kuota: 36</span>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="jurusan-card">
                    <div class="p-4 text-center">
                        <div class="jurusan-icon bg-danger">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Akuntansi</h4>
                        <p class="text-muted mb-3">Akuntansi dan Keuangan Lembaga - Mempelajari pembukuan, perpajakan, dan manajemen keuangan</p>
                        <div class="d-flex justify-content-between text-sm">
                            <span><i class="fas fa-users me-1"></i>Kuota: 36</span>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection