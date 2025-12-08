@extends('layout')

@section('title', 'KlikHome | Pembayaran Berhasil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/klik-home/payment/success.css') }}">
@endpush

@section('body')
    <div class="klikhome-success-page">
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
                <p>
                    Terima kasih! Jadwal kunjungan nakes telah terkonfirmasi.
                    Mohon tunggu di lokasi sesuai waktu yang ditentukan.
                </p>
            </div>
            <div class="receipt-box">
                <div class="receipt-row">
                    <span class="label">Kode Booking</span>
                    <span class="value">#{{ $order->order_code }}</span>
                </div>

                <div class="receipt-row">
                    <span class="label">Layanan</span>
                    <span class="value">{{ $order->service->name }}</span>
                </div>

                <div class="receipt-row">
                    <span class="label">Jadwal Kunjungan</span>
                    <span class="value highlight">
                        {{ \Carbon\Carbon::parse($order->scheduled_date)->translatedFormat('l, d F Y') }},
                        {{ $order->scheduled_time }} WIB
                    </span>
                </div>

                <div class="receipt-row">
                    <span class="label">Alamat Kunjungan</span>
                    <span class="value">
                        {{ $order->address->address_line }},
                        {{ $order->address->cityRelation->name ?? '' }},
                        {{ $order->address->provinceRelation->name ?? '' }}
                    </span>
                </div>

                <div class="receipt-row">
                    <span class="label">Metode Bayar</span>
                    <span class="value">
                        {{ $order->payment_type ?? 'Pembayaran Online' }}
                    </span>
                </div>

                <div class="divider"></div>

                <div class="receipt-row total">
                    <span class="label">Total Dibayar</span>
                    <span class="value">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('klik-home.riwayat.detail', ['orderCode' => $order->order_code]) }}" class="btn-primary">
                    Lihat Detail Booking
                </a>
                <a href="{{ route('klik-home') }}" class="btn-secondary">
                    Pesan Layanan Lain
                </a>
            </div>

        </div>
    </div>
@endsection
