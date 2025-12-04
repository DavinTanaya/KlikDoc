<nav class="navbar navbar-expand-lg sticky-top border-bottom bg-white shadow-sm">
    <div class="container">
        
        {{-- 1. Brand / Logo --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc" height="35">
            {{-- Opsional: Tambahan label Partner/Dokter --}}
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill d-none d-sm-block" 
                  style="font-size: 0.7rem; letter-spacing: 0.5px;">PARTNER</span>
        </a>

        {{-- 2. Toggler Mobile --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#doctorNavbar"
            aria-controls="doctorNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- 3. Menu Collapse --}}
        <div class="navbar-collapse collapse" id="doctorNavbar">
            
            {{-- Navigasi Utama --}}
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium">
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('dokter/dashboard*') ? 'active text-primary fw-bold' : '' }}" 
                       href="#">Dashboard</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('dokter/konsultasi*') ? 'active text-primary fw-bold' : '' }}" 
                       href="#">Konsultasi</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('dokter/jadwal*') ? 'active text-primary fw-bold' : '' }}" 
                       href="#">Jadwal Praktik</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('dokter/resep*') ? 'active text-primary fw-bold' : '' }}" 
                       href="#">Resep Digital</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('dokter/artikel*') ? 'active text-primary fw-bold' : '' }}" 
                       href="#">Artikel</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('dokter/pendapatan*') ? 'active text-primary fw-bold' : '' }}" 
                       href="#">Pendapatan</a>
                </li>
            </ul>

            {{-- Menu Kanan (Notifikasi & Akun) --}}
            <div class="d-flex align-items-center justify-content-end gap-3">
                
                {{-- Notifikasi --}}
                <div class="dropdown">
                    <button class="btn btn-light position-relative rounded-circle text-secondary" 
                            type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell-fill"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">
                            12
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                        <li><h6 class="dropdown-header">Notifikasi</h6></li>
                        <li><a class="dropdown-item" href="#">Ada jadwal baru</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center small text-primary" href="#">Lihat Semua</a></li>
                    </ul>
                </div>

                {{-- Divider Desktop --}}
                <div class="vr d-none d-lg-block mx-1"></div>

                {{-- Profil User --}}
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">Masuk</a>
                @else
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle gap-2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            
                            {{-- Info Teks (Hanya Desktop) --}}
                            <div class="text-end d-none d-lg-block lh-1">
                                <span class="d-block fw-bold text-dark" style="font-size: 0.9rem;">
                                    {{ Auth::user()->name ?? 'dr. Andi Setiawan' }}
                                </span>
                                <span class="d-block text-muted" style="font-size: 0.75rem;">
                                    Spesialis Jantung
                                </span>
                            </div>

                            {{-- Avatar --}}
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=100&h=100&fit=crop"
                                class="rounded-circle border" width="40" height="40" alt="Avatar">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                            {{-- Info Mobile (Muncul di dalam dropdown saat mobile) --}}
                            <li class="d-lg-none px-3 py-2 border-bottom mb-2 bg-light">
                                <span class="d-block fw-bold">{{ Auth::user()->name ?? 'dr. Andi Setiawan' }}</span>
                                <small class="text-muted">Spesialis Jantung</small>
                            </li>
                            
                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person-badge me-2 text-secondary"></i>Profil Saya</a></li>
                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-gear me-2 text-secondary"></i>Pengaturan</a></li>
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
    </div>
</nav>