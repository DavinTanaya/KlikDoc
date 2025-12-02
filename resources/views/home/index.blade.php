@extends('layout')

@section('title', 'KlikDoc | Home')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/home/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/home/fitur-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/home/dukungan-item.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/home/mandiri-item.css') }}">
@endpush
@section('body')
    <main class="home">
        <div class="home_information">
            <div class="home_information_blue"></div>
        </div>
        <section class="home_solusi-kesehatan home_section-title">
            <h2>Solusi Kesehatan di Tanganmu</h2>
            <div class="home_fitur-grid">
                @include('home.components.fitur-card')
                @include('home.components.fitur-card')
                @include('home.components.fitur-card')
                @include('home.components.fitur-card')
            </div>
        </section>
        <section class="home_promo-section home_section-title">
            <h2>Promo & Penawaran Hari Ini</h2>
            <div class="promo-cards">
                <div class="promo-card dark-promo"></div>
                <div class="promo-card red-promo"></div>
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
        <section class="home_dukungan-section home_section-title">
            <div class="home_dukungan-header">
                <h2>Dapatkan Dukungan untuk Berbagai Kebutuhan</h2>
                <p>Dari penanganan penyakit kronis hingga perawatan anabul, semua ada disini</p>
                <a href="#" class="home_lebih-lengkap">
                    Lebih lengkap
                    <svg viewBox="0 0 15 8" fill="none">
                        <path
                            d="M0.330173 7.69408C0.541647 7.88996 0.828428 8 1.12745 8C1.42648 8 1.71326 7.88996 1.92473 7.69408L7.50681 2.52205L13.0889 7.69408C13.3016 7.88441 13.5864 7.98972 13.8821 7.98734C14.1778 7.98496 14.4606 7.87508 14.6697 7.68135C14.8788 7.48763 14.9974 7.22557 15 6.95161C15.0025 6.67765 14.8889 6.41372 14.6834 6.21666L8.30409 0.305919C8.09261 0.110039 7.80583 0 7.50681 0C7.20778 0 6.921 0.110039 6.70953 0.305919L0.330173 6.21666C0.118763 6.4126 0 6.67831 0 6.95537C0 7.23243 0.118763 7.49814 0.330173 7.69408Z"
                            fill="#FF4867" />
                    </svg>
                </a>
            </div>
            <div class="home_dukungan-grid">
                @include('home.components.dukungan-item')
                @include('home.components.dukungan-item')
                @include('home.components.dukungan-item')
                @include('home.components.dukungan-item')
                @include('home.components.dukungan-item')
                @include('home.components.dukungan-item')
            </div>
        </section>
        <section class="home_mandiri-section">
            <div class="home_mandiri-header home_section-title">
                <h2>Cek Kesehatan Mandiri</h2>
                <p>Dapatkan gambaran ringkas tentang kesehatanmu dan ketahui penanganan selanjutnya, tanpa biaya.</p>
                <a href="#" class="home_lebih-lengkap">
                    Lebih lengkap
                    <svg viewBox="0 0 15 8" fill="none">
                        <path
                            d="M0.330173 7.69408C0.541647 7.88996 0.828428 8 1.12745 8C1.42648 8 1.71326 7.88996 1.92473 7.69408L7.50681 2.52205L13.0889 7.69408C13.3016 7.88441 13.5864 7.98972 13.8821 7.98734C14.1778 7.98496 14.4606 7.87508 14.6697 7.68135C14.8788 7.48763 14.9974 7.22557 15 6.95161C15.0025 6.67765 14.8889 6.41372 14.6834 6.21666L8.30409 0.305919C8.09261 0.110039 7.80583 0 7.50681 0C7.20778 0 6.921 0.110039 6.70953 0.305919L0.330173 6.21666C0.118763 6.4126 0 6.67831 0 6.95537C0 7.23243 0.118763 7.49814 0.330173 7.69408Z"
                            fill="#FF4867" />
                    </svg>
                </a>
            </div>
            <div class="home_mandiri-grid">
                @include('home.components.mandiri-item')
                @include('home.components.mandiri-item')
                @include('home.components.mandiri-item')
                @include('home.components.mandiri-item')
                @include('home.components.mandiri-item')
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
                    <div class="home_artikel-image artikel-img-1"></div>
                    <h3>Olahraga 30 Menit Sehari Terbukti Menurunkan Risiko Penyakit Kronis</h3>
                </div>
                <div class="home_artikel-card">
                    <div class="home_artikel-image artikel-img-2"></div>
                    <h3>Dokter Temukan Pola Baru Keluhan Pasien Selama Perubahan Musim</h3>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script src="{{ asset('js/user/home.js') }}"></script>
@endpush
