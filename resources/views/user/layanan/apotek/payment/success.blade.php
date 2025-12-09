@extends('layout')

@section('title', 'KlikDoc | Pembayaran Berhasil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/payment/success.css') }}">
@endpush

@section('body')
    <div class="success-page">
        <div class="success-card">
            <div class="success-icon-wrapper">
                <div class="success-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <div class="ripple"></div>
            </div>
            <div class="text-content">
                <h1>Pembayaran Berhasil!</h1>
                <p>Terima kasih, pesanan Anda telah kami terima dan sedang diproses oleh apotek.</p>
            </div>
            <div class="receipt-box">
                <div class="receipt-row">
                    <span class="label">No. Pesanan</span>
                    <span class="value">{{ $order->order_code }}</span>
                </div>
                <div class="receipt-row">
                    <span class="label">Waktu Transaksi</span>
                    <span class="value">{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="receipt-row">
                    <span class="label">Metode Pembayaran</span>
                    <span class="value">
                        {{ $order->payment_method ?? 'Midtrans Virtual Account' }}
                    </span>
                </div>

                <div class="divider"></div>

                <div class="receipt-row">
                    <span class="label">Detail Produk</span>
                </div>

                @foreach ($order->items as $item)
                    <div class="receipt-row small">
                        <span class="value">{{ $item->drug->name }} (x{{ $item->quantity }})</span>
                        <span class="value">Rp {{ number_format($item->total, 0, ',', '.') }}</span>
                    </div>
                @endforeach

                <div class="divider"></div>

                <div class="receipt-row total">
                    <span class="label">Total Dibayar</span>
                    <span class="value">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </span>
                </div>
            </div>
            <div class="action-buttons">
                <a href="{{ route('orders.detail', $order->order_code) }}" class="btn-primary">
                    Lihat Status Pesanan
                </a>

                <a href="{{ url('/') }}" class="btn-secondary">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
@endsection
