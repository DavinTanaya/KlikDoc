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
</div>


<div class="row g-4">

  <div class="col-lg-8">
    <div class="card fade-in">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="d-flex align-items-center mb-0 gap-3">
          Daftar Produk

        </h5>

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


  <!-- PESANAN TERBARU (Biarkan dummy dulu) -->
  <div class="col-lg-4">
    <div class="card fade-in">
      <div class="card-header">
        <h5 class="mb-0">Pesanan Terbaru</h5>
      </div>
      <div class="card-body">
        <p class="text-muted">Integrasi pesanan belum dibuat.</p>
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
