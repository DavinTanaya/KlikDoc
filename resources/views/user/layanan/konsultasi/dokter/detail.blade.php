@extends('layout')

@section('title', 'Detail Dokter - ' . $doctor->full_name)

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/layanan/konsultasi/dokter/detail.css') }}">
@endpush

@section('body')
  <div class="doctor-detail-page">
    <div class="detail-container">

      {{-- BACK --}}
      <div class="top-nav">
        <a href="{{ url()->previous() }}" class="btn-back">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
          </svg>
          Kembali
        </a>
      </div>

      <div class="content-grid">

        {{-- ================= LEFT ================= --}}
        <div class="main-content">

          {{-- ===== PROFILE ===== --}}
          <div class="doctor-profile-section">
            <div class="profile-flex">

              <div class="avatar-wrapper">
                <div class="avatar-lg bg-blue-soft">
                  <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#1C274C"
                    stroke-width="1.5">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                  </svg>

                  <div class="status-indicator {{ $doctor->is_active ? 'online' : 'offline' }}"></div>
                </div>
              </div>

              <div class="info-wrapper">
                <div class="name-row">
                  <h1>{{ $doctor->full_name }}</h1>
                  <span class="badge-verification">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                      stroke-width="2">
                      <polyline points="20 6 9 17 4 12" />
                    </svg>
                    Terverifikasi
                  </span>
                </div>

                <p class="specialist">{{ $doctor->spesialisasi }}</p>

                <p class="hospital">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M3 21h18M5 21V7l8-4 8 4v14M8 21v-4h8v4" />
                  </svg>
                  Konsultasi Online
                </p>
              </div>

            </div>

            {{-- ===== STATS ===== --}}
            <div class="stats-grid">
              <div class="stat-item">
                <span class="val">{{ $doctor->experience_years }} Tahun</span>
                <span class="lbl">Pengalaman</span>
              </div>

              <div class="stat-item">
                <span class="val">
                  {{ number_format($ratingAverage, 1) }} ★
                </span>
                <span class="lbl">{{ $ratingCount }} Ulasan</span>
              </div>

              <div class="stat-item">
                <span class="val">STR</span>
                <span class="lbl">{{ $doctor->str }}</span>
              </div>
            </div>
          </div>

          <hr class="divider">

          {{-- ===== ULASAN SAJA ===== --}}
          <h2 class="section-title">
            Ulasan Pasien ({{ $ratingCount }})
          </h2>

          <div class="reviews-list">

            @forelse ($doctor->ratings as $rating)
              <div class="review-item">
                <div class="review-header">
                  <span class="reviewer">
                    {{ $rating->user->name }}
                  </span>
                  <span class="rating">
                    ★ {{ number_format($rating->rating, 1) }}
                  </span>
                </div>

                <p class="comment">
                  {{ $rating->review ?? 'Tidak ada komentar.' }}
                </p>
              </div>
            @empty
              <p class="text-muted">Belum ada ulasan untuk dokter ini.</p>
            @endforelse

          </div>

        </div>

        {{-- ================= RIGHT ================= --}}
        <div class="booking-sidebar">
          <div class="booking-card">

            <div class="price-header">
              <span class="label">Biaya Konsultasi</span>
              <span class="price">Rp {{ number_format($price) }}</span>
            </div>

            <div class="booking-summary-list">
              <div class="summary-item">
                <span class="label">Dokter</span>
                <span class="value">{{ $doctor->full_name }}</span>
              </div>

              <div class="summary-item">
                <span class="label">Spesialisasi</span>
                <span class="value">{{ $doctor->spesialisasi }}</span>
              </div>

              <div class="summary-item highlight">
                <span class="label">Metode</span>
                <span class="value">Chat Online</span>
              </div>
            </div>

            <hr class="card-divider">

            <div class="price-breakdown">
              <div class="summary-row">
                <span>Subtotal</span>
                <span>Rp {{ number_format($price) }}</span>
              </div>
              <div class="summary-row">
                <span>Biaya Layanan</span>
                <span>Rp 2.000</span>
              </div>
              <div class="summary-row total">
                <span>Total Bayar</span>
                <span>Rp {{ number_format($price + 2000) }}</span>
              </div>
            </div>

            <form action="{{ route('konsultasi.bayar', $doctor->id) }}" method="POST">
              @csrf
              <button type="submit" class="btn-payment">
                Lanjut Pembayaran
              </button>
            </form>


            <p class="secure-text">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2" />
                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
              </svg>
              Pembayaran Aman & Terenkripsi
            </p>

          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
