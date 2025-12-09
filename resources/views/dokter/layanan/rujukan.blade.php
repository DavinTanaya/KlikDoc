@extends('dokter.layout')

@section('title', 'Kelola Rujukan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dokter/layanan/rujukan.css') }}">
@endpush

@section('body')
    <div class="rujukan-dashboard">
        <div class="main-wrapper">
            <div class="top-header">
                <div class="header-left">
                    <a href="{{ route('dokter.dashboard') }}" class="btn-back">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5M12 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>
                    <div class="title-block">
                        <h1>Kelola Rujukan</h1>
                        <div class="date-capsule">{{ date('d F Y') }}</div>
                    </div>
                </div>
            </div>
            <div class="tabs-wrapper">
                <button class="tab-pill active" onclick="switchTab('active', this)">Rujukan Aktif</button>
                <button class="tab-pill" onclick="switchTab('history', this)">Riwayat Rujukan</button>
            </div>
            <div id="tab-active">

                <div class="table-head-info">
                    <h3>Konsultasi Online Aktif</h3>
                    <span class="count-bubble">{{ $consultationsOnline->count() }} Sesi</span>
                </div>

                <div class="table-container fade-in">
                    <table class="floating-table">
                        <thead>
                            <tr>
                                <th width="10%">Jam</th>
                                <th width="30%">Pasien</th>
                                <th width="20%">Media</th>
                                <th width="25%">Keluhan / Diagnosa</th>
                                <th width="15%" class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($consultationsOnline as $c)
                                <tr>
                                    <td>{{ $c->created_at->format('H:i') }}</td>

                                    <td>
                                        <div class="profile-group">
                                            <div class="avatar-box gradient-blue">
                                                {{ strtoupper(substr($c->user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="p-name">{{ $c->user->name }}</div>
                                                <div class="p-id">
                                                    {{ $c->user->gender }} / {{ $c->user->age }} Thn
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="media-tag {{ $c->media }}">{{ ucfirst($c->media) }}</span>
                                    </td>

                                    <td>{{ $c->diagnosis ?? '-' }}</td>

                                    <td class="text-right">
                                        <button class="btn-primary-pill"
                                            onclick="openModal(
                      '{{ $c->id }}',
                      '{{ $c->user->name }}',
                      '{{ $c->user->gender }} / {{ $c->user->age }} Thn',
                      '{{ $c->diagnosis ?? '-' }}'
                    )">
                                            Buat Rujukan
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted text-center">
                                        Tidak ada konsultasi online
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="tab-history" style="display:none">

                <div class="table-head-info">
                    <h3>Riwayat Rujukan</h3>
                    <span class="count-bubble">{{ $referrals->count() }} Rujukan</span>
                </div>

                <div class="table-container fade-in">
                    <table class="floating-table">
                        <thead>
                            <tr>
                                <th width="15%">Tanggal</th>
                                <th width="30%">Pasien</th>
                                <th width="25%">Tujuan</th>
                                <th width="20%">Poli</th>
                                <th width="10%" class="text-right">Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($referrals as $r)
                                <tr>
                                    <td>
                                        <div>{{ $r->created_at->format('d M Y') }}</div>
                                        <small class="text-muted">{{ $r->created_at->format('H:i') }}</small>
                                    </td>

                                    <td>
                                        <div class="profile-group">
                                            <div class="avatar-box gradient-blue">
                                                {{ strtoupper(substr($r->consultation->user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="p-name">{{ $r->consultation->user->name }}</div>
                                                <div class="p-id">
                                                    {{ $r->consultation->user->gender }} /
                                                    {{ $r->consultation->user->age }} Thn
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $r->destination }}</td>
                                    <td>{{ $r->department }}</td>

                                    <td class="text-right">
                                        <a href="{{ route('referral.download', $r->id) }}" class="btn-primary-pill">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted text-center">
                                        Belum ada riwayat rujukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="modal-overlay" id="referralModal">
            <div class="modal-card">
                <button class="btn-close-absolute" onclick="closeModal()">×</button>

                <div class="modal-flex">

                    <div class="modal-sidebar theme-dark">
                        <h2 id="mName"></h2>
                        <p id="mInfo"></p>
                        <p id="mComplaint" class="text-highlight"></p>
                    </div>

                    <div class="modal-main theme-light">
                        <h3>Buat Surat Rujukan</h3>

                        <form id="referralForm">
                            @csrf
                            <input type="hidden" id="consultationId">

                            <div class="form-group">
                                <label>Rumah Sakit Tujuan</label>
                                <input class="input-field" id="destination" required>
                            </div>

                            <div class="form-group">
                                <label>Poli Spesialis</label>
                                <input class="input-field" id="department" required>
                            </div>

                            <div class="form-group">
                                <label>Alasan Rujukan</label>
                                <textarea class="input-field" id="reason" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Catatan Tambahan</label>
                                <textarea class="input-field" id="notes"></textarea>
                            </div>

                            <div class="form-footer">
                                <button type="button" class="btn-ghost" onclick="closeModal()">Batal</button>
                                <button type="submit" class="btn-solid">Simpan Rujukan</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script>
        const modal = document.getElementById('referralModal');

        function switchTab(type, el) {
            document.getElementById('tab-active').style.display = type === 'active' ? 'block' : 'none';
            document.getElementById('tab-history').style.display = type === 'history' ? 'block' : 'none';

            document.querySelectorAll('.tab-pill').forEach(b => b.classList.remove('active'));
            el.classList.add('active');
        }

        function openModal(id, name, info, diagnosis) {
            consultationId.value = id;
            mName.innerText = name;
            mInfo.innerText = info;
            mComplaint.innerText = diagnosis;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('referralForm').addEventListener('submit', e => {
            e.preventDefault();

            fetch("{{ route('dokter.rujukan.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    consultation_id: consultationId.value,
                    destination: destination.value,
                    department: department.value,
                    reason: reason.value,
                    notes: notes.value
                })
            }).then(() => location.reload());
        });
    </script>
@endsection
