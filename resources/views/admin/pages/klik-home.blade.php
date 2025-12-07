<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  .klikhome-create-form .section-title {
    font-weight: 600;
    font-size: 0.85rem;
    color: #495057;
    border-left: 3px solid #0d6efd;
    padding-left: 8px;
    margin-bottom: 6px;
  }

  .klikhome-create-form label {
    font-size: 0.75rem;
    font-weight: 600;
    color: #555;
  }

  .klikhome-create-form textarea,
  .klikhome-create-form input,
  .klikhome-create-form select {
    font-size: 0.8rem;
  }

  .klikhome-create-form textarea {
    resize: vertical;
  }

  .klikhome-create-form textarea::placeholder,
  .klikhome-create-form input::placeholder {
    color: #aaa;
    font-size: 0.75rem;
  }

  .klikhome-create-form .btn-success {
    box-shadow: 0 4px 10px rgba(25, 135, 84, 0.25);
  }

  .klikhome-create-form .btn-success:hover {
    transform: translateY(-1px);
  }

  .service-card:hover {
    transform: translateY(-4px);
    transition: .2s ease;
    box-shadow: 0 12px 25px rgba(0, 0, 0, .1);
  }

  .service-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
  }

  .pill {
    padding: 4px 10px;
    border-radius: 14px;
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

  .pill.info {
    background: #e3f2fd;
    color: #2563eb;
  }

  .latest-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 6px;
    border-radius: 8px;
    text-decoration: none;
    color: inherit;
  }

  .latest-item:hover {
    background: #f7f9fc;
  }

  .divider {
    height: 1px;
    background: #eee;
    margin: 8px 0;
  }
</style>

<div class="row g-4 fade-in mb-4">
  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Total Layanan</p>
        <h2 class="stat-value">{{ $totalServices }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Layanan Aktif</p>
        <h2 class="stat-value text-success">{{ $activeServices }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Nonaktif</p>
        <h2 class="stat-value text-danger">{{ $inactiveServices }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Total Order</p>
        <h2 class="stat-value text-primary">{{ $totalOrders }}</h2>
      </div>
    </div>
  </div>
</div>

{{-- ================= STATS ROW 2 ================= --}}
<div class="row g-4 fade-in mb-4">
  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Belum Bayar</p>
        <h2 class="stat-value text-warning">{{ $pendingOrders }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Terjadwal</p>
        <h2 class="stat-value text-info">{{ $scheduledOrders }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Selesai</p>
        <h2 class="stat-value text-success">{{ $completedOrders }}</h2>
      </div>
    </div>
  </div>
</div>

{{-- ================= MAIN CONTENT ================= --}}
<div class="row g-4">

  {{-- ===== LEFT: CRUD LAYANAN ===== --}}
  <div class="col-lg-8">
    <div class="card fade-in h-100">
      <div class="card-header d-flex justify-content-between">
        <h5 class="fw-bold mb-0">Layanan KlikHome</h5>
        <button class="btn btn-primary btn-sm" onclick="openCreateKlikHomeService()">
          + Tambah Layanan
        </button>
      </div>

      <div class="card-body">
        <div class="row g-4">

          @forelse ($services as $service)
            @php
              $payload = [
                  'id' => $service->id,
                  'name' => $service->name,
                  'category' => $service->category,
                  'price' => $service->price,
                  'service_fee' => $service->service_fee,
                  'duration_minutes' => $service->duration_minutes,
                  'handled_by' => $service->handled_by,
                  'description' => $service->description,
                  'is_active' => $service->is_active,
              ];
            @endphp
            <div class="col-md-6 col-lg-4">
              <div class="card service-card border-0">
                <div class="card-body d-flex flex-column gap-3">

                  <div class="d-flex align-items-center gap-3">
                    <div class="service-icon">
                      {!! $service->icon_svg !!}
                    </div>
                    <div>
                      <div class="fw-bold">{{ $service->name }}</div>
                      <small class="text-muted">{{ $service->category }}</small>
                    </div>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                    <span class="pill {{ $service->is_active ? 'success' : 'danger' }}">
                      {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>

                    <strong>
                      Rp {{ number_format($service->price, 0, ',', '.') }}
                    </strong>
                  </div>

                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary w-100"
                      onclick='openEditKlikHomeService(@json($payload))'>
                      Edit

                    </button>
                    <button class="btn btn-sm btn-outline-secondary w-100"
                      onclick='showKlikHomeServiceDetail(@json($payload))'>
                      <i class="bi bi-eye"></i> Detail
                    </button>
                  </div>

                </div>
              </div>
            </div>
          @empty
            <p class="text-muted text-center">Belum ada layanan KlikHome.</p>
          @endforelse

        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card fade-in h-100">
      <div class="card-header">
        <h5 class="fw-semibold mb-0">Order Terbaru</h5>
      </div>

      <div class="card-body p-3">
        @forelse ($latestOrders as $order)
          @php
            $statusClass = match ($order->status) {
                'MENUNGGU_PEMBAYARAN' => 'warning',
                'DIBAYAR' => 'info',
                'SELESAI' => 'success',
                default => 'danger',
            };
          @endphp

          <a href="" class="latest-item">
            {{-- {{ route('admin.klikhome.orders.show', $order->order_code) }} --}}
            <div>
              <div class="fw-semibold">{{ $order->service->name }}</div>
              <small class="text-muted">
                {{ $order->created_at->format('d M Y') }}
              </small>
              <div>
                <span class="pill {{ $statusClass }}">
                  {{ str_replace('_', ' ', $order->status) }}
                </span>
              </div>
            </div>

            <strong>
              Rp {{ number_format($order->total, 0, ',', '.') }}
            </strong>
          </a>

          <div class="divider"></div>
        @empty
          <p class="text-muted text-center">Belum ada order.</p>
        @endforelse

        <a href="{{ route('admin.klikhome.history') }}" class="d-block text-primary fw-semibold text-center">
          Lihat Semua →
        </a>
      </div>
    </div>
  </div>

</div>
