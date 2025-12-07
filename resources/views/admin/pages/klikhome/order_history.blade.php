@extends('layout')

@section('title', 'KlikHome | Riwayat Booking')

@push('styles')
  {{-- reuse css apotek biar konsisten --}}
  <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/obat/history.css') }}">
@endpush

@section('body')
  <div class="history-page">

    {{-- HEADER --}}
    <header class="history-header">
      <div class="header-container">
        <a href="{{ route('admin.index') }}" class="btn-back">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
          </svg>
          Kembali
        </a>
        <h1>Riwayat Booking KlikHome</h1>
        <div class="spacer"></div>
      </div>
    </header>

    <main class="history-content">
      <div class="history-container">

        {{-- TABS STATUS --}}
        <div class="status-tabs">
          <a href="{{ route('admin.klikhome.history') }}" class="tab {{ request('status') ? '' : 'active' }}">
            Semua
          </a>

          <a href="{{ route('admin.klikhome.history', ['status' => 'MENUNGGU_PEMBAYARAN']) }}"
            class="tab {{ request('status') === 'MENUNGGU_PEMBAYARAN' ? 'active' : '' }}">
            Belum Bayar
          </a>

          <a href="{{ route('admin.klikhome.history', ['status' => 'DIBAYAR']) }}"
            class="tab {{ request('status') === 'DIBAYAR' ? 'active' : '' }}">
            Terjadwal
          </a>

          <a href="{{ route('admin.klikhome.history', ['status' => 'DIPROSES']) }}"
            class="tab {{ request('status') === 'DIPROSES' ? 'active' : '' }}">
            Diproses
          </a>

          <a href="{{ route('admin.klikhome.history', ['status' => 'SELESAI']) }}"
            class="tab {{ request('status') === 'SELESAI' ? 'active' : '' }}">
            Selesai
          </a>
        </div>

        {{-- LIST --}}
        <div class="order-list">

          @forelse ($orders as $order)
            <div class="order-card">

              {{-- HEADER --}}
              <div class="card-header">
                <div class="meta">
                  <span class="date">{{ $order->created_at->format('d M Y') }}</span>
                  <span class="order-id">{{ $order->order_code }}</span>
                  <span class="date" style="color:red">
                    {{ $order->user->name ?? 'User' }}
                  </span>
                </div>

                @php
                  $badgeClass = match ($order->status) {
                      'MENUNGGU_PEMBAYARAN' => 'red',
                      'DIBAYAR' => 'blue',
                      'DIPROSES' => 'orange',
                      'SELESAI' => 'green',
                      'BATAL' => 'gray',
                      default => 'gray',
                  };
                @endphp

                <span class="badge {{ $badgeClass }}">
                  {{ str_replace('_', ' ', strtolower($order->status)) }}
                </span>
              </div>

              {{-- BODY --}}
              <div class="card-body">

                {{-- ICON --}}
                <div class="product-thumb">
                  {!! $order->service->icon_svg ??
                      '
                                      <svg width="40" height="40" fill="none" stroke="#ccc">
                                        <rect x="2" y="7" width="20" height="14" />
                                      </svg>' !!}
                </div>

                {{-- INFO --}}
                <div class="product-info">
                  <h3>{{ $order->service->name }}</h3>
                  <p class="extra-items">
                    Jadwal:
                    {{ \Carbon\Carbon::parse($order->scheduled_date)->format('d M Y') }},
                    {{ $order->scheduled_time }} WIB
                  </p>
                </div>

                {{-- PRICE --}}
                <div class="bill-info">
                  <span class="label">Total Biaya</span>
                  <span class="price">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                  </span>
                </div>
              </div>

              {{-- FOOTER --}}
              <div class="card-footer footer-action">

                @if ($order->status === 'MENUNGGU_PEMBAYARAN')
                  <div class="payment-timer">
                    <svg width="16" height="16" fill="none" stroke="currentColor">
                      <circle cx="12" cy="12" r="10" />
                      <polyline points="12 6 12 12 16 14" />
                    </svg>
                    <span>
                      Bayar sebelum
                      <strong>{{ $order->created_at->addDay()->format('d M, H:i') }}</strong>
                    </span>
                  </div>

                  <a href="{{ route('klikhome.retry', $order->order_code) }}" class="btn-primary">
                    Bayar Sekarang
                  </a>
                @else
                  <a href="{{ route('admin.klikhome.history.detail', $order->order_code) }}" class="btn-outline">
                    Detail Booking
                  </a>
                @endif

              </div>
            </div>

          @empty
            <p class="mt-4 text-center">Belum ada booking KlikHome.</p>
          @endforelse

        </div>

      </div>
    </main>

  </div>
@endsection
