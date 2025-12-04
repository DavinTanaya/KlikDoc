@extends('layout')

@section('title', 'KlikDoc | Registrasi Mitra Dokter')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dokter/pendaftaran/styles.css') }}">
@endpush

@section('body')
    <div class="pendaftaran-dokter">
        
        {{-- Container Utama --}}
        <div class="split-container">
            
            {{-- Bagian Kiri (Hero & Branding) --}}
            <aside class="split-left">
                <div class="brand-content">
                    <div class="brand-logo">
                        <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc Logo" class="mb-3">
                    </div>

                    <div class="hero-text">
                        <h1>Jadilah Bagian dari <br> Revolusi Kesehatan Digital</h1>
                        <p>Bergabunglah dengan ribuan rekan sejawat yang telah melayani pasien dengan lebih fleksibel dan modern.</p>
                    </div>

                    <div class="benefits-list">
                        <div class="benefit-item">
                            <div class="icon-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2v20M2 12h20" />
                                </svg>
                            </div>
                            <div class="text">
                                <h4>Waktu Fleksibel</h4>
                                <p>Atur jadwal praktik sesuai keinginan Anda.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="icon-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="text">
                                <h4>Jangkauan Luas</h4>
                                <p>Akses pasien dari seluruh penjuru negeri.</p>
                            </div>
                        </div>
                    </div>
                    <div class="decoration-circle"></div>
                </div>
            </aside>

            {{-- Bagian Kanan (Form) --}}
            <main class="split-right">
                <div class="form-wrapper">
                    <div class="klik_form-title form-header">
                        <h1>Registrasi Mitra</h1>
                        <h2>Silakan lengkapi data profesional Anda untuk verifikasi.</h2>
                    </div>

                    <form action="" method="POST" enctype="multipart/form-data" class="premium-form">
                        @csrf
                        
                        {{-- SECTION 1: Identitas --}}
                        <div class="form-section">
                            <h3 class="section-label">01. Identitas Diri</h3>

                            <div class="input-group">
                                <label for="fullname">Nama Lengkap & Gelar</label>
                                <input class="klik_form-input" type="text" id="fullname" name="fullname"
                                    placeholder="Contoh: dr. Andi Setiawan, Sp.JP" required>
                            </div>

                            <div class="row-grid">
                                <div class="input-group">
                                    <label for="nik">NIK (KTP)</label>
                                    <input type="number" id="nik" name="nik" placeholder="16 digit angka" required>
                                </div>
                                <div class="input-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <div class="select-wrapper">
                                        <select id="gender" name="gender" required>
                                            <option value="" disabled selected>Pilih...</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SECTION 2: Kredensial --}}
                        <div class="form-section">
                            <h3 class="section-label">02. Kredensial Medis</h3>

                            <div class="row-grid">
                                <div class="input-group">
                                    <label for="str">Nomor STR</label>
                                    <input type="text" id="str" name="str_number" placeholder="Nomor Tanda Registrasi" required>
                                </div>
                                <div class="input-group">
                                    <label for="sip">Nomor SIP</label>
                                    <input type="text" id="sip" name="sip_number" placeholder="Nomor Izin Praktik" required>
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="specialization">Spesialisasi</label>
                                <div class="select-wrapper">
                                    <select id="specialization" name="specialization" required>
                                        <option value="" disabled selected>Pilih Spesialisasi...</option>
                                        <option value="umum">Dokter Umum</option>
                                        <option value="gigi">Dokter Gigi</option>
                                        <option value="anak">Spesialis Anak</option>
                                        <option value="penyakit_dalam">Spesialis Penyakit Dalam</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group">
                                <label>Unggah Dokumen (Scan STR/SIP)</label>
                                <div class="file-upload-box">
                                    <input type="file" id="document" name="document" accept=".pdf,.jpg" required>
                                    <div class="upload-content">
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                            <polyline points="17 8 12 3 7 8" />
                                            <line x1="12" y1="3" x2="12" y2="15" />
                                        </svg>
                                        <span>Klik atau Tarik File ke Sini</span>
                                        <small>PDF atau JPG (Maks. 5MB)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SECTION 3: Akun --}}
                        <div class="form-section">
                            <h3 class="section-label">03. Pengaturan Akun</h3>

                            <div class="input-group">
                                <label for="email">Alamat Email</label>
                                <input type="email" id="email" name="email" placeholder="email@contoh.com" required>
                            </div>

                            <div class="input-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn-submit">
                                Ajukan Pendaftaran
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                            <p class="disclaimer">Dengan mendaftar, Anda menyetujui <a href="#">Syarat & Ketentuan</a> Mitra Dokter KlikDoc.</p>
                        </div>
                    </form>
                </div>
            </main>
        </div>

        {{-- === POPUP SUCCESS MODAL === --}}
        {{-- Muncul hanya jika Controller mengirim session 'success' --}}
        @if(session('success'))
        <div class="popup-overlay">
            <div class="popup-content">
                <div class="popup-icon">
                    <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <h2>Pendaftaran Berhasil!</h2>
                <p>Terima kasih telah mendaftar. Data Anda telah kami terima dan sedang dalam proses verifikasi oleh tim Admin KlikDoc.</p>
                <p class="sub-text">Mohon cek email Anda secara berkala untuk info selanjutnya.</p>
                
                {{-- Tombol Kembali ke Home --}}
                <a href="{{ url('/') }}" class="btn-popup-home">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
        @endif
        {{-- === END POPUP === --}}

    </div>
@endsection