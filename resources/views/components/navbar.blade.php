<nav class="navbar navbar-expand-lg sticky-top border-bottom bg-white py-2 shadow-sm">
  <div class="container">

    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
      <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc" height="35">
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar"
      aria-controls="userNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="userNavbar">

      <ul class="navbar-nav mb-lg-0 fw-medium mx-auto mb-2">
        <li class="nav-item px-2">
          <a class="nav-link {{ request()->is('konsultasi*') ? 'active text-primary fw-bold' : '' }}"
            href="{{ route('konsultasi') }}">Konsultasi</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link {{ request()->is('booking*') ? 'active text-primary fw-bold' : '' }}"
            href="#">Booking</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link {{ request()->is('apotek*') ? 'active text-primary fw-bold' : '' }}"
            href="{{ route('apotek') }}">Apotek</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link {{ request()->is('layanan*') ? 'active text-primary fw-bold' : '' }}"
            href="#">Layanan Kesehatan</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link {{ request()->is('artikel*') ? 'active text-primary fw-bold' : '' }}"
            href="{{ route('artikel') }}">Artikel Kesehatan</a>
        </li>
      </ul>

      <div class="d-flex align-items-center justify-content-end gap-3">

        <form class="d-none d-lg-block" role="search">
          <div class="input-group">
            <span class="input-group-text bg-light border-end-0 rounded-start-pill text-muted py-1">
              <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control bg-light border-start-0 rounded-end-pill py-1"
              placeholder="Cari obat, dokter..." style="width: 200px; font-size: 0.9rem;">
          </div>
        </form>

        <div class="dropdown">
          @if (auth()->check() && auth()->user()->role === 'user')
            <a href="{{ route('chat.index') }}" class="btn btn-light position-relative rounded-circle text-secondary"
              style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-envelope-fill"></i>
              {{-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">
                                12
                            </span> --}}
            </a>
          @elseif(auth()->check() && auth()->user()->role === 'doctor')
            <a href="{{ route('dokter.chat.index') }}"
              class="btn btn-light position-relative rounded-circle text-secondary"
              style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-envelope-fill"></i>
              {{-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">
                                8
                            </span> --}}
            </a>
          @endif
          <ul class="dropdown-menu dropdown-menu-end mt-2 border-0 shadow-sm">
            <li>
              <h6 class="dropdown-header">Notifikasi</h6>
            </li>
            <li><a class="dropdown-item" href="#">Jadwal konsultasi besok</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item small text-primary text-center" href="#">Lihat Semua</a></li>
          </ul>
        </div>

        <div class="vr d-none d-lg-block mx-1" style="height: 25px; align-self: center;"></div>

        @guest
          <div class="d-flex gap-2">
            <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill fw-semibold px-4">Masuk</a>
            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill fw-semibold px-4">Daftar</a>
          </div>
        @else
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle gap-2"
              data-bs-toggle="dropdown" aria-expanded="false">

              <div class="d-none d-lg-block lh-1 text-end">
                <span class="d-block fw-bold text-dark"
                  style="font-size: 0.9rem;">{{ Str::limit(Auth::user()->name, 15) }}</span>
              </div>

              <img
                src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random' }}"
                class="rounded-circle border" width="40" height="40" alt="User">
            </a>

            <ul class="dropdown-menu dropdown-menu-end mt-2 border-0 shadow-sm">
              <li class="d-lg-none border-bottom bg-light mb-2 px-3 py-2">
                <span class="fw-bold d-block">{{ Auth::user()->name }}</span>
                <small class="text-muted">{{ Auth::user()->email }}</small>
              </li>

              @if (auth()->user()->role === 'admin')
                <li><a class="dropdown-item py-2" href="{{ route('admin.index') }}"><i
                      class="bi bi-speedometer2 text-secondary me-2"></i>Admin Area</a></li>
              @elseif(auth()->user()->role === 'doctor')
                <li><a class="dropdown-item py-2" href="{{ route('dokter.dashboard') }}"><i
                      class="bi bi-speedometer2 text-secondary me-2"></i>Doctor Area</a></li>
              @endif
              <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person text-secondary me-2"></i>Profil
                  Saya</a></li>
              <li><a class="dropdown-item py-2" href="{{ route('konsultasi.riwayat') }}"><i
                    class="bi bi-clock-history text-secondary me-2"></i>Riwayat Medis</a></li>
              <li><a class="dropdown-item py-2" href="{{ route('orders.history') }}"><i
                    class="bi bi-receipt text-secondary me-2"></i>Transaksi</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger py-2">
                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                  </button>
                </form>
              </li>
            </ul>
          </div>
        @endguest
      </div>
    </div>

    <div class="w-100 d-lg-none show collapse mt-3" id="mobileSearch">
      <form role="search">
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0 text-muted">
            <i class="bi bi-search"></i>
          </span>
          <input type="text" class="form-control bg-light border-start-0"
            placeholder="Cari dokter, spesialis, atau obat...">
        </div>
      </form>
    </div>

  </div>
</nav>
