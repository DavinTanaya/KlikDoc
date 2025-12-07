@extends('dokter.layout')

@section('title', 'KlikDoc | Dashboard Dokter')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dokter/dashboard/styles.css') }}">
@endpush

@section('body')
<div class="dashboard-wrapper">
    <div class="dashboard-container">

        {{-- ================= TOP BAR ================= --}}
        <header class="top-bar">
            <div class="welcome-text">
                <h1>Selamat Datang, Dokter.</h1>
                <p>Berikut ringkasan aktivitas konsultasi Anda hari ini</p>
            </div>

            <div class="status-toggle-wrapper">
                <span class="status-label">Status Online</span>
                <label class="switch">
                    <input type="checkbox" checked disabled>
                    <span class="slider round"></span>
                </label>
            </div>
        </header>

        {{-- ================= STAT CARDS ================= --}}
        <div class="stats-grid">

            {{-- Total Pasien --}}
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-user-injured"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalPasien }}</h3>
                    <p>Total Pasien</p>
                </div>
            </div>

            {{-- Konsultasi Aktif --}}
            <div class="stat-card">
                <div class="stat-icon pink">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $aktifConsultation }}</h3>
                    <p>Konsultasi Aktif</p>
                </div>
            </div>

            {{-- Konsultasi Selesai --}}
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $selesaiConsultation }}</h3>
                    <p>Konsultasi Selesai</p>
                </div>
            </div>

        </div>

        {{-- ================= MAIN CONTENT ================= --}}
        <div class="dashboard-content-grid">

            {{-- ========== LEFT ========= --}}
            <div class="content-left">

                {{-- Priority Card --}}
                <div class="chat-priority-card">
                    <div class="priority-content">
                        <div class="live-indicator">
                            <span class="dot"></span> Live Konsultasi
                        </div>

                        <h2>Antrean Konsultasi</h2>

                        <p>
                            Ada <strong>{{ $aktifConsultation }}</strong>
                            pasien yang sedang menunggu respon Anda
                        </p>

                        <a href="{{ route('dokter.chat.index') }}"
                           class="btn-start-chat text-decoration-none">
                            Masuk Ruang Chat
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- Quick Menu --}}
                <h3 class="section-title">Akses Cepat</h3>

                <div class="quick-menu-grid">

                    <a href="{{ route('article.index') }}" class="text-decoration-none">
                        <div class="menu-item">
                            <div class="icon-box">
                                <i class="fas fa-edit"></i>
                            </div>
                            <span>Article</span>
                        </div>
                    </a>

                    <a href="{{ route('dokter.riwayat') }}" class="text-decoration-none">
                        <div class="menu-item">
                            <div class="icon-box">
                                <i class="fas fa-history"></i>
                            </div>
                            <span>Riwayat Konsultasi</span>
                        </div>
                    </a>

                    <a href="{{ route('dokter.rujukan') }}"  class="text-decoration-none">
                        <div class="menu-item">
                            <div class="icon-box">
                                <i class="fas fa-file-medical"></i>
                            </div>
                            <span>Buat Rujukan</span>
                        </div>
                    </a>

                </div>
            </div>

            {{-- ========== RIGHT ========= --}}
            <div class="content-right">
                <div class="schedule-panel">
                    <div class="panel-header">
                        <h3>Konsultasi Aktif Saat Ini</h3>
                    </div>

                    <div class="schedule-list">

                        @forelse ($activeChats as $chat)
                            <div class="schedule-item active-highlight">
                                <div class="info-col">
                                    <h4>{{ $chat->user->name }}</h4>
                                    <p>Konsultasi sedang berlangsung</p>
                                </div>

                                <a href="{{ route('dokter.chat.index') }}"
                                   class="btn-check">
                                    Masuk Chat
                                </a>
                            </div>
                        @empty
                            <div style="padding:16px;color:#64748b;">
                                Tidak ada konsultasi aktif
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
