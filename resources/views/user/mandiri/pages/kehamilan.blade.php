@extends('user.mandiri.layout')

@section('title', 'KlikDoc | Kalender Menstruasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/mandiri/kehamilan.css') }}">
@endpush

@section('split-left')
    <div class="brand-content">
        <div class="hero-text">
            <h1>Kehamilan Sehat, <br> Ibu Bahagia<span class="dot">.</span></h1>
            <p>
                Ketahui Hari Perkiraan Lahir (HPL) buah hati Anda.
                Pantau usia kehamilan untuk mempersiapkan nutrisi dan pemeriksaan yang tepat.
            </p>
        </div>
        <div class="benefits-list">
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-baby-carriage"></i>
                </div>
                <div class="text">
                    <h4>Hitung HPL</h4>
                    <p>Prediksi tanggal kelahiran si kecil dengan akurat.</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div class="text">
                    <h4>Usia Kandungan</h4>
                    <p>Pantau perkembangan janin minggu demi minggu.</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="text">
                    <h4>Persiapan Matang</h4>
                    <p>Rencanakan persalinan sejak dini.</p>
                </div>
            </div>
        </div>
        <div class="decoration-circle"></div>
    </div>
@endsection

@section('split-right')
    <div class="form-wrapper">
        <div class="form-header klik_form-header">
            <h1>Kalkulator Kehamilan</h1>
            <h2>Masukkan Hari Pertama Haid Terakhir (HPHT) untuk melihat perkiraan.</h2>
        </div>

        <form onsubmit="event.preventDefault(); calculatePregnancy();" class="tracker-form">
            <div class="row g-3">
                <div class="col-12">
                    <div class="input-group-custom">
                        <label for="hpht_date" class="klik_form-label">Hari Pertama Haid Terakhir (HPHT)</label>
                        <div class="input-with-icon">
                            <input type="date" id="hpht_date" class="klik_form-input" required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit mt-3 klik_form-button">
                <i class="fas fa-calculator"></i>
                <span>Hitung Sekarang</span>
            </button>
        </form>

        <div id="result-wrapper" class="calendar-container">
            <div class="result-content">
                <div class="result-title">Hari Perkiraan Lahir (HPL)</div>
                <div class="result-value" id="hpl-display">-</div>

                <div class="result-title">Usia Kehamilan Saat Ini</div>
                <div class="gestational-age" id="age-display">-</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0];
        document.getElementById('hpht_date').setAttribute('max', formattedDate);
    </script>
    <script src="{{ asset('js/user/mandiri/kehamilan.js') }}"></script>
@endpush
