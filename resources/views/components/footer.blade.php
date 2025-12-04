<style>
    .footer-klik {
        background-color: rgb(var(--blue1));
    }

    .text-custom-blue {
        color: rgb(var(--blue4));
    }

    .text-custom-gray {
        color: rgb(var(--white));
    }

    .footer-contact span {
        color: rgb(var(--white));
    }

    .footer-link {
        color: rgb(var(--white));
        text-decoration: none;
        transition: color 0.3s ease;
        display: block;
        margin-bottom: 0.75rem;
    }

    .footer-link:hover {
        color: rgb(var(--blue4));
        text-decoration: none;
    }

    .social-btn {
        width: 30px;
        color: rgb(var(--white));
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        text-decoration: none;
    }

    .section-title {
        color: rgb(var(--blue4));
        font-weight: 600;
        font-size: 1.125rem;
        margin-bottom: 1.5rem;
    }
</style>
<footer class="footer-klik pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="d-flex flex-column align-items-start gap-3">
                    <div class="mb-2">
                        <img src="{{ asset('image/KlikDoc.png') }}" alt="Logo KlikDoc"
                            style="height: 60px; object-fit: contain;" href="{{ route('home') }}">
                    </div>
                    <div class="footer-contact fw-medium">
                        <div class="d-flex flex-grow gap-3 align-items-center mb-3">
                            <img src="{{ asset('icons/footer/phone.svg') }}" style="width: 25px;">
                            <span>021-1234-3456</span>
                        </div>
                        <div class="d-flex flex-grow gap-3 align-items-center">
                            <img src="{{ asset('icons/footer/message.svg') }}" style="width: 25px;">
                            <span>customer@klikdoc.com</span>
                        </div>
                    </div>
                    <div class="d-flex gap-4 mt-2">
                        <a href="#" class="social-btn"><img src="{{ asset('icons/footer/instagram.svg') }}"></a>
                        <a href="#" class="social-btn"><img src="{{ asset('icons/footer/tiktok.svg') }}"></a>
                        <a href="#" class="social-btn"><img src="{{ asset('icons/footer/facebook.svg') }}"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h3 class="section-title">Bantuan & Panduan</h3>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Pusat Bantuan</a></li>
                    <li><a href="#" class="footer-link">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="footer-link">Pemberitahuan Privasi</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h3 class="section-title mb-3">KlikDoc</h3>

                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="#" class="footer-link">Tentang Kami</a></li>
                            <li><a href="#" class="footer-link">Booking</a></li>
                            <li><a href="#" class="footer-link">Apotek</a></li>
                            <li><a href="#" class="footer-link">Promo Hari Ini</a></li>
                        </ul>
                    </div>

                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="#" class="footer-link">Artikel Kesehatan</a></li>
                            <li><a href="#" class="footer-link">Layanan Kesehatan</a></li>
                            <li><a href="#" class="footer-link">Konsultasi</a></li>
                            <li><a href="#" class="footer-link">Pendaftaran Dokter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4" style="color: rgb(var(--white));">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small">
            <div class="mb-3 mb-md-0" style="color: rgb(var(--white));">
                &copy; 2025 KlikDoc. Semua hak dilindungi.
            </div>
            <div class="d-flex gap-4">
                <a href="#" class="footer-link">Keamanan</a>
                <a href="#" class="footer-link">Kebijakan</a>
                <a href="#" class="footer-link">Privasi</a>
            </div>
        </div>
    </div>
</footer>
