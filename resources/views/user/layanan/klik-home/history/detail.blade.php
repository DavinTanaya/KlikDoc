@extends('layout')

@section('title', 'KlikHome | Detail Riwayat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/klik-home/history/detail.css') }}">
@endpush

@section('body')
    <div class="klikhome-detail-page">
        {{-- Header --}}
        <header class="detail-header">
            <div class="header-container">
                <a href="{{ url('/klikhome/history') }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Kembali
                </a>
                <h1>Detail Layanan</h1>
                <div class="spacer"></div>
            </div>
        </header>

        <main class="detail-content">
            <div class="detail-container">
                
                {{-- Scrollable Content Area --}}
                <div class="detail-scroll-area">
                    
                    {{-- Section 1: Status Banner --}}
                    <div class="section-block status-banner">
                        <div class="status-info">
                            <span class="label">Status Booking</span>
                            <h2 class="status-text text-blue">Terjadwal</h2>
                        </div>
                        {{-- Countdown dihapus jika status sudah lunas/terjadwal --}}
                        <div class="status-badge-pill">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            Lunas
                        </div>
                    </div>

                    {{-- Section 2: Informasi Kunjungan (Adaptasi dari Info Pengiriman) --}}
                    <div class="section-block shipping-section">
                        <h3>Informasi Kunjungan</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="label">Petugas Medis</span>
                                <span class="value">Sr. Siti Aminah (Perawat)</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Kode Booking</span>
                                <span class="value">KH-20231025-VIT</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Tanggal Pemesanan</span>
                                <span class="value">25 Okt 2023, 10:30</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Jadwal Kunjungan</span>
                                <span class="value text-green">Besok, 13:00 - 14:00 WIB</span>
                            </div>
                            <div class="info-item full-width">
                                <span class="label">Lokasi Kunjungan</span>
                                <span class="value">Jl. Mawar No. 12, Jakarta Selatan, DKI Jakarta 12430 (Rumah Pagar Hitam)</span>
                            </div>
                        </div>
                    </div>

                    {{-- Section 3: Layanan yang Dipesan --}}
                    <div class="section-block products-section">
                        <h3>Rincian Layanan</h3>
                        <div class="product-list">
                            {{-- Item 1 --}}
                            <div class="product-item">
                                <div class="thumb bg-orange-soft">
                                    {{-- Icon Vitamin --}}
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f57c00" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path></svg>
                                </div>
                                <div class="details">
                                    <h4>Immune Booster Infusion</h4>
                                    <span class="meta">1 Pasien (Dewasa)</span>
                                </div>
                                <div class="subtotal">Rp 350.000</div>
                            </div>

                            {{-- Item 2 (Contoh tambahan alat) --}}
                            <div class="product-item">
                                <div class="thumb bg-blue-soft">
                                    {{-- Icon Alat --}}
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1565c0" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"></rect><path d="M12 12h.01"></path></svg>
                                </div>
                                <div class="details">
                                    <h4>Alat Kesehatan (Infus Set)</h4>
                                    <span class="meta">Termasuk dalam paket</span>
                                </div>
                                <div class="subtotal">Rp 0</div>
                            </div>
                        </div>
                    </div>

                    {{-- Section 4: Rincian Biaya --}}
                    <div class="section-block cost-section">
                        <h3>Rincian Pembayaran</h3>
                        <div class="cost-row">
                            <span>Harga Layanan</span>
                            <span>Rp 350.000</span>
                        </div>
                        <div class="cost-row">
                            <span>Biaya Transport Nakes</span>
                            <span>Rp 25.000</span>
                        </div>
                        <div class="cost-row voucher-row">
                            <span class="voucher-label">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
                                Voucher (SEHATRUMAH)
                            </span>
                            <span class="discount">- Rp 20.000</span>
                        </div>
                        <div class="cost-row">
                            <span>Biaya Aplikasi</span>
                            <span>Rp 1.000</span>
                        </div>
                        <div class="divider"></div>
                        <div class="cost-row total-row">
                            <span>Total Dibayar</span>
                            <span class="total-amount">Rp 356.000</span>
                        </div>
                        <div class="cost-row method-row">
                            <span class="method-label">Metode Pembayaran</span>
                            <span class="method-value">BCA Virtual Account</span>
                        </div>
                    </div>

                </div>

                {{-- Sticky Footer Action --}}
                <div class="detail-footer">
                    <button class="btn-help">Bantuan</button>
                    <button class="btn-primary-action">Hubungi Nakes</button>
                </div>

            </div>
        </main>
    </div>
@endsection