@extends('dokter.layout')

@section('title', 'KlikDoc | Dashboard Dokter')

@push('styles')
    {{-- Memanggil file CSS eksternal yang baru dibuat --}}
    <link rel="stylesheet" href="{{ asset('css/dokter/dashboard/styles.css') }}">
@endpush

@section('body')
    <div class="dashboard-wrapper">
        {{-- Container membatasi lebar agar nyaman dilihat di layar lebar --}}
        <div class="dashboard-container">

            {{-- === TOP BAR (Clean White) === --}}
            <header class="top-bar">
                <div class="welcome-text">
                    <h1>Selamat Pagi, Dokter.</h1>
                    <p>Siap melayani pasien hari ini?</p>
                </div>

                <div class="status-toggle-wrapper">
                    <span class="status-label">Status Online</span>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </header>

            {{-- === STATISTIK UTAMA === --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>12</h3>
                        <p>Total Pasien</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon pink">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>3</h3>
                        <p>Menunggu Chat</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>5</h3>
                        <p>Jadwal Tatap Muka</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3>8</h3>
                        <p>Artikel Diterbitkan</p>
                    </div>
                </div>
            </div>

            {{-- === KONTEN UTAMA (Split Layout) === --}}
            <div class="dashboard-content-grid">

                {{-- KOLOM KIRI --}}
                <div class="content-left">

                    {{-- Priority Card (White Theme) --}}
                    <div class="chat-priority-card">
                        <div class="priority-content">
                            <div class="live-indicator">
                                <span class="dot"></span> Live Konsultasi
                            </div>
                            <h2>Antrean Chat Pasien</h2>
                            <p>Ada <strong>3 pasien</strong> sedang menunggu respon Anda sekarang.</p>

                            <button class="btn-start-chat">
                                Masuk ke Ruang Chat
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Menu Cepat --}}
                    <h3 class="section-title">Akses Cepat</h3>
                    <div class="quick-menu-grid">
                        <div class="menu-item">
                            <div class="icon-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                            </div>
                            <span>Buat Resep</span>
                        </div>
                        <div class="menu-item">
                            <div class="icon-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <path d="M12 18v-6"></path>
                                    <path d="M9 15l3 3 3-3"></path>
                                </svg>
                            </div>
                            <span>Buat Rujukan</span>
                        </div>
                        <div class="menu-item">
                            <div class="icon-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </div>
                            <span>Tulis Artikel</span>
                        </div>
                        <div class="menu-item">
                            <div class="icon-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <span>Riwayat</span>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN --}}
                <div class="content-right">
                    <div class="schedule-panel">
                        <div class="panel-header">
                            <h3>Jadwal Tatap Muka</h3>
                            <a href="#" class="view-all">Lihat Semua</a>
                        </div>

                        <div class="date-selector">
                            <span class="today">Hari Ini, 24 Okt</span>
                        </div>

                        <div class="schedule-list">
                            <div class="schedule-item">
                                <div class="time-col">
                                    <span class="time">09:00</span>
                                    <span class="meridiem">WIB</span>
                                </div>
                                <div class="info-col">
                                    <h4>Budi Santoso</h4>
                                    <p>Demam & Pusing</p>
                                </div>
                                <button class="btn-check">Detail</button>
                            </div>

                            <div class="schedule-item">
                                <div class="time-col">
                                    <span class="time">10:30</span>
                                    <span class="meridiem">WIB</span>
                                </div>
                                <div class="info-col">
                                    <h4>Siti Aminah</h4>
                                    <p>Cek Tensi</p>
                                </div>
                                <button class="btn-check">Detail</button>
                            </div>

                            <div class="schedule-item active-highlight">
                                <div class="time-col">
                                    <span class="time">13:00</span>
                                    <span class="meridiem">WIB</span>
                                </div>
                                <div class="info-col">
                                    <h4>Rahmat Hidayat</h4>
                                    <p>Nyeri Dada</p>
                                </div>
                                <button class="btn-check">Detail</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
