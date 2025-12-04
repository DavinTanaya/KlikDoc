@extends('layout')

@section('title', 'KlikDoc | Keranjang Saya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/keranjang/styles.css') }}">
@endpush

@section('body')
    <div class="cart-page">
        {{-- Header Sederhana --}}
        <header class="cart-header">
            <div class="header-container">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Kembali
                </a>
                <h1>Keranjang Saya</h1>
                <div class="spacer"></div> {{-- Spacer untuk centering title --}}
            </div>
        </header>

        <main class="cart-content">
            <div class="cart-container">
                
                {{-- Opsi Pilih Semua --}}
                <div class="cart-actions-bar">
                    <label class="custom-checkbox">
                        <input type="checkbox" checked>
                        <span class="checkmark"></span>
                        <span class="label-text">Pilih Semua (3 Item)</span>
                    </label>
                    <button class="btn-delete-selected">Hapus</button>
                </div>

                {{-- List Item Keranjang --}}
                <div class="cart-items-list">
                    
                    {{-- Item 1 --}}
                    <div class="cart-item">
                        <div class="item-select">
                            <label class="custom-checkbox">
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="item-image">
                            {{-- Placeholder Image --}}
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd" stroke-width="1"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                        </div>
                        <div class="item-details">
                            <div class="item-info">
                                <span class="badge blue">Obat Bebas</span>
                                <h3>Paracetamol 500mg</h3>
                                <p class="unit">Strip (10 Tablet)</p>
                                <div class="price">Rp 5.000</div>
                            </div>
                            <div class="item-actions">
                                <button class="btn-trash">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                                <div class="qty-control">
                                    <button class="btn-qty minus">-</button>
                                    <input type="text" value="2" readonly>
                                    <button class="btn-qty plus">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Item 2 --}}
                    <div class="cart-item">
                        <div class="item-select">
                            <label class="custom-checkbox">
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="item-image">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd" stroke-width="1"><path d="M20.2 7.8l-7.7 7.7a4 4 0 0 1-5.7-5.7l7.7-7.7a4 4 0 0 1 5.7 5.7z"></path><path d="M15 7l-4 4"></path></svg>
                        </div>
                        <div class="item-details">
                            <div class="item-info">
                                <span class="badge green">Vitamin</span>
                                <h3>Vitamin C 1000mg</h3>
                                <p class="unit">Botol (30 Tablet)</p>
                                <div class="price">Rp 45.000</div>
                            </div>
                            <div class="item-actions">
                                <button class="btn-trash">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                                <div class="qty-control">
                                    <button class="btn-qty minus">-</button>
                                    <input type="text" value="1" readonly>
                                    <button class="btn-qty plus">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Item 3 (Unchecked Example) --}}
                    <div class="cart-item unchecked-item">
                        <div class="item-select">
                            <label class="custom-checkbox">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="item-image">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd" stroke-width="1"><circle cx="12" cy="12" r="10"></circle></svg>
                        </div>
                        <div class="item-details">
                            <div class="item-info">
                                <span class="badge blue">Obat Bebas</span>
                                <h3>Minyak Kayu Putih</h3>
                                <p class="unit">Botol 60ml</p>
                                <div class="price">Rp 22.000</div>
                            </div>
                            <div class="item-actions">
                                <button class="btn-trash">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                                <div class="qty-control">
                                    <button class="btn-qty minus">-</button>
                                    <input type="text" value="1" readonly>
                                    <button class="btn-qty plus">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        {{-- Bottom Sticky Bar --}}
        <footer class="cart-footer">
            <div class="footer-container">
                <div class="total-section">
                    <span class="label">Total Pembayaran</span>
                    <span class="amount">Rp 55.000</span>
                </div>
                <button class="btn-checkout">
                    Bayar Sekarang (2)
                </button>
            </div>
        </footer>
    </div>
@endsection