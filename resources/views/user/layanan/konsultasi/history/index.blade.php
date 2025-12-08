@extends('layout')

@section('title', 'KlikDoc | Riwayat Konsultasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/konsultasi/history/styles.css') }}">
@endpush

@section('body')
    <div class="history-page">
        <header class="history-header">
            <div class="header-container">
                <a href="{{ route('konsultasi') }}" class="btn-back">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <h1>Riwayat Konsultasi</h1>
                <div class="spacer"></div>
            </div>
        </header>

        <main class="history-content">
            <div class="history-container">

                @php
                    $activeStatus = request('status');
                @endphp

                <div class="status-tabs">
                    <a href="{{ route('konsultasi.riwayat') }}"
                        class="tab {{ !$activeStatus ? 'active' : '' }} text-decoration-none">
                        Semua
                    </a>

                    <a href="{{ route('konsultasi.riwayat', ['status' => 'BELUM_BAYAR']) }}"
                        class="tab {{ $activeStatus === 'BELUM_BAYAR' ? 'active' : '' }} text-decoration-none">
                        Belum Dibayar
                    </a>

                    <a href="{{ route('konsultasi.riwayat', ['status' => 'AKTIF']) }}"
                        class="tab {{ $activeStatus === 'AKTIF' ? 'active' : '' }} text-decoration-none">
                        Sedang Berjalan
                    </a>

                    <a href="{{ route('konsultasi.riwayat', ['status' => 'SELESAI']) }}"
                        class="tab {{ $activeStatus === 'SELESAI' ? 'active' : '' }} text-decoration-none">
                        Selesai
                    </a>
                </div>

                <div class="order-list">
                    @forelse ($consultations as $c)
                        @php
                            $statusUi = match ($c->status) {
                                'BELUM_BAYAR' => ['cls' => 'unpaid', 'badge' => 'red', 'text' => 'Belum Dibayar'],
                                'AKTIF' => ['cls' => 'ongoing', 'badge' => 'blue', 'text' => 'Sedang Berjalan'],
                                'SELESAI' => ['cls' => 'finished', 'badge' => 'green', 'text' => 'Selesai'],
                            };
                        @endphp

                        <div class="order-card {{ $statusUi['cls'] }}">
                            <div class="card-header">
                                <div class="meta">
                                    <span class="date">{{ $c->created_at->format('d M Y') }}</span>
                                    <span class="order-id">{{ $c->consultation_code }}</span>
                                </div>
                                <span class="badge {{ $statusUi['badge'] }}">
                                    {{ $statusUi['text'] }}
                                </span>
                            </div>

                            <div class="card-body">
                                <div class="product-thumb">
                                    <svg width="32" height="32" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>

                                <div class="product-info">
                                    <h3>{{ $c->doctor->full_name }}</h3>
                                    <p class="specialist">{{ $c->doctor->spesialisasi }}</p>
                                    <p class="extra-items">Konsultasi Chat Online</p>
                                </div>

                                <div class="bill-info">
                                    <span class="label">Total Bayar</span>
                                    <span class="price">Rp {{ number_format($c->total) }}</span>
                                </div>
                            </div>

                            <div class="card-footer footer-action">

                                @if ($c->status === 'BELUM_BAYAR')
                                    <button class="btn-primary"
                                        onclick="location.href='{{ route('konsultasi.retry', $c->consultation_code) }}'">
                                        Bayar Sekarang
                                    </button>
                                @elseif ($c->status === 'AKTIF')
                                    <button class="btn-blue"
                                        onclick="location.href='{{ route('chat.index', ['consultation' => $c->id]) }}'">
                                        Lanjut Chat
                                    </button>
                                @else
                                    <button class="btn-outline"
                                        onclick="location.href='{{ route('konsultasi.riwayat.detail', $c->id) }}'">
                                        Detail
                                    </button>
                                @endif

                            </div>
                        </div>

                    @empty
                        <div class="empty-state">
                            <svg width="64" height="64" fill="none" stroke="#ccc" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                            <h3>Tidak ada data</h3>
                            <p>Riwayat konsultasi belum tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
@endsection
