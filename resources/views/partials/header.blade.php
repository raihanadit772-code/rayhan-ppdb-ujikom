  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="d-none d-md-flex align-items-center">
          <i class="bi bi-clock me-1"></i> PPDB 2026: 1 Juni - 30 Juni 2026
        </div>
        <div class="d-flex align-items-center">
          <i class="bi bi-phone me-1"></i> Info PPDB: +62 812-3456-7890
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-end">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
          <img src="{{ asset('assets/img/a.JPG') }}" alt="SMK Bakti Nusantara 666" style="height: 60px; margin-right: 10px;">
          <div>
            <h1 class="sitename" style="font-size: 1.5rem; margin: 0; line-height: 1.2;">SMK Bakti Nusantara 666</h1>
            <small style="color: #666; font-size: 0.8rem;">Sekolah Menengah Kejuruan</small>
          </div>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="{{ url('/') }}" class="{{ Request::is(patterns: '/') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ url('/about') }}" class="{{ Request::is(patterns: 'about') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ url('/jurusan') }}" class="{{ Request::is(patterns: 'jurusan') ? 'active' : '' }}">Jurusan</a></li>

            <li><a href="{{ url('/kontak') }}" class="{{ Request::is('kontak') ? 'active' : '' }}">Kontak</a></li>
            <li><a href="{{ route('login') }}" class="{{ Request::is('login') ? 'active' : '' }}">Login</a></li>
            </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>



      </div>

    </div>

  </header>