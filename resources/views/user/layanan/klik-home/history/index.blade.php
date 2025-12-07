@extends('layout')

@section('title', 'KlikHome | Riwayat Layanan')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/layanan/klik-home/history/styles.css') }}">
@endpush

@section('body')
  <div class="klikhome-history-page">

    {{-- Header --}}
    <header class="history-header">
      <div class="header-container">
        <a href="{{ route('klik-home') }}" class="btn-back">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7" />
          </svg>
          Kembali
        </a>
        <h1>Riwayat KlikHome</h1>
        <div class="spacer"></div>
      </div>
    </header>

    <main class="history-content">
      <div class="history-container">

        {{-- Tabs --}}
        @php
          $activeStatus = request('status');
        @endphp

        <div class="status-tabs">
          <a href="{{ route('klik-home.riwayat') }}" class="tab {{ $activeStatus === null ? 'active' : '' }} text-decoration-none">
            Semua
          </a>

          <a href="{{ route('klik-home.riwayat', ['status' => 'MENUNGGU_PEMBAYARAN']) }}"
            class="tab {{ $activeStatus === 'MENUNGGU_PEMBAYARAN' ? 'active' : '' }} text-decoration-none">
            Belum Bayar
          </a>

          <a href="{{ route('klik-home.riwayat', ['status' => 'DIBAYAR']) }}"
            class="tab {{ $activeStatus === 'DIBAYAR' ? 'active' : '' }} text-decoration-none">
            Terjadwal
          </a>

          <a href="{{ route('klik-home.riwayat', ['status' => 'SELESAI']) }}"
            class="tab {{ $activeStatus === 'SELESAI' ? 'active' : '' }} text-decoration-none">
            Selesai
          </a>
        </div>


        {{-- Order List --}}
        <div class="order-list">

          @forelse ($orders as $order)
            @php
              // Badge mapping
              $statusMap = [
                  'MENUNGGU_PEMBAYARAN' => ['label' => 'Belum Dibayar', 'class' => 'red'],
                  'DIBAYAR' => ['label' => 'Terjadwal', 'class' => 'blue'],
                  'DIPROSES' => ['label' => 'Nakes OTW', 'class' => 'orange'],
                  'SELESAI' => ['label' => 'Selesai', 'class' => 'green'],
                  'BATAL' => ['label' => 'Dibatalkan', 'class' => 'gray'],
              ];

              $status = $statusMap[$order->status] ?? ['label' => $order->status, 'class' => 'gray'];

              // Icon color by category
              $iconBg = match ($order->service->category) {
                  'Vitamin Booster' => 'bg-orange-soft',
                  'Lab Tes' => 'bg-purple-soft',
                  'Dokter / Bidan' => 'bg-cyan-soft',
                  'Vaksinasi' => 'bg-green-soft',
                  default => 'bg-blue-soft',
              };
            @endphp

            <div class="order-card">

              {{-- Header --}}
              <div class="card-header">
                <div class="meta">
                  <span class="date">
                    {{ $order->created_at->translatedFormat('d M Y, H:i') }}
                  </span>
                  <span class="order-id">{{ $order->order_code }}</span>
                </div>

                <span class="badge {{ $status['class'] }}">
                  {{ $status['label'] }}
                </span>
              </div>

              {{-- Body --}}
              <div class="card-body">

                {{-- Icon --}}
                <div class="product-thumb {{ $iconBg }}">
                  {!! $order->service->icon_svg ?? '' !!}
                </div>

                {{-- Info --}}
                <div class="product-info">
                  <h3>{{ $order->service->name }}</h3>
                  <p class="extra-items">
                    Jadwal:
                    {{ \Carbon\Carbon::parse($order->scheduled_date)->translatedFormat('d M Y') }},
                    {{ $order->scheduled_time }} WIB
                  </p>
                </div>

                {{-- Bill --}}
                <div class="bill-info">
                  <span class="label">Total Biaya</span>
                  <span class="price">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                  </span>
                </div>

              </div>

              {{-- Footer --}}
              <div class="card-footer footer-action">

                {{-- ACTION BASED ON STATUS --}}
                @if ($order->status === 'MENUNGGU_PEMBAYARAN')
                  <div class="payment-timer">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                      stroke-width="2">
                      <circle cx="12" cy="12" r="10"></circle>
                      <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span>Menunggu pembayaran</span>
                  </div>

                  <a href="{{ route('klikhome.retry', $order->order_code) }}" class="btn-primary">
                    Bayar Sekarang
                  </a>
                @elseif ($order->status === 'DIBAYAR')
                  <div class="shipping-info">
                    <span>Menunggu penugasan nakes</span>
                  </div>
                  <a href="{{ route('klik-home.riwayat.detail', ['orderCode' => $order->order_code]) }}" class="btn-outline">
                    Detail Booking
                  </a>
                @elseif ($order->status === 'DIPROSES')
                  <div class="shipping-info">
                    <span>Nakes sedang menuju lokasi</span>
                  </div>
                  <button class="btn-outline">Lacak Posisi</button>
                @elseif ($order->status === 'SELESAI')
                  <a href="{{ route('klik-home.riwayat.detail', ['orderCode' => $order->order_code]) }}" class="btn-outline">
                    Lihat Detail
                  </a>
                @else
                  <span class="text-muted">Tidak tersedia</span>
                @endif

              </div>
            </div>

          @empty
            <div class="text-muted py-5 text-center">
              Belum ada riwayat layanan KlikHome
            </div>
          @endforelse

        </div>
      </div>
    </main>
  </div>
@endsection
