<nav class="navbar navbar-expand-lg sticky-top border-bottom bg-white shadow-sm py-2">
    <div class="container">
        
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc" height="35">
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar"
            aria-controls="userNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="userNavbar">
            
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium">
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('konsultasi*') ? 'active text-primary fw-bold' : '' }}" href="{{ route('konsultasi') }}">Konsultasi</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('booking*') ? 'active text-primary fw-bold' : '' }}" href="#">Booking</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('apotek*') ? 'active text-primary fw-bold' : '' }}" href="{{ route('apotek') }}">Apotek</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('layanan*') ? 'active text-primary fw-bold' : '' }}" href="#">Layanan Kesehatan</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('artikel*') ? 'active text-primary fw-bold' : '' }}" href="{{ route('artikel') }}">Artikel Kesehatan</a>
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
                    <button class="btn btn-light position-relative rounded-circle text-secondary" 
                            type="button" data-bs-toggle="dropdown" style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-bell-fill"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">
                            12
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                        <li><h6 class="dropdown-header">Notifikasi</h6></li>
                        <li><a class="dropdown-item" href="#">Jadwal konsultasi besok</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center small text-primary" href="#">Lihat Semua</a></li>
                    </ul>
                </div>

                <div class="vr d-none d-lg-block mx-1" style="height: 25px; align-self: center;"></div>

                @guest
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 fw-semibold">Masuk</a>
                        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 fw-semibold">Daftar</a>
                    </div>
                @else
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle gap-2"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            
                            <div class="d-none d-lg-block text-end lh-1">
                                <span class="d-block fw-bold text-dark" style="font-size: 0.9rem;">{{ Str::limit(Auth::user()->name, 15) }}</span>
                            </div>
                            
                            <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=random' }}" 
                                 class="rounded-circle border" width="40" height="40" alt="User">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                            <li class="d-lg-none px-3 py-2 border-bottom mb-2 bg-light">
                                <span class="fw-bold d-block">{{ Auth::user()->name }}</span>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </li>

                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2 text-secondary"></i>Profil Saya</a></li>
                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-clock-history me-2 text-secondary"></i>Riwayat Medis</a></li>
                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-receipt me-2 text-secondary"></i>Transaksi</a></li>
                            <li><hr class="dropdown-divider"></li>
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

        <div class="w-100 d-lg-none mt-3 collapse show" id="mobileSearch">
            <form role="search">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control bg-light border-start-0" placeholder="Cari dokter, spesialis, atau obat...">
                </div>
            </form>
        </div>
        
    </div>
</nav>