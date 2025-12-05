@extends('dokter.layout')

@section('title', 'Jadwal Praktik')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dokter/layanan/jadwal_praktik.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@endpush

@section('body')
    <div class="jadwal-praktik">
        
        <div class="main-wrapper">
            
            {{-- Header Area --}}
            <div class="top-header">
                <div class="header-left">
                    <a href="{{ url()->previous() }}" class="btn-back-pill">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span>Kembali</span>
                    </a>
                    <div class="title-block">
                        <h1>Jadwal Praktik</h1>
                        <div class="date-capsule">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ date('d F Y') }}
                        </div>
                    </div>
                </div>
                
                {{-- Status Ruangan di kanan atas telah dihapus sesuai permintaan --}}
            </div>

            {{-- Table Section --}}
            <div class="table-container">
                <div class="table-head-info">
                    <h3>Antrian Pasien</h3>
                    <span class="count-bubble">3 Pasien</span>
                </div>

                <table class="floating-table">
                    <thead>
                        <tr>
                            <th width="10%">Jam</th>
                            <th width="35%">Identitas Pasien</th>
                            <th width="15%">Info</th>
                            <th width="20%">Keluhan / Diagnosa</th>
                            <th width="10%">Status</th>
                            <th width="10%" class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <!-- Pasien 1 -->
                        <tr class="patient-row" id="row-1">
                            <td>
                                <div class="time-stamp">09:00</div>
                            </td>
                            <td>
                                <div class="profile-group">
                                    <div class="avatar-box gradient-blue">BS</div>
                                    <div>
                                        <div class="p-name">Budi Santoso</div>
                                        <div class="p-id">ID: P-001</div>
                                        {{-- Badge Rujukan (Akan muncul jika ditandai dari modal) --}}
                                        <div class="referral-badge" id="ref-badge-1" style="display: none;">
                                            ⚠ Butuh Rujukan
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="gender-pill male">
                                    <span>Laki-laki</span> • 32 Thn
                                </div>
                            </td>
                            <td>
                                <span class="complaint">Demam & Pusing</span>
                            </td>
                            <td><span class="status-pill waiting">Menunggu</span></td>
                            <td>
                                <div class="action-buttons">
                                    {{-- Tombol Periksa (Memicu Modal) --}}
                                    <button class="btn-primary-pill" onclick="openModal(1, 'Budi Santoso', 'Laki-laki / 32 Thn', 'Demam & Pusing', 'BS')">
                                        Periksa
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Pasien 2 -->
                        <tr class="patient-row" id="row-2">
                            <td>
                                <div class="time-stamp">10:30</div>
                            </td>
                            <td>
                                <div class="profile-group">
                                    <div class="avatar-box gradient-purple">SA</div>
                                    <div>
                                        <div class="p-name">Siti Aminah</div>
                                        <div class="p-id">ID: P-002</div>
                                        <div class="referral-badge" id="ref-badge-2" style="display: none;">
                                            ⚠ Butuh Rujukan
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="gender-pill female">
                                    <span>Perempuan</span> • 45 Thn
                                </div>
                            </td>
                            <td>
                                <span class="complaint">Cek Tensi Rutin</span>
                            </td>
                            <td><span class="status-pill waiting">Menunggu</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-primary-pill" onclick="openModal(2, 'Siti Aminah', 'Perempuan / 45 Thn', 'Cek Tensi', 'SA')">
                                        Periksa
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Pasien 3 (Selesai) -->
                        <tr class="patient-row done-row">
                            <td>
                                <div class="time-stamp done">13:00</div>
                            </td>
                            <td>
                                <div class="profile-group">
                                    <div class="avatar-box gray">RH</div>
                                    <div>
                                        <div class="p-name">Rahmat Hidayat</div>
                                        <div class="p-id">ID: P-003</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="gender-pill gray">
                                    <span>Laki-laki</span> • 28 Thn
                                </div>
                            </td>
                            <td>
                                <span class="complaint gray">Nyeri Dada</span>
                            </td>
                            <td><span class="status-pill done">Selesai</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-primary-pill disabled" disabled>
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Selesai
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>

        {{-- MODAL POPUP --}}
        <div class="modal-overlay" id="examModal">
            <div class="modal-card">
                <button class="btn-close-absolute" onclick="closeModal()">&times;</button>
                
                <div class="modal-flex">
                    {{-- SISI KIRI (INFO) --}}
                    <div class="modal-sidebar theme-dark">
                        <div class="sidebar-header">
                            <div class="avatar-xl" id="mAvatar">BS</div>
                            <div>
                                <h2 id="mName">Nama Pasien</h2>
                                <span class="patient-tag">Rawat Jalan</span>
                            </div>
                        </div>

                        <div class="divider-line"></div>

                        <div class="info-block">
                            <label>Info Personal</label>
                            <p id="mInfo">Laki-laki / 32 Thn</p>
                        </div>

                        <div class="info-block">
                            <label>Keluhan Utama</label>
                            <p id="mComplaint" class="text-alert">Demam Tinggi</p>
                        </div>
                        
                        <div class="visual-bottom">
                            <svg width="50" height="50" fill="none" stroke="rgba(255,255,255,0.2)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>

                    {{-- SISI KANAN (INPUT) --}}
                    <div class="modal-main theme-light">
                        <div class="main-header">
                            <div class="icon-wrap">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <div>
                                <h3>Catatan Medis</h3>
                                <p>Isi hasil pemeriksaan fisik dan diagnosa.</p>
                            </div>
                        </div>

                        <form onsubmit="event.preventDefault(); saveExam();">
                            {{-- Hidden input untuk menyimpan ID Baris yang sedang diedit --}}
                            <input type="hidden" id="currentRowId" value="">

                            <div class="form-item">
                                <label>Diagnosa ICD-10 / Klinis</label>
                                <textarea class="input-field" rows="4" placeholder="Contoh: A01.0 Typhoid fever..."></textarea>
                            </div>

                            <div class="form-item">
                                <label>Terapi / Resep Obat</label>
                                <textarea class="input-field" rows="3" placeholder="Nama obat, dosis, frekuensi..."></textarea>
                            </div>

                            <div class="referral-box">
                                <label class="checkbox-container warning">
                                    <input type="checkbox" id="needReferral">
                                    <span class="checkmark"></span>
                                    <span class="text">Pasien Membutuhkan Rujukan</span>
                                </label>
                            </div>

                            <div class="form-footer">
                                <div class="checkbox-group">
                                    <input type="checkbox" id="markDone">
                                    <label for="markDone">Selesaikan Sesi</label>
                                </div>
                                <div class="btn-wrap">
                                    <button type="button" class="btn-ghost" onclick="closeModal()">Batal</button>
                                    <button type="submit" class="btn-solid">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        const modal = document.getElementById('examModal');

        // Membuka Modal
        function openModal(rowId, name, info, complaint, initials) {
            // Set Hidden ID
            document.getElementById('currentRowId').value = rowId;

            // Set Info Pasien
            document.getElementById('mName').innerText = name;
            document.getElementById('mInfo').innerText = info;
            document.getElementById('mComplaint').innerText = complaint;
            document.getElementById('mAvatar').innerText = initials;
            
            // Reset input form
            document.querySelectorAll('textarea').forEach(el => el.value = '');
            document.getElementById('markDone').checked = false;

            // Cek status rujukan saat ini di baris tabel
            const row = document.getElementById('row-' + rowId);
            const isReferral = row.classList.contains('is-referral');
            document.getElementById('needReferral').checked = isReferral;

            // Tampilkan Modal
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Simpan Data & Update Tampilan Baris
        function saveExam() {
            const rowId = document.getElementById('currentRowId').value;
            const needsReferral = document.getElementById('needReferral').checked;
            
            const btn = document.querySelector('.btn-solid');
            const originalText = btn.innerText;
            btn.innerText = 'Menyimpan...';

            // Simulasi loading
            setTimeout(() => {
                // Update UI di Tabel Background
                const row = document.getElementById('row-' + rowId);
                const badge = document.getElementById('ref-badge-' + rowId);

                if (needsReferral) {
                    row.classList.add('is-referral');
                    badge.style.display = 'block';
                } else {
                    row.classList.remove('is-referral');
                    badge.style.display = 'none';
                }

                alert('Data pemeriksaan berhasil disimpan.');
                btn.innerText = originalText;
                closeModal();
            }, 600);
        }

        // Close backdrop click
        modal.addEventListener('click', e => {
            if (e.target === modal) closeModal();
        });
    </script>
@endsection