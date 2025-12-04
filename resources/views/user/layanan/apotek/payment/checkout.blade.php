@extends('layout')

@section('title', 'KlikDoc | Pengiriman & Pembayaran')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/checkout/styles.css') }}">
@endpush

@section('body')
    <div class="checkout-page">
        {{-- Header --}}
        <header class="checkout-header">
            <div class="header-container">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <h1>Pengiriman & Pembayaran</h1>
                <div class="spacer"></div>
            </div>
        </header>

        <main class="checkout-content">
            {{-- Top Card: Scrollable Content --}}
            <div class="checkout-container">
                <div class="checkout-scroll-area">

                    {{-- Section 1: Alamat Pengiriman --}}
                    <div class="section-block">
                        <h2 class="section-title">Alamat Pengiriman</h2>

                        {{-- Kartu Alamat Utama --}}
                        <div class="address-card">
                            <div class="address-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </div>
                            <div class="address-details">
                                <span class="label-home">Rumah</span>
                                <h3>Andi Setiawan (0812-3456-7890)</h3>
                                <p>Jl. Melati Indah No. 45, RT 02/RW 05, Cilandak Barat, Jakarta Selatan, 12430</p>
                            </div>
                            {{-- Button Ubah memicu Modal Edit --}}
                            <button class="btn-change" data-bs-toggle="modal"
                                data-bs-target="#editAddressModal">Ubah</button>
                        </div>

                        {{-- Button Tambahan: Pilih Lain & Tambah Baru --}}
                        <div class="address-actions">
                            <button class="btn-address-action" data-bs-toggle="modal" data-bs-target="#savedAddressModal">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                Pilih Alamat Lain
                            </button>
                            <button class="btn-address-action" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Tambah Alamat Baru
                            </button>
                        </div>
                    </div>

                    <div class="divider"></div>

                    {{-- Section 2: Produk Dipesan --}}
                    <div class="section-block">
                        <h2 class="section-title">Produk Dipesan</h2>
                        <div class="product-list">
                            <div class="product-item">
                                <div class="prod-img">
                                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ccc"
                                        stroke-width="1.5">
                                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2">
                                        </rect>
                                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                    </svg>
                                </div>
                                <div class="prod-info">
                                    <h4>Paracetamol 500mg</h4>
                                    <p>2 x Rp 5.000</p>
                                </div>
                                <div class="prod-total">Rp 10.000</div>
                            </div>

                            <div class="product-item">
                                <div class="prod-img">
                                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ccc"
                                        stroke-width="1.5">
                                        <path d="M20.2 7.8l-7.7 7.7a4 4 0 0 1-5.7-5.7l7.7-7.7a4 4 0 0 1 5.7 5.7z"></path>
                                        <path d="M15 7l-4 4"></path>
                                    </svg>
                                </div>
                                <div class="prod-info">
                                    <h4>Vitamin C 1000mg</h4>
                                    <p>1 x Rp 45.000</p>
                                </div>
                                <div class="prod-total">Rp 45.000</div>
                            </div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    {{-- Section 3: Voucher & Rincian --}}
                    <div class="section-block">
                        <h2 class="section-title">Voucher & Pembayaran</h2>
                        <div class="voucher-box">
                            <div class="input-group">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                    </path>
                                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                </svg>
                                <input type="text" placeholder="Masukkan kode voucher">
                            </div>
                            <button class="btn-apply">Pakai</button>
                        </div>

                        <div class="price-summary">
                            <div class="summary-row"><span>Subtotal Produk</span><span>Rp 55.000</span></div>
                            <div class="summary-row"><span>Biaya Pengiriman</span><span>Rp 15.000</span></div>
                            <div class="summary-row discount"><span>Diskon Pengiriman</span><span>-Rp 5.000</span></div>
                            <div class="summary-row"><span>Biaya Layanan</span><span>Rp 1.000</span></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer: Total & Bayar --}}
            <footer class="checkout-footer">
                <div class="footer-container">
                    <div class="total-section">
                        <span class="label">Total Pembayaran</span>
                        <span class="amount">Rp 66.000</span>
                    </div>
                    <button class="btn-pay">Bayar Sekarang</button>
                </div>
            </footer>
        </main>
    </div>

    {{-- ================= MODALS SECTION ================= --}}

    {{-- 1. Modal Edit Alamat --}}
    <div class="modal fade" id="editAddressModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Alamat Pengiriman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control" value="Andi Setiawan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" value="0812-3456-7890">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" rows="3">Jl. Melati Indah No. 45, RT 02/RW 05, Cilandak Barat, Jakarta Selatan, 12430</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary"
                        style="background-color: #1C274C; border: none;">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Modal Pilih Alamat Tersimpan --}}
    <div class="modal fade" id="savedAddressModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Alamat Pengiriman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group">
                        {{-- Alamat 1 --}}
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true"
                            style="background-color: #e3f2fd; color: #333; border-color: #1C274C;">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 fw-bold">Rumah (Andi) <span class="badge bg-primary ms-2">Utama</span>
                                </h6>
                                <small>0812-3456-7890</small>
                            </div>
                            <p class="mb-1 small">Jl. Melati Indah No. 45, Cilandak Barat, Jakarta Selatan.</p>
                        </a>
                        {{-- Alamat 2 --}}
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 fw-bold">Kantor</h6>
                                <small>0812-3456-7890</small>
                            </div>
                            <p class="mb-1 small">Gedung Cyber 2, Jl. HR Rasuna Said, Kuningan, Jakarta Selatan.</p>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Modal Tambah Alamat Baru --}}
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Alamat Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Label Alamat (Rumah/Kantor/Kost)</label>
                            <input type="text" class="form-control" placeholder="Contoh: Rumah">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Nama Penerima</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" rows="3" placeholder="Nama Jalan, No. Rumah, RT/RW"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary"
                        style="background-color: #1C274C; border: none;">Simpan Alamat</button>
                </div>
            </div>
        </div>
    </div>
@endsection
