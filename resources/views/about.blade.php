@extends('layout.main')

@section('title', 'Tentang Kami - SMK Bakti Nusantara 666')

@section('styles')
<style>
.hero-about {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 100px 0;
    position: relative;
}
.hero-about::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset('assets/img/bn.jpeg') }}') center/cover;
    opacity: 0.1;
}
.hero-about .container {
    position: relative;
    z-index: 2;
}
.feature-box {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
    text-align: center;
}
.feature-box:hover {
    transform: translateY(-10px);
}
.feature-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin: 0 auto 1.5rem;
}
.stats-modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4rem 0;
}
.stat-card {
    text-align: center;
    padding: 2rem;
    background: rgba(255,255,255,0.1);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
}
.stat-number {
    font-size: 3rem;
    font-weight: 700;
    display: block;
    margin-bottom: 0.5rem;
}
.facility-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
    text-align: center;
}
.facility-card:hover {
    transform: translateY(-5px);
}
.facility-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin: 0 auto 1rem;
}
</style>
@endsection

@section('content')

    <!-- Modern Hero Section -->
    <section class="hero-about">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-4" data-aos="fade-up">Tentang SMK Bakti Nusantara 666</h1>
            <p class="lead mb-0" data-aos="fade-up" data-aos-delay="200">Mencetak Generasi Unggul, Berkarakter, dan Siap Menghadapi Masa Depan</p>
        </div>
    </section>

    <!-- Vision Mission Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="display-5 fw-bold mb-4">Visi & Misi Kami</h2>
                    <div class="mb-4">
                        <h4 class="text-primary mb-3"><i class="fas fa-eye me-2"></i>Visi</h4>
                        <p class="lead">Menjadi SMK unggul yang menghasilkan lulusan kompeten, berkarakter, dan berdaya saing global pada tahun 2030.</p>
                    </div>
                    <div>
                        <h4 class="text-success mb-3"><i class="fas fa-bullseye me-2"></i>Misi</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Menyelenggarakan pendidikan kejuruan berkualitas</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Mengembangkan karakter siswa yang SAJUTA</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Membangun kemitraan dengan dunia industri</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Menghasilkan lulusan siap kerja dan wirausaha</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="feature-box">
                                <div class="feature-icon bg-primary">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <h5>Pendidikan Berkualitas</h5>
                                <p class="text-muted">Kurikulum modern sesuai standar industri</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="feature-box">
                                <div class="feature-icon bg-success">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5>Tenaga Ahli</h5>
                                <p class="text-muted">Guru profesional dan berpengalaman</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="feature-box">
                                <div class="feature-icon bg-warning">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <h5>Fasilitas Modern</h5>
                                <p class="text-muted">Laboratorium dan workshop lengkap</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="feature-box">
                                <div class="feature-icon bg-info">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <h5>Kemitraan Industri</h5>
                                <p class="text-muted">Kerjasama dengan perusahaan terkemuka</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-modern">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card">
                        <span class="stat-number">1200+</span>
                        <span>Siswa Aktif</span>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card">
                        <span class="stat-number">85+</span>
                        <span>Guru & Staff</span>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <span class="stat-number">5</span>
                        <span>Program Keahlian</span>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-card">
                        <span class="stat-number">95%</span>
                        <span>Tingkat Kelulusan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold" data-aos="fade-up">Fasilitas Unggulan</h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="200">Fasilitas modern untuk mendukung pembelajaran optimal</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="facility-card">
                        <div class="facility-icon bg-primary">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h5>Lab Komputer</h5>
                        <p class="text-muted">5 ruang lab dengan perangkat terbaru dan internet berkecepatan tinggi</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="facility-card">
                        <div class="facility-icon bg-success">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h5>Workshop Praktik</h5>
                        <p class="text-muted">Bengkel lengkap untuk praktik sesuai program keahlian</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="facility-card">
                        <div class="facility-icon bg-warning">
                            <i class="fas fa-book"></i>
                        </div>
                        <h5>Perpustakaan Digital</h5>
                        <p class="text-muted">Koleksi buku fisik dan digital dengan ruang baca nyaman</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="facility-card">
                        <div class="facility-icon bg-info">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h5>WiFi Campus</h5>
                        <p class="text-muted">Internet gratis di seluruh area dengan bandwidth dedicated</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="facility-card">
                        <div class="facility-icon bg-danger">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <h5>Fasilitas Olahraga</h5>
                        <p class="text-muted">Lapangan olahraga dan aula untuk kegiatan ekstrakurikuler</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="facility-card">
                        <div class="facility-icon bg-secondary">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h5>Kantin & Koperasi</h5>
                        <p class="text-muted">Kantin sehat dan koperasi siswa untuk kebutuhan harian</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="display-5 fw-bold mb-4" data-aos="fade-up">Bergabunglah dengan Keluarga Besar Kami</h2>
                    <p class="lead mb-4" data-aos="fade-up" data-aos-delay="200">Wujudkan impian menjadi lulusan yang kompeten, berkarakter, dan siap menghadapi tantangan masa depan</p>
                    <div class="d-flex justify-content-center flex-wrap gap-3" data-aos="fade-up" data-aos-delay="400">
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4 py-3">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                        <a href="{{ url('/jurusan') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                            <i class="fas fa-graduation-cap me-2"></i>Lihat Program Keahlian
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection