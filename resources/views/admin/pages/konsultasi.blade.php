<div class="row g-4 fade-in mb-4">

  {{-- TOTAL TODAY --}}
  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Konsultasi Hari Ini</p>
        <h2 class="stat-value">{{ $totalToday }}</h2>
      </div>
    </div>
  </div>

  {{-- ACTIVE --}}
  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Sedang Berlangsung</p>
        <h2 class="stat-value text-success">{{ $active }}</h2>
      </div>
    </div>
  </div>

  {{-- WAITING --}}
  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Menunggu</p>
        <h2 class="stat-value text-warning">{{ $waiting }}</h2>
      </div>
    </div>
  </div>

  {{-- FINISHED --}}
  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Selesai</p>
        <h2 class="stat-value text-primary">{{ $finished }}</h2>
      </div>
    </div>
  </div>

</div>


{{-- ================== LIST KONSULTASI ================== --}}
<div class="card fade-in">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Konsultasi Terbaru</h5>
  </div>

  <div class="card-body">

    @forelse ($consultations as $c)
      <div class="list-item">

        {{-- HEADER --}}
        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-3">

          <div class="d-flex align-items-center gap-3">
            {{-- AVATAR --}}
            <div class="avatar">
              {{ strtoupper(substr($c->user->name, 0, 2)) }}
            </div>

            {{-- INFO --}}
            <div>
              <h6 class="mb-1">{{ $c->user->name }}</h6>

              <p class="text-muted small mb-1">
                {{ $c->doctor->full_name ?? 'Dokter' }}
              </p>

              <small class="text-muted">
                Metode: {{ strtoupper($c->method) }}
              </small>
            </div>
          </div>

          {{-- STATUS --}}
          @php
            $statusMap = [
                'AKTIF' => ['class' => 'success', 'label' => 'Berlangsung'],
                'MENUNGGU' => ['class' => 'warning', 'label' => 'Menunggu'],
                'SELESAI' => ['class' => 'secondary', 'label' => 'Selesai'],
            ];
            $status = $statusMap[$c->status] ?? ['class' => 'secondary', 'label' => $c->status];
          @endphp

          <span class="badge bg-{{ $status['class'] }}">
            {{ $status['label'] }}
          </span>
        </div>

        {{-- FOOTER --}}
        <div class="d-flex justify-content-between align-items-center">

          <div class="d-flex small text-muted gap-3">
            <span>ID: {{ $c->consultation_code }}</span>
            <span>{{ $c->created_at->format('H:i') }}</span>
            <span class="badge bg-info">
              {{ strtoupper($c->method) }}
            </span>
          </div>

          @if ($c->chat)
            <button class="btn btn-sm btn-outline-primary" onclick="openMonitor({{ $c->id }})">
              <i class="bi bi-eye"></i> Monitor
            </button>
          @else
            <span class="text-muted small">No chat</span>
          @endif


        </div>
      </div>

    @empty
      <div class="text-muted py-4 text-center">
        Belum ada konsultasi
      </div>
    @endforelse

    {{-- CTA --}}
    <div class="mt-3 text-end">
      <a href="{{ route('admin.consultations.index') }}" class="btn btn-outline-primary">
        Lihat Semua Konsultasi
      </a>

    </div>

  </div>
</div>
<div class="modal fade" id="monitorModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Live Chat Monitor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body p-0" id="monitorContent">
        <div class="text-muted py-5 text-center">
          Loading chat...
        </div>
      </div>

    </div>
  </div>
</div>
