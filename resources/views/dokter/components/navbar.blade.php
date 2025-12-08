<nav class="navbar navbar-expand-xl sticky-top border-bottom bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dokter.dashboard') }}">
            <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc" height="35">
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill d-none d-sm-block"
                style="font-size: 0.7rem; letter-spacing: 0.5px;">PARTNER</span>
        </a>

        <div class="d-flex align-items-center gap-3 ms-auto order-xl-last">
            <div class="dropdown">
                @if(auth()->check() && auth()->user()->role === 'doctor')
                    <a href="{{ route('dokter.chat.index') }}"
                        class="btn btn-light position-relative rounded-circle text-secondary"
                        style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                @endif
            </div>

            <div class="vr d-none d-lg-block" style="height: 30px; align-self: center; width: 1.5px;"></div>

            @guest
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">Masuk</a>
                </div>
            @else
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle gap-2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="text-end d-none d-xl-block lh-1">
                            <span class="d-block fw-bold text-dark pb-1" style="font-size: 1rem;">
                                {{ Auth::user()->name ?? 'dr. Andi Setiawan' }}
                            </span>
                            <span class="d-block text-muted" style="font-size: 0.8rem;">
                                {{ Auth()->user()->application?->spesialisasi ?? '' }}
                            </span>
                        </div>
                        <img src="{{ Auth::user()->application?->avatar ? asset(Auth::user()->application?->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->application?->full_name ?? 'Dokter') }}"
                            class="rounded-circle border" width="40" height="40" alt="Avatar">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                        <li class="d-xl-none px-3 py-2 border-bottom mb-2 bg-light">
                            <span class="d-block fw-bold">{{ Auth::user()->name ?? 'dr. Andi Setiawan' }}</span>
                            <small class="text-muted">Spesialis Jantung</small>
                        </li>

                        <li><a class="dropdown-item py-2" href="{{ route('dokter.profile') }}"><i
                                    class="bi bi-person-badge me-2 text-secondary"></i>Profil Saya</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i
                                    class="bi bi-gear me-2 text-secondary"></i>Pengaturan</a></li>
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
        <button class="navbar-toggler border-0 ms-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#doctorNavbar" aria-controls="doctorNavbar" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="doctorNavbar">
            <ul class="navbar-nav mb-2 mb-lg-0 fw-medium text-center mt-3 mt-xl-0">
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('dokter') ? 'active text-primary fw-bold' : '' }}"
                        href="{{ route('dokter.dashboard') }}">Beranda</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('dokter/chat*') ? 'active text-primary fw-bold' : '' }}"
                        href="{{ route('dokter.chat.index') }}">Konsultasi</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('artikel*') ? 'active text-primary fw-bold' : '' }}"
                        href="{{ route('article.index') }}">Artikel</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
