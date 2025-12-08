@extends('layout')

@section('title', 'KlikDoc | Konsultasi Dokter')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/konsultasi/dokter/styles.css') }}">
@endpush

@section('body')
    <div class="konsultasi-page">
        <div class="split-container">
            <aside class="split-sidebar">
                <div class="sidebar-header">
                    <h2>Konsultasi<span class="dot">.</span></h2>
                    <p>Temukan dokter spesialis terbaik untukmu.</p>
                </div>
                <div class="sidebar-widget search-widget">
                    <form id="filterForm" action="{{ route('konsultasi') }}" method="GET">
                        <div class="input-icon-wrapper">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>

                            <input type="text" name="search" placeholder="Cari dokter, spesialis, RS..."
                                value="{{ $search }}" class="search-input"
                                onkeydown="if(event.key === 'Enter') document.getElementById('filterForm').submit();">
                        </div>
                        <input type="hidden" name="kategori_json" id="kategoriInput"
                            value="{{ json_encode($selectedSpecs) }}">
                        <input type="hidden" name="filter" id="filterInput" value="{{ request()->query('filter') }}">
                    </form>
                </div>

                <div class="sidebar-widget appointment-widget">
                    <div class="widget-header">
                        <span>Jadwal Terdekat</span>
                    </div>

                    @forelse ($upcomingConsultations as $c)
                        <div class="appointment-card">
                            <div class="app-info">
                                <span class="app-doctor">
                                    {{ $c->doctor->full_name }}
                                </span>
                                <span class="app-spec">
                                    {{ $c->doctor->spesialisasi }}
                                </span>
                                <div class="app-time">
                                    {{ $c->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                            <a href="{{ route('chat.index') }}" class="btn-join text-decoration-none">Masuk</a>
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada jadwal aktif</p>
                    @endforelse
                </div>

                <div class="sidebar-widget history-widget">
                    <div class="widget-header">
                        <span>Riwayat Konsultasi</span>
                    </div>

                    <div class="history-list">
                        @forelse ($historyConsultations as $c)
                            <div class="history-item">
                                <div class="history-info">
                                    <span class="history-date">
                                        {{ $c->created_at->format('d M Y') }}
                                    </span>
                                    <span class="history-name">
                                        {{ $c->doctor->full_name }}
                                    </span>
                                </div>
                                <span class="status-pill success">Selesai</span>
                            </div>
                        @empty
                            <p class="text-muted">Belum ada riwayat</p>
                        @endforelse
                    </div>
                    <a href="{{ route('konsultasi.riwayat') }}" class="btn-history-more">Lihat Semua</a>
                </div>

                <hr class="sidebar-divider">

                <div class="sidebar-filters">
                    <div class="filter-group">
                        <h3>Spesialisasi</h3>
                        @foreach ($specializations as $spec)
                            <label class="checkbox-item">
                                <input type="checkbox" value="{{ $spec }}"
                                    {{ in_array($spec, $selectedSpecs) ? 'checked' : '' }} onchange="applyFilters()">
                                <span class="checkmark"></span>
                                {{ $spec }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </aside>

            <main class="split-content">
                <div class="content-header">
                    <h1>Pilih Dokter</h1>
                    <div class="sort-wrapper">
                        <span>Urutkan:</span>
                        <select onchange="onSortChange(this.value)">
                            <option value="">Paling Relevan</option>
                            <option value="pengalaman-terlama"
                                {{ request('filter') === 'pengalaman-terlama' ? 'selected' : '' }}>
                                Pengalaman Terlama</option>
                            <option value="pengalaman-terbaru"
                                {{ request('filter') === 'pengalaman-terbaru' ? 'selected' : '' }}>
                                Pengalaman Terbaru</option>
                            <option value="nama-a-z" {{ request('filter') === 'nama-a-z' ? 'selected' : '' }}>Nama A-Z
                            </option>
                            <option value="nama-z-a" {{ request('filter') === 'nama-z-a' ? 'selected' : '' }}>Nama Z-A
                            </option>
                        </select>
                    </div>
                </div>

                <div class="doctor-grid">
                    @forelse ($doctors as $doc)
                        <div class="doctor-card">
                            <div class="doctor-image-wrapper">
                                <div class="status-badge {{ $doc->is_active ? 'online' : 'offline' }}">
                                    {{ $doc->is_active ? 'Online' : 'Offline' }}
                                </div>
                                <div class="doctor-img-placeholder bg-blue-soft">
                                    <svg width="80" height="80" ...></svg>
                                </div>
                                <div class="experience-badge">
                                    {{ $doc->experience_years }} Tahun Exp
                                </div>
                            </div>

                            <div class="doctor-info">

                                <div class="doc-header">
                                    <div class="spec-label">{{ $doc->spesialisasi }}</div>

                                    <div class="rating-badge">
                                        <span class="star">★</span>
                                        {{ number_format($doc->averageRating() ?? 0, 1) }}
                                        <small>({{ $doc->ratingCount() }})</small>
                                    </div>

                                </div>

                                <h3>{{ $doc->full_name }}</h3>

                                <div class="service-tags">
                                    <span class="tag-service chat">
                                        <svg width="12" height="12" ...></svg>
                                        Chat Online
                                    </span>
                                </div>

                                <div class="hospital-info">
                                    Klinik / Online Consultation
                                </div>

                                <hr class="card-divider">

                                <div class="price-action">
                                    <div class="price-box">
                                        <small>Biaya Chat</small>
                                        @php
                                            $base = 30000;
                                            $expFactor = 4000;

                                            $rating = $doc->averageRating();
                                            $ratingBonus = max(0, $rating - 4.0) * 20000;

                                            $price = $base + $doc->experience_years * $expFactor + $ratingBonus;

                                        @endphp
                                        <span class="price">Rp {{ number_format($price) }}</span>
                                    </div>
                                    <a href="{{ route('konsultasi.detail', $doc->id) }}"
                                        class="btn-book-direct">Konsultasi</a>
                                </div>

                            </div>

                        </div>
                    @empty
                        <p class="text-muted">Belum ada dokter tersedia.</p>
                    @endforelse

                </div>
                <div class="pagination-wrapper">
                    {{ $doctors->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>

            </main>
        </div>
    </div>

    <script>
        function applyFilters() {
            let selected = [];

            document.querySelectorAll('.checkbox-item input[type=checkbox]:checked')
                .forEach(cb => selected.push(cb.value));

            document.getElementById('kategoriInput').value = JSON.stringify(selected);

            document.getElementById('filterForm').submit();
        }

        function onSortChange(value) {
            document.getElementById('filterInput').value = value;
            document.getElementById('filterForm').submit();
        }
    </script>

@endsection
