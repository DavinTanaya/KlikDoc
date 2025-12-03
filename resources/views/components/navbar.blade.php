<nav class="navbar navbar-expand-lg sticky-top border-bottom bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
      <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc" height="35px">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
      aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="mainNavbar">
      <ul class="navbar-nav mb-lg-0 mb-2 me-auto">
        <li class="nav-item">
          <a class="nav-link" href="">Konsultasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Booking</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Apotek</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Layanan Kesehatan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Artikel Kesehatan</a>
        </li>
      </ul>

      <form class="d-none d-lg-flex align-items-center me-3" action="" method="GET" role="search">
        <div class="input-group search-box d-none d-md-flex">
          <span class="input-group-text bg-white">
            <i class="bi bi-search"></i>
          </span>
          <input type="text" class="form-control border-start-0" placeholder="Cari di KlikDoc">
        </div>
      </form>

      <button class="btn btn-light position-relative me-3">
        <i class="bi bi-bell-fill"></i>
        <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger top-0">
          12
        </span>
      </button>

      @guest
        <div class="d-flex align-items-center gap-2">
          <a href="{{ route('login') }}" class="btn btn-danger rounded-pill px-4">Masuk</a>
          {{-- Opsional: tombol daftar
          <a href="{{ route('register') }}" class="btn btn-outline-secondary rounded-pill px-4">Daftar</a>
          --}}
        </div>
      @else
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop"
              class="rounded-circle" width="40" height="40" alt="Admin">
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item text-danger"><i
                    class="bi bi-box-arrow-right me-2"></i>Logout</button>
              </form>
            </li>
          </ul>
        </div>
        {{-- <div class="dropdown">
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
        </div> --}}
      @endguest
    </div>

    <form class="w-100 d-lg-none mt-2" action="" method="GET" role="search">
      <div class="input-group search-box d-none d-md-flex">
        <span class="input-group-text bg-white">
          <i class="bi bi-search"></i>
        </span>
        <input type="text" class="form-control border-start-0" placeholder="Cari...">
      </div>
    </form>
  </div>
</nav>
