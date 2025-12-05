@extends('layout')

@section('title', 'KlikDoc | Konsultasi Dokter')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/konsultasi/dokter/styles.css') }}">
@endpush

@section('body')
    <div class="konsultasi-page">
        <div class="split-container">

            {{-- SISI KIRI: Sidebar (Search, Filter, Jadwal, History) --}}
            <aside class="split-sidebar">
                <div class="sidebar-header">
                    <h2>Konsultasi<span class="dot">.</span></h2>
                    <p>Temukan dokter spesialis terbaik untukmu.</p>
                </div>

                {{-- Fitur 1: Global Search --}}
                <div class="sidebar-widget search-widget">
                    <div class="input-icon-wrapper">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" placeholder="Cari dokter, spesialis, RS..." class="search-input">
                    </div>
                </div>

                {{-- Fitur 2: Jadwal Terdekat --}}
                <div class="sidebar-widget appointment-widget">
                    <div class="widget-header">
                        <span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            Jadwal Terdekat
                        </span>
                    </div>
                    <div class="appointment-card">
                        <div class="app-info">
                            <span class="app-doctor">Dr. Sarah Wijaya</span>
                            <span class="app-spec">Sp. Penyakit Dalam</span>
                            <div class="app-time">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                Besok, 14:00 WIB
                            </div>
                        </div>
                        <button class="btn-join">Masuk</button>
                    </div>
                </div>

                {{-- Fitur 3: Riwayat Konsultasi --}}
                <div class="sidebar-widget history-widget">
                    <div class="widget-header">
                        <span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Riwayat Konsultasi
                        </span>
                    </div>
                    <div class="history-list">
                        <div class="history-item">
                            <div class="history-info">
                                <span class="history-date">20 Okt 2023</span>
                                <span class="history-name">Dr. Budi Santoso</span>
                            </div>
                            <span class="status-pill success">Selesai</span>
                        </div>
                        <div class="history-item">
                            <div class="history-info">
                                <span class="history-date">15 Sep 2023</span>
                                <span class="history-name">Drg. Lina Marlina</span>
                            </div>
                            <span class="status-pill success">Selesai</span>
                        </div>
                    </div>
                    <a href="#" class="btn-history-more">Lihat Semua</a>
                </div>

                <hr class="sidebar-divider">

                {{-- Fitur 4: Filtering --}}
                <div class="sidebar-filters">
                    <div class="filter-group">
                        <h3>Spesialisasi</h3>
                        <label class="checkbox-item">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            Semua Spesialis
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            Dokter Umum
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            Spesialis Anak
                        </label>
                         <label class="checkbox-item">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            Spesialis Kulit
                        </label>
                    </div>
                </div>
            </aside>

            {{-- SISI KANAN: Grid Dokter --}}
            <main class="split-content">
                <div class="content-header">
                    <h1>Pilih Dokter</h1>
                    <div class="sort-wrapper">
                        <span>Urutkan:</span>
                        <select>
                            <option>Paling Relevan</option>
                            <option>Pengalaman Terlama</option>
                            <option>Harga Terendah</option>
                            <option>Harga Tertinggi</option>
                        </select>
                    </div>
                </div>

                {{-- Doctor Grid --}}
                <div class="doctor-grid">
                    
                    {{-- Dokter 1: BISA DUA-DUANYA (Online & Tatap Muka) --}}
                    {{-- Hapus data-bs-toggle karena tidak ada modal --}}
                    <div class="doctor-card">
                        <div class="doctor-image-wrapper">
                            <div class="status-badge online">Online</div>
                            <div class="doctor-img-placeholder bg-blue-soft">
                                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#1C274C" stroke-width="1.5">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="experience-badge">10 Tahun Exp</div>
                        </div>
                        <div class="doctor-info">
                            <div class="doc-header">
                                <div class="spec-label">Dokter Umum</div>
                                <div class="rating-badge">
                                    <span class="star">★</span> 4.9
                                </div>
                            </div>
                            
                            <h3>Dr. Andi Pratama</h3>
                            
                            {{-- Tags Layanan --}}
                            <div class="service-tags">
                                <span class="tag-service chat">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                    Chat Online
                                </span>
                                <span class="tag-service visit">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V7l8-4 8 4v14M8 21v-4h8v4"></path></svg>
                                    Tatap Muka
                                </span>
                            </div>

                            <div class="hospital-info">
                                RS Siloam, Jakarta
                            </div>
                            
                            <hr class="card-divider">
                            <div class="price-action">
                                <div class="price-box">
                                    <small>Mulai dari</small>
                                    <span class="price">Rp 50.000</span>
                                </div>
                                <a href="#" class="btn-book-direct">Buat Janji</a>
                            </div>
                        </div>
                    </div>

                    {{-- Dokter 2: HANYA ONLINE --}}
                    <div class="doctor-card">
                        <div class="doctor-image-wrapper">
                            <div class="status-badge online">Online</div>
                            <div class="doctor-img-placeholder bg-pink-soft">
                                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#FF4867" stroke-width="1.5">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="experience-badge">7 Tahun Exp</div>
                        </div>
                        <div class="doctor-info">
                             <div class="doc-header">
                                <div class="spec-label">Spesialis Kulit</div>
                                <div class="rating-badge">
                                    <span class="star">★</span> 5.0
                                </div>
                            </div>

                            <h3>Dr. Jessica Tan, Sp.KK</h3>
                            
                            {{-- Tags Layanan --}}
                            <div class="service-tags">
                                <span class="tag-service chat">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                    Chat Online
                                </span>
                                {{-- Tidak ada tag Tatap Muka --}}
                            </div>

                            <div class="hospital-info">
                                Praktik Mandiri (Online)
                            </div>

                            <hr class="card-divider">
                            <div class="price-action">
                                <div class="price-box">
                                    <small>Biaya Chat</small>
                                    <span class="price">Rp 150.000</span>
                                </div>
                                <a href="#" class="btn-book-direct">Konsultasi</a>
                            </div>
                        </div>
                    </div>

                    {{-- Dokter 3: HANYA TATAP MUKA --}}
                     <div class="doctor-card">
                        <div class="doctor-image-wrapper">
                            <div class="status-badge offline">Offline</div>
                             <div class="doctor-img-placeholder bg-blue-soft">
                                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#1C274C" stroke-width="1.5">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="experience-badge">15 Tahun Exp</div>
                        </div>
                        <div class="doctor-info">
                             <div class="doc-header">
                                <div class="spec-label">Spesialis Anak</div>
                                <div class="rating-badge">
                                    <span class="star">★</span> 4.8
                                </div>
                            </div>
                            
                            <h3>Dr. Bambang S., Sp.A</h3>

                            {{-- Tags Layanan --}}
                            <div class="service-tags">
                                <span class="tag-service visit">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V7l8-4 8 4v14M8 21v-4h8v4"></path></svg>
                                    Tatap Muka
                                </span>
                            </div>

                            <div class="hospital-info">
                                RS Hermina, Bekasi
                            </div>

                            <hr class="card-divider">
                            <div class="price-action">
                                <div class="price-box">
                                    <small>Biaya Kunjungan</small>
                                    <span class="price">Rp 120.000</span>
                                </div>
                                <a href="#" class="btn-book-direct">Buat Janji</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="pagination-wrapper">
                    <button class="page-btn" disabled>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6" /></svg>
                    </button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6" /></svg></button>
                </div>
            </main>
        </div>
    </div>
@endsection