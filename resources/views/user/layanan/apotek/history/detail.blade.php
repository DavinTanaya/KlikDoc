@extends('layout')

@section('title', 'KlikDoc | Detail Pesanan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/obat/detail.css') }}">
@endpush

@section('body')
    <div class="detail-page">
        {{-- Header --}}
        <header class="detail-header">
            <div class="header-container">
                <a href="{{ url('/history') }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Kembali
                </a>
                <h1>Detail Pesanan</h1>
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
                            <span class="label">Status Pesanan</span>
                            <h2 class="status-text text-red">Menunggu Pembayaran</h2>
                        </div>
                        <div class="countdown-timer">
                            <span>Bayar dalam: </span>
                            <strong class="timer">23:59:02</strong>
                        </div>
                    </div>

                    {{-- Section 2: Kode Pembayaran (Hanya muncul jika belum bayar) --}}
                    <div class="section-block payment-code-section">
                        <div class="bank-info">
                            <div class="logo-box">BCA</div>
                            <div class="info-text">
                                <span class="method">BCA Virtual Account</span>
                                <span class="check-auto">Dicek Otomatis</span>
                            </div>
                        </div>
                        <div class="va-box">
                            <span class="label">Nomor Virtual Account</span>
                            <div class="code-row">
                                <strong class="code">8801 2938 2291 001</strong>
                                <button class="btn-copy">Salin</button>
                            </div>
                        </div>
                    </div>

                    {{-- Section 3: Informasi Pengiriman --}}
                    <div class="section-block shipping-section">
                        <h3>Informasi Pengiriman</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="label">Kurir</span>
                                <span class="value">JNE Regular (Rp 10.000)</span>
                            </div>
                            <div class="info-item">
                                <span class="label">No. Resi</span>
                                <span class="value">JO00921822</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Tanggal Pembelian</span>
                                <span class="value">12 Okt 2023, 14:30</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Estimasi Sampai</span>
                                <span class="value text-green">14 - 15 Okt 2023</span>
                            </div>
                            <div class="info-item full-width">
                                <span class="label">Alamat Penerima</span>
                                <span class="value">Jl. Mawar No. 12, Jakarta Selatan, DKI Jakarta 12430 (Rumah Pagar Hitam)</span>
                            </div>
                        </div>
                    </div>

                    {{-- Section 4: Produk yang Dibeli --}}
                    <div class="section-block products-section">
                        <h3>Produk (3 Barang)</h3>
                        <div class="product-list">
                            {{-- Item 1 --}}
                            <div class="product-item">
                                <div class="thumb">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#aaa" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                </div>
                                <div class="details">
                                    <h4>Paracetamol 500mg</h4>
                                    <span class="meta">2 x Rp 5.000</span>
                                </div>
                                <div class="subtotal">Rp 10.000</div>
                            </div>

                            {{-- Item 2 --}}
                            <div class="product-item">
                                <div class="thumb">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#aaa" stroke-width="1.5"><path d="M20.2 7.8l-7.7 7.7a4 4 0 0 1-5.7-5.7l7.7-7.7a4 4 0 0 1 5.7 5.7z"></path></svg>
                                </div>
                                <div class="details">
                                    <h4>Vitamin C 1000mg</h4>
                                    <span class="meta">1 x Rp 45.000</span>
                                </div>
                                <div class="subtotal">Rp 45.000</div>
                            </div>
                        </div>
                    </div>

                    {{-- Section 5: Rincian Biaya & Voucher --}}
                    <div class="section-block cost-section">
                        <h3>Rincian Pembayaran</h3>
                        <div class="cost-row">
                            <span>Total Harga Barang</span>
                            <span>Rp 55.000</span>
                        </div>
                        <div class="cost-row">
                            <span>Biaya Pengiriman</span>
                            <span>Rp 10.000</span>
                        </div>
                        <div class="cost-row voucher-row">
                            <span class="voucher-label">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
                                Voucher (DISKONKILAT)
                            </span>
                            <span class="discount">- Rp 5.000</span>
                        </div>
                        <div class="cost-row">
                            <span>Biaya Layanan</span>
                            <span>Rp 1.000</span>
                        </div>
                        <div class="divider"></div>
                        <div class="cost-row total-row">
                            <span>Total Belanja</span>
                            <span class="total-amount">Rp 61.000</span>
                        </div>
                    </div>

                </div>

                {{-- Sticky Footer Action (Inside Container) --}}
                <div class="detail-footer">
                    <button class="btn-help">Bantuan</button>
                    <button class="btn-primary-action">Cek Status Pembayaran</button>
                </div>

            </div>
        </main>
    </div>
@endsection