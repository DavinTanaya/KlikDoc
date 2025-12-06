<style>
  .order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 4px;
    border-radius: 8px;
    text-decoration: none !important;
    transition: 0.2s ease;
    color: inherit;
  }

  .order-item:hover {
    background: #f3f6fb;
  }

  .order-left {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .order-id {
    font-weight: 600;
    font-size: 14px;
    color: #1e1e2d;
  }

  .order-user {
    font-size: 12px;
    color: #6c757d;
  }

  .pill {
    padding: 2px 10px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 600;
    width: fit-content;
    margin-top: 4px;
  }

  .pill.primary {
    background: #e3f1ff;
    color: #007bff;
  }

  .pill.success {
    background: #e5f8e8;
    color: #2e7d32;
  }

  .pill.warning {
    background: #fff4d6;
    color: #b77400;
  }

  .pill.danger {
    background: #ffe3e3;
    color: #d32f2f;
  }

  .order-right {
    text-align: right;
  }

  .order-right .price {
    font-weight: 700;
    font-size: 15px;
    color: #1b4ad1;
  }

  .order-right .lihat {
    font-size: 12px;
    color: #9aa0ac;
  }

  .divider {
    height: 1px;
    background: #eee;
    margin: 8px 0;
  }

  .product-search-form {
    margin-right: 10px;
  }

  .product-search-box {
    display: flex;
    align-items: center;
    background: #f1f3f5;
    padding: 6px 10px;
    border-radius: 8px;
  }

  .product-search-box input {
    border: none;
    background: transparent;
    outline: none;
    font-size: 13px;
    width: 150px;
  }

  .product-search-box button {
    border: none;
    background: transparent;
    cursor: pointer;
    padding: 0;
    color: #6c757d;
  }

  .product-search-box button:hover {
    color: #0d6efd;
  }
</style>
<div class="row g-4 fade-in mb-4">
  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Terjadi kesalahan!</strong>
      <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Total Produk</p>
        <h2 class="stat-value">{{ $drugs->count() }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Stok Rendah</p>
        <h2 class="stat-value text-warning">
          {{ $drugs->where('stock', '<', 20)->count() }}
        </h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Total Pesanan</p>
        <h2 class="stat-value text-primary">
          {{ number_format($totalOrders) }}
        </h2>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Pesanan Hari Ini</p>
        <h2 class="stat-value text-success">
          {{ number_format($todayOrders) }}
        </h2>
      </div>
    </div>
  </div>

</div>


<div class="row g-4">

  <div class="col-lg-8">
    <div class="card fade-in">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="d-flex align-items-center mb-0 gap-3">
          Daftar Produk

        </h5>
        <form method="GET" class="product-search-form d-flex align-items-center">
          <div class="product-search-box">
            <input type="text" name="search" id="productSearch" placeholder="Cari produk..."
              value="{{ request('search') }}">
            <button type="submit">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddDrug" onclick="showAddForm()">
          <i class="bi bi-plus-lg"></i> Tambah Produk
        </button>
      </div>

      <div class="card-body">

        @forelse ($drugs as $drug)
          <div class="border-bottom mb-4 list-item pb-3">
            <div class="d-flex align-items-start gap-3">

              <div class="bg-light rounded p-3" style="width: 64px; height: 64px;">
                @if ($drug->image)
                  <img src="{{ asset('images/drugs/' . $drug->image) }}" class="img-fluid rounded"
                    style="width: 100%; height: 100%; object-fit: cover;">
                @else
                  <i class="bi bi-capsule-pill" style="font-size: 32px; color: #4fc3f7;"></i>
                @endif
              </div>

              <div class="flex-grow-1">

                <!-- Nama + Category -->
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div>
                    <h6 class="mb-1">{{ $drug->name }}</h6>
                    <p class="text-muted small mb-0">
                      {{ $drug->category }} • {{ $drug->type }}
                    </p>
                  </div>

                  {{-- BADGE STATUS STOCK --}}
                  @php
                    $badge = $drug->stock < 20 ? 'badge-warning-custom' : 'badge-success-custom';
                    $label = $drug->stock < 20 ? 'Stok Rendah' : 'Tersedia';
                  @endphp

                  <span class="badge {{ $badge }}">{{ $label }}</span>
                </div>

                <!-- STOCK BAR -->
                <div class="mb-2">
                  <div class="d-flex justify-content-between small mb-1">
                    <span class="text-muted">Stok</span>
                    <span>{{ $drug->stock }}</span>
                  </div>

                  @php
                    $progress = min(($drug->stock / 200) * 100, 100);
                    $progressColor = $drug->stock < 20 ? 'bg-warning' : 'bg-success';
                  @endphp

                  <div class="progress" style="height: 6px;">
                    <div class="progress-bar {{ $progressColor }}" style="width: {{ $progress }}%;"></div>
                  </div>
                </div>

                <!-- PRICE + BUTTONS -->
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex small text-muted gap-3">
                    <span class="text-primary fw-semibold">
                      Rp {{ number_format($drug->price, 0, ',', '.') }}
                    </span>
                  </div>

                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" data-bs-toggle="modal"
                      data-bs-target="#modalViewDrug{{ $drug->id }}">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-outline-secondary" onclick='showEditForm(@json($drug))'>
                      <i class="bi bi-pencil"></i>
                    </button>

                    <button class="btn btn-outline-danger" onclick='showDeleteForm(@json($drug))'>
                      <i class="bi bi-trash"></i>
                    </button>

                  </div>
                </div>

              </div>
            </div>
          </div>

        @empty
          <p class="text-muted">Belum ada produk.</p>
        @endforelse

      </div>

    </div>
  </div>


  <div class="col-lg-4">
    <div class="card fade-in">
      <div class="card-header">
        <h5 class="mb-0">Pesanan Terbaru</h5>
      </div>

      <div class="card-body p-3">

        @forelse ($latestOrders as $order)
          <a href="{{ route('admin.orders.detail', $order->order_code) }}" class="order-item">

            <div class="order-left">
              <div class="order-id">#{{ $order->order_code }}</div>
              <div class="order-user">
                {{ $order->user->name }} • {{ $order->created_at->format('d M Y') }}
              </div>

              @php
                $badgeClass = match ($order->status) {
                    'BELUM_BAYAR' => 'pill danger',
                    'DIPROSES' => 'pill primary',
                    'DIKIRIM' => 'pill warning',
                    'SELESAI' => 'pill success',
                    default => 'pill secondary',
                };
              @endphp

              <span class="{{ $badgeClass }}">
                {{ ucfirst(strtolower(str_replace('_', ' ', $order->status))) }}
              </span>
            </div>

            <div class="order-right">
              <div class="price">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
              <span class="lihat">Lihat →</span>
            </div>

          </a>

          @if (!$loop->last)
            <div class="divider"></div>
          @endif

        @empty
          <p class="text-muted mb-0 text-center">Belum ada pesanan.</p>
        @endforelse
        <hr>
          <a href="{{ route('admin.orders.history') }}" class="text-center d-block" style="text-decoration: none; color: inherit;">Lihat Semua →</a>
      </div>
    </div>
  </div>


  <div id="hiddenFormAdd" class="d-none">
    @include('admin.components.forms.addProductForm')
  </div>

  <div id="hiddenFormEdit" class="d-none">
    @include('admin.components.forms.editProductForm')
  </div>

  <div id="hiddenFormDelete" class="d-none">
    @include('admin.components.forms.deleteProductForm')
  </div>

</div>
<script>
  document.getElementById("productSearch").addEventListener("keydown", function(e) {
    if (e.key === "Enter") {
      this.form.submit();
    }
  });
</script>
