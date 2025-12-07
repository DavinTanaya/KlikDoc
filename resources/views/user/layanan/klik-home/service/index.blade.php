@extends('layout')

@section('title', 'KlikHome | Layanan Kesehatan di Rumah')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/layanan/klik-home/service/styles.css') }}">
@endpush

@section('body')
  <div class="klikhome-page">
    <div class="split-container">

      {{-- ================= SIDEBAR ================= --}}
      <aside class="split-sidebar">

        <div class="sidebar-header">
          <h2>KlikHome<span class="dot">.</span></h2>
          <p>Layanan kesehatan profesional, langsung di rumah Anda.</p>
        </div>

        {{-- SEARCH --}}
        <form method="GET" class="sidebar-widget search-widget">
          <div class="input-icon-wrapper">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
              placeholder="Cari layanan (mis: Infus Vitamin)" class="search-input">
          </div>
        </form>
        <div class="klikhome">
          <div class="sidebar-widget history-widget">
            <div class="widget-header">
              <span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Riwayat KlikHome
              </span>
            </div>

            <div class="history-list">

              @forelse ($recentOrders as $order)
                @php
                  $serviceName = $order->service->name ?? 'Layanan';

                  $badgeClass = match ($order->status) {
                      'MENUNGGU_PEMBAYARAN' => 'warning',
                      'DIBAYAR' => 'info',
                      'DIPROSES' => 'primary',
                      'SELESAI' => 'success',
                      'BATAL' => 'danger',
                      default => 'neutral',
                  };

                  $badgeLabel = match ($order->status) {
                      'MENUNGGU_PEMBAYARAN' => 'Belum Bayar',
                      'DIBAYAR' => 'Terjadwal',
                      'DIPROSES' => 'Berjalan',
                      'SELESAI' => 'Selesai',
                      'BATAL' => 'Dibatalkan',
                      default => $order->status,
                  };
                @endphp

                <a href="{{ route('klik-home.riwayat.detail', $order->order_code) }}" class="history-item"
                  style="text-decoration:none;color:inherit;">

                  <div class="history-info">
                    <span class="history-date">
                      {{ $order->created_at->format('d M Y') }}
                    </span>
                    <span class="history-name">
                      {{ $serviceName }}
                    </span>
                  </div>

                  <span class="status-pill {{ $badgeClass }}">
                    {{ $badgeLabel }}
                  </span>
                </a>

              @empty
                <p class="text-muted small">Belum ada layanan KlikHome.</p>
              @endforelse

            </div>

            <a href="{{ route('klik-home.riwayat') }}" class="btn-history-more">
              Lihat Semua
            </a>
          </div>
        </div>


        {{-- CATEGORY --}}
        <div class="sidebar-widget category-widget">
          <div class="widget-header">Kategori Layanan</div>

          @php
            $categories = ['Lab Tes', 'Vaksinasi', 'Vitamin Booster', 'Grooming & Care', 'Dokter / Bidan'];

            $selectedCategories = (array) request('category');
          @endphp

          <form method="GET" action="{{ url()->current() }}" id="filterForm">

            {{-- keep search if ada --}}
            @if (request('search'))
              <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <div class="filter-group">
              <label class="checkbox-item">
                <input type="checkbox" id="selectAll"
                  {{ count($selectedCategories) === count($categories) ? 'checked' : '' }}
                  onchange="toggleAllCategories()">
                <span class="checkmark"></span>
                <strong>Semua Kategori</strong>
              </label>

              @foreach ($categories as $cat)
                <label class="checkbox-item">
                  <input type="checkbox" name="category[]" value="{{ $cat }}"
                    {{ in_array($cat, $selectedCategories) ? 'checked' : '' }} onchange="applyFilters()">
                  <span class="checkmark"></span>
                  {{ $cat }}
                </label>
              @endforeach
            </div>
          </form>
        </div>


        <hr class="sidebar-divider">

        {{-- TRUST --}}
        <div class="sidebar-banner trust-banner">
          <div class="trust-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              <path d="M9 12l2 2 4-4" />
            </svg>
          </div>
          <div>
            <h3>Aman & Steril</h3>
            <p>Nakes kami menggunakan APD lengkap dan alat steril.</p>
          </div>
        </div>
      </aside>

      {{-- ================= CONTENT ================= --}}
      <main class="split-content">

        <div class="content-header">
          <h1>Pilih Layanan</h1>
        </div>

        {{-- GRID --}}
        <div class="service-grid">

          @forelse ($services as $service)
            <div class="service-card">

              <div class="card-thumb">
                <span class="service-tag">
                  {{ $service->category }}
                </span>

                <div class="thumb-placeholder">
                  {{-- simple icon --}}
                  <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                  </svg>
                </div>
              </div>

              <div class="card-body">
                <h3>{{ $service->name }}</h3>
                <p class="desc">{{ $service->description }}</p>

                <div class="meta-info">
                  <span>⏱ {{ $service->duration_minutes }} menit</span>
                  <span>👩‍⚕️ Tenaga Medis</span>
                </div>

                <hr class="divider">

                <div class="price-action">
                  <div class="price">
                    Rp {{ number_format($service->price, 0, ',', '.') }}
                  </div>

                  <a href="{{ route('klik-home.detail', $service->slug) }}" class="btn-book text-decoration-none">
                    Pesan
                  </a>
                </div>
              </div>

            </div>

          @empty
            <div class="text-muted py-5 text-center">
              Tidak ada layanan tersedia
            </div>
          @endforelse

        </div>
      </main>

    </div>
  </div>
@endsection
@push('scripts')
  <script>
    function applyFilters() {
      document.getElementById('filterForm').submit();
    }

    function toggleAllCategories() {
      const selectAllCheckbox = document.getElementById('selectAll');
      const categoryCheckboxes = document.querySelectorAll('input[name="category[]"]');

      categoryCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
      });

      applyFilters();
    }
  </script>
@endpush
