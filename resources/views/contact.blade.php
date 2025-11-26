@extends('layout.main')

@section('title', 'Kontak - SMK Bakti Nusantara 666')

@section('styles')
<style>
.hero-contact {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 100px 0;
}
.contact-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    height: 100%;
}
.contact-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-bottom: 1rem;
}
</style>
@endsection

@section('content')

<section class="hero-contact">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-4" data-aos="fade-up">Hubungi Kami</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="200">Kami siap membantu menjawab pertanyaan Anda</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-card text-center">
                    <div class="contact-icon bg-primary mx-auto">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h5>Alamat</h5>
                    <p class="text-muted">Jl. Pendidikan No. 123<br>Bandung, Jawa Barat 40123</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="contact-card text-center">
                    <div class="contact-icon bg-success mx-auto">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h5>Telepon</h5>
                    <p class="text-muted">+62 812-3456-7890<br>+62 22-1234-5678</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="contact-card text-center">
                    <div class="contact-icon bg-info mx-auto">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h5>Email</h5>
                    <p class="text-muted">info@smkbaktinusantara666.sch.id<br>ppdb@smkbaktinusantara666.sch.id</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="contact-card">
                    <h3 class="text-center mb-4">Kirim Pesan</h3>
                    <form method="POST" action="{{ route('kontak.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-12">
                                <input type="text" name="subjek" class="form-control" placeholder="Subjek" required>
                            </div>
                            <div class="col-12">
                                <textarea name="pesan" class="form-control" rows="5" placeholder="Pesan Anda" required></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection