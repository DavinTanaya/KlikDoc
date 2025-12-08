@extends('layout')

@section('title', 'KlikDoc | Registrasi Mitra Dokter')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dokter/pendaftaran/styles.css') }}">
@endpush

@section('body')
    <div class="pendaftaran-dokter">
        <div class="split-container">
            <aside class="split-left">
                <div class="brand-content">
                    <div class="brand-logo">
                        <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc Logo" class="mb-3">
                    </div>

                    <div class="hero-text">
                        <h1>Jadilah Bagian dari <br> Revolusi Kesehatan Digital</h1>
                        <p>Bergabunglah dengan ribuan rekan sejawat yang telah melayani pasien dengan lebih fleksibel dan
                            modern.</p>
                    </div>

                    <div class="benefits-list">
                        <div class="benefit-item">
                            <div class="icon-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
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
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
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

            <main class="split-right">
                <div class="form-wrapper">
                    <div class="klik_form-title form-header">
                        <h1>Registrasi Mitra</h1>
                        <h2>Silakan lengkapi data profesional Anda untuk verifikasi.</h2>
                    </div>

                    <form action="{{ route('dokter.register') }}" method="POST" enctype="multipart/form-data"
                        class="premium-form">
                        @csrf

                        <div class="form-section">
                            <h3 class="section-label">01. Identitas Diri</h3>

                            <div class="input-group">
                                <label for="fullname">Nama Lengkap & Gelar</label>
                                <input class="klik_form-input" type="text" id="fullname" name="full_name"
                                    placeholder="Contoh: dr. Andi Setiawan, Sp.JP" required>
                            </div>

                            <div class="row-grid">
                                <div class="input-group">
                                    <label for="nik">NIK (KTP)</label>
                                    <input type="number" id="nik" name="nik" placeholder="16 digit angka"
                                        required>
                                </div>
                                <div class="input-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <div class="select-wrapper">
                                        <select id="gender" name="gender" required>
                                            <option value="" disabled selected>Pilih...</option>
                                            <option value="male">Laki-laki</option>
                                            <option value="female">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3 class="section-label">02. Kredensial Medis</h3>

                            <div class="row-grid">
                                <div class="input-group">
                                    <label for="str">Nomor STR</label>
                                    <input type="text" id="str" name="str" placeholder="Nomor Tanda Registrasi"
                                        required>
                                </div>
                                <div class="input-group">
                                    <label for="sip">Nomor SIP</label>
                                    <input type="text" id="sip" name="sip" placeholder="Nomor Izin Praktik"
                                        required>
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="specialization">Spesialisasi</label>
                                <div class="select-wrapper">
                                    <select id="specialization" name="spesialisasi" required>
                                        <option value="" disabled selected>Pilih Spesialisasi...</option>
                                        <option value="Dokter Umum">Dokter Umum</option>
                                        <option value="Dokter Gigi">Dokter Gigi</option>
                                        <option value="Spesialis Anak">Spesialis Anak</option>
                                        <option value="Spesialis Penyakit Dalam">Spesialis Penyakit Dalam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="experience_years">Total Pengalaman (Tahun)</label>
                                <input type="number" id="experience_years" name="experience_years"
                                    placeholder="Tahun Pengalaman Kerja" required>
                            </div>

                            <div class="input-group">
                                <label>Unggah Dokumen (Scan STR/SIP)</label>
                                <div class="file-upload-box">
                                    <input type="file" id="document" name="document" accept=".pdf,.jpg" required>
                                    <div class="upload-content">
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round">
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

                        <div class="form-footer">
                            <button type="submit" class="btn-submit">
                                Ajukan Pendaftaran
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                            <p class="disclaimer">Dengan mendaftar, Anda menyetujui <a href="#">Syarat &
                                    Ketentuan</a> Mitra
                                Dokter KlikDoc.</p>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
