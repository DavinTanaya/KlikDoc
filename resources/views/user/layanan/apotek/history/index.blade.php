@extends('layout')

@section('title', 'KlikDoc | Riwayat Pesanan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/obat/history.css') }}">
@endpush

@section('body')
    <div class="history-page">
        {{-- Header (Konsisten dengan Keranjang) --}}
        <header class="history-header">
            <div class="header-container">
                <a href="{{ url('/dashboard') }}" class="btn-back">
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

                {{-- Tabs / Filter Status (Opsional, visual only) --}}
                <div class="status-tabs">
                    <button class="tab active">Semua</button>
                    <button class="tab">Belum Bayar</button>
                    <button class="tab">Diproses</button>
                    <button class="tab">Selesai</button>
                </div>

                {{-- List Pesanan --}}
                <div class="order-list">

                    {{-- CASE 1: Belum Dibayar --}}
                    <div class="order-card">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">12 Okt 2023</span>
                                <span class="order-id">INV/20231012/MPL/001</span>
                            </div>
                            <span class="badge red">Belum Dibayar</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                                    stroke-width="1">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Paracetamol 500mg (Strip)</h3>
                                <p class="extra-items">+ 2 item lainnya</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Total Belanja</span>
                                <span class="price">Rp 55.000</span>
                            </div>
                        </div>
                        <div class="card-footer footer-action">
                            <div class="payment-timer">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span>Bayar sebelum <strong>13 Okt, 14:00</strong></span>
                            </div>
                            <button class="btn-primary">Bayar Sekarang</button>
                        </div>
                    </div>

                    {{-- CASE 2: Dikemas --}}
                    <div class="order-card">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">10 Okt 2023</span>
                                <span class="order-id">INV/20231010/MPL/099</span>
                            </div>
                            <span class="badge blue">Dikemas</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                                    stroke-width="1">
                                    <path d="M20.2 7.8l-7.7 7.7a4 4 0 0 1-5.7-5.7l7.7-7.7a4 4 0 0 1 5.7 5.7z"></path>
                                    <path d="M15 7l-4 4"></path>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Vitamin C 1000mg</h3>
                                <p class="extra-items">1 barang</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Total Belanja</span>
                                <span class="price">Rp 45.000</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn-outline">Detail Pesanan</button>
                        </div>
                    </div>

                    {{-- CASE 3: Dikirim --}}
                    <div class="order-card">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">08 Okt 2023</span>
                                <span class="order-id">INV/20231008/MPL/045</span>
                            </div>
                            <span class="badge orange">Dikirim</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                                    stroke-width="1">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Minyak Kayu Putih 60ml</h3>
                                <p class="extra-items">+ 1 item lainnya</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Total Belanja</span>
                                <span class="price">Rp 32.000</span>
                            </div>
                        </div>
                        <div class="card-footer footer-action">
                            <div class="shipping-info">
                                <span>Kurir: JNE Regular (JO00921822)</span>
                            </div>
                            <button class="btn-outline">Lacak / Detail</button>
                        </div>
                    </div>

                    {{-- CASE 4: Selesai --}}
                    <div class="order-card">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">01 Okt 2023</span>
                                <span class="order-id">INV/20231001/MPL/002</span>
                            </div>
                            <span class="badge green">Selesai</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                                    stroke-width="1">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Paket Kesehatan Keluarga</h3>
                                <p class="extra-items">3 barang</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Total Belanja</span>
                                <span class="price">Rp 120.000</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn-outline">Detail Pesanan</button>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
@endsection
