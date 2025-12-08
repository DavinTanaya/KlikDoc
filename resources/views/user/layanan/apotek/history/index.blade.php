@extends('layout')

@section('title', 'KlikDoc | Riwayat Pesanan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/obat/history.css') }}">
@endpush

@section('body')
    <div class="history-page">
        <header class="history-header">
            <div class="header-container">
                <a href="{{ route('apotek') }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <h1>Riwayat Pesanan</h1>
                <div class="spacer"></div>
            </div>
        </header>

        <main class="history-content">
            <div class="history-container">
                <div class="status-tabs">
                    <a href="{{ route('orders.history') }}" class="tab {{ request()->query('status') ? '' : 'active' }}"
                        style="text-decoration: none">Semua</a>
                    <a href="{{ route('orders.history', ['status' => 'BELUM_BAYAR']) }}"
                        class="tab {{ request()->query('status') === 'BELUM_BAYAR' ? 'active' : '' }}"
                        style="text-decoration: none">Belum Bayar</a>
                    <a href="{{ route('orders.history', ['status' => 'DIPROSES']) }}"
                        class="tab {{ request()->query('status') === 'DIPROSES' ? 'active' : '' }}"
                        style="text-decoration: none">Diproses</a>
                    <a href="{{ route('orders.history', ['status' => 'SELESAI']) }}"
                        class="tab {{ request()->query('status') === 'SELESAI' ? 'active' : '' }}"
                        style="text-decoration: none">Selesai</a>
                </div>
                <div class="order-list">

                    @forelse ($orders as $order)
                        <div class="order-card">
                            <div class="card-header">
                                <div class="meta">
                                    <span class="date">{{ $order->created_at->format('d M Y') }}</span>
                                    <span class="order-id">{{ $order->order_code }}</span>
                                </div>
                                @php
                                    $badgeClass = match ($order->status) {
                                        'BELUM_BAYAR' => 'red',
                                        'DIPROSES' => 'blue',
                                        'DIKIRIM' => 'orange',
                                        'SELESAI' => 'green',
                                        default => 'gray',
                                    };
                                @endphp

                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst(strtolower(str_replace('_', ' ', $order->status))) }}
                                </span>
                            </div>                            
                            <div class="card-body">
                                <div class="product-thumb">
                                    @php
                                        $first = $order->items->first();
                                    @endphp

                                    @if ($first && $first->drug->image)
                                        <img src="{{ asset('images/drugs/' . $first->drug->image) }}" height="40">
                                    @else
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                                            stroke-width="1">
                                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2">
                                            </rect>
                                        </svg>
                                    @endif
                                </div>

                                <div class="product-info">
                                    <h3>{{ $first->drug->name ?? 'Produk' }}</h3>

                                    @if ($order->items->count() > 1)
                                        <p class="extra-items">+ {{ $order->items->count() - 1 }} item lainnya</p>
                                    @else
                                        <p class="extra-items">1 barang</p>
                                    @endif
                                </div>

                                <div class="bill-info">
                                    <span class="label">Total Belanja</span>
                                    <span class="price">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <div class="card-footer footer-action">

                                @if ($order->status === 'BELUM_BAYAR')
                                    <div class="payment-timer">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        <span>Bayar sebelum
                                            <strong>{{ $order->created_at->addDay()->format('d M, H:i') }}</strong></span>
                                    </div>

                                    <a href="{{ route('apotek.checkout.retry', $order->order_code) }}" class="btn-primary">
                                        Bayar Sekarang
                                    </a>
                                @else
                                    <a href="{{ route('orders.detail', $order->order_code) }}" class="btn-outline">
                                        Detail Pesanan
                                    </a>
                                @endif

                            </div>

                        </div>
                    @empty

                        <p class="mt-4 text-center">Belum ada riwayat pesanan.</p>
                    @endforelse

                </div>

            </div>
        </main>
    </div>
@endsection
