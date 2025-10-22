<nav class="navbar navbar-expand-lg sticky-top border-bottom bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
      <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc" height="28">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
      aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="mainNavbar">
      <ul class="navbar-nav mb-lg-0 mb-2 me-auto">
        <li class="nav-item">
          <a class="nav-link"
            href="">Konsultasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"
            href="">Booking</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"
            href="">Apotek</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"
            href="">Layanan Kesehatan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"
            href="">Artikel Kesehatan</a>
        </li>
      </ul>

      <form class="d-none d-lg-flex align-items-center me-3" action="" method="GET"
        role="search">
        <div class="input-group rounded-pill overflow-hidden border" style="max-width: 380px;">
          <span class="input-group-text border-0 bg-white">
            <i class="bi bi-search"></i>
          </span>
          <input type="search" name="q" value="{{ request('q') }}" class="form-control border-0"
            placeholder="Cari di KlikDoc" aria-label="Cari di KlikDoc">
        </div>
      </form>

      @guest
        <div class="d-flex align-items-center gap-2">
          <a href="{{ route('login') }}" class="btn btn-danger rounded-pill px-4">Masuk</a>
          {{-- Opsional: tombol daftar
          <a href="{{ route('register') }}" class="btn btn-outline-secondary rounded-pill px-4">Daftar</a>
          --}}
        </div>
      @else
        <div class="dropdown">
          <button class="btn btn-outline-secondary rounded-pill dropdown-toggle px-3" type="button" id="userMenu"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name ?? 'Akun' }}
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
            <li><a class="dropdown-item" href="">Profil</a></li>
            <li><a class="dropdown-item" href="">Riwayat</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item text-danger">Keluar</button>
              </form>
            </li>
          </ul>
        </div>
      @endguest
    </div>

    <form class="w-100 d-lg-none mt-2" action="" method="GET" role="search">
      <div class="input-group rounded-pill overflow-hidden border">
        <span class="input-group-text border-0 bg-white">
          <i class="bi bi-search"></i>
        </span>
        <input type="search" name="q" value="{{ request('q') }}" class="form-control border-0"
          placeholder="Cari di KlikDoc">
      </div>
    </form>
  </div>
</nav>
