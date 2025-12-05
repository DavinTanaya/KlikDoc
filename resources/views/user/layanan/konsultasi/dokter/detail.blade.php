@extends('layout')

@section('title', 'Detail Dokter - Dr. Andi Pratama')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/konsultasi/dokter/detail.css') }}">
@endpush

@section('body')
    <div class="doctor-detail-page">
        <div class="container-width">
            
            {{-- Breadcrumb / Back Button --}}
            <div class="page-header">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="detail-layout">
                
                {{-- KOLOM KIRI: Info Utama & Jadwal --}}
                <div class="left-column">
                    
                    {{-- Section 1: Doctor Profile Header --}}
                    <div class="card profile-header-card">
                        <div class="profile-layout">
                            <div class="avatar-wrapper">
                                <div class="avatar-lg bg-blue-soft">
                                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#1C274C" stroke-width="1.5">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <div class="status-indicator online"></div>
                                </div>
                            </div>
                            <div class="info-wrapper">
                                <div class="name-row">
                                    <h1>Dr. Andi Pratama</h1>
                                    <span class="badge-verification">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        Terverifikasi
                                    </span>
                                </div>
                                <p class="specialist">Dokter Umum</p>
                                <p class="hospital">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V7l8-4 8 4v14M8 21v-4h8v4"></path></svg>
                                    RS Siloam, Jakarta Selatan
                                </p>
                                
                                <div class="stats-grid">
                                    <div class="stat-box">
                                        <span class="val">10 Tahun</span>
                                        <span class="lbl">Pengalaman</span>
                                    </div>
                                    <div class="stat-box">
                                        <span class="val">98%</span>
                                        <span class="lbl">Kepuasan</span>
                                    </div>
                                    <div class="stat-box">
                                        <span class="val">STR</span>
                                        <span class="lbl">12399877.21</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section 2: Tabs Content (Jadwal, Bio, Review) --}}
                    <div class="content-tabs">
                        <button class="tab-btn active" onclick="switchTab('jadwal')">Jadwal Praktik</button>
                        <button class="tab-btn" onclick="switchTab('bio')">Tentang Dokter</button>
                        <button class="tab-btn" onclick="switchTab('review')">Ulasan (120)</button>
                    </div>

                    {{-- Tab Body: JADWAL (Default) --}}
                    <div id="tab-jadwal" class="tab-content active">
                        
                        {{-- Date Picker --}}
                        <div class="section-label">Pilih Tanggal</div>
                        <div class="date-strip-wrapper">
                            <div class="date-strip">
                                <div class="date-item active">
                                    <span class="day">Sen</span>
                                    <span class="date">24 Okt</span>
                                </div>
                                <div class="date-item">
                                    <span class="day">Sel</span>
                                    <span class="date">25 Okt</span>
                                </div>
                                <div class="date-item">
                                    <span class="day">Rab</span>
                                    <span class="date">26 Okt</span>
                                </div>
                                <div class="date-item">
                                    <span class="day">Kam</span>
                                    <span class="date">27 Okt</span>
                                </div>
                                <div class="date-item">
                                    <span class="day">Jum</span>
                                    <span class="date">28 Okt</span>
                                </div>
                                <div class="date-item disabled">
                                    <span class="day">Sab</span>
                                    <span class="date">29 Okt</span>
                                </div>
                            </div>
                        </div>

                        {{-- Time Slots --}}
                        <div class="section-label mt-4">Pilih Waktu Konsultasi</div>
                        <div class="time-grid">
                            <div class="time-period">
                                <h4>Pagi (09:00 - 12:00)</h4>
                                <div class="slots">
                                    <button class="slot-btn">09:00</button>
                                    <button class="slot-btn">09:30</button>
                                    <button class="slot-btn disabled">10:00</button>
                                    <button class="slot-btn active">10:30</button>
                                    <button class="slot-btn">11:00</button>
                                </div>
                            </div>

                            <div class="time-period mt-3">
                                <h4>Malam (19:00 - 21:00)</h4>
                                <div class="slots">
                                    <button class="slot-btn">19:00</button>
                                    <button class="slot-btn">19:30</button>
                                    <button class="slot-btn">20:00</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tab Body: BIO (Hidden by default) --}}
                    <div id="tab-bio" class="tab-content" style="display: none;">
                        <div class="bio-text">
                            <h3>Latar Belakang</h3>
                            <p>Dr. Andi Pratama adalah lulusan Fakultas Kedokteran Universitas Indonesia tahun 2013. Beliau telah mengabdikan diri selama 10 tahun di berbagai Rumah Sakit terkemuka.</p>
                            
                            <h3>Pendidikan</h3>
                            <ul class="edu-list">
                                <li>S1 Kedokteran Umum - Universitas Indonesia (2009-2013)</li>
                                <li>Profesi Dokter - RS Cipto Mangunkusumo (2013-2015)</li>
                            </ul>

                            <h3>Nomor Izin Praktik (SIP)</h3>
                            <p class="sip-num">503/1234/SIP.D/2023</p>
                        </div>
                    </div>

                    {{-- Tab Body: REVIEW --}}
                    <div id="tab-review" class="tab-content" style="display: none;">
                        <div class="reviews-wrapper">
                            {{-- Container Scrollable (Tombol Load More SEKARANG DI DALAM SINI) --}}
                            <div class="reviews-scroll-area">
                                {{-- Review Item 1 --}}
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="reviewer-info">
                                            <div class="reviewer-avatar">BS</div>
                                            <div>
                                                <span class="reviewer-name">Budi Santoso</span>
                                                <span class="review-date">20 Okt 2023</span>
                                            </div>
                                        </div>
                                        <div class="review-rating">★ 5.0</div>
                                    </div>
                                    <p class="review-comment">Dokternya sangat ramah dan penjelasannya mudah dimengerti. Sangat merekomendasikan!</p>
                                </div>

                                {{-- Review Item 2 --}}
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="reviewer-info">
                                            <div class="reviewer-avatar pink">SA</div>
                                            <div>
                                                <span class="reviewer-name">Siti Aminah</span>
                                                <span class="review-date">18 Okt 2023</span>
                                            </div>
                                        </div>
                                        <div class="review-rating">★ 4.8</div>
                                    </div>
                                    <p class="review-comment">Konsultasi berjalan lancar, respon dokter cepat.</p>
                                </div>

                                {{-- Review Item 3 --}}
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="reviewer-info">
                                            <div class="reviewer-avatar green">D</div>
                                            <div>
                                                <span class="reviewer-name">Dimas</span>
                                                <span class="review-date">15 Okt 2023</span>
                                            </div>
                                        </div>
                                        <div class="review-rating">★ 5.0</div>
                                    </div>
                                    <p class="review-comment">Solusi yang diberikan sangat tepat sasaran. Terima kasih dok.</p>
                                </div>
                                
                                {{-- Review Item 4 --}}
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="reviewer-info">
                                            <div class="reviewer-avatar">R</div>
                                            <div>
                                                <span class="reviewer-name">Rina</span>
                                                <span class="review-date">10 Okt 2023</span>
                                            </div>
                                        </div>
                                        <div class="review-rating">★ 5.0</div>
                                    </div>
                                    <p class="review-comment">Dokter sangat sabar mendengarkan keluhan saya.</p>
                                </div>
                                
                                {{-- Load More Button DI DALAM SCROLL AREA --}}
                                <div class="load-more-container">
                                    <button class="btn-load-more">
                                        Lihat Lebih Banyak
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN: Sticky Booking Summary --}}
                <div class="right-column">
                    <div class="booking-card sticky-card">
                        <h3>Ringkasan Pesanan</h3>
                        
                        <div class="booking-summary-list">
                            <div class="summary-item">
                                <span class="label">Dokter</span>
                                <span class="value">Dr. Andi Pratama</span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Spesialisasi</span>
                                <span class="value">Dokter Umum</span>
                            </div>
                            <div class="summary-item highlight">
                                <span class="label">Waktu</span>
                                <span class="value">Senin, 24 Okt • 10:30</span>
                            </div>
                            <div class="summary-item highlight">
                                <span class="label">Metode</span>
                                <span class="value">Chat Online</span>
                            </div>
                        </div>

                        <hr class="summary-divider">

                        <div class="price-breakdown">
                            <div class="price-row">
                                <span>Biaya Konsultasi</span>
                                <span>Rp 50.000</span>
                            </div>
                            <div class="price-row">
                                <span>Biaya Layanan</span>
                                <span>Rp 2.000</span>
                            </div>
                            <div class="price-row total">
                                <span>Total Bayar</span>
                                <span class="total-amount">Rp 52.000</span>
                            </div>
                        </div>
                        <a href="{{ route('konsultasi.success') }}">
                            <button class="btn-pay-now">
                                Lanjut Pembayaran
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </button>
                        </a>

                        <p class="secure-text">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            Pembayaran Aman & Terenkripsi
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Script Sederhana untuk Tab Switching --}}
    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            
            document.getElementById('tab-' + tabName).style.display = 'block';
            
             const buttons = document.querySelectorAll('.tab-btn');
             buttons.forEach(btn => {
                 if(btn.textContent.toLowerCase().includes(tabName.replace('tab-', ''))) {
                     btn.classList.add('active');
                 } else if (tabName === 'jadwal' && btn.textContent.includes('Jadwal')) {
                     btn.classList.add('active');
                 } else if (tabName === 'bio' && btn.textContent.includes('Tentang')) {
                     btn.classList.add('active');
                 } else if (tabName === 'review' && btn.textContent.includes('Ulasan')) {
                     btn.classList.add('active');
                 }
             });
        }
    </script>
@endsection