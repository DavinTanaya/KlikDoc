@extends('user.mandiri.layout')

@section('title', 'KlikDoc | Pengingat Obat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/mandiri/obat.css') }}">
@endpush

@section('split-left')
    <div class="brand-content">
        <div class="hero-text">
            <h1>Jangan Lewatkan <br> Jadwal Obatmu<span class="dot">.</span></h1>
            <p>
                Kepatuhan minum obat adalah kunci kesembuhan.
                Atur jadwal pengingat harian Anda dengan mudah di sini agar tidak ada dosis yang terlewat.
            </p>
        </div>
        <div class="benefits-list">
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-pills"></i>
                </div>
                <div class="text">
                    <h4>Atur Jadwal</h4>
                    <p>Sesuaikan waktu minum obat sesuai resep dokter.</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="text">
                    <h4>Pengingat Tepat</h4>
                    <p>Lihat daftar obat harian Anda dengan jelas.</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="text">
                    <h4>Jaga Kesehatan</h4>
                    <p>Disiplin minum obat mempercepat pemulihan.</p>
                </div>
            </div>
        </div>
        <div class="decoration-circle"></div>
    </div>
@endsection

@section('split-right')
    <div class="form-wrapper">
        <div class="form-header klik_form-header">
            <h1>Pengingat Obat</h1>
            <h2>Tambahkan detail obat untuk membuat jadwal harian.</h2>
        </div>

        <form onsubmit="event.preventDefault(); addReminder();" class="tracker-form">
            <div class="row g-3">
                <div class="col-12">
                    <div class="input-group-custom">
                        <label for="med_name" class="klik_form-label">Nama Obat</label>
                        <div class="input-with-icon">
                            <input class="klik_form-input" type="text" id="med_name" required placeholder="Contoh: Paracetamol">
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-6">
                    <div class="input-group-custom">
                        <label for="med_freq" class="klik_form-label">Frekuensi</label>
                        <div class="input-with-icon">
                            <select class="klik_form-select" id="med_freq" required>
                                <option value="1">1x Sehari</option>
                                <option value="2">2x Sehari</option>
                                <option value="3">3x Sehari</option>
                                <option value="4">4x Sehari</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-6">
                    <div class="input-group-custom">
                        <label for="med_time" class="klik_form-label">Jam Pertama</label>
                        <div class="input-with-icon">
                            <input class="klik_form-input" type="time" id="med_time" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-12">
                    <div class="input-group-custom">
                        <label for="med_note" class="klik_form-label">Catatan</label>
                        <div class="input-with-icon">
                            <input class="klik_form-input" type="text" id="med_note" placeholder="Cth: Sesudah makan">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit mt-3 klik_form-button">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah Pengingat</span>
            </button>
        </form>

        <div class="med-list-container">
            <div class="med-list-title">
                <i class="fas fa-list-ul"></i> Daftar Obat Anda
            </div>
            <div id="med-list"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/mandiri/obat.js') }}"></script>
@endpush
