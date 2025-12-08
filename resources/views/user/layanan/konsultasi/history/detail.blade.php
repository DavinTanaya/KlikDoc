@extends('layout')

@section('title', 'KlikDoc | Detail Konsultasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/konsultasi/history/detail.css') }}">
@endpush

@section('body')
    <div class="detail-page">
        <header class="detail-header">
            <div class="header-container">
                <a href="{{ route('konsultasi.riwayat') }}" class="btn-back">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <h1>Detail Konsultasi</h1>
                <div class="spacer"></div>
            </div>
        </header>

        <main class="detail-content">
            <div class="detail-container">

                <div class="detail-grid">
                    <div class="main-info">
                        <div class="content-card doctor-card">
                            <div class="card-title">Dokter Penanggung Jawab</div>

                            <div class="doctor-profile">
                                <div class="doctor-thumb">
                                    <svg width="40" height="40" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </div>

                                <div class="doctor-text">
                                    <h2>{{ $consultation->doctor->full_name }}</h2>
                                    <p class="specialist">{{ $consultation->doctor->spesialisasi }}</p>
                                    <p class="license">STR: {{ $consultation->doctor->str }}</p>
                                </div>
                            </div>

                            <div class="session-badge online">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="1" y="5" width="15" height="14" rx="2" />
                                    <path d="M23 7l-7 5 7 5V7z" />
                                </svg>
                                <span>Konsultasi Chat Online</span>
                            </div>
                        </div>
                        <div class="content-card">
                            <div class="card-title">Catatan Dokter</div>

                            <div class="note-box">
                                @if ($consultation->prescriptions->notes)
                                    {!! nl2br(e($consultation->prescriptions->notes)) !!}
                                @else
                                    <p class="text-muted">Belum ada catatan dari dokter.</p>
                                @endif
                            </div>
                        </div>
                        @if ($consultation->prescriptions && $consultation->prescriptions->items->isNotEmpty())
                            <div class="content-card">
                                <div class="card-title-row">
                                    <div class="card-title">Resep Dokter</div>
                                    <a href="{{ route('resep.download', $consultation->prescriptions->id) }}"
                                        class="btn btn-primary">
                                        Unduh PDF
                                    </a>

                                </div>

                                <div class="prescription-list">
                                    @foreach ($consultation->prescriptions->items as $item)
                                        {{-- {{ dd($item->drug) }} --}}
                                        <div class="prescription-item">
                                            <div class="drug-info">
                                                <h4>{{ $item->drug->name }}</h4>
                                                <p>{{ $item->drug->dosis }}</p>
                                                <span class="note">{{ $item->drug->short_description }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="prescription-action">
                                    <a href="{{ route('apotek.fromPrescription', $consultation->id) }}"
                                        class="btn-secondary-full">
                                        Tebus Obat di Apotek
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="sidebar-info">
                        @php
                            $badge = match ($consultation->status) {
                                'BELUM_BAYAR' => ['cls' => 'red', 'text' => 'Belum Dibayar'],
                                'AKTIF' => ['cls' => 'blue', 'text' => 'Sedang Berjalan'],
                                'SELESAI' => ['cls' => 'green', 'text' => 'Selesai'],
                            };
                        @endphp

                        <div class="content-card status-section">
                            <div class="meta-row">
                                <span class="label">No. Konsultasi</span>
                                <span class="value">{{ $consultation->consultation_code }}</span>
                            </div>
                            <div class="meta-row">
                                <span class="label">Tanggal</span>
                                <span class="value">
                                    {{ $consultation->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>
                            <div class="divider"></div>
                            <div class="meta-row center">
                                <span class="badge {{ $badge['cls'] }}">
                                    {{ $badge['text'] }}
                                </span>
                            </div>
                        </div>

                        <div class="content-card payment-section">
                            <div class="card-title">Rincian Pembayaran</div>

                            <div class="bill-row">
                                <span>Biaya Konsultasi</span>
                                <span>Rp
                                    {{ number_format($consultation->total - $consultation->service_fee - $consultation->platform_fee) }}</span>
                            </div>
                            <div class="bill-row">
                                <span>Biaya Layanan</span>
                                <span>Rp {{ number_format($consultation->service_fee) }}</span>
                            </div>

                            @if ($consultation->discount > 0)
                                <div class="bill-row discount">
                                    <span>Diskon</span>
                                    <span>-Rp {{ number_format($consultation->discount) }}</span>
                                </div>
                            @endif

                            <div class="divider"></div>

                            <div class="bill-row total">
                                <span>Total Bayar</span>
                                <span>Rp {{ number_format($consultation->total) }}</span>
                            </div>

                            <div class="payment-method">
                                <span>
                                    Metode:
                                    <strong>{{ strtoupper($consultation->payment_method ?? 'MIDTRANS') }}</strong>
                                </span>
                                <span class="paid-status">
                                    {{ $consultation->status === 'BELUM_BAYAR' ? 'BELUM BAYAR' : 'LUNAS' }}
                                </span>
                            </div>
                        </div>

                        <div class="action-section">

                            @if ($consultation->status === 'BELUM_BAYAR')
                                <a href="{{ route('konsultasi.retry', $consultation->consultation_code) }}"
                                    class="btn-primary-action">
                                    Bayar Sekarang
                                </a>
                            @elseif ($consultation->status === 'AKTIF')
                                <a href="{{ route('chat.index', ['consultation' => $consultation->id]) }}"
                                    class="btn-primary-action">
                                    Lanjut Chat Dokter
                                </a>
                            @elseif ($consultation->status === 'SELESAI' && !$consultation->rating)
                                <button class="btn-primary-action" onclick="openratingModal()">
                                    Beri Ulasan
                                </button>
                            @endif

                            <a href="" class="btn-outline-action">
                                Bantuan
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </main>

        @if ($consultation->status === 'SELESAI' && !$consultation->rating)
            <form method="POST" action="{{ route('konsultasi.rating.store', $consultation->id) }}" id="ratingModal"
                class="modal-overlay">
                @csrf

                <div class="modal-content">
                    <button type="button" class="close-modal" onclick="closeratingModal()">&times;</button>

                    <h3>Bagaimana pengalaman Anda?</h3>
                    <p>Beri rating untuk {{ $consultation->doctor->full_name }}</p>

                    <div class="star-rating">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                                required>
                            <label for="star{{ $i }}">★</label>
                        @endfor
                    </div>

                    <div class="comment-box">
                        <textarea name="review" placeholder="Tulis ulasan (opsional)"></textarea>
                    </div>

                    <div class="modal-actions">
                        <button type="submit" class="btn-submit">Kirim Ulasan</button>
                    </div>
                </div>
            </form>
        @endif

    </div>
@endsection

@push('scripts')
    <script>
        function openratingModal() {
            document.getElementById('ratingModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeratingModal() {
            document.getElementById('ratingModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    </script>
@endpush
