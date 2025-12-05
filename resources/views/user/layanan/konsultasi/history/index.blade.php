@extends('layout')

@section('title', 'KlikDoc | Riwayat Konsultasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/konsultasi/history/styles.css') }}">
@endpush

@section('body')
    <div class="history-page">
        {{-- Header --}}
        <header class="history-header">
            <div class="header-container">
                <a href="{{ url('/dashboard') }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <h1>Riwayat Konsultasi</h1>
                <div class="spacer"></div>
            </div>
        </header>

        <main class="history-content">
            <div class="history-container">

                {{-- Tabs / Filter Status --}}
                <div class="status-tabs">
                    <button class="tab active" onclick="filterSelection('all', this)">Semua</button>
                    <button class="tab" onclick="filterSelection('unpaid', this)">Belum Dibayar</button>
                    <button class="tab" onclick="filterSelection('ongoing', this)">Sedang Berjalan</button>
                    <button class="tab" onclick="filterSelection('finished', this)">Selesai</button>
                </div>

                {{-- List Pesanan --}}
                <div class="order-list" id="orderList">

                    {{-- CASE 1: Belum Dibayar --}}
                    <div class="order-card filter-item unpaid">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">05 Des 2025</span>
                                <span class="order-id">CON/20251205/GP/001</span>
                            </div>
                            <span class="badge red">Belum Dibayar</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb">
                                {{-- Icon Dokter --}}
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Dr. Budi Santoso, Sp.PD</h3>
                                <p class="specialist">Spesialis Penyakit Dalam</p>
                                <p class="extra-items">Konsultasi Chat via Aplikasi</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Biaya Konsultasi</span>
                                <span class="price">Rp 75.000</span>
                            </div>
                        </div>
                        <div class="card-footer footer-action">
                            <div class="payment-timer">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span>Bayar dalam <strong>58:20</strong> menit</span>
                            </div>
                            <button class="btn-primary">Bayar Sekarang</button>
                        </div>
                    </div>

                    {{-- CASE 2: Sedang Berjalan --}}
                    <div class="order-card filter-item ongoing">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">05 Des 2025</span>
                                <span class="order-id">CON/20251205/PD/088</span>
                            </div>
                            <span class="badge blue">Sedang Berjalan</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb">
                                {{-- Icon Stetoskop --}}
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"></path>
                                    <path d="M8 15v1a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6v-4"></path>
                                    <circle cx="20" cy="10" r="2"></circle>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Dr. Siti Aminah, Sp.A</h3>
                                <p class="specialist">Spesialis Anak</p>
                                <p class="extra-items">Sesi Video Call - Ruang 2</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Biaya Konsultasi</span>
                                <span class="price">Rp 120.000</span>
                            </div>
                        </div>
                        <div class="card-footer footer-action">
                            <div class="consultation-info">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                <span>Dokter sedang mengetik...</span>
                            </div>
                            <button class="btn-blue">Lanjut Chat</button>
                        </div>
                    </div>

                    {{-- CASE 3: Selesai --}}
                    <div class="order-card filter-item finished">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">01 Des 2025</span>
                                <span class="order-id">CON/20251201/UM/012</span>
                            </div>
                            <span class="badge green">Selesai</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Dr. Andi Wijaya</h3>
                                <p class="specialist">Dokter Umum</p>
                                <p class="extra-items">Durasi: 15 menit</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Biaya Konsultasi</span>
                                <span class="price">Rp 45.000</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn-outline">Detail</button>
                            {{-- <button class="btn-outline" style="margin-left: 8px;">Beri Ulasan</button> --}}
                        </div>
                    </div>

                    {{-- CASE 4: Selesai (Data Lama) --}}
                    <div class="order-card filter-item finished">
                        <div class="card-header">
                            <div class="meta">
                                <span class="date">28 Nov 2025</span>
                                <span class="order-id">CON/20251128/KG/103</span>
                            </div>
                            <span class="badge green">Selesai</span>
                        </div>
                        <div class="card-body">
                            <div class="product-thumb">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="product-info">
                                <h3>Drg. Ratna Sari</h3>
                                <p class="specialist">Dokter Gigi</p>
                                <p class="extra-items">Durasi: 20 menit</p>
                            </div>
                            <div class="bill-info">
                                <span class="label">Biaya Konsultasi</span>
                                <span class="price">Rp 90.000</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn-outline">Detail</button>
                        </div>
                    </div>

                    {{-- Empty State --}}
                    <div class="empty-state" id="emptyState" style="display: none;">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#e0e0e0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        <h3>Tidak ada data</h3>
                        <p>Belum ada riwayat konsultasi di kategori ini.</p>
                    </div>

                </div>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
<script>
    function filterSelection(category, btn) {
        var items, i;
        
        // 1. Handle Active Tab Styling
        var tabs = document.getElementsByClassName("tab");
        for (i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove("active");
        }
        btn.classList.add("active");

        // 2. Handle Filtering Logic
        items = document.getElementsByClassName("filter-item");
        var visibleCount = 0;

        if (category == "all") {
            category = "";
        }

        for (i = 0; i < items.length; i++) {
            items[i].style.display = "none"; 
            
            if (items[i].className.indexOf(category) > -1) {
                items[i].style.display = ""; 
                visibleCount++;
            }
        }

        // 3. Handle Empty State
        var emptyState = document.getElementById("emptyState");
        if (visibleCount === 0) {
            emptyState.style.display = "flex";
        } else {
            emptyState.style.display = "none";
        }
    }
</script>
@endpush