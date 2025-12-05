@extends('dokter.layout')

@section('title', 'Riwayat Praktik & Konsultasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dokter/layanan/history.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@endpush

@section('body')
    <div class="history-dashboard">
        
        <div class="main-wrapper">
            
            {{-- Header --}}
            <div class="top-header">
                <div class="header-left">
                    {{-- Tombol Kembali Ditambahkan --}}
                    <a href="{{ url()->previous() }}" class="btn-back-pill">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span>Kembali</span>
                    </a>

                    <div class="title-block">
                        <h1>Riwayat Praktik</h1>
                        <p class="subtitle">Arsip konsultasi pasien dan jadwal praktik yang telah selesai.</p>
                    </div>
                </div>
            </div>

            {{-- Filter Bar (Card Style like Rujukan) --}}
            <div class="filter-bar">
                <div class="filter-group">
                    <label>Periode Tanggal</label>
                    <div class="date-range-box">
                        <input type="date" class="date-input" value="{{ date('Y-m-01') }}">
                        <span class="separator">s/d</span>
                        <input type="date" class="date-input" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                
                <div class="filter-group">
                    <label>Kategori</label>
                    <select class="select-input">
                        <option value="all">Semua Kategori</option>
                        <option value="tatap_muka">Tatap Muka</option>
                        <option value="online">Konsultasi Online</option>
                    </select>
                </div>

                <button class="btn-filter">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Terapkan Filter
                </button>
            </div>

            {{-- Tabs --}}
            <div class="tabs-wrapper">
                <button class="tab-pill active" onclick="switchTab('konsultasi')">
                    Riwayat Konsultasi
                </button>
                <button class="tab-pill" onclick="switchTab('jadwal')">
                    Riwayat Jadwal Praktik
                </button>
            </div>

            {{-- TAB 1: RIWAYAT KONSULTASI --}}
            <div id="view-konsultasi" class="table-container fade-in">
                <table class="floating-table">
                    <thead>
                        <tr>
                            <th width="15%">Tanggal & Waktu</th>
                            <th width="25%">Pasien</th>
                            <th width="15%">Tipe</th>
                            <th width="20%">Diagnosa Akhir</th>
                            <th width="15%">Status Penanganan</th>
                            <th width="10%" class="text-right">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item 1: Selesai dengan Resep -->
                        <tr class="history-row">
                            <td>
                                <div class="date-text">{{ date('d M Y') }}</div>
                                <div class="time-text">09:30 WIB</div>
                            </td>
                            <td>
                                <div class="profile-group">
                                    <div class="avatar-box gradient-blue">BS</div>
                                    <div>
                                        <div class="p-name">Budi Santoso</div>
                                        <div class="p-id">P-001</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="type-badge offline">Tatap Muka</span>
                            </td>
                            <td>Demam Tifoid (A01.0)</td>
                            <td>
                                <span class="status-badge success">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Resep Diberikan
                                </span>
                            </td>
                            <td class="text-right">
                                <button class="btn-detail" onclick="openDetailModal('Budi Santoso', 'Laki-laki / 32 Thn', 'Tatap Muka', 'Demam Tifoid', 'resep')">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </td>
                        </tr>

                        <!-- Item 2: Dirujuk -->
                        <tr class="history-row">
                            <td>
                                <div class="date-text">{{ date('d M Y') }}</div>
                                <div class="time-text">10:15 WIB</div>
                            </td>
                            <td>
                                <div class="profile-group">
                                    <div class="avatar-box gradient-purple">SA</div>
                                    <div>
                                        <div class="p-name">Siti Aminah</div>
                                        <div class="p-id">P-002</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="type-badge offline">Tatap Muka</span>
                            </td>
                            <td>Hipertensi Kronis</td>
                            <td>
                                <span class="status-badge warning">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                    Dirujuk RS
                                </span>
                            </td>
                            <td class="text-right">
                                <button class="btn-detail" onclick="openDetailModal('Siti Aminah', 'Perempuan / 45 Thn', 'Tatap Muka', 'Hipertensi', 'rujuk')">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </td>
                        </tr>

                        <!-- Item 3: Online -->
                        <tr class="history-row">
                            <td>
                                <div class="date-text">{{ date('d M Y', strtotime('-1 day')) }}</div>
                                <div class="time-text">14:00 WIB</div>
                            </td>
                            <td>
                                <div class="profile-group">
                                    <div class="avatar-box gradient-teal">RH</div>
                                    <div>
                                        <div class="p-name">Rahmat Hidayat</div>
                                        <div class="p-id">OL-005</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="type-badge online">Online (Video)</span>
                            </td>
                            <td>Dermatitis</td>
                            <td>
                                <span class="status-badge success">Resep Digital</span>
                            </td>
                            <td class="text-right">
                                <button class="btn-detail" onclick="openDetailModal('Rahmat Hidayat', 'Laki-laki / 28 Thn', 'Online', 'Dermatitis', 'resep')">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- TAB 2: RIWAYAT JADWAL --}}
            <div id="view-jadwal" class="table-container fade-in" style="display: none;">
                <table class="floating-table">
                    <thead>
                        <tr>
                            <th width="20%">Tanggal</th>
                            <th width="20%">Shift Praktik</th>
                            <th width="20%">Total Pasien</th>
                            <th width="20%">Status Jadwal</th>
                            <th width="20%" class="text-right">Laporan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="history-row">
                            <td>{{ date('d M Y', strtotime('-1 day')) }}</td>
                            <td>08:00 - 14:00 WIB</td>
                            <td><span class="count-pill">12 Pasien</span></td>
                            <td><span class="status-text closed">Selesai / Tutup</span></td>
                            <td class="text-right">
                                <button class="btn-text-action">Lihat Laporan</button>
                            </td>
                        </tr>
                        <tr class="history-row">
                            <td>{{ date('d M Y', strtotime('-2 days')) }}</td>
                            <td>08:00 - 14:00 WIB</td>
                            <td><span class="count-pill">15 Pasien</span></td>
                            <td><span class="status-text closed">Selesai / Tutup</span></td>
                            <td class="text-right">
                                <button class="btn-text-action">Lihat Laporan</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        {{-- DETAIL MODAL (READ ONLY) --}}
        <div class="modal-overlay" id="historyModal">
            <div class="modal-card">
                <button class="btn-close-absolute" onclick="closeModal()">&times;</button>
                
                <div class="modal-flex">
                    {{-- KIRI: DATA PASIEN --}}
                    <div class="modal-sidebar theme-dark">
                        <div class="sidebar-header">
                            <div class="avatar-xl" id="mAvatar">BS</div>
                            <div>
                                <h2 id="mName">Nama Pasien</h2>
                                <span class="patient-tag" id="mType">Tipe</span>
                            </div>
                        </div>
                        <div class="divider-line"></div>
                        <div class="info-block">
                            <label>Info Personal</label>
                            <p id="mInfo">Gender / Usia</p>
                        </div>
                        <div class="info-block">
                            <label>Diagnosa Akhir</label>
                            <p id="mDiagnosis" class="text-highlight">Diagnosa</p>
                        </div>
                        <div class="status-stamp" id="mStatusStamp">
                            SELESAI
                        </div>
                    </div>

                    {{-- KANAN: DATA MEDIS (READ ONLY) --}}
                    <div class="modal-main theme-light">
                        <div class="main-header">
                            <h3>Detail Rekam Medis</h3>
                            <span class="date-chip">Tanggal: {{ date('d M Y') }}</span>
                        </div>

                        <div class="detail-section">
                            <label class="section-label">Catatan Pemeriksaan</label>
                            <div class="read-only-box">
                                <p>Pasien datang dengan keluhan demam sejak 3 hari lalu. Tidak ada riwayat alergi obat. Tanda vital stabil. Pemeriksaan fisik menunjukkan radang tenggorokan ringan.</p>
                            </div>
                        </div>

                        <div class="detail-section">
                            <label class="section-label">Tindakan / Resep / Rujukan</label>
                            <div class="read-only-box highlight-bg" id="mActionContent">
                                {{-- Isi akan diinject JS --}}
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="button" class="btn-solid" onclick="closeModal()">Tutup Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Tab Switcher
        function switchTab(type) {
            const viewKonsul = document.getElementById('view-konsultasi');
            const viewJadwal = document.getElementById('view-jadwal');
            const btns = document.querySelectorAll('.tab-pill');

            viewKonsul.style.display = 'none';
            viewJadwal.style.display = 'none';

            btns.forEach(b => b.classList.remove('active'));
            event.currentTarget.classList.add('active');

            if(type === 'konsultasi') viewKonsul.style.display = 'block';
            else viewJadwal.style.display = 'block';
        }

        // Modal Logic
        const modal = document.getElementById('historyModal');

        function openDetailModal(name, info, type, diagnosis, status) {
            document.getElementById('mName').innerText = name;
            document.getElementById('mInfo').innerText = info;
            document.getElementById('mType').innerText = type;
            document.getElementById('mDiagnosis').innerText = diagnosis;
            
            let initials = name.match(/\b(\w)/g);
            document.getElementById('mAvatar').innerText = initials ? initials.join('').substring(0, 2) : 'XX';

            // Set Content berdasarkan status
            const actionContent = document.getElementById('mActionContent');
            const stamp = document.getElementById('mStatusStamp');

            if(status === 'rujuk') {
                actionContent.innerHTML = `
                    <div class="ref-box">
                        <strong>PASIEN DIRUJUK</strong><br>
                        Tujuan: RSUD Dr. Soetomo - Poli Penyakit Dalam<br>
                        Alasan: Memerlukan pemeriksaan lab lanjutan.
                    </div>`;
                stamp.innerText = "DIRUJUK";
                stamp.style.borderColor = "#d97706";
                stamp.style.color = "#d97706";
            } else {
                actionContent.innerHTML = `
                    <ul style="padding-left: 1rem; margin: 0;">
                        <li>Paracetamol 500mg (3x1)</li>
                        <li>Vitamin C 500mg (1x1)</li>
                        <li>Saran: Istirahat cukup 3 hari</li>
                    </ul>`;
                stamp.innerText = "SELESAI";
                stamp.style.borderColor = "#10b981";
                stamp.style.color = "#10b981";
            }

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        modal.addEventListener('click', e => {
            if (e.target === modal) closeModal();
        });
    </script>
@endsection