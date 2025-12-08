@extends('user.mandiri.layout')

@section('title', 'KlikDoc | Kalender Menstruasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/mandiri/menstruasi.css') }}">
@endpush

@section('split-left')
    <div class="brand-content">
        <div class="hero-text">
            <h1>Kenali Siklus <br> Tubuhmu<span class="dot">.</span></h1>
            <p>
                Mengetahui siklus menstruasi membantu merencanakan aktivitas dan memantau kesehatan reproduksi.
                Gunakan pelacak pintar kami untuk prediksi yang akurat.
            </p>
        </div>
        <div class="benefits-list">
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="text">
                    <h4>Prediksi Akurat</h4>
                    <p>Mengetahui kapan haid berikutnya akan datang.</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-baby"></i>
                </div>
                <div class="text">
                    <h4>Masa Subur</h4>
                    <p>Tandai hari ovulasi untuk perencanaan kehamilan.</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-notes-medical"></i>
                </div>
                <div class="text">
                    <h4>Pantau Kesehatan</h4>
                    <p>Deteksi dini ketidakteraturan siklus.</p>
                </div>
            </div>
        </div>
        <div class="decoration-circle"></div>
    </div>
@endsection

@section('split-right')
    <div class="form-wrapper">
        <div class="form-header klik_form-header">
            <h1>Pelacak Menstruasi</h1>
            <h2>Isi data siklus terakhir Anda untuk melihat prediksi kalender.</h2>
        </div>

        <form onsubmit="event.preventDefault(); generateCalendar();" class="tracker-form">
            <div class="row g-3">
                <div class="col-6">
                    <div class="input-group-custom">
                        <label for="start_date" class="klik_form-label">Tanggal Haid Terakhir</label>
                        <div class="input-with-icon">
                            <input type="date" id="start_date" class="klik_form-input" required>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group-custom">
                        <label for="cycle_length" class="klik_form-label">Panjang Siklus (Hari)</label>
                        <div class="input-with-icon">
                            <input class="klik_form-input" type="number" id="cycle_length" value="28" min="21"
                                max="40" required placeholder="28">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit mt-3 klik_form-button">
                <i class="fas fa-magic"></i>
                <span>Tampilkan Prediksi</span>
            </button>
        </form>

        <div id="calendar-wrapper" class="calendar-container">
            <div id="calendar"></div>

            <div class="legend-container">
                <div class="legend-item">
                    <div class="legend-dot" style="background: rgb(var(--red2))"></div>
                    <span>Menstruasi</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot" style="background: rgb(var(--green1))"></div>
                    <span>Subur</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot" style="background: rgb(var(--yellow2))"></div>
                    <span>Prediksi Haid</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0];
        document.getElementById('start_date').setAttribute('max', formattedDate);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
    <script src="{{ asset('js/user/mandiri/menstruasi.js') }}"></script>
@endpush
