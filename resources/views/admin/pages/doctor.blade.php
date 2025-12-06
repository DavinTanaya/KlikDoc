<style>
  .avatar-circle {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
  }

  .pill {
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
  }

  .pill.success {
    background: #e6f9ec;
    color: #27a744;
  }

  .pill.warning {
    background: #fff3cd;
    color: #e0a800;
  }

  .pill.danger {
    background: #fde2e1;
    color: #d9534f;
  }

  .doctor-card:hover {
    transform: translateY(-2px);
    transition: 0.2s ease;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
  }

  .latest-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 4px;
    text-decoration: none;
    color: inherit;
  }

  .latest-item:hover {
    background: #f7f9fc;
    border-radius: 8px;
  }

  .divider {
    height: 1px;
    background: #eee;
    margin: 10px 0;
  }

  .lihat {
    font-size: 13px;
    color: #2563eb;
    font-weight: 600;
  }

  /* --- BASE CARD & HOVER --- */
  .doctor-card {
    /* Set a reasonable, modern max-width */
    max-width: 300px;
    border-radius: 12px;
    /* Slightly smaller radius for a modern feel */
    border: 1px solid #e0e0e0;
    /* Add a subtle border */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    /* Lighter shadow */
    transition: all 0.2s ease-in-out;
  }

  .doctor-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
  }

  .doctor-card .card-body {
    padding: 16px;
    /* Compact padding */
    display: flex;
    flex-direction: column;
    gap: 16px;
    /* Increased gap for better separation */
  }

  /* --- AVATAR & INFO GROUP --- */
  .doctor-header {
    display: flex;
    /* Aligns avatar and text group */
    align-items: center;
    /* Center the text vertically next to the avatar */
    gap: 12px;
  }

  .avatar-circle {
    width: 56px;
    /* Slightly smaller avatar */
    height: 56px;
    border-radius: 50%;
    flex-shrink: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    font-weight: 700;
  }

  /* --- TEXT STYLES --- */
  .doctor-text-info {
    line-height: 1.3;
  }

  .doctor-text-info .name {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 0px;
  }

  .doctor-text-info .specialization {
    font-size: 13px;
    color: #555;
    margin-bottom: 0px;
  }

  /* --- DETAIL BLOCK (NIK/STR/Date) --- */
  .doctor-info-detail-grid {
    /* Use CSS Grid for a clean two-column layout */
    display: grid;
    grid-template-columns: auto 1fr;
    /* Left column width adjusts to content, right takes remaining space */
    gap: 8px 15px;
    /* Vertical and horizontal gap */
    font-size: 13px;
    padding: 8px 0;
    border-top: 1px solid #f0f0f0;
    border-bottom: 1px solid #f0f0f0;
  }

  .doctor-info-detail-grid .label {
    color: #777;
    font-weight: 500;
    text-align: left;
  }

  .doctor-info-detail-grid .value {
    font-weight: 600;
    text-align: right;
  }

  /* --- ACTION BUTTON --- */
  .btn.w-100 {
    font-size: 14px;
    padding: 8px 0;
  }

  /* Keep your general utility classes for pills and dividers */
  .pill {
    padding: 3px 9px;
    border-radius: 14px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
  }

  .pill.success {
    background: #e6f9ec;
    color: #27a744;
  }

  .doctor-search-form {
    margin-right: 10px;
  }

  .doctor-search-box {
    display: flex;
    align-items: center;
    background: #f1f3f5;
    padding: 6px 10px;
    border-radius: 8px;
  }

  .doctor-search-box input {
    border: none;
    background: transparent;
    outline: none;
    font-size: 13px;
    width: 650px;
  }

  .doctor-search-box button {
    border: none;
    background: transparent;
    cursor: pointer;
    padding: 0;
    color: #6c757d;
  }

  .doctor-search-box button:hover {
    color: #0d6efd;
  }

  .disabled-card {
    opacity: 0.6;
  }
</style>

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="row g-4 fade-in mb-4">
  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Total Dokter</p>
        <h2 class="stat-value">{{ $acceptedApplicants }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Dokter Online</p>
        <h2 class="stat-value text-success" id="doctorOnlineCount">0</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Dokter Dinonaktifkan</p>
        <h2 class="stat-value text-danger">{{ $disabledApplicants }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Average Rating</p>
        <h2 class="stat-value text-warning">4.8</h2>
      </div>
    </div>
  </div>
</div>

<!-- ROW 2 -->
<div class="row g-4 fade-in mb-4">
  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Total Pengajuan</p>
        <h2 class="stat-value">{{ $totalApplicants }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Disetujui</p>
        <h2 class="stat-value text-success">{{ $acceptedApplicants }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Pending</p>
        <h2 class="stat-value text-warning">{{ $pendingApplicants }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Ditolak</p>
        <h2 class="stat-value text-danger">{{ $rejectedApplicants }}</h2>
      </div>
    </div>
  </div>
</div>

<div class="card fade-in">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-0">Daftar Dokter</h5>
  </div>

  <div class="card-body">
    <div class="row g-4">

      <div class="col-lg-8">
        <div class="card fade-in h-100">
          <div class="card-header d-flex justify-content-between align-items-center">
            <form method="GET" class="doctor-search-form d-flex align-items-center">
              <div class="doctor-search-box">
                <input type="text" name="search" id="doctorSearch" placeholder="Cari dokter..."
                  value="{{ request('search') }}">
                <button type="submit">
                  <i class="bi bi-search"></i>
                </button>
              </div>
            </form>
          </div>

          <div class="card-body">
            <div class="col-12 d-flex justify-content-start flex-wrap gap-4">

              @forelse ($doctors as $doctor)
                @php
                  $initials = collect(explode(' ', $doctor->full_name))
                      ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                      ->join('');

                  $appPayload = [
                      'appId' => $doctor->id,
                      'full_name' => $doctor->full_name,
                      'spesialisasi' => $doctor->spesialisasi,
                      'nik' => $doctor->nik,
                      'gender' => $doctor->gender,
                      'str' => $doctor->str,
                      'sip' => $doctor->sip,
                      'submission_date' => $doctor->created_at->format('d M Y'),
                      'status' => $doctor->status,
                      'document' => $doctor->document,
                      'experience_years' => $doctor->experience_years,
                  ];
                @endphp

                <div class="col-md-6 col-lg-4">
                  <div class="doctor-card card @if ($doctor->status === 'disabled') disabled-card @endif border-0">
                    <div class="card-body">

                      <!-- HEADER -->
                      <div class="doctor-header">
                        <div class="avatar-circle bg-primary-subtle text-primary">
                          {{ $initials }}
                        </div>
                        <div class="doctor-text-info">
                          <div class="name">{{ $doctor->full_name }}</div>
                          <div class="specialization">{{ $doctor->spesialisasi }}</div>
                        </div>
                      </div>

                      <!-- DETAIL GRID -->
                      <div class="doctor-info-detail-grid">

                        <span class="label">Disetujui:</span>
                        <span class="value">{{ $doctor->created_at->format('d M Y') }}</span>

                        <span class="label">NIK:</span>
                        <span class="value">{{ $doctor->nik }}</span>

                        <span class="label">STR:</span>
                        <span class="value">{{ $doctor->str }}</span>

                      </div>

                      <!-- BUTTON -->
                      <button class="btn btn-primary btn-sm w-100"
                        onclick='showApplicationDetail(@json($appPayload))'>
                        <i class="bi bi-eye"></i> Detail
                      </button>

                    </div>
                  </div>
                </div>

              @empty
                <p class="text-muted w-100 mt-3 text-center">Belum ada dokter terdaftar.</p>
              @endforelse

            </div>

          </div>
        </div>
      </div>

      <!-- ================= RIGHT COLUMN — LATEST SUBMISSIONS ================= -->
      <div class="col-lg-4">
        <div class="card fade-in h-100">
          <div class="card-header">
            <h5 class="fw-semibold mb-0">Pengajuan Terbaru</h5>
          </div>

          <div class="card-body p-3">

            @forelse ($latestApplicants as $item)
              @php
                $initials = collect(explode(' ', $item->full_name))
                    ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                    ->join('');

                $payload = [
                    'appId' => $item->id,
                    'full_name' => $item->full_name,
                    'spesialisasi' => $item->spesialisasi,
                    'nik' => $item->nik,
                    'gender' => $item->gender,
                    'str' => $item->str,
                    'sip' => $item->sip,
                    'submission_date' => $item->created_at->format('d M Y'),
                    'status' => ucfirst($item->status ?? 'Pending'),
                    'document' => $item->document,
                    'experience_years' => $item->experience_years,
                ];

                $pillClass = match ($item->status) {
                    'approved' => 'success',
                    'pending' => 'warning',
                    'rejected' => 'danger',
                    default => 'warning',
                };
              @endphp

              <a class="latest-item" href="javascript:void(0);"
                onclick='showApplicationDetail(@json($payload))'>
                <div class="left">
                  <div class="name fw-semibold">{{ $item->full_name }}</div>
                  <div class="meta small text-muted">
                    {{ $item->created_at->format('d M Y') }} • {{ $item->spesialisasi }}
                  </div>
                  <span class="pill {{ $pillClass }}">{{ ucfirst($item->status) }}</span>
                </div>
                <div class="right">
                  <span class="lihat">Lihat →</span>
                </div>
              </a>

              <div class="divider"></div>
            @empty
              <p class="text-muted text-center">Tidak ada pengajuan terbaru.</p>
            @endforelse

            <hr>
            <a href="{{ route('admin.applicants.history') }}" class="d-block text-center"
              style="text-decoration: none; color: inherit;">Lihat Semua →</a>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<script></script>
