<style>
    .footer-klik {
        background-color: rgb(var(--blue1));
        font-size: 0.95rem;
        transition: font-size 0.3s ease;
    }

    .text-custom-blue {
        color: rgb(var(--blue4));
    }

    .text-custom-gray {
        color: rgb(var(--white));
    }

    .footer-text-white {
        color: rgb(var(--white));
    }

    .footer-link {
        color: rgb(var(--white));
        text-decoration: none;
        transition: all 0.3s ease;
        display: block;
        margin-bottom: 0.75rem;
        opacity: 0.9;
    }

    .footer-link:hover {
        color: rgb(var(--blue4));
        transform: translateX(5px);
        opacity: 1;
    }

    .social-btn {
        width: 36px;
        height: 36px;
        color: rgb(var(--white));
        background-color: rgba(255, 255, 255, 0.1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-btn:hover {
        background-color: rgb(var(--blue4));
        color: white;
        transform: translateY(-3px);
    }

    .social-btn img {
        width: 18px;
        height: 18px;
        filter: brightness(0) invert(1);
        transition: all 0.3s ease;
    }

    .section-title {
        color: rgb(var(--blue4));
        font-weight: 700;
        font-size: 1.125rem;
        margin-bottom: 1.5rem;
        letter-spacing: 0.5px;
        transition: font-size 0.3s ease;
    }

    .footer-logo {
        height: 60px;
        object-fit: contain;
        transition: height 0.3s ease;
    }

    .footer-icon {
        width: 24px;
        height: 24px;
        transition: all 0.3s ease;
    }

    @media (max-width: 991px) {
        .footer-klik {
            padding-top: 2rem !important;
            padding-bottom: 1.5rem !important;
        }
    }

    @media (max-width: 768px) {
        .footer-klik {
            font-size: 0.85rem;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .section-title {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .footer-logo {
            height: 45px;
        }

        .footer-icon {
            width: 20px;
            height: 20px;
        }

        .social-btn {
            width: 32px;
            height: 32px;
        }

        .social-btn img {
            width: 16px;
            height: 16px;
        }

        .footer-link {
            margin-bottom: 0.5rem;
        }
    }
</style>

<footer class="footer-klik pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row justify-content-between gy-4 gy-lg-5">
            <div class="col-lg-4 col-12">
                <div class="d-flex flex-column align-items-start gap-3">
                    <div class="mb-2">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('image/KlikDoc.png') }}" alt="Logo KlikDoc" class="footer-logo">
                        </a>
                    </div>
                    <div class="footer-text-white fw-medium text-start">
                        <div class="d-flex align-items-center justify-content-start mb-3 gap-3">
                            <img src="{{ asset('icons/footer/phone.svg') }}" class="footer-icon">
                            <span>021-1234-3456</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start gap-3">
                            <img src="{{ asset('icons/footer/message.svg') }}" class="footer-icon">
                            <span>customer@klikdoc.com</span>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mt-2">
                        <a href="#" class="social-btn" aria-label="Instagram">
                            <img src="{{ asset('icons/footer/instagram.svg') }}" alt="IG">
                        </a>
                        <a href="#" class="social-btn" aria-label="TikTok">
                            <img src="{{ asset('icons/footer/tiktok.svg') }}" alt="TT">
                        </a>
                        <a href="#" class="social-btn" aria-label="Facebook">
                            <img src="{{ asset('icons/footer/facebook.svg') }}" alt="FB">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12">
                <div class="row justify-content-start justify-content-lg-end">
                    <div class="col-md-4 col-12 mb-4 mb-md-0">
                        <h3 class="section-title">Bantuan & Panduan</h3>
                        <ul class="list-unstyled">
                            <li><a href="#" class="footer-link">Pusat Bantuan</a></li>
                            <li><a href="#" class="footer-link">Syarat & Ketentuan</a></li>
                            <li><a href="#" class="footer-link">Pemberitahuan Privasi</a></li>
                        </ul>
                    </div>
                    <div class="col-md-8 col-12">
                        <h3 class="section-title mb-3">KlikDoc</h3>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="footer-link">Tentang Kami</a></li>
                                    <li><a href="{{ route('klik-home') }}" class="footer-link">KlikHome</a></li>
                                    <li><a href="#" class="footer-link">Apotek Online</a></li>
                                    <li><a href="#" class="footer-link">Promo Hari Ini</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-12">
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('artikel') }}" class="footer-link">Artikel Kesehatan</a></li>
                                    <li><a href="{{ route('konsultasi') }}" class="footer-link">Konsultasi</a></li>
                                    <li><a href="{{ route('dokter.pendaftaran') }}" class="footer-link">Pendaftaran
                                            Dokter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <hr class="my-4 bg-white">
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center small footer-text-white">
            <div class="mb-3 mb-md-0 text-start">
                &copy; 2025 KlikDoc. Semua hak dilindungi.
            </div>
            <div class="d-flex gap-4">
                <a href="#" class="footer-link m-0">Keamanan</a>
                <a href="#" class="footer-link m-0">Kebijakan</a>
                <a href="#" class="footer-link m-0">Privasi</a>
            </div>
        </div>
    </div>
</footer>
