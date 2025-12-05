@extends('layout')

@section('title', 'KlikDoc | Artikel Kesehatan')

@push('styles')
    {{-- Pastikan CSS global/konsultasi yang tadi kamu buat sudah diload, 
         lalu load CSS khusus artikel ini di bawahnya --}}
    <link rel="stylesheet" href="{{ asset('css/user/layanan/artikel/styles.css') }}">
@endpush

@section('body')
    <div class="artikel-page">
        <div class="split-container">

            {{-- SISI KIRI: Sidebar (Search, Kategori, Trending) --}}
            <aside class="split-sidebar">
                <div class="sidebar-header">
                    <h2>Wawasan<span class="dot">.</span></h2>
                    <p>Berita & tips kesehatan terpercaya.</p>
                </div>

                {{-- Fitur 1: Search Artikel --}}
                <div class="sidebar-widget search-widget">
                    <div class="input-icon-wrapper">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" placeholder="Cari topik (mis: Diabetes)..." class="search-input">
                    </div>
                </div>

                {{-- Fitur 2: Topik Populer (Pengganti Widget Jadwal) --}}
                <div class="sidebar-widget topic-widget">
                    <div class="widget-header">
                        <span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                            Topik Hangat
                        </span>
                    </div>
                    <div class="topic-cloud">
                        <a href="#" class="topic-tag active">#HidupSehat</a>
                        <a href="#" class="topic-tag">#COVID19</a>
                        <a href="#" class="topic-tag">#IbuAnak</a>
                        <a href="#" class="topic-tag">#DietSehat</a>
                        <a href="#" class="topic-tag">#MentalHealth</a>
                        <a href="#" class="topic-tag">#Jantung</a>
                    </div>
                </div>

                {{-- Fitur 3: Artikel Trending (List Compact) --}}
                <div class="sidebar-widget trending-widget">
                    <div class="widget-header">
                        <span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                            Sedang Trending
                        </span>
                    </div>
                    <div class="trending-list">
                        <a href="#" class="trending-item">
                            <span class="count">1</span>
                            <div class="trending-info">
                                <h4>Manfaat Air Putih di Pagi Hari</h4>
                                <small>12rb Pembaca</small>
                            </div>
                        </a>
                        <a href="#" class="trending-item">
                            <span class="count">2</span>
                            <div class="trending-info">
                                <h4>Kenali Gejala Awal Stroke</h4>
                                <small>8.5rb Pembaca</small>
                            </div>
                        </a>
                        <a href="#" class="trending-item">
                            <span class="count">3</span>
                            <div class="trending-info">
                                <h4>Tips MPASI untuk Pemula</h4>
                                <small>5rb Pembaca</small>
                            </div>
                        </a>
                    </div>
                </div>

                <hr class="sidebar-divider">

                {{-- Fitur 4: Newsletter CTA --}}
                <div class="sidebar-banner">
                    <h3>Dapatkan Tips Harian</h3>
                    <p>Langganan newsletter gratis kami.</p>
                    <button class="btn-subscribe">Berlangganan</button>
                </div>
            </aside>

            {{-- SISI KANAN: Grid Artikel --}}
            <main class="split-content">
                <div class="content-header">
                    <h1>Jelajahi Artikel</h1>
                    <div class="sort-wrapper">
                        <span>Urutkan:</span>
                        <select>
                            <option>Terbaru</option>
                            <option>Terpopuler</option>
                            <option>Rekomendasi Dokter</option>
                        </select>
                    </div>
                </div>

                {{-- Article Grid --}}
                <div class="article-grid">
                    
                    {{-- Artikel 1 --}}
                    <article class="article-card">
                        <div class="article-thumb">
                            <div class="category-badge cat-blue">Penyakit Dalam</div>
                            {{-- Placeholder Image --}}
                            <div class="img-placeholder bg-blue-light">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#1C274C" stroke-width="1.5">
                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="article-body">
                            <div class="article-meta">
                                <span class="meta-date">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    25 Okt 2023
                                </span>
                                <span class="meta-read">5 min baca</span>
                            </div>
                            
                            <h3 class="article-title">Mengapa Sering Merasa Lelah Padahal Cukup Tidur?</h3>
                            <p class="article-excerpt">
                                Rasa lelah yang terus-menerus bisa menjadi tanda adanya masalah kesehatan yang mendasari, mulai dari anemia hingga gangguan tiroid...
                            </p>

                            <div class="article-footer">
                                <div class="author">
                                    <div class="author-avatar">Dr</div>
                                    <span>Dr. Andi P.</span>
                                </div>
                                <a href="#" class="btn-read-more">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </article>

                    {{-- Artikel 2 --}}
                    <article class="article-card">
                        <div class="article-thumb">
                            <div class="category-badge cat-pink">Kesehatan Kulit</div>
                            <div class="img-placeholder bg-pink-light">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#FF4867" stroke-width="1.5">
                                    <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                                    <line x1="16" y1="8" x2="2" y2="22"></line>
                                    <line x1="17.5" y1="15" x2="9" y2="15"></line>
                                </svg>
                            </div>
                        </div>
                        <div class="article-body">
                            <div class="article-meta">
                                <span class="meta-date">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    24 Okt 2023
                                </span>
                                <span class="meta-read">3 min baca</span>
                            </div>
                            
                            <h3 class="article-title">Urutan Skincare Malam yang Tepat untuk Kulit Berjerawat</h3>
                            <p class="article-excerpt">
                                Jangan asal tumpuk! Simak urutan penggunaan serum, toner, dan moisturizer agar jerawat tidak semakin meradang saat tidur...
                            </p>

                            <div class="article-footer">
                                <div class="author">
                                    <div class="author-avatar">Dr</div>
                                    <span>Dr. Jessica</span>
                                </div>
                                <a href="#" class="btn-read-more">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </article>

                    {{-- Artikel 3 --}}
                    <article class="article-card">
                        <div class="article-thumb">
                            <div class="category-badge cat-green">Gizi & Nutrisi</div>
                            <div class="img-placeholder bg-green-light">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="1.5">
                                    <path d="M12 20h9"></path>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="article-body">
                            <div class="article-meta">
                                <span class="meta-date">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    20 Okt 2023
                                </span>
                                <span class="meta-read">7 min baca</span>
                            </div>
                            
                            <h3 class="article-title">Mitos vs Fakta: Diet Karbohidrat dan Pengaruhnya</h3>
                            <p class="article-excerpt">
                                Apakah benar-benar harus menghindari nasi putih untuk menurunkan berat badan? Ahli gizi kami menjawab keraguan Anda...
                            </p>

                            <div class="article-footer">
                                <div class="author">
                                    <div class="author-avatar">Nu</div>
                                    <span>Ahli Gizi Rina</span>
                                </div>
                                <a href="#" class="btn-read-more">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </article>

                     {{-- Artikel 4 --}}
                     <article class="article-card">
                        <div class="article-thumb">
                            <div class="category-badge cat-orange">Kesehatan Anak</div>
                            <div class="img-placeholder bg-orange-light">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ef6c00" stroke-width="1.5">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="article-body">
                            <div class="article-meta">
                                <span class="meta-date">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    18 Okt 2023
                                </span>
                                <span class="meta-read">4 min baca</span>
                            </div>
                            
                            <h3 class="article-title">Vaksinasi Anak: Jadwal Terbaru IDAI 2024</h3>
                            <p class="article-excerpt">
                                Pastikan buah hati Anda terlindungi. Berikut adalah update terbaru mengenai jadwal imunisasi dasar dan tambahan...
                            </p>

                            <div class="article-footer">
                                <div class="author">
                                    <div class="author-avatar">Dr</div>
                                    <span>Dr. Bambang</span>
                                </div>
                                <a href="#" class="btn-read-more">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </article>

                </div>

                {{-- Pagination --}}
                <div class="pagination-wrapper">
                    <button class="page-btn" disabled>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6" /></svg>
                    </button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6" /></svg></button>
                </div>
            </main>
        </div>
    </div>
@endsection