@extends('user.mandiri.layout')

@section('title', 'KlikDoc | Kalkulator BMI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/mandiri/bmi.css') }}">
@endpush

@section('split-left')
    <div class="brand-content">
        <div class="hero-text">
            <h1>Cek Kesehatan <br> Tubuhmu Sekarang<span class="dot">.</span></h1>
            <p>
                Berat badan ideal bukan sekadar penampilan, tapi tanda tubuh yang sehat.
                Yuk, cari tahu kondisi tubuhmu melalui Kalkulator BMI KlikDoc.
            </p>
        </div>
        <div class="benefits-list">
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-calculator"></i>
                </div>
                <div class="text">
                    <h4>Akurasi Tinggi</h4>
                    <p>Perhitungan standar kesehatan medis.</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div class="text">
                    <h4>Kategori Kesehatan</h4>
                    <p>Mengetahui kategori berat badan ideal atau tidak</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="icon-box">
                    <i class="fas fa-apple-alt"></i>
                </div>
                <div class="text">
                    <h4>Saran Diet</h4>
                    <p>Membantu perencanaan pola makan.</p>
                </div>
            </div>
        </div>
        <div class="decoration-circle"></div>
    </div>
@endsection

@section('split-right')
    <div class="form-wrapper">
        <div class="form-header klik_form-header">
            <h1>Kalkulator BMI</h1>
            <h2>Isi data diri Anda untuk mendapatkan hasil analisis.</h2>
        </div>
        <form action="{{ route('mandiri.kalkulator_bmi.hitung') }}" method="POST" class="bmi-form">
            @csrf
            <div class="form-section">
                <label class="section-label klik_form-label">Jenis Kelamin</label>
                <div class="gender-selector">
                    <div class="gender-option">
                        <input type="radio" name="gender" id="gender-male" value="male" checked>
                        <label class="gender-card male" for="gender-male">
                            <div class="icon"><i class="fas fa-mars"></i></div>
                            <span>Pria</span>
                        </label>
                    </div>
                    <div class="gender-option">
                        <input type="radio" name="gender" id="gender-female" value="female">
                        <label class="gender-card female" for="gender-female">
                            <div class="icon"><i class="fas fa-venus"></i></div>
                            <span>Wanita</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <div class="row-grid">
                    <div class="input-group">
                        <label for="tinggi-badan" class="klik_form-label">Tinggi Badan</label>
                        <div class="klik_form-input-unit">
                            <input type="number" id="tinggi-badan" name="height" placeholder="0" required>
                            <span class="unit">cm</span>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="berat-badan" class="klik_form-label">Berat Badan</label>
                        <div class="klik_form-input-unit">
                            <input type="number" id="berat-badan" name="weight" placeholder="0" required>
                            <span class="unit">kg</span>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-submit klik_form-button">
                Hitung BMI Saya
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        @if (session('bmi'))
        <div class="result-container mt-5">
            <div class="result-card {{ session('badge') }}">
                <div class="result-header">
                    <div class="header-icon">
                        <i class="fas fa-poll"></i>
                    </div>
                    <div class="header-text">
                        <h3>Analisis BMI</h3>
                        <p>Hasil perhitungan kesehatan Anda</p>
                    </div>
                </div>

                <div class="result-content">
                    <div class="bmi-circle-wrapper">
                        <div class="bmi-circle-outer">
                            <div class="bmi-circle-inner">
                                <span class="bmi-label">BMI Score</span>
                                <span class="bmi-value">{{ session('bmi') }}</span>
                            </div>
                        </div>
                        <div class="status-badge">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ session('status') }}</span>
                        </div>
                    </div>

                    <div class="suggestion-box">
                        <div class="suggestion-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="suggestion-text">
                            <h4>{{ session('pesan') }}</h4>
                            <p>{{ session('saran') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
