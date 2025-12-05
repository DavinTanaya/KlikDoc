@extends('dokter.layout')

@section('title', 'Kelola Rujukan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dokter/layanan/rujukan.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
@endpush

@section('body')
    <div class="rujukan-dashboard">

        <div class="main-wrapper">

            {{-- Header Area (Sama persis dengan Jadwal) --}}
            <div class="top-header">
                <div class="header-left">
                    <a href="{{ url()->previous() }}" class="btn-back-pill">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Kembali</span>
                    </a>
                    <div class="title-block">
                        <h1>Kelola Rujukan</h1>
                        <div class="date-capsule">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ date('d F Y') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabs Navigation (Style menyatu dengan table) --}}
            <div class="tabs-wrapper">
                <button class="tab-pill active" onclick="switchTab('tatap-muka')">
                    Pasien Tatap Muka
                </button>
                <button class="tab-pill" onclick="switchTab('online')">
                    Konsultasi Online
                    <span class="badge-count">2</span>
                </button>
            </div>

            {{-- CONTENT: TATAP MUKA --}}
            <div id="list-tatap-muka" class="table-container fade-in">
                <div class="table-head-info">
                    <h3>Antrian Pasien</h3>
                    <span class="count-bubble">2 Pasien</span>
                </div>

                <table class="floating-table">
                    <thead>
                        <tr>
                            <th width="10%">Jam</th>
                            <th width="35%">Identitas Pasien</th>
                            <th width="15%">Info</th>
                            <th width="20%">Diagnosa Sementara</th>
                            <th width="10%">Status</th>
                            <th width="10%" class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Pasien 1 -->
                        <tr class="patient-row" id="row-tm-1">
                            <td>
                                <div class="time-stamp">09:00</div>
                            </td>
                            <td>
                                <div class="profile-group">
                                    <div class="avatar-box gradient-blue">BS</div>
                                    <div>
                                        <div class="p-name">Budi Santoso</div>
                                        <div class="p-id">ID: P-001</div>
                                        <div class="referral-badge" id="badge-tm-1" style="display: none;">⚠ Butuh Rujukan
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="gender-pill male"><span>Laki-laki</span> • 32 Thn</div>
                            </td>
                            <td><span class="complaint">Demam Tifoid (A01.0)</span></td>
                            <td><span class="status-pill waiting">Menunggu</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-primary-pill"
                                        onclick="openModal('tm-1', 'Budi Santoso', 'Laki-laki / 32 Thn', 'Demam Tifoid')">
                                        Proses
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Pasien 2 -->
                        <tr class="patient-row" id="row-tm-2">
                            <td>
                                <div class="time-stamp">10:30</div>
                            </td>
                            <td>
                                <div class="profile-group">
                                    <div class="avatar-box gradient-purple">SA</div>
                                    <div>
                                        <div class="p-name">Siti Aminah</div>
                                        <div class="p-id">ID: P-002</div>
                                        <div class="referral-badge" id="badge-tm-2" style="display: none;">⚠ Butuh Rujukan
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="gender-pill female"><span>Perempuan</span> • 45 Thn</div>
                            </td>
                            <td><span class="complaint">Hipertensi (I10)</span></td>
                            <td><span class="status-pill waiting">Menunggu</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-primary-pill"
                                        onclick="openModal('tm-2', 'Siti Aminah', 'Perempuan / 45 Thn', 'Hipertensi')">
                                        Proses
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- CONTENT: ONLINE --}}
            <div id="list-online" class="table-container fade-in" style="display: none;">
                <div class="table-head-info">
                    <h3>Antrian Online</h3>
                    <span class="count-bubble">2 Sesi</span>
                </div>

                <table class="floating-table">
                    <thead>
                        <tr>
                            <th width="10%">Sesi</th>
                            <th width="35%">Identitas Pasien</th>
                            <th width="15%">Info</th>
                            <th width="20%">Media Konsultasi</th>
                            <th width="10%">Status</th>
                            <th width="10%" class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Online 1 -->
                        <tr class="patient-row" id="row-ol-1">
                            <td>
                                <div class="time-stamp">11:00</div>
                            </td>
                            <td>
                                <div class="profile-group">
                                    <div class="avatar-box gradient-teal">RH</div>
                                    <div>
                                        <div class="p-name">Rahmat Hidayat</div>
                                        <div class="p-id">ID: OL-003</div>
                                        <div class="referral-badge" id="badge-ol-1" style="display: none;">⚠ Butuh Rujukan
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="gender-pill male"><span>Laki-laki</span> • 28 Thn</div>
                            </td>
                            <td>
                                <span class="media-tag video">
                                    <svg width="12" height="12" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Video Call
                                </span>
                            </td>
                            <td><span class="status-pill waiting">Menunggu</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-primary-pill"
                                        onclick="openModal('ol-1', 'Rahmat Hidayat', 'Laki-laki / 28 Thn', 'Keluhan Kulit')">
                                        Proses
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Online 2 -->
                        <tr class="patient-row" id="row-ol-2">
                            <td>
                                <div class="time-stamp">11:15</div>
                            </td>
                            <td>
                                <div class="profile-group">
                                    <div class="avatar-box gradient-orange">DN</div>
                                    <div>
                                        <div class="p-name">Dina Nuralisa</div>
                                        <div class="p-id">ID: OL-004</div>
                                        <div class="referral-badge" id="badge-ol-2" style="display: none;">⚠ Butuh
                                            Rujukan</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="gender-pill female"><span>Perempuan</span> • 22 Thn</div>
                            </td>
                            <td>
                                <span class="media-tag chat">
                                    <svg width="12" height="12" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                    Chat
                                </span>
                            </td>
                            <td><span class="status-pill waiting">Menunggu</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-primary-pill"
                                        onclick="openModal('ol-2', 'Dina Nuralisa', 'Perempuan / 22 Thn', 'Maag Akut')">
                                        Proses
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        {{-- MODAL POPUP FORM RUJUKAN --}}
        <div class="modal-overlay" id="referralModal">
            <div class="modal-card">
                <button class="btn-close-absolute" onclick="closeModal()">&times;</button>

                <div class="modal-flex">
                    {{-- SISI KIRI (INFO) --}}
                    <div class="modal-sidebar theme-dark">
                        <div class="sidebar-header">
                            <div class="avatar-xl" id="mAvatar">BS</div>
                            <div>
                                <h2 id="mName">Nama Pasien</h2>
                                <span class="patient-tag">Status Pemeriksaan</span>
                            </div>
                        </div>

                        <div class="divider-line"></div>

                        <div class="info-block">
                            <label>Info Personal</label>
                            <p id="mInfo">Laki-laki / 32 Thn</p>
                        </div>

                        <div class="info-block">
                            <label>Diagnosa / Keluhan</label>
                            <p id="mComplaint" class="text-highlight">Demam Tifoid</p>
                        </div>

                        <div class="illustration-area">
                            <svg width="60" height="60" fill="none" stroke="rgba(255,255,255,0.2)"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <span>Sistem Rujukan Terintegrasi</span>
                        </div>
                    </div>

                    {{-- SISI KANAN (INPUT) --}}
                    <div class="modal-main theme-light">
                        <div class="main-header">
                            <div class="icon-wrap">
                                <svg width="24" height="24" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3>Buat Surat Rujukan</h3>
                                <p>Lengkapi data faskes tujuan di bawah ini.</p>
                            </div>
                        </div>

                        <form onsubmit="event.preventDefault(); saveReferral();">
                            <input type="hidden" id="currentRowId">

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Rumah Sakit Tujuan</label>
                                    <select class="input-field">
                                        <option>RSUD Dr. Soetomo</option>
                                        <option>RS Mitra Keluarga</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Poli Spesialis</label>
                                    <select class="input-field">
                                        <option>Penyakit Dalam</option>
                                        <option>Jantung</option>
                                        <option>Bedah</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Alasan Rujukan</label>
                                <textarea class="input-field" rows="4" placeholder="Jelaskan kondisi klinis dan alasan merujuk..."></textarea>
                            </div>

                            {{-- CHECKBOX UTAMA UNTUK MENANDAI RUJUKAN --}}
                            <div class="referral-activation-box">
                                <label class="checkbox-container">
                                    <input type="checkbox" id="markAsReferral">
                                    <span class="checkmark"></span>
                                    <div class="text-content">
                                        <span class="title">Konfirmasi Rujukan</span>
                                        <span class="desc">Pasien ini membutuhkan penanganan lebih lanjut (Rujuk).</span>
                                    </div>
                                </label>
                            </div>

                            <div class="form-footer">
                                <div class="toggle-option">
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="toggle-text">Cetak Otomatis</span>
                                </div>
                                <div class="btn-wrap">
                                    <button type="button" class="btn-ghost" onclick="closeModal()">Batal</button>
                                    <button type="submit" class="btn-solid">Simpan & Proses</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        const modal = document.getElementById('referralModal');

        // Tab Switcher
        function switchTab(type) {
            const listTatap = document.getElementById('list-tatap-muka');
            const listOnline = document.getElementById('list-online');
            const btns = document.querySelectorAll('.tab-pill');

            listTatap.style.display = 'none';
            listOnline.style.display = 'none';

            btns.forEach(b => b.classList.remove('active'));
            event.currentTarget.classList.add('active');

            if (type === 'tatap-muka') listTatap.style.display = 'block';
            else listOnline.style.display = 'block';
        }

        // Open Modal
        function openModal(rowId, name, info, diagnosis) {
            document.getElementById('currentRowId').value = rowId;
            document.getElementById('mName').innerText = name;
            document.getElementById('mInfo').innerText = info;
            document.getElementById('mComplaint').innerText = diagnosis;

            let initials = name.match(/\b(\w)/g);
            document.getElementById('mAvatar').innerText = initials ? initials.join('').substring(0, 2) : 'XX';

            // Reset Form
            const row = document.getElementById('row-' + rowId);
            const isReferral = row.classList.contains('is-referral');
            document.getElementById('markAsReferral').checked = isReferral;

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Save Logic (Update UI Background)
        function saveReferral() {
            const rowId = document.getElementById('currentRowId').value;
            const needsReferral = document.getElementById('markAsReferral').checked;
            const row = document.getElementById('row-' + rowId);
            const badge = document.getElementById('badge-' + rowId);
            const btn = document.querySelector('.btn-solid');
            const originalText = btn.innerText;

            btn.innerText = 'Memproses...';

            setTimeout(() => {
                if (needsReferral) {
                    row.classList.add('is-referral');
                    badge.style.display = 'block';
                    alert('Surat Rujukan Berhasil Dibuat!');
                } else {
                    row.classList.remove('is-referral');
                    badge.style.display = 'none';
                    alert('Data disimpan tanpa status rujukan.');
                }

                btn.innerText = originalText;
                closeModal();
            }, 800);
        }

        modal.addEventListener('click', e => {
            if (e.target === modal) closeModal();
        });
    </script>
@endsection
