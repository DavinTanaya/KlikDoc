@extends('layout')

@section('title', 'KlikHome | Layanan Kesehatan di Rumah')

@push('styles')
    {{-- Menggunakan file CSS khusus untuk KlikHome agar tidak konflik --}}
    <link rel="stylesheet" href="{{ asset('css/user/layanan/klik-home/service/styles.css') }}">
@endpush

@section('body')
    <div class="klikhome-page">
        <div class="split-container">

            {{-- SISI KIRI: Sidebar --}}
            <aside class="split-sidebar">
                <div class="sidebar-header">
                    <h2>KlikHome<span class="dot">.</span></h2>
                    <p>Layanan kesehatan profesional, langsung di rumah Anda.</p>
                </div>

                {{-- Fitur 1: Search --}}
                <div class="sidebar-widget search-widget">
                    <div class="input-icon-wrapper">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" placeholder="Cari layanan (mis: Infus Vitamin)..." class="search-input">
                    </div>
                </div>

                {{-- Fitur 2: Kategori Layanan --}}
                <div class="sidebar-widget category-widget">
                    <div class="widget-header">Kategori Layanan</div>
                    <div class="category-list">
                        <label class="cat-item active">
                            <input type="radio" name="category" checked>
                            <span class="cat-icon bg-blue-soft">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                            </span>
                            <span class="cat-name">Semua Layanan</span>
                        </label>
                        
                        <label class="cat-item">
                            <input type="radio" name="category">
                            <span class="cat-icon bg-purple-soft">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.3.3 0 1 0 .2.3V4a1 1 0 0 1 1 1v5a5 5 0 0 1-10 0V5a1 1 0 0 1 1-1h.8z"></path><line x1="8" y1="15" x2="8" y2="22"></line><line x1="16" y1="15" x2="16" y2="22"></line></svg>
                            </span>
                            <span class="cat-name">Lab Tes</span>
                        </label>

                        <label class="cat-item">
                            <input type="radio" name="category">
                            <span class="cat-icon bg-green-soft">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            </span>
                            <span class="cat-name">Vaksinasi</span>
                        </label>

                        <label class="cat-item">
                            <input type="radio" name="category">
                            <span class="cat-icon bg-orange-soft">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path></svg>
                            </span>
                            <span class="cat-name">Vitamin Booster</span>
                        </label>

                        <label class="cat-item">
                            <input type="radio" name="category">
                            <span class="cat-icon bg-pink-soft">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path></svg>
                            </span>
                            <span class="cat-name">Grooming & Care</span>
                        </label>

                        <label class="cat-item">
                            <input type="radio" name="category">
                            <span class="cat-icon bg-cyan-soft">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect><path d="M8 14h.01"></path><path d="M12 14h.01"></path><path d="M16 14h.01"></path><path d="M8 18h.01"></path><path d="M12 18h.01"></path><path d="M16 18h.01"></path></svg>
                            </span>
                            <span class="cat-name">Dokter / Bidan</span>
                        </label>
                    </div>
                </div>

                <hr class="sidebar-divider">

                {{-- Fitur 3: Trust Signal --}}
                <div class="sidebar-banner trust-banner">
                    <div class="trust-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path></svg>
                    </div>
                    <div>
                        <h3>Aman & Steril</h3>
                        <p>Nakes kami menggunakan APD lengkap dan alat steril sekali pakai.</p>
                    </div>
                </div>

            </aside>

            {{-- SISI KANAN: Grid Layanan --}}
            <main class="split-content">
                <div class="content-header">
                    <h1>Pilih Layanan</h1>
                    <div class="sort-wrapper">
                        <span>Urutkan:</span>
                        <select>
                            <option>Paling Laris</option>
                            <option>Harga Terendah</option>
                            <option>Harga Tertinggi</option>
                        </select>
                    </div>
                </div>

                {{-- Service Grid --}}
                <div class="service-grid">

                    {{-- Item 1: Vitamin --}}
                    <div class="service-card">
                        <div class="card-thumb">
                            <span class="service-tag tag-vitamin">Vitamin</span>
                            <div class="thumb-placeholder bg-orange-light">
                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#f57c00" stroke-width="1.5"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path></svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Immune Booster Infusion</h3>
                            <p class="desc">Infus vitamin C + B Complex dosis tinggi untuk menjaga daya tahan tubuh.</p>
                            <div class="meta-info">
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> 45 Menit</span>
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Perawat</span>
                            </div>
                            <hr class="divider">
                            <div class="price-action">
                                <div class="price">Rp 350.000</div>
                                <button class="btn-book">Pesan</button>
                            </div>
                        </div>
                    </div>

                    {{-- Item 2: Lab Tes --}}
                    <div class="service-card">
                        <div class="card-thumb">
                            <span class="service-tag tag-lab">Lab Tes</span>
                            <div class="thumb-placeholder bg-purple-light">
                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#7b1fa2" stroke-width="1.5"><path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.3.3 0 1 0 .2.3V4a1 1 0 0 1 1 1v5a5 5 0 0 1-10 0V5a1 1 0 0 1 1-1h.8z"></path></svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Medical Checkup Basic</h3>
                            <p class="desc">Pemeriksaan darah lengkap, kolesterol, gula darah, dan asam urat.</p>
                            <div class="meta-info">
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> 15 Menit</span>
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Analis</span>
                            </div>
                            <hr class="divider">
                            <div class="price-action">
                                <div class="price">Rp 450.000</div>
                                <button class="btn-book">Pesan</button>
                            </div>
                        </div>
                    </div>

                    {{-- Item 3: Vaksin --}}
                    <div class="service-card">
                        <div class="card-thumb">
                            <span class="service-tag tag-vaksin">Vaksin</span>
                            <div class="thumb-placeholder bg-green-light">
                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Vaksin Influenza 4 Strain</h3>
                            <p class="desc">Perlindungan terhadap flu musiman. Cocok untuk dewasa dan lansia.</p>
                            <div class="meta-info">
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> 10 Menit</span>
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path></svg> Dokter Umum</span>
                            </div>
                            <hr class="divider">
                            <div class="price-action">
                                <div class="price">Rp 380.000</div>
                                <button class="btn-book">Pesan</button>
                            </div>
                        </div>
                    </div>

                    {{-- Item 4: Dokter ke Rumah --}}
                    <div class="service-card">
                        <div class="card-thumb">
                            <span class="service-tag tag-dokter">Dokter</span>
                            <div class="thumb-placeholder bg-cyan-light">
                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#00838f" stroke-width="1.5"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Kunjungan Dokter Umum</h3>
                            <p class="desc">Pemeriksaan fisik, diagnosa, dan resep obat langsung di rumah Anda.</p>
                            <div class="meta-info">
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> 30-60 Menit</span>
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path></svg> Dokter Umum</span>
                            </div>
                            <hr class="divider">
                            <div class="price-action">
                                <div class="price">Rp 250.000</div>
                                <button class="btn-book">Pesan</button>
                            </div>
                        </div>
                    </div>

                     {{-- Item 5: Grooming --}}
                     <div class="service-card">
                        <div class="card-thumb">
                            <span class="service-tag tag-grooming">Grooming</span>
                            <div class="thumb-placeholder bg-pink-light">
                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#ad1457" stroke-width="1.5"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path><line x1="16" y1="8" x2="2" y2="22"></line></svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Perawatan Luka (Wound Care)</h3>
                            <p class="desc">Pembersihan dan perawatan luka pasca operasi atau luka diabetes.</p>
                            <div class="meta-info">
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> 45 Menit</span>
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Perawat Luka</span>
                            </div>
                            <hr class="divider">
                            <div class="price-action">
                                <div class="price">Rp 200.000</div>
                                <button class="btn-book">Pesan</button>
                            </div>
                        </div>
                    </div>

                    {{-- Item 6: Bidan --}}
                    <div class="service-card">
                        <div class="card-thumb">
                            <span class="service-tag tag-bidan">Bidan</span>
                            <div class="thumb-placeholder bg-blue-light">
                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#1565c0" stroke-width="1.5"><path d="M9 12l2 2 4-4"></path><path d="M12 3a9 9 0 0 0 0 18 9 9 0 0 0 0-18z"></path></svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Home Care Pasca Melahirkan</h3>
                            <p class="desc">Kunjungan bidan untuk cek kesehatan ibu, perawatan payudara, dan bayi.</p>
                            <div class="meta-info">
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> 60 Menit</span>
                                <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Bidan</span>
                            </div>
                            <hr class="divider">
                            <div class="price-action">
                                <div class="price">Rp 300.000</div>
                                <button class="btn-book">Pesan</button>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
@endsection