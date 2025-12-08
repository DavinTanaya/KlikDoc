@extends('layout')

@section('title', 'KlikDoc | Keranjang Saya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/payment/cart.css') }}">
@endpush

@section('body')
    <div class="cart-page">
        <header class="cart-header">
            <div class="header-container">
                <a href="{{ route('apotek') }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <h1>Keranjang Saya</h1>
                <div class="spacer"></div>
            </div>
        </header>

        <main class="cart-content">
            <div class="cart-container">

                <div class="cart-actions-bar">
                    <form id="deleteSelectedForm" action="{{ route('apotek_keranjang.delete_selected') }}" method="POST"
                        style="display:none;">
                        @csrf
                        <input type="hidden" name="ids" id="deleteSelectedIds">
                    </form>

                    <label class="custom-checkbox">
                        <input type="checkbox" id="selectAllCheckbox">
                        <span class="checkmark"></span>
                        <span class="label-text">Pilih Semua ({{ $cartBadge }} Item)</span>
                    </label>
                    <button class="btn-delete-selected" type="button">Hapus</button>
                </div>

                <div class="cart-items-list">
                    @if ($cartItems->isEmpty())
                        <div class="empty-cart">
                            <p class="text-center">Keranjang Anda kosong.</p>
                        </div>
                    @else
                        @foreach ($cartItems as $item)
                            @php
                                $drug = $item->drug;
                                $isUnavailable = !$drug->is_active || $drug->stock < $item->quantity;
                            @endphp

                            <div class="cart-item {{ $isUnavailable ? 'unchecked-item' : '' }}">

                                <div class="item-select">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" class="item-checkbox" data-id="{{ $item->id }}">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="item-image cart-image">
                                    @if ($drug->image)
                                        <img src="{{ asset('images/drugs/' . $drug->image) }}" alt="{{ $drug->name }}">
                                    @else
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                                            stroke-width="1">
                                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2">
                                            </rect>
                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                        </svg>
                                    @endif
                                </div>

                                <div class="item-details">
                                    <div class="item-info">
                                        <h3>{{ $drug->name }}</h3>
                                        <p class="unit">{{ $drug->short_description }}</p>

                                        @if (!$drug->is_active)
                                            <span class="stock-warning">Produk tidak aktif</span>
                                        @elseif($drug->stock < $item->quantity)
                                            <span class="stock-warning">Stok tidak mencukupi</span>
                                        @endif

                                        <div class="price">Rp {{ number_format($drug->price, 0, ',', '.') }}</div>
                                    </div>

                                    <div class="item-actions">

                                        <form action="{{ route('apotek_keranjang.delete', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-trash"> <svg width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg> </button>
                                        </form>

                                        <div class="qty-control">
                                            <form action="{{ route('apotek_keranjang.update', $item->id) }}" method="POST"
                                                class="qty-form">
                                                @csrf
                                                @method('PATCH')

                                                <button class="btn-qty minus" type="button"
                                                    @if ($isUnavailable) disabled @endif>-</button>

                                                <input type="text" value="{{ $item->quantity }}" readonly
                                                    class="qty-input">

                                                <input type="hidden" name="quantity" class="qty-hidden"
                                                    value="{{ $item->quantity }}">

                                                <button class="btn-qty plus" type="button"
                                                    @if ($isUnavailable) disabled @endif>+</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif

                </div>

            </div>
        </main>

        <footer class="cart-footer">
            <div class="footer-container">
                <div class="total-section">
                    <span class="label">Total Pembayaran</span>
                    <span class="amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <button class="btn-checkout">
                    Bayar Sekarang (<span id="checkedCount">0</span>)
                </button>
                <form id="checkoutForm" action="{{ route('apotek.checkout') }}" method="GET" style="display:none;">
                    @csrf
                    <input type="hidden" name="ids" id="checkoutSelectedIds">
                </form>

            </div>
        </footer>
    </div>
@endsection

@push('scripts')
    @if ($cartItems->isNotEmpty())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const btnDeleteSelected = document.querySelector(".btn-delete-selected");
                const deleteSelectedForm = document.getElementById("deleteSelectedForm");
                const deleteSelectedIdsInput = document.getElementById("deleteSelectedIds");

                btnDeleteSelected.addEventListener("click", function() {
                    const checkedBoxes = document.querySelectorAll(".item-checkbox:checked");
                    if (checkedBoxes.length === 0) {
                        alert("Tidak ada item yang dipilih.");
                        return;
                    }

                    let ids = [];
                    checkedBoxes.forEach(cb => ids.push(cb.dataset.id));

                    deleteSelectedIdsInput.value = JSON.stringify(ids);
                    deleteSelectedForm.submit();
                });


                document.querySelectorAll(".qty-form").forEach(form => {
                    const minusBtn = form.querySelector(".minus");
                    const plusBtn = form.querySelector(".plus");
                    const qtyInput = form.querySelector(".qty-input");
                    const hiddenInput = form.querySelector(".qty-hidden");

                    minusBtn.addEventListener("click", function() {
                        let qty = parseInt(qtyInput.value);
                        if (qty > 1) qty--;
                        qtyInput.value = qty;
                        hiddenInput.value = qty;
                        form.submit();
                    });

                    plusBtn.addEventListener("click", function() {
                        let qty = parseInt(qtyInput.value);

                        if (qty >= {{ $drug->stock }}) {
                            alert("Stok tidak mencukupi. Maksimum stok: " + maxStock);
                            return;
                        }

                        qty++;
                        qtyInput.value = qty;
                        hiddenInput.value = qty;
                        form.submit();
                    });
                });
                const selectAll = document.getElementById("selectAllCheckbox");
                const itemCheckboxes = document.querySelectorAll(".item-checkbox");
                const checkoutCount = document.getElementById("checkedCount");

                function updateCheckoutCount() {
                    const count = document.querySelectorAll(".item-checkbox:checked").length;
                    checkoutCount.textContent = count;
                }

                selectAll.addEventListener("change", function() {
                    const check = selectAll.checked;

                    itemCheckboxes.forEach(cb => {
                        cb.checked = check;
                    });

                    updateCheckoutCount();
                });

                itemCheckboxes.forEach(cb => {
                    cb.addEventListener("change", function() {
                        const total = itemCheckboxes.length;
                        const checked = document.querySelectorAll(".item-checkbox:checked").length;

                        selectAll.checked = (checked === total);

                        if (checked !== total) {
                            selectAll.checked = false;
                        }

                        updateCheckoutCount();
                    });
                });
                const checkoutBtn = document.querySelector(".btn-checkout");
                const checkoutForm = document.getElementById("checkoutForm");
                const checkoutSelectedIds = document.getElementById("checkoutSelectedIds");

                checkoutBtn.addEventListener("click", function() {
                    const checkedBoxes = document.querySelectorAll(".item-checkbox:checked");

                    if (checkedBoxes.length === 0) {
                        alert("Pilih minimal satu produk untuk checkout.");
                        return;
                    }

                    let ids = [];
                    checkedBoxes.forEach(cb => ids.push(cb.dataset.id));

                    checkoutSelectedIds.value = JSON.stringify(ids);
                    checkoutForm.submit();
                });

            });
        </script>
    @endif
@endpush
