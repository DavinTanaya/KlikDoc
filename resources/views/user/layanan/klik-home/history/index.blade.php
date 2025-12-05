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
                <a href="{{ url('/klikhome') }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

                {{-- Tabs / Filter Status --}}
                <div class="status-tabs">
                    <button class="tab active">Semua</button>
                    <button class="tab">Belum Bayar</button>
                    <button class="tab">Terjadwal</button>
                    <button class="tab">Selesai</button>
                </div>

                {{-- List Pesanan --}}
                <div class="order-list">

                    {{-- CASE 1: Belum Dibayar --}}
                    <div class="order-card">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">Hari Ini, 10:30</span>
                                <span class="order-id">KH/20231025/VIT/001</span>
                            </div>
                            <span class="badge red">Belum Dibayar</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb bg-orange-soft">
                                {{-- Icon Vitamin --}}
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#f57c00" stroke-width="1.5">
                                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Immune Booster Infusion</h3>
                                <p class="extra-items">Jadwal: Besok, 13:00 WIB</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Total Biaya</span>
                                <span class="price">Rp 355.000</span>
                            </div>
                        </div>
                        <div class="card-footer footer-action">
                            <div class="payment-timer">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span>Bayar sebelum <strong>14:30 WIB</strong></span>
                            </div>
                            <button class="btn-primary">Bayar Sekarang</button>
                        </div>
                    </div>

                    {{-- CASE 2: Terjadwal (Menunggu Nakes) --}}
                    <div class="order-card">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">20 Okt 2023</span>
                                <span class="order-id">KH/20231020/LAB/088</span>
                            </div>
                            <span class="badge blue">Terjadwal</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb bg-purple-soft">
                                {{-- Icon Lab --}}
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#7b1fa2" stroke-width="1.5">
                                    <path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.3.3 0 1 0 .2.3V4a1 1 0 0 1 1 1v5a5 5 0 0 1-10 0V5a1 1 0 0 1 1-1h.8z"></path>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Medical Checkup Basic</h3>
                                <p class="extra-items">Jadwal: 22 Okt, 08:00 WIB</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Total Biaya</span>
                                <span class="price">Rp 450.000</span>
                            </div>
                        </div>
                        <div class="card-footer footer-action">
                            <div class="shipping-info">
                                <span>Nakes: Sr. Siti Aminah (Perawat)</span>
                            </div>
                            <button class="btn-outline">Detail Booking</button>
                        </div>
                    </div>

                    {{-- CASE 3: Nakes Menuju Lokasi (Sedang Berjalan) --}}
                    <div class="order-card">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">18 Okt 2023</span>
                                <span class="order-id">KH/20231018/DOC/045</span>
                            </div>
                            <span class="badge orange">Nakes OTW</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb bg-cyan-soft">
                                {{-- Icon Dokter --}}
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#00838f" stroke-width="1.5">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Kunjungan Dokter Umum</h3>
                                <p class="extra-items">Pasien: Bpk. Budi Santoso</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Total Biaya</span>
                                <span class="price">Rp 250.000</span>
                            </div>
                        </div>
                        <div class="card-footer footer-action">
                            <div class="shipping-info">
                                <span>Dr. Andi Pratama sedang menuju lokasi</span>
                            </div>
                            <button class="btn-outline">Lacak Posisi</button>
                        </div>
                    </div>

                    {{-- CASE 4: Selesai --}}
                    <div class="order-card">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">01 Okt 2023</span>
                                <span class="order-id">KH/20231001/VAC/002</span>
                            </div>
                            <span class="badge green">Selesai</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb bg-green-soft">
                                {{-- Icon Vaksin --}}
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="1.5">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Vaksin Influenza 4 Strain</h3>
                                <p class="extra-items">1 Pasien (Dewasa)</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Total Biaya</span>
                                <span class="price">Rp 380.000</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn-outline">Lihat Hasil Medis</button>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
@endsection