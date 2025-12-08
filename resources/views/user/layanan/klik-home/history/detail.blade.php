@extends('layout')

@section('title', 'KlikHome | Detail Riwayat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/klik-home/history/detail.css') }}">
@endpush

@section('body')
    <div class="klikhome-detail-page">
        <header class="detail-header">
            <div class="header-container">
                <a href="{{ route('klik-home.riwayat') }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <h1>Detail Layanan</h1>
                <div class="spacer"></div>
            </div>
        </header>

        <main class="detail-content">
            <div class="detail-container">

                <div class="detail-scroll-area">
                    @php
                        $statusMap = [
                            'MENUNGGU_PEMBAYARAN' => ['text' => 'Belum Dibayar', 'class' => 'text-red'],
                            'DIBAYAR' => ['text' => 'Terjadwal', 'class' => 'text-blue'],
                            'DIPROSES' => ['text' => 'Berjalan', 'class' => 'text-orange'],
                            'SELESAI' => ['text' => 'Selesai', 'class' => 'text-green'],
                            'BATAL' => ['text' => 'Dibatalkan', 'class' => 'text-gray'],
                        ];
                        $status = $statusMap[$order->status] ?? ['text' => $order->status, 'class' => 'text-gray'];
                    @endphp

                    <div class="section-block status-banner">
                        <div class="status-info">
                            <span class="label">Status Booking</span>
                            <h2 class="status-text {{ $status['class'] }}">
                                {{ $status['text'] }}
                            </h2>
                        </div>

                        @if ($order->status !== 'MENUNGGU_PEMBAYARAN')
                            <div class="status-badge-pill">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Lunas
                            </div>
                        @endif
                    </div>

                    <div class="section-block shipping-section">
                        <h3>Informasi Kunjungan</h3>

                        <div class="info-grid">
                            <div class="info-item">
                                <span class="label">Kode Booking</span>
                                <span class="value">{{ $order->order_code }}</span>
                            </div>

                            <div class="info-item">
                                <span class="label">Tanggal Pemesanan</span>
                                <span class="value">
                                    {{ $order->created_at->translatedFormat('d M Y, H:i') }}
                                </span>
                            </div>

                            <div class="info-item">
                                <span class="label">Jadwal Kunjungan</span>
                                <span class="value text-green">
                                    {{ \Carbon\Carbon::parse($order->scheduled_date)->translatedFormat('d M Y') }},
                                    {{ $order->scheduled_time }} WIB
                                </span>
                            </div>

                            <div class="info-item full-width">
                                <span class="label">Lokasi Kunjungan</span>
                                <span class="value">
                                    {{ $order->address->address_line ?? '-' }},
                                    {{ $order->address->cityRelation->name ?? '' }},
                                    {{ $order->address->provinceRelation->name ?? '' }}
                                    {{ $order->address->zip_code ?? '' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="section-block products-section">
                        <h3>Rincian Layanan</h3>

                        <div class="product-list">
                            <div class="product-item">
                                <div class="thumb bg-blue-soft">
                                    {!! $order->service->icon_svg ?? '' !!}
                                </div>

                                <div class="details">
                                    <h4>{{ $order->service->name }}</h4>
                                    <span class="meta">
                                        {{ $order->service->handled_by ?? 'Petugas Medis' }}
                                    </span>
                                </div>

                                <div class="subtotal">
                                    Rp {{ number_format($order->subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>

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

                        @if ($order->payment_type)
                            <div class="cost-row method-row">
                                <span class="method-label">Metode Pembayaran</span>
                                <span class="method-value">
                                    {{ strtoupper(str_replace('_', ' ', $order->payment_type)) }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="detail-footer">
                    <button class="btn-help">Bantuan</button>

                    @if ($order->status === 'MENUNGGU_PEMBAYARAN')
                        <a href="{{ route('klikhome.retry', $order->order_code) }}" class="btn-primary-action">
                            Bayar Sekarang
                        </a>
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection
