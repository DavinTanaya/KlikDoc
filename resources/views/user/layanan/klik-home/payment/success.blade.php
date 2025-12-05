@extends('layout')

@section('title', 'KlikHome | Pembayaran Berhasil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/klik-home/payment/success.css') }}">
@endpush

@section('body')
    <div class="klikhome-success-page">
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
                <p>Terima kasih! Jadwal kunjungan nakes telah terkonfirmasi. Mohon tunggu di lokasi sesuai waktu yang ditentukan.</p>
            </div>

            {{-- Transaction Details (Disesuaikan untuk Jasa/Service) --}}
            <div class="receipt-box">
                <div class="receipt-row">
                    <span class="label">Kode Booking</span>
                    <span class="value">#KH-882910</span>
                </div>
                <div class="receipt-row">
                    <span class="label">Layanan</span>
                    <span class="value">Immune Booster Infusion</span>
                </div>
                <div class="receipt-row">
                    <span class="label">Jadwal Kunjungan</span>
                    <span class="value highlight">Besok, 13:00 - 14:00 WIB</span>
                </div>
                <div class="receipt-row">
                    <span class="label">Metode Bayar</span>
                    <span class="value">BCA Virtual Account</span>
                </div>
                
                <div class="divider"></div>
                
                <div class="receipt-row total">
                    <span class="label">Total Dibayar</span>
                    <span class="value">Rp 355.000</span>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="action-buttons">
                <a href="#" class="btn-primary">Lihat Detail Booking</a>
                <a href="{{ url('/klikhome') }}" class="btn-secondary">Pesan Layanan Lain</a>
            </div>

        </div>
    </div>
@endsection