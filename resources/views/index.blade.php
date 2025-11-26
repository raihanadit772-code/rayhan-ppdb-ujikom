@extends('layout.main')

@section('title', 'Beranda - PPDB SMK Bakti Nusantara 666')

@section('styles')
<style>
.hero-modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}
.hero-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset('assets/img/hero-carousel/da.jpeg') }}') center/cover;
    opacity: 0.1;
    z-index: 1;
}
.hero-content {
    position: relative;
    z-index: 2;
    color: white;
    text-align: center;
}
.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.hero-subtitle {
    font-size: 1.3rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}
.cta-buttons {
    gap: 1rem;
}
.btn-modern {
    padding: 15px 30px;
    border-radius: 50px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    border: none;
    text-decoration: none;
    display: inline-block;
}
.btn-primary-modern {
    background: linear-gradient(45deg, #ff6b6b, #ee5a24);
    color: white;
}
.btn-primary-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(255, 107, 107, 0.4);
    color: white;
}
.btn-outline-modern {
    background: transparent;
    color: white;
    border: 2px solid white;
}
.btn-outline-modern:hover {
    background: white;
    color: #667eea;
    transform: translateY(-3px);
}
.feature-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
}
.feature-card:hover {
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
.stats-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4rem 0;
}
.stat-item {
    text-align: center;
    margin-bottom: 2rem;
}
.stat-number {
    font-size: 3rem;
    font-weight: 700;
    display: block;
}
.stat-label {
    font-size: 1.1rem;
    opacity: 0.9;
}
</style>
@endsection

@section('content')

    <!-- Modern Hero Section -->
    <section class="hero-modern">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title" data-aos="fade-up">SMK Bakti Nusantara 666</h1>
                <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">
                    Mencetak Generasi Unggul, Berkarakter, dan Siap Kerja<br>
                    <strong>"SAJUTA - Santun, Jujur, dan Taat"</strong>
                </p>
                <div class="cta-buttons d-flex justify-content-center flex-wrap" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('login') }}" class="btn-modern btn-primary-modern me-3 mb-2">
                        <i class="fas fa-sign-in-alt me-2"></i>Portal Siswa
                    </a>
                    <a href="{{ url('/jurusan') }}" class="btn-modern btn-outline-modern mb-2">
                        <i class="fas fa-graduation-cap me-2"></i>Lihat Jurusan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                        <span class="stat-number">5+</span>
                        <span class="stat-label">Program Keahlian</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                        <span class="stat-number">95%</span>
                        <span class="stat-label">Tingkat Kelulusan</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Prestasi Diraih</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                        <span class="stat-number">85%</span>
                        <span class="stat-label">Lulusan Terserap Kerja</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold" data-aos="fade-up">Mengapa Memilih SMK Bakti Nusantara 666?</h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="200">Keunggulan yang membuat kami berbeda</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card text-center">
                        <div class="feature-icon bg-primary">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Prestasi Gemilang</h4>
                        <p class="text-muted">Juara 1 Paskibra se-Kota Bandung, Juara 1 Futsal se-Kabupaten, Juara 1 Coding Pelajar, dan 50+ prestasi lainnya di tingkat kota hingga provinsi.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card text-center">
                        <div class="feature-icon bg-success">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Keunggulan Akademik</h4>
                        <p class="text-muted">Mencetak generasi kompeten dan berkarakter dengan fasilitas lengkap, tenaga pendidik berpengalaman, dan kurikulum sesuai kebutuhan industri.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card text-center">
                        <div class="feature-icon bg-warning">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Siap Kerja</h4>
                        <p class="text-muted">Fokus keterampilan praktis, magang industri, peluang wirausaha, dan jaringan profesional luas melalui kerjasama dengan perusahaan.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card text-center">
                        <div class="feature-icon bg-info">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Karakter SAJUTA</h4>
                        <p class="text-muted">Membentuk siswa yang <strong>Santun, Jujur, dan Taat</strong> - nilai-nilai yang menjadi fondasi kuat untuk masa depan yang gemilang.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="display-5 fw-bold mb-4" data-aos="fade-up">Siap Memulai Masa Depan Cemerlang?</h2>
                    <p class="lead mb-4" data-aos="fade-up" data-aos-delay="200">Bergabunglah dengan ribuan siswa yang telah merasakan pendidikan berkualitas di SMK Bakti Nusantara 666</p>
                    <div class="d-flex justify-content-center flex-wrap gap-3" data-aos="fade-up" data-aos-delay="400">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-3">
                            <i class="fas fa-user-plus me-2"></i>Mulai Daftar
                        </a>
                        <a href="{{ url('/about') }}" class="btn btn-outline-primary btn-lg px-4 py-3">
                            <i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

  
@endsection