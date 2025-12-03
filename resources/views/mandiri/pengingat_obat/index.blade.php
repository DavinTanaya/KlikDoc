@extends('layout')

@section('title', 'KlikDoc | Pengingat Obat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/mandiri/pengingat_obat/pengingat_obat.css') }}">
@endpush

@section('body')
    <main class="reminder py-5">
        <div class="reminder_container container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="reminder_information mb-4">
                        <h1 class="mb-3">Pengingat Obat</h1>
                        <p>
                            Kelola jadwal minum obat dengan mudah agar terapi berjalan lebih efektif.
                            Atur pengingat harian atau mingguan dan dapatkan notifikasi tepat waktu.
                            Sehat itu dimulai dari disiplin!
                        </p>
                    </div>

                    <div class="reminder_keunggulan">
                        <h5 class="mb-2">Keunggulan Fitur</h5>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-1">
                                <div class="p-1">
                                    <img src="{{ asset('icons/check-icon.svg') }}" width="25" alt="check">
                                </div>
                                <p class="mb-0">Pengingat otomatis sesuai jadwal</p>
                            </li>
                            <li class="d-flex align-items-center mb-1">
                                <div class="p-1">
                                    <img src="{{ asset('icons/check-icon.svg') }}" width="25" alt="check">
                                </div>
                                <p class="mb-0">Mendukung banyak obat sekaligus</p>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="p-1">
                                    <img src="{{ asset('icons/check-icon.svg') }}" width="25" alt="check">
                                </div>
                                <p class="mb-0">Cocok untuk jadwal harian atau mingguan</p>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- RIGHT: Form --}}
                <div class="col-lg-5 offset-lg-1">
                    <div class="reminder_form">
                        <h4 class="mb-4">Atur Pengingat Obat</h4>
                        <form action="" method="POST">@csrf
                            <div class="mb-3">
                                <label class="klik_form-label form-label small text-muted">
                                    Nama Obat
                                </label>
                                <input type="text" name="medicine_name" class="klik_form-input form-control" placeholder="Masukkan nama obat">
                            </div>

                            <div class="mb-3">
                                <label class="klik_form-label form-label small text-muted">
                                    Dosis
                                </label>
                                <input type="text" name="dosage" class="klik_form-input form-control" placeholder="Masukkan dosis obat">
                            </div>

                            <div class="mb-3">
                                <label class="klik_form-label form-label small text-muted">
                                    Frekuensi Minum
                                </label>
                                <select name="frequency" class="klik_form-input form-control">
                                    <option value="1">1x sehari</option>
                                    <option value="2">2x sehari</option>
                                    <option value="3">3x sehari</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="klik_form-label form-label small text-muted">
                                    Waktu Minum
                                </label>
                                <input type="time" name="time" class="klik_form-input form-control">
                            </div>

                            <button type="submit" class="klik_form-button btn shadow">
                                Simpan Pengingat
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
