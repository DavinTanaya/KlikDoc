@extends('layout')

@section('title', 'KlikDoc | Detail Konsultasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/konsultasi/history/detail.css') }}">
@endpush

@section('body')
    <div class="detail-page">
        {{-- Header --}}
        <header class="detail-header">
            <div class="header-container">
                <a href="{{ url('/history') }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                
                {{-- Layout Grid: Kiri (Info Utama) & Kanan (Status & Bayar) --}}
                <div class="detail-grid">

                    {{-- KOLOM KIRI: Informasi Dokter & Resep --}}
                    <div class="main-info">
                        
                        {{-- Kartu Dokter --}}
                        <div class="content-card doctor-card">
                            <div class="card-title">Dokter Penanggung Jawab</div>
                            <div class="doctor-profile">
                                <div class="doctor-thumb">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <div class="doctor-text">
                                    <h2>Dr. Budi Santoso, Sp.PD</h2>
                                    <p class="specialist">Spesialis Penyakit Dalam</p>
                                    <p class="license">SIP: 449.1/022/SIP-TU/III/2021</p>
                                </div>
                            </div>
                            
                            <div class="session-badge online">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M23 7l-7 5 7 5V7z"></path>
                                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                                </svg>
                                <span>Sesi Online (Video Call)</span>
                            </div>
                            {{-- Jika Onsite, ganti class 'online' jadi 'onsite' dan icon map-pin --}}
                        </div>

                        {{-- Catatan Dokter (Diagnosa) --}}
                        <div class="content-card">
                            <div class="card-title">Catatan Dokter</div>
                            <div class="note-box">
                                <p><strong>Diagnosa:</strong> Gejala flu ringan disertai demam (Common Cold).</p>
                                <p><strong>Saran:</strong> Istirahat cukup minimal 3 hari, perbanyak minum air putih hangat, hindari makanan berminyak.</p>
                            </div>
                        </div>

                        {{-- Resep Dokter (Hanya muncul jika Status = Selesai & Ada Resep) --}}
                        <div class="content-card">
                            <div class="card-title-row">
                                <div class="card-title">Resep Dokter</div>
                                <button class="btn-text">Unduh PDF</button>
                            </div>
                            
                            <div class="prescription-list">
                                <div class="prescription-item">
                                    <div class="drug-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                        </svg>
                                    </div>
                                    <div class="drug-info">
                                        <h4>Paracetamol 500mg</h4>
                                        <p>3 x 1 Tablet (Sesudah makan)</p>
                                        <span class="note">Bila demam/pusing</span>
                                    </div>
                                </div>

                                <div class="prescription-item">
                                    <div class="drug-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M20.2 7.8l-7.7 7.7a4 4 0 0 1-5.7-5.7l7.7-7.7a4 4 0 0 1 5.7 5.7z"></path>
                                            <path d="M15 7l-4 4"></path>
                                        </svg>
                                    </div>
                                    <div class="drug-info">
                                        <h4>Vitamin C 1000mg</h4>
                                        <p>1 x 1 Tablet (Pagi hari)</p>
                                        <span class="note">Untuk menjaga daya tahan tubuh</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="prescription-action">
                                <button class="btn-secondary-full">Tebus Obat di Apotek</button>
                            </div>
                        </div>

                    </div>

                    {{-- KOLOM KANAN: Status, Pembayaran, Aksi --}}
                    <div class="sidebar-info">
                        
                        {{-- Status & Meta --}}
                        <div class="content-card status-section">
                            <div class="meta-row">
                                <span class="label">No. Invoice</span>
                                <span class="value">INV/20251205/GP/001</span>
                            </div>
                            <div class="meta-row">
                                <span class="label">Tanggal</span>
                                <span class="value">05 Des 2025, 14:30</span>
                            </div>
                            <div class="divider"></div>
                            <div class="meta-row center">
                                <span class="badge green">Selesai</span>
                                {{-- Gunakan class 'blue' untuk Sedang Berjalan --}}
                            </div>
                        </div>

                        {{-- Rincian Pembayaran --}}
                        <div class="content-card payment-section">
                            <div class="card-title">Rincian Pembayaran</div>
                            <div class="bill-row">
                                <span>Biaya Konsultasi</span>
                                <span>Rp 75.000</span>
                            </div>
                            <div class="bill-row">
                                <span>Biaya Layanan</span>
                                <span>Rp 2.500</span>
                            </div>
                            <div class="bill-row discount">
                                <span>Diskon Promo</span>
                                <span>-Rp 5.000</span>
                            </div>
                            <div class="divider"></div>
                            <div class="bill-row total">
                                <span>Total Bayar</span>
                                <span>Rp 72.500</span>
                            </div>
                            <div class="payment-method">
                                <span>Metode: <strong>Gopay</strong></span>
                                <span class="paid-status">LUNAS</span>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="action-section">
                            {{-- Jika status 'Sedang Berjalan' --}}
                            {{-- <button class="btn-primary-action">Lanjut Chat Dokter</button> --}}

                            {{-- Jika status 'Selesai' --}}
                            <button class="btn-primary-action" onclick="openReviewModal()">Beri Ulasan</button>
                            <button class="btn-outline-action">Bantuan</button>
                        </div>

                    </div>

                </div>
            </div>
        </main>

        {{-- MODAL ULASAN (Hidden by default) --}}
        <div id="reviewModal" class="modal-overlay">
            <div class="modal-content">
                <button class="close-modal" onclick="closeReviewModal()">&times;</button>
                <h3>Bagaimana pengalaman Anda?</h3>
                <p>Beri rating untuk Dr. Budi Santoso</p>
                
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Sangat Baik">★</label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Baik">★</label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Cukup">★</label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Buruk">★</label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sangat Buruk">★</label>
                </div>

                <div class="comment-box">
                    <textarea placeholder="Tulis pengalaman konsultasi Anda di sini... (Opsional)"></textarea>
                </div>

                <div class="modal-actions">
                    <button class="btn-submit" onclick="submitReview()">Kirim Ulasan</button>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
<script>
    // Logic untuk Modal Ulasan
    function openReviewModal() {
        document.getElementById('reviewModal').style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Disable scroll background
    }

    function closeReviewModal() {
        document.getElementById('reviewModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Enable scroll
    }

    function submitReview() {
        // Disini nanti masuk logic AJAX ke controller Laravel
        alert('Terima kasih! Ulasan Anda telah berhasil dikirim.');
        closeReviewModal();
    }

    // Close modal jika klik di luar box
    window.onclick = function(event) {
        var modal = document.getElementById('reviewModal');
        if (event.target == modal) {
            closeReviewModal();
        }
    }
</script>
@endpush