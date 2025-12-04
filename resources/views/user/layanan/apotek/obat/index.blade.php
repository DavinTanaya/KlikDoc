@extends('layout')

@section('title', 'KlikDoc | Apotek Online')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/obat/styles.css') }}">
@endpush

@section('body')
    {{-- Wrapper Utama dengan Scoped Class --}}
    <div class="apotek-online">
        <div class="split-container">

            {{-- SISI KIRI: Sidebar (Search, Filter, Cart, History) --}}
            <aside class="split-sidebar">
                <div class="sidebar-header">
                    <h2>Apotek<span class="dot">.</span></h2>
                    <p>Obat asli, lengkap, dan terpercaya.</p>
                </div>

                {{-- Fitur 1: Global Search --}}
                <div class="sidebar-widget search-widget">
                    <div class="input-icon-wrapper">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" placeholder="Cari obat, vitamin..." class="search-input">
                    </div>
                </div>

                {{-- Fitur 2: Keranjang Mini --}}
                <div class="sidebar-widget cart-widget">
                    <div class="widget-header">
                        <span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg> Keranjang Saya</span>
                        <span class="badge">3</span>
                    </div>
                    <div class="cart-summary">
                        <div class="cart-total">
                            <small>Total Estimasi</small>
                            <strong>Rp 145.000</strong>
                        </div>
                        <button class="btn-cart">Lihat</button>
                    </div>
                </div>

                {{-- Fitur Baru: Riwayat Pesanan --}}
                <div class="sidebar-widget history-widget">
                    <div class="widget-header">
                        <span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg> Riwayat Pesanan</span>
                    </div>
                    <div class="history-list">
                        {{-- History Item 1 --}}
                        <div class="history-item">
                            <div class="history-info">
                                <span class="history-date">24 Okt 2023</span>
                                <span class="history-name">Amoxicillin, dll.</span>
                            </div>
                            <span class="status-pill success">Selesai</span>
                        </div>
                        {{-- History Item 2 --}}
                        <div class="history-item">
                            <div class="history-info">
                                <span class="history-date">10 Okt 2023</span>
                                <span class="history-name">Vitamin C 1000mg</span>
                            </div>
                            <span class="status-pill success">Selesai</span>
                        </div>
                        {{-- History Item 3 --}}
                        <div class="history-item">
                            <div class="history-info">
                                <span class="history-date">01 Okt 2023</span>
                                <span class="history-name">Panadol Extra</span>
                            </div>
                            <span class="status-pill info">Dikirim</span>
                        </div>
                    </div>
                    <a href="#" class="btn-history-more">Lihat Semua</a>
                </div>

                <hr class="sidebar-divider">

                {{-- Fitur 3: Filtering --}}
                <div class="sidebar-filters">
                    <div class="filter-group">
                        <h3>Kategori Obat</h3>
                        <label class="checkbox-item">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            Semua
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            Obat Bebas
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            Obat Resep
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            Vitamin & Suplemen
                        </label>
                    </div>

                    <div class="filter-group">
                        <h3>Rentang Harga</h3>
                        <div class="price-range">
                            <input type="number" placeholder="Min" class="price-input">
                            <span>-</span>
                            <input type="number" placeholder="Max" class="price-input">
                        </div>
                    </div>
                </div>
            </aside>

            {{-- SISI KANAN: Grid Produk --}}
            <main class="split-content">
                <div class="content-header">
                    <h1>Rekomendasi Kesehatan</h1>
                    <div class="sort-wrapper">
                        <span>Urutkan:</span>
                        <select>
                            <option>Paling Relevan</option>
                            <option>Harga Terendah</option>
                            <option>Harga Tertinggi</option>
                        </select>
                    </div>
                </div>

                {{-- Product Grid --}}
                <div class="product-grid">
                    {{-- Item 1 --}}
                    <!-- Tambahkan data-bs-toggle untuk memicu modal -->
                    <div class="product-card" data-bs-toggle="modal" data-bs-target="#productDetailModal">
                        <div class="product-image">
                            <div class="tag-badge blue">Obat Bebas</div>
                            <div class="img-placeholder">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                                    stroke-width="1">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2">
                                    </rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3>Paracetamol 500mg</h3>
                            <p class="unit">Strip (10 Tablet)</p>
                            <div class="price-action">
                                <span class="price">Rp 5.000</span>
                                <button class="btn-add">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Item 2 --}}
                    <div class="product-card" data-bs-toggle="modal" data-bs-target="#productDetailModal">
                        <div class="product-image">
                            <div class="tag-badge green">Vitamin</div>
                            <div class="img-placeholder">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                                    stroke-width="1">
                                    <path d="M20.2 7.8l-7.7 7.7a4 4 0 0 1-5.7-5.7l7.7-7.7a4 4 0 0 1 5.7 5.7z"></path>
                                    <path d="M15 7l-4 4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3>Vitamin C 1000mg</h3>
                            <p class="unit">Botol (30 Tablet)</p>
                            <div class="price-action">
                                <span class="price">Rp 45.000</span>
                                <button class="btn-add">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Item 3 --}}
                    <div class="product-card" data-bs-toggle="modal" data-bs-target="#productDetailModal">
                        <div class="product-image">
                            <div class="tag-badge red">Resep Dokter</div>
                            <div class="img-placeholder">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                                    stroke-width="1">
                                    <path d="M10.5 20.5l10-10a4.95 4.95 0 1 0-7-7l-10 10a4.95 4.95 0 1 0 7 7Z"></path>
                                    <path d="m8.5 8.5 7 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3>Amoxicillin Trihydrate</h3>
                            <p class="unit">Strip (10 Kapsul)</p>
                            <div class="price-action">
                                <span class="price">Rp 8.500</span>
                                <button class="btn-add">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Item 4 --}}
                    <div class="product-card" data-bs-toggle="modal" data-bs-target="#productDetailModal">
                        <div class="product-image">
                            <div class="tag-badge blue">Obat Bebas</div>
                            <div class="img-placeholder">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                                    stroke-width="1">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3>Minyak Kayu Putih</h3>
                            <p class="unit">Botol 60ml</p>
                            <div class="price-action">
                                <span class="price">Rp 22.000</span>
                                <button class="btn-add">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pagination Section --}}
                <div class="pagination-wrapper">
                    <button class="page-btn" disabled>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <span class="dots">...</span>
                    <button class="page-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>
                </div>
            </main>
        </div>
    </div>

    {{-- MODAL DETAIL PRODUK --}}
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content product-modal">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="modal-body p-0">
                    <div class="product-modal-grid">
                        {{-- Sisi Kiri: Gambar --}}
                        <div class="modal-img-wrapper">
                            <div class="tag-badge blue big">Obat Bebas</div>
                            <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="#1C274C"
                                stroke-width="1">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
                        </div>

                        {{-- Sisi Kanan: Informasi --}}
                        <div class="modal-info-wrapper">
                            <h2 class="modal-title">Paracetamol 500mg</h2>
                            <p class="modal-unit">Strip (10 Tablet)</p>

                            <div class="modal-price">Rp 5.000</div>

                            <hr class="modal-divider">

                            <div class="modal-details">
                                <div class="detail-row">
                                    <span class="label">Deskripsi</span>
                                    <p class="value">Obat analgesik dan antipiretik yang digunakan untuk meredakan sakit
                                        kepala, sakit gigi, dan menurunkan demam.</p>
                                </div>
                                <div class="detail-row">
                                    <span class="label">Dosis</span>
                                    <p class="value">Dewasa: 1-2 tablet, 3-4 kali sehari. Anak-anak: 1/2 - 1 tablet, 3-4
                                        kali sehari.</p>
                                </div>
                                <div class="detail-row">
                                    <span class="label">Jenis</span>
                                    <p class="value">Tablet</p>
                                </div>
                            </div>

                            <div class="modal-actions">
                                <div class="qty-selector">
                                    <button>-</button>
                                    <input type="text" value="1" readonly>
                                    <button>+</button>
                                </div>
                                <button class="btn-add-cart-modal">
                                    + Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
