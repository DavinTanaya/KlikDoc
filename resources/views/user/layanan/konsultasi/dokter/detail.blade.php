@extends('layout')

@section('title', 'Detail Dokter - Dr. Andi Pratama')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/konsultasi/dokter/detail.css') }}">
@endpush

@section('body')
    <div class="doctor-detail-page">
        <div class="detail-container">
            
            {{-- Navigation Back --}}
            <div class="top-nav">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="content-grid">
                
                {{-- KOLOM KIRI: Profil Dokter & Jadwal (Main Content) --}}
                <div class="main-content">
                    
                    {{-- 1. Doctor Profile Header --}}
                    <div class="doctor-profile-section">
                        <div class="profile-flex">
                            <div class="avatar-wrapper">
                                <div class="avatar-lg bg-blue-soft">
                                    {{-- Placeholder Avatar --}}
                                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#1C274C" stroke-width="1.5">
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
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        Terverifikasi
                                    </span>
                                </div>
                                <p class="specialist">Dokter Umum</p>
                                <p class="hospital">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V7l8-4 8 4v14M8 21v-4h8v4"></path></svg>
                                    RS Siloam, Jakarta Selatan
                                </p>
                            </div>
                        </div>

                        {{-- Stats Grid --}}
                        <div class="stats-grid">
                            <div class="stat-item">
                                <span class="val">10 Tahun</span>
                                <span class="lbl">Pengalaman</span>
                            </div>
                            <div class="stat-item">
                                <span class="val">98%</span>
                                <span class="lbl">Kepuasan</span>
                            </div>
                            <div class="stat-item">
                                <span class="val">STR</span>
                                <span class="lbl">12399877.21</span>
                            </div>
                        </div>
                    </div>

                    <hr class="divider">

                    {{-- 2. Tabs Navigation --}}
                    <div class="content-tabs">
                        <button class="tab-btn active" onclick="switchTab('jadwal')">Jadwal Praktik</button>
                        <button class="tab-btn" onclick="switchTab('bio')">Tentang Dokter</button>
                        <button class="tab-btn" onclick="switchTab('review')">Ulasan (120)</button>
                    </div>

                    {{-- 3. Tab Contents --}}
                    
                    {{-- TAB: JADWAL --}}
                    <div id="tab-jadwal" class="tab-content active">
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
                                <div class="date-item disabled">
                                    <span class="day">Kam</span>
                                    <span class="date">27 Okt</span>
                                </div>
                                <div class="date-item">
                                    <span class="day">Jum</span>
                                    <span class="date">28 Okt</span>
                                </div>
                            </div>
                        </div>

                        <div class="section-label mt-4">Pilih Waktu</div>
                        <div class="time-grid">
                            <div class="time-period">
                                <h4>Pagi</h4>
                                <div class="slots">
                                    <button class="slot-btn">09:00</button>
                                    <button class="slot-btn disabled">09:30</button>
                                    <button class="slot-btn active">10:30</button>
                                    <button class="slot-btn">11:00</button>
                                </div>
                            </div>
                            <div class="time-period">
                                <h4>Sore</h4>
                                <div class="slots">
                                    <button class="slot-btn">15:00</button>
                                    <button class="slot-btn">16:00</button>
                                    <button class="slot-btn">16:30</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TAB: BIO --}}
                    <div id="tab-bio" class="tab-content" style="display: none;">
                        <div class="bio-text">
                            <h3>Latar Belakang</h3>
                            <p>Dr. Andi Pratama adalah lulusan Fakultas Kedokteran Universitas Indonesia tahun 2013. Beliau telah mengabdikan diri selama 10 tahun di berbagai Rumah Sakit terkemuka dengan fokus pada penanganan penyakit dalam dan preventif.</p>
                            
                            <h3>Pendidikan</h3>
                            <ul class="check-list">
                                <li>S1 Kedokteran Umum - Universitas Indonesia (2009-2013)</li>
                                <li>Profesi Dokter - RS Cipto Mangunkusumo (2013-2015)</li>
                            </ul>
                        </div>
                    </div>

                    {{-- TAB: REVIEW --}}
                    <div id="tab-review" class="tab-content" style="display: none;">
                        <div class="reviews-list">
                            <div class="review-item">
                                <div class="review-header">
                                    <span class="reviewer">Budi Santoso</span>
                                    <span class="rating">★ 5.0</span>
                                </div>
                                <p class="comment">Dokternya sangat ramah dan penjelasannya mudah dimengerti. Sangat merekomendasikan!</p>
                            </div>
                            <div class="review-item">
                                <div class="review-header">
                                    <span class="reviewer">Siti Aminah</span>
                                    <span class="rating">★ 4.8</span>
                                </div>
                                <p class="comment">Respon cepat, konsultasi sangat membantu saya memahami gejala yang saya alami.</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN: Booking Sidebar (Sticky) --}}
                <div class="booking-sidebar">
                    <div class="booking-card">
                        <div class="price-header">
                            <span class="label">Biaya Konsultasi</span>
                            <span class="price">Rp 50.000</span>
                        </div>
                        
                        <div class="booking-summary-list">
                            <div class="summary-item">
                                <span class="label">Dokter</span>
                                <span class="value">Dr. Andi Pratama</span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Spesialisasi</span>
                                <span class="value">Dokter Umum</span>
                            </div>
                            {{-- Pilihan Waktu Dinamis (Contoh Static) --}}
                            <div class="summary-item highlight">
                                <span class="label">Jadwal</span>
                                <span class="value">Senin, 24 Okt • 10:30</span>
                            </div>
                            <div class="summary-item highlight">
                                <span class="label">Metode</span>
                                <span class="value">Chat Online</span>
                            </div>
                        </div>

                        <hr class="card-divider">

                        <div class="price-breakdown">
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span>Rp 50.000</span>
                            </div>
                            <div class="summary-row">
                                <span>Biaya Layanan</span>
                                <span>Rp 2.000</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total Bayar</span>
                                <span>Rp 52.000</span>
                            </div>
                        </div>

                        <a href="#" class="btn-payment">
                            Lanjut Pembayaran
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

    {{-- Script Tab Switching --}}
    <script>
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            
            // Show selected
            document.getElementById('tab-' + tabName).style.display = 'block';
            
            // Active Button state
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => {
                if(btn.textContent.toLowerCase().includes(tabName) || 
                   (tabName === 'jadwal' && btn.textContent.includes('Jadwal')) ||
                   (tabName === 'bio' && btn.textContent.includes('Tentang'))) {
                    btn.classList.add('active');
                }
            });
        }
    </script>
@endsection