@extends('layout')

@section('title', 'KlikDoc | Home')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/home/styles.css') }}">
@endpush

@section('body')
    <main class="home">
        <div class="home_information">
            <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators carousel-bullet">
                    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('image/home/information/information-1.png') }}" class="d-block w-100" alt="Banner 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('image/home/artikel/artikel-1.png') }}" class="d-block w-100" alt="Banner 2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('image/home/artikel/artikel-2.png') }}" class="d-block w-100" alt="Banner 3">
                    </div>
                </div>
            </div>
        </div>

        <section class="home_solusi-kesehatan home_section-title">
            <h2>Solusi Kesehatan di Tanganmu</h2>
            <div class="home_fitur-grid">
                <a href="{{ route('konsultasi') }}" class="no-link">
                    <div class="home_fitur-card">
                        <div class="home_fitur-icon">
                            <img src="{{ asset('icons/home/layanan/fitur-chat.svg') }}" alt="fitur-chat">
                        </div>
                        <div class="home_fitur-info">
                            <h6>Chat dengan dokter</h6>
                            <p>Lebih dari 100 Spesialis tersedia 24 jam</p>
                        </div>
                        <div class="home_fitur-arrow">
                            <img src="{{ asset('icons/blue-arrow.svg') }}" alt="arrow">
                        </div>
                    </div>
                </a>
                <a href="{{ route('klik-home') }}" class="no-link">
                    <div class="home_fitur-card">
                        <div class="home_fitur-icon">
                            <img src="{{ asset('icons/home/layanan/fitur-klik_home.svg') }}" alt="fitur-chat">
                        </div>
                        <div class="home_fitur-info">
                            <h6>KlikHome</h6>
                            <p>Tes lab, vaksin, vitamin booster & dokter ke rumah</p>
                        </div>
                        <div class="home_fitur-arrow">
                            <img src="{{ asset('icons/blue-arrow.svg') }}" alt="arrow">
                        </div>
                    </div>
                </a>
                <a href="{{ route('apotek') }}" class="no-link">
                    <div class="home_fitur-card">
                        <div class="home_fitur-icon">
                            <img src="{{ asset('icons/home/layanan/fitur-apotek.svg') }}" alt="fitur-chat">
                        </div>
                        <div class="home_fitur-info">
                            <h6>Apotek Online</h6>
                            <p>100% produk asli, 2 jam sampai</p>
                        </div>
                        <div class="home_fitur-arrow">
                            <img src="{{ asset('icons/blue-arrow.svg') }}" alt="arrow">
                        </div>
                    </div>
                </a>
                <a href="{{ route('artikel') }}" class="no-link">
                    <div class="home_fitur-card">
                        <div class="home_fitur-icon">
                            <img src="{{ asset('icons/home/layanan/fitur-artikel.svg') }}" alt="fitur-chat">
                        </div>
                        <div class="home_fitur-info">
                            <h6>Artikel Kesehatan</h6>
                            <p>Informasi kesehatan yang selalu update</p>
                        </div>
                        <div class="home_fitur-arrow">
                            <img src="{{ asset('icons/blue-arrow.svg') }}" alt="arrow">
                        </div>
                    </div>
                </a>
            </div>
        </section>

        <section class="home_promo-section home_section-title">
            <h2>Promo & Penawaran Hari Ini</h2>
            <div class="home_promo-wrapper">
                <div class="promo-scroll-container">
                    <div class="promo-card-item">
                        <img src="{{ asset('image/home/promo/promo-1.png') }}" alt="Promo 1">
                    </div>
                    <div class="promo-card-item">
                        <div class="promo-placeholder red-promo"></div>
                    </div>
                    <div class="promo-card-item">
                        <img src="{{ asset('image/home/promo/promo-1.png') }}" alt="Promo 3">
                    </div>
                    <div class="promo-card-item">
                        <img src="{{ asset('image/home/promo/promo-1.png') }}" alt="Promo 4">
                    </div>
                </div>
                <div class="promo-indicators carousel-bullet"></div>
            </div>
        </section>

        <section class="home_board-section">
            <div class="home_board-image">
                <img src="{{ asset('image/home/board-doctor.svg') }}" alt="board-doctor">
            </div>
            <div class="home_board-content home_section-title">
                <h2>Diawasi oleh Board of Medical Excellence</h2>
                <p>Seluruh prosedur medis dan tenaga kesehatan di KlikDoc dipastikan memenuhi standar regulasi dan etika
                    layanan kesehatan tertinggi.</p>
            </div>
        </section>

        <section class="home_mandiri-section">
            <div class="home_mandiri-header home_section-title">
                <h2>Cek Kesehatan Mandiri</h2>
                <p>Dapatkan gambaran ringkas tentang kesehatanmu dan ketahui penanganan selanjutnya, tanpa biaya.</p>
            </div>
            <div class="home_mandiri-grid">
                <a href="{{ route('kalkulator_bmi') }}" class="no-link">
                    <div class="home_mandiri-item">
                        <div class="home_mandiri-logo">
                            <img src="{{ asset('icons/home/mandiri/mandiri-bmi.svg') }}" alt="mandiri-bmi">
                        </div>
                        <div class="home_mandiri-text">
                            <p>Kalkulator BMI</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('pengingat_obat') }}" class="no-link">
                    <div class="home_mandiri-item">
                        <div class="home_mandiri-logo">
                            <img src="{{ asset('icons/home/mandiri/mandiri-alarm.svg') }}" alt="mandiri-alarm">
                        </div>
                        <div class="home_mandiri-text">
                            <p>Pengingat Obat</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('kalender_menstruasi') }}" class="no-link">
                    <div class="home_mandiri-item">
                        <div class="home_mandiri-logo">
                            <img src="{{ asset('icons/home/mandiri/mandiri-menstruasi.svg') }}" alt="mandiri-menstruasi">
                        </div>
                        <div class="home_mandiri-text">
                            <p>Kalender Menstruasi</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('kalender_kehamilan') }}" class="no-link">
                    <div class="home_mandiri-item">
                        <div class="home_mandiri-logo">
                            <img src="{{ asset('icons/home/mandiri/mandiri-kehamilan.svg') }}" alt="mandiri-kehamilan">
                        </div>
                        <div class="home_mandiri-text">
                            <p>Kalender Kehamilan</p>
                        </div>
                    </div>
                </a>
            </div>
        </section>

        <section class="home_artikel-section">
            <div class="home_artikel-header home_section-title">
                <h2>Artikel Kesehatan Terkini</h2>
                <p>Informasi kesehatan terbaru yang relevan dan mudah dipahami.</p>
                <a href="#" class="home_lebih-lengkap">
                    Lebih lengkap
                    <svg viewBox="0 0 15 8" fill="none">
                        <path
                            d="M0.330173 7.69408C0.541647 7.88996 0.828428 8 1.12745 8C1.42648 8 1.71326 7.88996 1.92473 7.69408L7.50681 2.52205L13.0889 7.69408C13.3016 7.88441 13.5864 7.98972 13.8821 7.98734C14.1778 7.98496 14.4606 7.87508 14.6697 7.68135C14.8788 7.48763 14.9974 7.22557 15 6.95161C15.0025 6.67765 14.8889 6.41372 14.6834 6.21666L8.30409 0.305919C8.09261 0.110039 7.80583 0 7.50681 0C7.20778 0 6.921 0.110039 6.70953 0.305919L0.330173 6.21666C0.118763 6.4126 0 6.67831 0 6.95537C0 7.23243 0.118763 7.49814 0.330173 7.69408Z"
                            fill="#FF4867" />
                    </svg>
                </a>
            </div>
            <div class="home_artikel-grid">
                <div class="home_artikel-card">
                    <img src="{{ asset('image/home/artikel/artikel-1.png') }}" alt="artikel">
                    <h3>Olahraga 30 Menit Sehari Terbukti Menurunkan Risiko Penyakit Kronis</h3>
                </div>
                <div class="home_artikel-card">
                    <img src="{{ asset('image/home/artikel/artikel-2.png') }}" alt="artikel">
                    <h3>Dokter Temukan Pola Baru Keluhan Pasien Selama Perubahan Musim</h3>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/home/home.js') }}"></script>
@endpush