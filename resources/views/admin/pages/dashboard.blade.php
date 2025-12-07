<style>
  .stat-card {
    border-radius: 14px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, .05);
    transition: .2s;
  }

  .stat-card:hover {
    transform: translateY(-3px);
  }

  .stat-value {
    font-size: 1.7rem;
    font-weight: 800;
  }

  .stat-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
  }

  .list-item {
    padding-bottom: 1rem;
    margin-bottom: 1rem;
    border-bottom: 1px dashed #ddd;
  }

  .progress {
    height: 6px;
    background: #f1f3f5
  }

  .progress-bar {
    background: linear-gradient(90deg, #2563eb, #4f46e5);
  }

  .service-card {
    border-radius: 14px;
    border: 1px solid #eee;
    padding: 1.2rem;
    background-color: #eee
  }

  .service-title {
    font-weight: 700;
    font-size: 1.1rem
  }

  .service-metric {
    font-size: .9rem;
    color: #666
  }
</style>
<div class="container-fluid fade-in">

  <div class="mb-4">
    <h3 class="fw-bold mb-1">Dashboard Admin</h3>
    <p class="text-muted mb-0">Ringkasan performa seluruh layanan</p>
  </div>

  <div class="row g-4 mb-4">

    <div class="col-xl-3 col-md-6">
      <div class="card stat-card">
        <div class="card-body d-flex justify-content-between">
          <div>
            <p class="text-muted mb-1">Total Revenue</p>
            <h2 class="stat-value">
              Rp {{ number_format($global['revenue'], 0, ',', '.') }}
            </h2>
            <small class="text-success">
              <i class="bi bi-arrow-up"></i> {{ $global['growth'] }}%
            </small>
          </div>
          <div class="stat-icon bg-success text-success bg-opacity-10">
            <i class="bi bi-cash-stack"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card stat-card">
        <div class="card-body d-flex justify-content-between">
          <div>
            <p class="text-muted mb-1">Total Transaksi</p>
            <h2 class="stat-value">{{ $global['transactions'] }}</h2>
            <small class="text-muted">Semua layanan</small>
          </div>
          <div class="stat-icon bg-primary text-primary bg-opacity-10">
            <i class="bi bi-receipt"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card stat-card">
        <div class="card-body d-flex justify-content-between">
          <div>
            <p class="text-muted mb-1">Active Users</p>
            <h2 class="stat-value">{{ $global['users'] }}</h2>
            <small class="text-muted">30 hari terakhir</small>
          </div>
          <div class="stat-icon bg-info text-info bg-opacity-10">
            <i class="bi bi-people-fill"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card stat-card">
        <div class="card-body d-flex justify-content-between">
          <div>
            <p class="text-muted mb-1">Completion Rate</p>
            <h2 class="stat-value">{{ $global['completion'] }}%</h2>
            <small class="text-muted">Pesanan selesai</small>
          </div>
          <div class="stat-icon bg-warning text-warning bg-opacity-10">
            <i class="bi bi-check-circle-fill"></i>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row g-4 mb-4">

    {{-- KlikHome --}}
    <div class="col-md-4">
      <div class="service-card">
        <div class="service-title mb-2">KlikHome</div>
        <div class="service-metric">Revenue</div>
        <h5>Rp {{ number_format($services['klikhome']['revenue'], 0, ',', '.') }}</h5>
        <div class="service-metric mt-1">
          {{ $services['klikhome']['orders'] }} booking •
          {{ $services['klikhome']['completed'] }} selesai
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="service-card">
        <div class="service-title mb-2">Konsultasi</div>
        <div class="service-metric">Revenue</div>
        <h5>Rp {{ number_format($services['konsultasi']['revenue'], 0, ',', '.') }}</h5>
        <div class="service-metric mt-1">
          {{ $services['konsultasi']['sessions'] }} sesi •
          {{ $services['konsultasi']['doctors'] }} dokter aktif
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="service-card">
        <div class="service-title mb-2">Apotek</div>
        <div class="service-metric">Revenue</div>
        <h5>Rp {{ number_format($services['apotek']['revenue'], 0, ',', '.') }}</h5>
        <div class="service-metric mt-1">
          {{ $services['apotek']['orders'] }} order •
          {{ $services['apotek']['items'] }} produk terjual
        </div>
      </div>
    </div>

  </div>

  {{-- ================= MONTHLY PERFORMANCE ================= --}}
  <div class="card fade-in">
    <div class="card-header d-flex justify-content-between">
      <h5 class="fw-bold mb-0">Performa Bulanan (6 Bulan)</h5>
      <a href="{{ route('admin.dashboard.export.pdf') }}" class="btn btn-outline-primary btn-sm">
        <i class="bi bi-download"></i> Export
      </a>
    </div>

    <div class="card-body">
      @foreach ($monthly as $m)
        <div class="list-item">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
              <strong>{{ $m['label'] }}</strong><br>
              <small class="text-muted">
                Rp {{ number_format($m['revenue'], 0, ',', '.') }} •
                {{ $m['transactions'] }} transaksi
              </small>
            </div>
            <span
              class="badge {{ $m['growth'] >= 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
              {{ $m['growth'] }}%
            </span>
          </div>
          <div class="progress">
            <div class="progress-bar" style="width:{{ $m['progress'] }}%"></div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

</div>
