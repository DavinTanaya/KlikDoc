@extends('layout')

@section('title', 'KlikDoc | Riwayat Applicants')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/obat/history.css') }}">
    <style>
        .btn-outline {
            padding: 10px 16px !important;
            border-radius: 8px !important;
            border: 1px solid #DBDDE0 !important;
            font-weight: 600 !important;
            color: #23262F !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-decoration: none !important;
            background: white !important;
            cursor: pointer !important;
            width: auto !important;
        }

        .btn-outline:hover {
            background: #f4f4f4 !important;
        }
    </style>
@endpush

@section('body')
    <div class="history-page">
        <header class="history-header">
            <div class="header-container">
                <a href="{{ route('admin.index') }}" class="btn-back">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <h1>Riwayat Applicants</h1>
                <div class="spacer"></div>
            </div>
        </header>

        <main class="history-content">
            <div class="history-container">
                <div class="status-tabs">
                    <a href="{{ route('admin.applicants.history') }}" class="tab {{ request('status') ? '' : 'active' }}"
                        style="text-decoration: none">Semua</a>

                    <a href="{{ route('admin.applicants.history', ['status' => 'pending']) }}"
                        class="tab {{ request('status') === 'pending' ? 'active' : '' }}"
                        style="text-decoration: none">Pending</a>

                    <a href="{{ route('admin.applicants.history', ['status' => 'approved']) }}"
                        class="tab {{ request('status') === 'approved' ? 'active' : '' }}"
                        style="text-decoration: none">Approved</a>

                    <a href="{{ route('admin.applicants.history', ['status' => 'rejected']) }}"
                        class="tab {{ request('status') === 'rejected' ? 'active' : '' }}"
                        style="text-decoration: none">Rejected</a>

                    <a href="{{ route('admin.applicants.history', ['status' => 'disabled']) }}"
                        class="tab {{ request('status') === 'disabled' ? 'active' : '' }}"
                        style="text-decoration: none">Disabled</a>
                </div>
                <div class="order-list">

                    @forelse ($applicants as $app)
                        <div class="order-card">
                            <div class="card-header">
                                <div class="meta">
                                    <span class="date">{{ $app->created_at->format('d M Y') }}</span>
                                    <span class="order-id">{{ $app->full_name }}</span>
                                    <span class="date" style="color:red">{{ $app->spesialisasi }}</span>
                                </div>
                                @php
                                    $badgeClass = match ($app->status) {
                                        'pending' => 'orange',
                                        'approved' => 'green',
                                        'rejected' => 'red',
                                        'disabled' => 'gray',
                                        default => 'gray',
                                    };
                                @endphp

                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="product-thumb">
                                    <div class="avatar-circle bg-primary-subtle text-primary"
                                        style="width:40px;height:40px;font-size:16px;">
                                        {{ strtoupper(substr($app->full_name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3>{{ $app->full_name }}</h3>
                                    <p class="extra-items">{{ $app->nik }}</p>
                                </div>
                                <div class="bill-info">
                                    <span class="label">STR</span>
                                    <span class="price">{{ $app->str }}</span>
                                </div>
                            </div>
                            <div class="card-footer footer-action">
                                @php
                                    $appDetails = [
                                        'appId' => $app->id,
                                        'full_name' => $app->full_name,
                                        'gender' => $app->gender,
                                        'nik' => $app->nik,
                                        'str' => $app->str,
                                        'sip' => $app->sip,
                                        'spesialisasi' => $app->spesialisasi,
                                        'document' => $app->document,
                                        'status' => $app->status,
                                        'submission_date' => $app->created_at->format('d M Y'),
                                        'experience_years' => $app->experience_years,
                                    ];
                                @endphp
                                <div>

                                </div>
                                <button class="btn-outline" onclick='showApplicationDetail(@json($appDetails))'>
                                    Detail Applicant</button>

                            </div>

                        </div>

                    @empty
                        <p class="text-muted mt-4 text-center">Belum ada data applicants.</p>
                    @endforelse

                </div>

            </div>
        </main>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalTitle">Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detailModalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/modals.js') }}"></script>
    <script src="{{ asset('js/admin/modal-handlers.js') }}"></script>
@endpush
