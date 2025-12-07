@extends('layout')

@section('title', 'KlikHome | Detail Booking')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/layanan/klik-home/history/detail.css') }}">
  <style>
    .status-dropdown {
      margin-top: 6px;
      padding: 6px 10px;
      border-radius: 6px;
      border: 1px solid #d0d4da;
      background: #fff;
      font-size: 14px;
      cursor: pointer;
    }

    .status-dropdown:focus {
      outline: none;
      border-color: #4c6ef5;
      box-shadow: 0 0 3px rgba(76, 110, 245, .35);
    }
  </style>
@endpush

@section('body')
  <div class="klikhome-detail-page">
    <header class="detail-header">
      <div class="header-container">
        <a href="{{ route('admin.klikhome.history') }}" class="btn-back">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
          </svg>
          Kembali
        </a>
        <h1>Detail Booking KlikHome</h1>
        <div class="spacer"></div>
      </div>
    </header>

    <main class="detail-content">
      <div class="detail-container">
        <div class="detail-scroll-area">

          @php
            $statusText = [
                'MENUNGGU_PEMBAYARAN' => 'Menunggu Pembayaran',
                'DIBAYAR' => 'Terjadwal',
                'DIPROSES' => 'Nakes Menuju Lokasi',
                'SELESAI' => 'Selesai',
                'BATAL' => 'Dibatalkan',
            ];

            $statusColor = [
                'MENUNGGU_PEMBAYARAN' => 'text-red',
                'DIBAYAR' => 'text-blue',
                'DIPROSES' => 'text-orange',
                'SELESAI' => 'text-green',
                'BATAL' => 'text-grey',
            ];
          @endphp

          <div class="section-block status-banner">
            <div class="status-info">
              <span class="label">Status Booking</span>

              <h2 class="status-text {{ $statusColor[$order->status] ?? 'text-grey' }}">
                {{ $statusText[$order->status] ?? $order->status }}
              </h2>

              @if (auth()->user()->role === 'admin')
                <form method="POST" action="{{ route('admin.klikhome.orders.update', $order->order_code) }}">
                  @csrf
                  @method('PATCH')

                  <select name="status" class="status-dropdown" onchange="this.form.submit()">
                    @foreach ($statusText as $key => $label)
                      <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>
                        {{ $label }}
                      </option>
                    @endforeach
                  </select>
                </form>
              @endif
            </div>

            {{-- TIMER --}}
            @if ($order->status === 'MENUNGGU_PEMBAYARAN')
              <div class="countdown-timer">
                <span>Bayar sebelum</span>
                <strong>
                  {{ $order->created_at->addDay()->format('d M Y, H:i') }}
                </strong>
              </div>
            @endif
          </div>

          {{-- ================= PAYMENT INFO ================= --}}
          @if ($order->status === 'MENUNGGU_PEMBAYARAN')
            <div class="section-block payment-code-section">
              <div class="bank-info">
                <div class="logo-box">Midtrans</div>
                <div class="info-text">
                  <span class="method">Pembayaran Online</span>
                  <span class="check-auto">Dicek otomatis</span>
                </div>
              </div>

              <div class="va-box">
                <span class="label">Order ID</span>
                <div class="code-row">
                  <strong class="code">{{ $order->order_code }}</strong>
                </div>
              </div>
            </div>
          @endif

          {{-- ================= VISIT INFO ================= --}}
          <div class="section-block shipping-section">
            <h3>Informasi Kunjungan</h3>
            <div class="info-grid">
              <div class="info-item">
                <span class="label">Layanan</span>
                <span class="value">{{ $order->service->name }}</span>
              </div>

              <div class="info-item">
                <span class="label">Tanggal Pemesanan</span>
                <span class="value">{{ $order->created_at->format('d M Y, H:i') }}</span>
              </div>

              <div class="info-item">
                <span class="label">Jadwal Kunjungan</span>
                <span class="value text-green">
                  {{ \Carbon\Carbon::parse($order->scheduled_date)->translatedFormat('d M Y') }},
                  {{ $order->scheduled_time }} WIB
                </span>
              </div>

              <div class="info-item full-width">
                <span class="label">Alamat Kunjungan</span>
                <span class="value">
                  {{ $order->address->address_line }},
                  {{ $order->address->cityRelation->name }},
                  {{ $order->address->provinceRelation->name }}
                </span>
              </div>
            </div>
          </div>

          {{-- ================= SERVICE DETAIL ================= --}}
          <div class="section-block products-section">
            <h3>Rincian Layanan</h3>

            <div class="product-list">
              <div class="product-item">
                <div class="thumb bg-blue-soft">
                  {!! $order->service->icon_svg ?? '<svg width="24" height="24"></svg>' !!}
                </div>

                <div class="details">
                  <h4>{{ $order->service->name }}</h4>
                  <span class="meta">
                    Durasi {{ $order->service->duration_minutes }} menit
                  </span>
                </div>

                <div class="subtotal">
                  Rp {{ number_format($order->service->price, 0, ',', '.') }}
                </div>
              </div>
            </div>
          </div>

          {{-- ================= COST ================= --}}
          <div class="section-block cost-section">
            <h3>Rincian Pembayaran</h3>

            <div class="cost-row">
              <span>Harga Layanan</span>
              <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>

            <div class="cost-row">
              <span>Biaya Layanan</span>
              <span>Rp {{ number_format($order->service_fee, 0, ',', '.') }}</span>
            </div>

            <div class="divider"></div>

            <div class="cost-row total-row">
              <span>Total Dibayar</span>
              <span class="total-amount">
                Rp {{ number_format($order->total, 0, ',', '.') }}
              </span>
            </div>
          </div>

        </div>

        {{-- ================= FOOTER ================= --}}
        <div class="detail-footer">
          <button class="btn-help">Bantuan</button>

          @if ($order->status === 'MENUNGGU_PEMBAYARAN')
            <a href="{{ route('klikhome.retry', $order->order_code) }}" class="btn-primary-action">
              Bayar Sekarang
            </a>
          @elseif ($order->status === 'DIPROSES')
            <button class="btn-primary-action">
              Lacak Nakes
            </button>
          @endif
        </div>

      </div>
    </main>
  </div>
@endsection
