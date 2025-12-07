<nav class="navbar navbar-expand-xl sticky-top border-bottom bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc" height="35">
        </a>

        <div class="d-flex align-items-center gap-3 ms-auto order-xl-last">
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
                    <a href="{{ route('chat.index') }}"
                        class="btn btn-light position-relative rounded-circle text-secondary"
                        style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                @elseif(auth()->check() && auth()->user()->role === 'doctor')
                    <a href="{{ route('dokter.chat.index') }}"
                        class="btn btn-light position-relative rounded-circle text-secondary"
                        style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                @else
                    <button class="btn btn-light position-relative rounded-circle text-secondary" type="button"
                        data-bs-toggle="dropdown"
                        style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-bell-fill"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">12</span>
                    </button>
                @endif

                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                    <li>
                        <h6 class="dropdown-header">Notifikasi</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Jadwal konsultasi besok</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-center small text-primary" href="#">Lihat Semua</a></li>
                </ul>
            </div>

            <div class="vr d-none d-lg-block mx-2" style="height: 30px; align-self: center; width: 2px;"></div>

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
                            <span class="d-block fw-bold text-dark"
                                style="font-size: 0.9rem;">{{ Str::limit(Auth::user()->name, 15) }}</span>
                        </div>

                        <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random' }}"
                            class="rounded-circle border" width="40" height="40" alt="User">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                        <li class="d-lg-none px-3 py-2 border-bottom mb-2 bg-light">
                            <span class="fw-bold d-block">{{ Auth::user()->name }}</span>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </li>

                        @if (auth()->user()->role === 'admin')
                            <li><a class="dropdown-item py-2" href="{{ route('admin.index') }}"><i
                                        class="bi bi-speedometer2 me-2 text-secondary"></i>Admin Area</a></li>
                        @elseif(auth()->user()->role === 'doctor')
                            <li><a class="dropdown-item py-2" href="{{ route('dokter.dashboard') }}"><i
                                        class="bi bi-speedometer2 me-2 text-secondary"></i>Doctor Area</a></li>
                        @endif

                        <li><a class="dropdown-item py-2" href="#"><i
                                    class="bi bi-person me-2 text-secondary"></i>Profil Saya</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('konsultasi.riwayat') }}"><i
                                    class="bi bi-clock-history me-2 text-secondary"></i>Riwayat Medis</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('orders.history') }}"><i
                                    class="bi bi-receipt me-2 text-secondary"></i>Transaksi</a></li>
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

        <button class="navbar-toggler border-0 ms-3" type="button" data-bs-toggle="collapse"
            data-bs-target="#userNavbar" aria-controls="userNavbar" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="userNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium text-center text-xl-start mt-3 mt-xl-0">
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('konsultasi*') ? 'active text-primary fw-bold' : '' }}"
                        href="{{ route('konsultasi') }}">Konsultasi</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('klik-home*') ? 'active text-primary fw-bold' : '' }}"
                        href="{{ route('klik-home') }}">KlikHome</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('apotek*') ? 'active text-primary fw-bold' : '' }}"
                        href="{{ route('apotek') }}">Apotek Online</a>
                </li>
                <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle {{ request()->is('mandiri*') ? 'active text-primary fw-bold' : '' }}"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">Cek Mandiri</a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 mt-2 shadow-sm rounded-3 overflow-hidden">
                        <li>
                            <a class="dropdown-item py-2 fw-medium text-center text-xl-start"
                                href="{{ route('mandiri.kalkulator_bmi') }}">
                                Kalkulator BMI
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-0">
                        </li>
                        <li>
                            <a class="dropdown-item py-2 fw-medium text-center text-xl-start"
                                href="{{ route('mandiri.pengingat_obat') }}">
                                Pengingat Obat
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-0">
                        </li>
                        <li>
                            <a class="dropdown-item py-2 fw-medium text-center text-xl-start"
                                href="{{ route('mandiri.kalender_menstruasi') }}">
                                Kalender Menstruasi
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-0">
                        </li>
                        <li>
                            <a class="dropdown-item py-2 fw-medium text-center text-xl-start"
                                href="{{ route('mandiri.kalender_kehamilan') }}">
                                Kalender Kehamilan
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('artikel*') ? 'active text-primary fw-bold' : '' }}"
                        href="{{ route('artikel') }}">Artikel Kesehatan</a>
                </li>
            </ul>
        </div>
        <div class="w-100 d-lg-none mt-3" id="mobileSearch">
            <form role="search">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-pill text-muted py-1">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control bg-light border-start-0 rounded-end-pill py-1"
                        placeholder="Cari dokter, spesialis, atau obat..." style="font-size: 0.9rem;">
                </div>
            </form>
        </div>
    </div>
</nav>
