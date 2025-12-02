<footer class="pt-5 pb-4 mt-auto"
    style="background: linear-gradient(
        to bottom,
        rgba(var(--blue4), 0.3),
        rgba(var(--white), 0.2)
    );">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="d-flex flex-column align-items-start gap-3">
                    <div class="mb-2">
                        <img src="{{ asset('image/KlikDoc.png') }}" alt="Logo KlikDoc"
                            style="height: 60px; object-fit: contain;"
                            href="{{ route('home') }}">
                    </div>
                    <div class="fw-medium" style="color: rgb(var(--grey2));">
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

            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h3 class="section-title">KlikDoc</h3>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Tentang Kami</a></li>
                    <li><a href="#" class="footer-link">Booking</a></li>
                    <li><a href="#" class="footer-link">Apotek</a></li>
                    <li><a href="#" class="footer-link">Promo Hari Ini</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-none d-lg-block" style="height: 3.6rem;"></div>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Artikel Kesehatan</a></li>
                    <li><a href="#" class="footer-link">Layanan Kesehatan</a></li>
                    <li><a href="#" class="footer-link">Konsultasi</a></li>
                </ul>
            </div>
        </div>
        <hr class="text-secondary opacity-25 my-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-muted small">
            <div class="mb-3 mb-md-0">
                &copy; 2025 KlikDoc. Semua hak dilindungi.
            </div>
            <div class="d-flex gap-4">
                <a href="#" class="text-decoration-none text-muted hover-primary">Keamanan</a>
                <a href="#" class="text-decoration-none text-muted hover-primary">Kebijakan</a>
                <a href="#" class="text-decoration-none text-muted hover-primary">Privasi</a>
            </div>
        </div>
    </div>
</footer>
