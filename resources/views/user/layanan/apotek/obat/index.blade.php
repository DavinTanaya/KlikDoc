@extends('layout')

@section('title', 'KlikDoc | Apotek Online')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/obat/styles.css') }}">
@endpush

@section('body')

  <div class="apotek-online">
    <div class="split-container">


      <aside class="split-sidebar">
        <div class="sidebar-header">
          <h2>Apotek<span class="dot">.</span></h2>
          <p>Obat asli, lengkap, dan terpercaya.</p>
        </div>


        <div class="sidebar-widget search-widget">
          <div class="input-icon-wrapper">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" placeholder="Cari obat, vitamin..." class="search-input" id="searchInput">
          </div>
        </div>


        <div class="sidebar-widget cart-widget">
          <div class="widget-header">
            <span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <path d="M16 10a4 4 0 0 1-8 0"></path>
              </svg> Keranjang Saya</span>
            <span class="badge">{{ $cartBadge }}</span>
          </div>
          <div class="cart-summary">
            <div class="cart-total">
              <small>Total Estimasi</small>
              <strong>Rp {{ number_format($totalEstimation, 0, ',', '.') }}</strong>
            </div>
            <a href="{{ route('apotek_keranjang') }}" style="text-decoration: none;" class="btn-cart">Lihat</a>
          </div>
        </div>


        <div class="sidebar-widget history-widget">
          <div class="widget-header">
            <span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
              </svg> Riwayat Pesanan</span>
          </div>
          <div class="history-list">

            @forelse ($recentOrders as $order)
              @php
                $firstItem = $order->items->first();
                $productName = $firstItem ? $firstItem->drug->name : 'Produk';

                if ($order->items->count() > 1) {
                    $productName .= ', dll.';
                }

                $badgeClass = match ($order->status) {
                    'SELESAI' => 'success',
                    'DIPROSES' => 'info',
                    'BELUM_BAYAR' => 'warning',
                    default => 'neutral',
                };
              @endphp

              <a href="{{ route('orders.detail', $order->order_code) }}" style="text-decoration: none;color:inherit;" class="history-item">
                <div class="history-info">
                  <span class="history-date">{{ $order->created_at->format('d M Y') }}</span>
                  <span class="history-name">{{ $productName }}</span>
                </div>

                <span class="status-pill {{ $badgeClass }}">
                  {{ ucfirst(strtolower(str_replace('_', ' ', $order->status))) }}
                </span>
              </a>

            @empty
              <p class="text-muted small">Belum ada pesanan.</p>
            @endforelse

          </div>

          <a href="{{ route('orders.history') }}" class="btn-history-more">Lihat Semua</a>

        </div>

        <hr class="sidebar-divider">

        <div class="sidebar-filters">
          <div class="filter-group">
            <h3>Kategori Obat</h3>

            @php
              $selectedCategories = (array) request()->get('kategori', []);
              $isAll = count($selectedCategories) === 0;
            @endphp

            <label class="checkbox-item">
              <input type="checkbox" class="cat-all" {{ $isAll ? 'checked' : '' }}>
              <span class="checkmark"></span>
              Semua
            </label>

            @foreach ($categories as $cat)
              <label class="checkbox-item">
                <input type="checkbox" class="cat-check" value="{{ $cat }}"
                  {{ in_array($cat, $selectedCategories) ? 'checked' : '' }}>
                <span class="checkmark"></span>
                {{ $cat }}
              </label>
            @endforeach


          </div>

          <div class="filter-group">
            <h3>Rentang Harga</h3>
            <div class="price-range">
              <input type="number" placeholder="Min" class="price-input" id="minPrice">
              <span>-</span>
              <input type="number" placeholder="Max" class="price-input" id="maxPrice">
            </div>
          </div>
        </div>

      </aside>

      <main class="split-content">
        <div class="content-header">
          <h1>Rekomendasi Kesehatan</h1>
          <div class="sort-wrapper">
            <span>Urutkan:</span>
            <select id="sortSelect">
              <option value="relevan">Paling Relevan</option>
              <option value="harga-terendah">Harga Terendah</option>
              <option value="harga-tertinggi">Harga Tertinggi</option>
            </select>
          </div>

        </div>

        <div class="product-grid">

          @foreach ($drugs as $drug)
            <div class="product-card" data-bs-toggle="modal" data-id="{{ $drug->id }}"
              data-bs-target="#productDetailModal" data-name="{{ $drug->name }}"
              data-unit="{{ $drug->short_description }}" data-price="{{ number_format($drug->price, 0, ',', '.') }}"
              data-category="{{ $drug->category }}"
              data-description="{{ $drug->description ?? 'Tidak ada deskripsi.' }}"
              data-dosage="{{ $drug->dosis ?? 'Tidak ada informasi dosis.' }}" data-type="{{ $drug->type ?? '-' }}"
              data-image="{{ $drug->image ? asset('images/drugs/' . $drug->image) : '' }}"
              data-submit-route="{{ route('apotek_keranjang.post', ['id' => $drug->id]) }}">

              <div class="product-image">
                <div class="tag-badge gray">
                  {{ $drug->category }}
                </div>

                <div class="img-placeholder">
                  @if ($drug->image)
                    <img src="{{ asset('images/drugs/' . $drug->image) }}" alt="{{ $drug->name }}" style="">
                  @else
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                      stroke-width="1">
                      <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                      <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                  @endif
                </div>
              </div>

              <div class="product-info">
                <h3>{{ $drug->name }}</h3>
                <p class="unit">{{ $drug->short_description }}</p>

                <div class="price-action">
                  <span class="price">Rp {{ number_format($drug->price, 0, ',', '.') }}</span>

                  <button class="btn-add">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                      stroke-width="2">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                  </button>
                </div>
              </div>

            </div>
          @endforeach

        </div>



        <div class="pagination-wrapper">
          {{ $drugs->links('pagination::bootstrap-4') }}
        </div>

      </main>
    </div>
  </div>


  <div class="modal fade" id="productDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content product-modal">
        <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>

        <div class="modal-body p-0">
          <div class="product-modal-grid">


            <div class="modal-img-wrapper">
              <div class="tag-badge big" id="modalCategoryBadge">Kategori</div>
              <img id="modalProductImage" src="" alt="Product" class="modal-img">
            </div>


            <div class="modal-info-wrapper">
              <h2 id="modalProductName"></h2>
              <p id="modalProductUnit"></p>
              <div class="modal-price" id="modalProductPrice"></div>

              <hr class="modal-divider">

              <div class="modal-details">
                <div class="detail-row">
                  <span class="label">Deskripsi</span>
                  <p class="value" id="modalProductDescription"></p>
                </div>

                <div class="detail-row">
                  <span class="label">Dosis</span>
                  <p class="value" id="modalProductDosage"></p>
                </div>

                <div class="detail-row">
                  <span class="label">Jenis</span>
                  <p class="value" id="modalProductType"></p>
                </div>
              </div>

              <div class="modal-actions">
                <div class="qty-selector">
                  <button class="qty-minus">-</button>
                  <input type="text" class="qty-input" value="1" readonly>
                  <button class="qty-plus">+</button>
                </div>

                <form id="addToCartForm" method="POST" action="">
                  @csrf
                  <input type="hidden" name="quantity" id="quantityField" value="1">
                  <button type="submit" class="btn-add-cart-modal">+ Keranjang</button>
                </form>
              </div>

            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

@endsection

@push('scripts')
  <script src="{{ asset('js/user/layanan/apotek/obat/scripts.js') }}"></script>
@endpush
