@extends('layout')

@section('title', 'KlikDoc | BMI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/mandiri/kalkulator_bmi/styles.css') }}">
@endpush

@section('body')
    <main class="bmi py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="information mb-4">
                        <h1 class="mb-3">Kalkulator BMI</h1>
                        <p>
                            Berat badan ideal adalah impian semua orang. Tidak hanya memiliki bentuk tubuh yang menunjang
                            penampilan,
                            berat badan ideal juga menandakan kondisi tubuh yang sehat. Bagaimana denganmu? Yuk, hitung
                            sekarang
                            di BMI Kalkulator.
                        </p>
                    </div>
                    <div class="keunggulan">
                        <h5 class="mb-2">Keunggulan Fitur</h5>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-1">
                                <div class="p-1">
                                    <img src="{{ asset('icons/check-icon.svg') }}" width="25" alt="check">
                                </div>
                                <p class="mb-0">Menghitung akurasi berat badan</p>
                            </li>
                            <li class="d-flex align-items-center mb-1">
                                <div class="p-1">
                                    <img src="{{ asset('icons/check-icon.svg') }}" width="25" alt="check">
                                </div>
                                <p class="mb-0">Menentukan kategori kesehatan tubuh</p>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="p-1">
                                    <img src="{{ asset('icons/check-icon.svg') }}" width="25" alt="check">
                                </div>
                                <p class="mb-0">Membantu perencanaan diet</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-5 offset-lg-1">
                    <div class="form">
                        <h1 class="klik_form-title mb-4">Hitung BMI Kamu</h1>
                        <form action="" method="POST"> @csrf

                            <div class="mb-2">
                                <label class="klik_form-label form-label small text-muted">Jenis Kelamin</label>
                                <div class="gender-selector">
                                    <div class="gender-option gender-option-male">
                                        <input type="radio" name="gender" id="gender-male" value="male" checked>
                                        <label class="gender-label" for="gender-male">
                                            <i class="fas fa-mars"></i>
                                            <span>Pria</span>
                                        </label>
                                    </div>
                                    <div class="gender-option gender-option-female">
                                        <input type="radio" name="gender" id="gender-female" value="female">
                                        <label class="gender-label" for="gender-female">
                                            <i class="fas fa-venus"></i>
                                            <span>Wanita</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="tinggi-badan" class="klik_form-label form-label small text-muted">
                                    Tinggi Badan
                                </label>
                                <div class="input-group">
                                    <input id="tinggi-badan" name="height" type="number"
                                        class="form-control klik_form-input">
                                    <span class="input-group-text text-muted">cm</span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="berat-badan" class="klik_form-label form-label small text-muted">Berat
                                    Badan</label>
                                <div class="input-group">
                                    <input id="berat-badan" name="weight" type="number"
                                        class="form-control klik_form-input">
                                    <span class="input-group-text text-muted">kg</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary shadow klik_form-button">
                                Hitung Sekarang
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
