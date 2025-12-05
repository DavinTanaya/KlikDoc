@extends('layout')

@section('title', 'Immune Booster Infusion - KlikHome')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/klik-home/service/detail.css') }}">
@endpush

@section('body')
    <div class="klikhome-detail-page">
        <div class="detail-container">
            
            {{-- Navigation Back --}}
            <div class="top-nav">
                <a href="{{ url('/klikhome') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Daftar Layanan
                </a>
            </div>

            <div class="content-grid">
                
                {{-- KOLOM KIRI: Informasi Detail Layanan --}}
                <div class="main-content">
                    
                    {{-- Hero Image --}}
                    <div class="service-hero-image bg-orange-light">
                        <div class="hero-icon">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#f57c00" stroke-width="1.5">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                            </svg>
                        </div>
                        <span class="category-badge">Vitamin Booster</span>
                    </div>

                    {{-- Judul & Ringkasan --}}
                    <header class="service-header">
                        <h1>Immune Booster Infusion</h1>
                        <div class="service-meta-row">
                            <div class="meta-item">
                                <div class="icon-box">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </div>
                                <span>45 Menit</span>
                            </div>
                            <div class="meta-item">
                                <div class="icon-box">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                </div>
                                <span>Perawat Terverifikasi</span>
                            </div>
                            <div class="meta-item">
                                <div class="icon-box">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                </div>
                                <span>Alat Steril</span>
                            </div>
                        </div>
                    </header>

                    <hr class="divider">

                    {{-- Deskripsi --}}
                    <div class="info-section">
                        <h3>Tentang Layanan</h3>
                        <p>
                            Layanan infus vitamin C dan B Complex dosis optimal yang dirancang untuk meningkatkan sistem kekebalan tubuh secara instan. Sangat cocok bagi Anda yang memiliki aktivitas padat, sering merasa lelah, atau dalam masa pemulihan setelah sakit.
                        </p>
                        <p>
                            Cairan infus akan langsung masuk ke pembuluh darah (intravena), sehingga penyerapan vitamin mencapai 99% dibandingkan vitamin oral (tablet/kapsul).
                        </p>
                    </div>

                    <div class="info-section">
                        <h3>Manfaat Utama</h3>
                        <ul class="check-list">
                            <li>Meningkatkan daya tahan tubuh terhadap virus dan bakteri.</li>
                            <li>Mempercepat pemulihan dari flu atau kelelahan kronis.</li>
                            <li>Mencerahkan kulit dan sebagai antioksidan.</li>
                            <li>Mengembalikan hidrasi tubuh.</li>
                        </ul>
                    </div>

                    <div class="info-section">
                        <h3>Yang Termasuk Dalam Paket</h3>
                        <div class="inclusion-card">
                            <div class="inc-item">
                                <span class="dot"></span> 1x Cairan Infus Vitamin C 1000mg + B Complex
                            </div>
                            <div class="inc-item">
                                <span class="dot"></span> Jasa Perawat Home Care ke Lokasi
                            </div>
                            <div class="inc-item">
                                <span class="dot"></span> Alat Kesehatan (Jarum, Infus Set, Alcohol Swab)
                            </div>
                            <div class="inc-item">
                                <span class="dot"></span> Konsultasi Singkat Tanda Vital (Tensi, Suhu)
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3>Prosedur Keamanan</h3>
                        <div class="safety-box">
                            <div class="safety-item">
                                <strong>APD Lengkap</strong>
                                <p>Perawat kami menggunakan masker, sarung tangan, dan gown sesuai standar medis.</p>
                            </div>
                            <div class="safety-item">
                                <strong>Alat Sekali Pakai</strong>
                                <p>Jarum dan selang infus baru dibuka di depan pasien untuk menjamin sterilitas.</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN: Widget Pemesanan --}}
                <div class="booking-sidebar">
                    <div class="booking-card">
                        <div class="price-header">
                            <span class="label">Total Biaya</span>
                            <span class="price">Rp 350.000</span>
                        </div>
                        
                        <div class="booking-form">
                            {{-- Form Lokasi --}}
                            <div class="form-group">
                                <div class="label-row">
                                    <label>Lokasi Kunjungan</label>
                                    {{-- Tombol Tambah Alamat (Membuka Modal Edit Kosong/Baru) --}}
                                    <button type="button" class="btn-add-address" onclick="openEditModal()">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        Tambah Alamat
                                    </button>
                                </div>

                                {{-- Preview Alamat Terpilih --}}
                                <div class="location-preview">
                                    <div class="loc-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    </div>
                                    <div class="loc-text">
                                        <span class="loc-name">Rumah (Utama)</span>
                                        <span class="loc-detail">Jl. Mawar No. 12, Jakarta Selatan</span>
                                    </div>
                                    {{-- Tombol Ubah Alamat Terpilih (Membuka Modal Edit) --}}
                                    <button type="button" class="btn-change" onclick="openEditModal()">Ubah</button>
                                </div>

                                {{-- Tombol Pilih Alamat Lain (Membuka Modal List) --}}
                                <button type="button" class="btn-select-other" onclick="openAddressModal()">
                                    Pilih Alamat Lain
                                </button>
                            </div>

                            <div class="form-group">
                                <label>Jadwal Kunjungan</label>
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>

                            <div class="form-group">
                                <label>Waktu</label>
                                <select class="form-control">
                                    <option>09:00 - 10:00</option>
                                    <option>10:00 - 11:00</option>
                                    <option selected>13:00 - 14:00</option>
                                    <option>15:00 - 16:00</option>
                                </select>
                            </div>
                        </div>

                        <hr class="card-divider">

                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>Rp 350.000</span>
                        </div>
                        <div class="summary-row">
                            <span>Biaya Layanan</span>
                            <span>Rp 5.000</span>
                        </div>
                         <div class="summary-row total">
                            <span>Total Bayar</span>
                            <span>Rp 355.000</span>
                        </div>

                        <button class="btn-payment">Lanjut Pembayaran</button>
                        <p class="secure-text">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            Pembayaran Aman & Terenkripsi
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- MODAL 1: PILIH ALAMAT (LIST) --}}
        <div id="addressModal" class="modal-overlay hidden">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Pilih Alamat</h3>
                    <button class="btn-close" onclick="closeAddressModal()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <div class="modal-body">
                    {{-- Alamat 1 --}}
                    <div class="address-item selected">
                        <div class="addr-info">
                            <span class="addr-tag">Rumah</span>
                            <p class="addr-text">Jl. Mawar No. 12, RT 05/RW 02, Kec. Tebet, Jakarta Selatan, 12810</p>
                            <span class="addr-phone">0812-3456-7890 (Penerima: Budi)</span>
                        </div>
                        <div class="addr-check">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                    </div>

                    {{-- Alamat 2 --}}
                    <div class="address-item">
                        <div class="addr-info">
                            <span class="addr-tag secondary">Kantor</span>
                            <p class="addr-text">Gedung Menara Karya Lt. 5, Jl. Rasuna Said, Kuningan, Jakarta Selatan</p>
                            <span class="addr-phone">0812-3456-7890</span>
                        </div>
                        <button class="btn-use-addr">Pilih</button>
                    </div>

                    {{-- Alamat 3 --}}
                    <div class="address-item">
                        <div class="addr-info">
                            <span class="addr-tag secondary">Orang Tua</span>
                            <p class="addr-text">Jl. Kenanga No. 88, Bekasi Barat</p>
                            <span class="addr-phone">0818-9999-0000</span>
                        </div>
                        <button class="btn-use-addr">Pilih</button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn-new-addr-modal" onclick="closeAddressModal(); openEditModal();">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Tambah Alamat Baru
                    </button>
                </div>
            </div>
        </div>

        {{-- MODAL 2: UBAH / TAMBAH DETAIL ALAMAT (FORM) --}}
        <div id="editAddressModal" class="modal-overlay hidden">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Detail Alamat</h3>
                    <button class="btn-close" onclick="closeEditModal()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form class="address-form">
                        <div class="form-group">
                            <label>Label Alamat (Contoh: Rumah, Kantor)</label>
                            <input type="text" class="form-control" placeholder="Rumah" value="Rumah">
                        </div>
                        
                        <div class="form-row two-col">
                            <div class="form-group">
                                <label>Nama Penerima</label>
                                <input type="text" class="form-control" value="Budi Santoso">
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="tel" class="form-control" value="081234567890">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea class="form-control" rows="3" placeholder="Nama Jalan, No Rumah, RT/RW, Kelurahan, Kecamatan">Jl. Mawar No. 12, RT 05/RW 02, Kec. Tebet, Jakarta Selatan, 12810</textarea>
                        </div>

                        <div class="form-group">
                            <label>Catatan untuk Nakes (Opsional)</label>
                            <input type="text" class="form-control" placeholder="Contoh: Pagar hitam, bel rusak">
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn-save-addr" onclick="closeEditModal()">Simpan Perubahan</button>
                </div>
            </div>
        </div>

    </div>

    {{-- Script Toggle Modal --}}
    <script>
        function openAddressModal() {
            document.getElementById('addressModal').classList.remove('hidden');
        }
        function closeAddressModal() {
            document.getElementById('addressModal').classList.add('hidden');
        }

        function openEditModal() {
            document.getElementById('editAddressModal').classList.remove('hidden');
        }
        function closeEditModal() {
            document.getElementById('editAddressModal').classList.add('hidden');
        }
    </script>
@endsection