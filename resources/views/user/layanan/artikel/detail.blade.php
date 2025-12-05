@extends('layout')

@section('title', 'Mengapa Sering Merasa Lelah? - KlikDoc Artikel')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/artikel/detail.css') }}">
@endpush

@section('body')
    <div class="article-detail-page">
        
        {{-- Navbar Sederhana / Breadcrumb --}}
        <div class="article-nav-container">
            <a href="{{ url('/artikel') }}" class="btn-back">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali ke Artikel
            </a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Penyakit Dalam</span>
        </div>

        {{-- Main Content Wrapper (Centered, ~60vw) --}}
        <article class="article-wrapper">
            
            {{-- Header Artikel --}}
            <header class="article-header">
                <div class="category-pill">Penyakit Dalam</div>
                <h1 class="main-title">Mengapa Sering Merasa Lelah Padahal Cukup Tidur? Kenali Tanda-Tandanya</h1>
                
                <div class="article-meta">
                    <div class="author-info">
                        <div class="avatar">
                            <img src="https://ui-avatars.com/api/?name=Andi+Pratama&background=1C274C&color=fff" alt="Dr. Andi">
                        </div>
                        <div class="text">
                            <span class="name">Ditinjau oleh <a href="#">Dr. Andi Pratama, Sp.PD</a></span>
                            <span class="date">25 Oktober 2023 &bull; 5 menit baca</span>
                        </div>
                    </div>
                    
                    {{-- Share Buttons (Mobile only shown here, Desktop floating) --}}
                    <div class="share-actions">
                        <button class="btn-share"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg></button>
                        <button class="btn-bookmark"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg></button>
                    </div>
                </div>
            </header>

            {{-- Featured Image --}}
            <figure class="featured-image-container">
                {{-- Placeholder Image --}}
                <div class="img-placeholder bg-gradient">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-opacity="0.8">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
                <figcaption>Ilustrasi kelelahan kronis (Sumber: Freepik)</figcaption>
            </figure>

            {{-- Isi Konten Artikel --}}
            <div class="article-content">
                <p class="lead">
                    Pernahkah Anda bangun tidur namun tubuh tetap terasa berat? Atau merasa energi terkuras habis padahal aktivitas fisik tidak terlalu berat? Jangan abaikan sinyal tubuh ini.
                </p>

                <p>
                    Kelelahan adalah keluhan umum yang sering diabaikan. Namun, jika rasa lelah menetap lebih dari dua minggu meskipun sudah memperbaiki pola tidur, ini bisa menjadi indikator medis yang perlu diperiksakan.
                </p>

                <h2>1. Anemia Defisiensi Besi</h2>
                <p>
                    Salah satu penyebab paling umum dari kelelahan kronis, terutama pada wanita, adalah anemia. Kondisi ini terjadi ketika tubuh kekurangan sel darah merah yang sehat untuk membawa oksigen ke seluruh jaringan tubuh.
                </p>
                <ul>
                    <li>Kulit pucat</li>
                    <li>Sering pusing atau berkunang-kunang</li>
                    <li>Jantung berdebar</li>
                    <li>Tangan dan kaki dingin</li>
                </ul>

                <h2>2. Gangguan Tiroid (Hipotiroidisme)</h2>
                <p>
                    Kelenjar tiroid mengatur metabolisme tubuh. Ketika kelenjar ini kurang aktif (hipotiroid), metabolisme melambat, membuat Anda merasa lesu dan berat badan mudah naik.
                </p>
                
                <div class="highlight-box">
                    <strong>Catatan Dokter:</strong>
                    <p>Jika Anda mengalami kelelahan disertai kerontokan rambut dan kulit kering, segera konsultasikan ke Spesialis Penyakit Dalam untuk cek kadar hormon TSH.</p>
                </div>

                <h2>3. Sleep Apnea</h2>
                <p>
                    Tidur cukup secara durasi (7-8 jam) belum tentu berkualitas. Penderita <em>sleep apnea</em> mengalami henti napas sejenak saat tidur, yang menyebabkan otak terbangun berkali-kali tanpa disadari. Akibatnya, fase tidur dalam (deep sleep) tidak tercapai.
                </p>

                <h3>Kapan Harus ke Dokter?</h3>
                <p>
                    Jangan menunda konsultasi jika kelelahan disertai nyeri dada, sesak napas, atau penurunan berat badan drastis tanpa sebab. Deteksi dini dapat mencegah komplikasi yang lebih serius.
                </p>
            </div>

            {{-- Tags --}}
            <div class="article-tags">
                <a href="#">#Kelelahan</a>
                <a href="#">#Anemia</a>
                <a href="#">#HidupSehat</a>
            </div>

            <hr class="divider">

            {{-- Author Bio Box --}}
            <div class="author-bio-box">
                <div class="bio-avatar">
                    <img src="https://ui-avatars.com/api/?name=Andi+Pratama&background=1C274C&color=fff" alt="Dr. Andi">
                </div>
                <div class="bio-text">
                    <h4>Dr. Andi Pratama, Sp.PD</h4>
                    <p>Dokter Spesialis Penyakit Dalam dengan pengalaman 10 tahun. Aktif memberikan edukasi kesehatan metabolik dan pencegahan penyakit kronis.</p>
                    <a href="#" class="btn-consult">Konsultasi dengan Dokter</a>
                </div>
            </div>

        </article>

        {{-- Related Articles Section --}}
        <section class="related-articles-section">
            <div class="related-container">
                <h3>Bacaan Terkait</h3>
                <div class="related-grid">
                    {{-- Card 1 --}}
                    <a href="#" class="related-card">
                        <div class="rel-thumb bg-pink-soft"></div>
                        <div class="rel-info">
                            <span class="rel-cat">Nutrisi</span>
                            <h5>Makanan Penambah Darah Alami</h5>
                        </div>
                    </a>
                    {{-- Card 2 --}}
                    <a href="#" class="related-card">
                        <div class="rel-thumb bg-blue-soft"></div>
                        <div class="rel-info">
                            <span class="rel-cat">Jantung</span>
                            <h5>Detak Jantung Tidak Teratur?</h5>
                        </div>
                    </a>
                    {{-- Card 3 --}}
                    <a href="#" class="related-card">
                        <div class="rel-thumb bg-orange-soft"></div>
                        <div class="rel-info">
                            <span class="rel-cat">Gaya Hidup</span>
                            <h5>Tips Tidur Berkualitas (Deep Sleep)</h5>
                        </div>
                    </a>
                </div>
            </div>
        </section>

    </div>
@endsection