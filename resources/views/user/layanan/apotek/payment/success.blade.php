@extends('layout')

@section('title', 'KlikDoc | Pembayaran Berhasil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/payment/success.css') }}">
@endpush

@section('body')
    <div class="success-page">
        <div class="success-card">
            
            {{-- Animated Icon --}}
            <div class="success-icon-wrapper">
                <div class="success-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
                <div class="ripple"></div>
            </div>

            {{-- Main Message --}}
            <div class="text-content">
                <h1>Pembayaran Berhasil!</h1>
                <p>Terima kasih, pesanan Anda telah kami terima dan sedang diproses oleh apotek.</p>
            </div>

            {{-- Transaction Details --}}
            <div class="receipt-box">
                <div class="receipt-row">
                    <span class="label">No. Pesanan</span>
                    <span class="value">#KD-2938491</span>
                </div>
                <div class="receipt-row">
                    <span class="label">Waktu Transaksi</span>
                    <span class="value">{{ date('d M Y, H:i') }}</span>
                </div>
                <div class="receipt-row">
                    <span class="label">Metode Pembayaran</span>
                    <span class="value">Transfer Bank BCA</span>
                </div>
                <div class="divider"></div>
                <div class="receipt-row total">
                    <span class="label">Total Dibayar</span>
                    <span class="value">Rp 66.000</span>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="action-buttons">
                <a href="#" class="btn-primary">Lihat Status Pesanan</a>
                <a href="{{ url('/') }}" class="btn-secondary">Kembali ke Beranda</a>
            </div>

        </div>
    </div>
@endsection