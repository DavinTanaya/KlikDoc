@extends('dokter.layout')
@section('title', 'Riwayat Konsultasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dokter/layanan/history.css') }}">
    <style>
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(6px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-card {
            background: #ffffff;
            width: 100%;
            max-width: 520px;
            border-radius: 16px;
            padding: 24px 24px 20px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .35);
            position: relative;
            animation: popIn .25s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        @keyframes popIn {
            from {
                transform: translateY(10px) scale(.96);
                opacity: 0;
            }

            to {
                transform: none;
                opacity: 1;
            }
        }

        .btn-close {
            position: absolute;
            top: 14px;
            right: 16px;
            background: none;
            border: none;
            font-size: 26px;
            line-height: 1;
            cursor: pointer;
            color: #6b7280;
        }

        .btn-close:hover {
            color: #111827;
        }

        .modal-card h2 {
            margin-bottom: 6px;
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }

        .modal-card p {
            margin-bottom: 14px;
            font-size: 14px;
            color: #374151;
        }

        .read-only-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 14px;
            color: #374151;
            margin-bottom: 12px;
        }

        .read-only-box.highlight-bg {
            background: #ecfeff;
            border-color: #67e8f9;
            color: #065f46;
            font-weight: 600;
        }

        .btn-solid {
            width: 100%;
            margin-top: 14px;
            padding: 10px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            cursor: pointer;
        }

        .btn-solid:hover {
            opacity: .95;
        }

        .btn-download-mini {
            margin-left: 10px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 999px;
            background: #2563eb;
            color: #fff;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: background .2s;
        }

        .btn-download-mini:hover {
            background: #1d4ed8;
        }
    </style>
@endpush

@section('body')
    <div class="history-dashboard">
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
                        <h1>Riwayat Konsultasi</h1>
                        <p class="subtitle">Konsultasi online yang telah selesai</p>
                    </div>
                </div>
            </div>
            <div class="table-container">
                <table class="floating-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pasien</th>
                            <th>Tipe</th>
                            <th>Diagnosa</th>
                            <th>Status</th>
                            <th class="text-right">Detail</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($consultations as $c)
                            <tr class="history-row">
                                <td>
                                    <div class="date-text">{{ $c->created_at->format('d M Y') }}</div>
                                    <div class="time-text">{{ $c->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td>
                                    <div class="profile-group">
                                        <div class="avatar-box gradient-blue">
                                            {{ strtoupper(substr($c->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="p-name">{{ $c->user->name }}</div>
                                            <div class="p-id">ID-{{ $c->user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="type-badge online">Online</span>
                                </td>
                                <td>
                                    {{ $c->prescriptions->diagnosis ?? '-' }}
                                </td>
                                <td>
                                    @if ($c->referral)
                                        <span class="status-badge warning">Dirujuk</span>
                                    @elseif($c->prescriptions)
                                        <span class="status-badge success">Resep Diberikan</span>
                                    @else
                                        <span class="status-badge gray">Selesai</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <button class="btn-detail"
                                        onclick="openDetail(
                '{{ $c->user->name }}',
                '{{ $c->prescriptions->diagnosis ?? '-' }}',
                '{{ $c->prescriptions->notes ?? '-' }}',
                '{{ $c->referral ? 'rujuk' : ($c->prescriptions ? 'resep' : 'selesai') }}',
                '{{ $c->prescriptions->id }}',
                '{{ $c->referral?->id ? $c->referral->id : '' }}'
            )">
                                        👁
                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;color:#777">
                                    Tidak ada riwayat konsultasi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
        <div class="modal-overlay" id="detailModal">
            <div class="modal-card">
                <a id="downloadPrescriptionBtn" href="#" class="btn-solid"
                    style="display:none;text-align:center;text-decoration:none;">
                    ⬇ Download Resep (PDF)
                </a>
                <button class="btn-close" onclick="closeModal()">×</button>

                <h2 id="mName"></h2>
                <p id="mDiagnosis"></p>

                <div class="read-only-box" id="mNotes"></div>

                <div class="read-only-box highlight-bg" id="mAction"></div>

                <button class="btn-solid" onclick="closeModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function openDetail(name, diagnosis, notes, type, prescriptionId, referralId) {
            document.getElementById('mName').innerText = name;
            document.getElementById('mDiagnosis').innerText = "Diagnosa: " + diagnosis;
            document.getElementById('mNotes').innerText = notes;

            const action = document.getElementById('mAction');

            if (type === 'resep' && prescriptionId) {
                action.innerHTML = `
      ✅ Resep digital telah diberikan
      <a href="/prescription/${prescriptionId}/download"
         target="_blank"
         class="btn-download-mini">
         ⬇ PDF
      </a>
    `;
            } else if (type === 'rujuk' && referralId) {
                action.innerHTML = `⚠️ Pasien dirujuk ke fasilitas lanjutan 
         <a href = "/rujukan/${referralId}/download"
        target = "_blank"
        class = "btn-download-mini" > ⬇PDF
          </a>`;
            } else {
                action.innerHTML = "✔️ Konsultasi selesai tanpa tindakan";
            }

            document.getElementById('detailModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('detailModal').classList.remove('active');
        }

        function closeModal() {
            document.getElementById('detailModal').classList.remove('active');
        }

        function closeModal() {
            document.getElementById('detailModal').classList.remove('active');
        }
    </script>
@endsection
