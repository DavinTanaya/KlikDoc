@extends('user.mandiri.layout')

@section('title', 'KlikDoc | Pengingat Obat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/mandiri/obat.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <div class="icon-box"><i class="fas fa-pills"></i></div>
                <div class="text">
                    <h4>Atur Jadwal</h4>
                    <p>Sesuaikan waktu minum obat sesuai resep dokter.</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="icon-box"><i class="fas fa-bell"></i></div>
                <div class="text">
                    <h4>Pengingat Tepat</h4>
                    <p>Lihat daftar obat harian Anda dengan jelas.</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="icon-box"><i class="fas fa-heart"></i></div>
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

        {{-- FORM TAMBAH --}}
        <form id="reminderForm" class="tracker-form">
            <div class="row g-3">

                <div class="col-12">
                    <label class="klik_form-label">Nama Obat</label>
                    <input id="med_name" type="text" class="klik_form-input" required placeholder="Contoh: Paracetamol">
                </div>

                <div class="col-md-4 col-6">
                    <label class="klik_form-label">Frekuensi</label>
                    <select id="med_freq" class="klik_form-select" required>
                        <option value="1">1x Sehari</option>
                        <option value="2">2x Sehari</option>
                        <option value="3">3x Sehari</option>
                        <option value="4">4x Sehari</option>
                    </select>
                </div>

                <div class="col-md-4 col-6">
                    <label class="klik_form-label">Jam Pertama</label>
                    <input id="med_time" type="time" class="klik_form-input" required>
                </div>

                <div class="col-md-4 col-12">
                    <label class="klik_form-label">Catatan</label>
                    <input id="med_note" type="text" class="klik_form-input" placeholder="Cth: Sesudah makan">
                </div>

            </div>

            <button type="submit" class="btn-submit mt-3 klik_form-button">
                <i class="fas fa-plus-circle"></i> Tambah Pengingat
            </button>
        </form>
        <div class="med-list-container mt-4">
            <div class="med-list-title">
                <i class="fas fa-list-ul"></i> Daftar Obat Anda
            </div>

            <div id="med-list">
                @foreach ($reminders as $reminder)
                    <div class="med-item" id="reminder-{{ $reminder->id }}">
                        <div>
                            <h4>{{ $reminder->name }}</h4>
                            <p>{{ $reminder->frequency }}x sehari — {{ $reminder->time }} WIB</p>
                            <small class="text-muted">{{ $reminder->note }}</small>
                        </div>

                        <button class="delete-btn" onclick="deleteReminder({{ $reminder->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const csrf = document.querySelector("meta[name='csrf-token']").content;

        document.getElementById('reminderForm').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch("{{ route('medicine-reminder.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf
                    },
                    body: JSON.stringify({
                        name: document.getElementById("med_name").value,
                        frequency: document.getElementById("med_freq").value,
                        time: document.getElementById("med_time").value,
                        note: document.getElementById("med_note").value,
                    })
                })
                .then(res => res.json())
                .then(data => {
                    document.getElementById("med-list").insertAdjacentHTML('beforeend', data.html);
                });
        });

        function deleteReminder(id) {
            fetch(`/mandiri/medicine-reminder/${id}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrf
                    }
                })
                .then(() => {
                    document.getElementById(`reminder-${id}`).remove();
                });
        }
    </script>
@endpush
