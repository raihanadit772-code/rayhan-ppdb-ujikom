<footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">SMK BAKTI NUSANTARA 666</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>Jl. Raya Percobaan No.65, Cileunyi Kulon, Kec. Cileunyi, Kabupaten Bandung, Jawa Barat 40622</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 89656485998</span></p>
            <p><strong>Email:</strong> <span>smkbaknus666@gmail.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Menu Utama</h4>
          <ul>
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
            <li><a href="{{ url('/jurusan') }}">Program Keahlian</a></li>
            <li><a href="{{ url('/kontak') }}">Kontak</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Program Keahlian</h4>
          <ul>
            <li><a href="{{ url('/jurusan') }}">PPLG</a></li>
            <li><a href="{{ url('/jurusan') }}">DKV</a></li>
            <li><a href="{{ url('/jurusan') }}">Animasi</a></li>
            <li><a href="{{ url('/jurusan') }}">BDP</a></li>
            <li><a href="{{ url('/jurusan') }}">Akuntansi</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Informasi PPDB</h4>
          <ul>
            <li><a href="{{ route('login') }}">Portal Siswa</a></li>
            <li><a href="{{ route('siswa.register') }}">Daftar Akun</a></li>
            <li><a href="{{ url('/about') }}">Syarat Pendaftaran</a></li>
            <li><a href="{{ url('/kontak') }}">Bantuan</a></li>
            <li><a href="{{ url('/about') }}">FAQ</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">SMK BAKTI NUSANTARA 666</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>