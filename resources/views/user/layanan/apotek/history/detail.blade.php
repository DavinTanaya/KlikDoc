@extends('layout')

@section('title', 'KlikDoc | Detail Pesanan')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/obat/detail.css') }}">
@endpush

@section('body')
  <div class="detail-page">

    {{-- HEADER --}}
    <header class="detail-header">
      <div class="header-container">
        <a href="{{ route('orders.history') }}" class="btn-back">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
          </svg>
          Kembali
        </a>
        <h1>Detail Pesanan</h1>
        <div class="spacer"></div>
      </div>
    </header>

    <main class="detail-content">
      <div class="detail-container">

        {{-- SCROLL AREA --}}
        <div class="detail-scroll-area">

          {{-- STATUS BANNER --}}
          <div class="section-block status-banner">
            <div class="status-info">
              <span class="label">Status Pesanan</span>

              @php
                $statusText = [
                    'BELUM_BAYAR' => 'Menunggu Pembayaran',
                    'DIPROSES' => 'Sedang Diproses',
                    'DIKIRIM' => 'Sedang Dikirim',
                    'SELESAI' => 'Selesai',
                ];
                $bannerColor = [
                    'BELUM_BAYAR' => 'text-red',
                    'DIPROSES' => 'text-blue',
                    'DIKIRIM' => 'text-orange',
                    'SELESAI' => 'text-green',
                ];
              @endphp

              <h2 class="status-text {{ $bannerColor[$order->status] ?? 'text-grey' }}">
                {{ $statusText[$order->status] ?? $order->status }}
              </h2>
            </div>

            {{-- TIMER HANYA UNTUK BELUM BAYAR --}}
            @if ($order->status === 'BELUM_BAYAR')
              <div class="countdown-timer">
                <span>Bayar sebelum:</span>
                <strong class="timer">
                  {{ $order->created_at->addDay()->format('d M, H:i') }}
                </strong>
              </div>
            @endif
          </div>

          {{-- PAYMENT CODE SECTION (hanya jika BELUM BAYAR & ada snap token) --}}
          @if ($order->status === 'BELUM_BAYAR')
            <div class="section-block payment-code-section">
              <div class="bank-info">
                <div class="logo-box">
                  BCA
                </div>
                <div class="info-text">
                  <span class="method">Midtrans Virtual Account</span>
                  <span class="check-auto">Dicek Otomatis</span>
                </div>
              </div>

              <div class="va-box">
                <span class="label">Nomor Virtual Account</span>
                <div class="code-row">
                  <strong class="code">{{ $order->midtrans_va_number ?? '---' }}</strong>
                  <button class="btn-copy"
                    onclick="navigator.clipboard.writeText('{{ $order->midtrans_va_number }}')">Salin</button>
                </div>
              </div>
            </div>
          @endif

          {{-- SHIPPING INFO --}}
          <div class="section-block shipping-section">
            <h3>Informasi Pengiriman</h3>
            <div class="info-grid">

              <div class="info-item">
                <span class="label">Kurir</span>
                <span class="value">JNE Regular (Rp 15.000)</span>
              </div>

              <div class="info-item">
                <span class="label">Tanggal Pembelian</span>
                <span class="value">{{ $order->created_at->format('d M Y, H:i') }}</span>
              </div>

              <div class="info-item full-width">
                <span class="label">Alamat Penerima</span>
                <span class="value">
                  {{ $order->address->address_line }},
                  {{ $order->address->cityRelation->name }},
                  {{ $order->address->provinceRelation->name }}
                  {{ $order->address->zip_code }}
                  ({{ $order->address->label }})
                </span>
              </div>

            </div>
          </div>

          {{-- PRODUCTS SECTION --}}
          <div class="section-block products-section">
            <h3>Produk ({{ $order->items->count() }} Barang)</h3>

            <div class="product-list">
              @foreach ($order->items as $item)
                <div class="product-item">
                  <div class="thumb">
                    @if ($item->drug->image)
                      <img src="{{ asset('images/drugs/' . $item->drug->image) }}" width="32">
                    @else
                      <svg width="32" height="32" fill="none" stroke="#aaa">
                        <rect x="2" y="7" width="20" height="14" />
                      </svg>
                    @endif
                  </div>

                  <div class="details">
                    <h4>{{ $item->drug->name }}</h4>
                    <span class="meta">{{ $item->quantity }} x Rp
                      {{ number_format($item->price, 0, ',', '.') }}</span>
                  </div>

                  <div class="subtotal">
                    Rp {{ number_format($item->total, 0, ',', '.') }}
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          {{-- COST SECTION --}}
          <div class="section-block cost-section">
            <h3>Rincian Pembayaran</h3>

            <div class="cost-row">
              <span>Total Harga Barang</span>
              <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>

            <div class="cost-row">
              <span>Biaya Pengiriman</span>
              <span>Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</span>
            </div>

            @if ($order->voucher_discount > 0)
              <div class="cost-row voucher-row">
                <span class="voucher-label">Voucher</span>
                <span class="discount">- Rp {{ number_format($order->voucher_discount, 0, ',', '.') }}</span>
              </div>
            @endif

            <div class="cost-row">
              <span>Biaya Layanan</span>
              <span>Rp {{ number_format($order->service_fee, 0, ',', '.') }}</span>
            </div>

            <div class="divider"></div>

            <div class="cost-row total-row">
              <span>Total Belanja</span>
              <span class="total-amount">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
          </div>

        </div>

        {{-- FOOTER ACTION --}}
        <div class="detail-footer">

          <button class="btn-help">Bantuan</button>

          @if ($order->status === 'BELUM_BAYAR')
            <a href="{{ route('apotek.checkout.retry', $order->order_code) }}" class="btn-primary-action">
              Bayar Sekarang
            </a>
          @else
            <button class="btn-primary-action">Cek Status Pengiriman</button>
          @endif
        </div>

      </div>
    </main>

  </div>
@endsection
