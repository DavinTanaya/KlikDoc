@extends('layout')

@section('title', 'KlikDoc | Pengiriman & Pembayaran')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/apotek/payment/checkout.css') }}">
@endpush

@section('body')
    <div class="checkout-page">
        <header class="checkout-header">
            <div class="header-container">
                <a href="{{ route('apotek_keranjang') }}" class="btn-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <h1>Pengiriman & Pembayaran</h1>
                <div class="spacer"></div>
            </div>
        </header>

        <main class="checkout-content">
            <div class="checkout-container">
                <div class="checkout-scroll-area">
                    <div class="section-block">
                        <h2 class="section-title">Alamat Pengiriman</h2>
                        @if ($noAddress)
                            <div class="address-card empty-address">
                                <p>Anda belum memiliki alamat pengiriman.</p>
                                <button class="btn-address-action" data-bs-toggle="modal" data-bs-target="#addAddressModal"
                                    data-return-url="{{ url()->current() }}">
                                    Tambah Alamat Baru
                                </button>
                            </div>
                        @else
                            <div class="address-card">
                                <div class="address-icon">...</div>

                                <div class="address-details">
                                    <span class="label-home">{{ $defaultAddress->label }}</span>
                                    <h3>{{ $defaultAddress->recipient_name }} ({{ $defaultAddress->phone_number }})</h3>

                                    <p>
                                        {{ $defaultAddress->address_line }},
                                        {{ $defaultAddress->cityRelation->name }}
                                        {{ $defaultAddress->provinceRelation->name }}

                                        {{ $defaultAddress->zip_code }}
                                    </p>
                                </div>

                                <button class="btn-change" data-bs-toggle="modal" data-bs-target="#editAddressModal">
                                    Ubah
                                </button>
                            </div>
                        @endif

                        @if (!$noAddress)
                            <div class="address-actions">
                                <button class="btn-address-action" data-bs-toggle="modal"
                                    data-bs-target="#savedAddressModal">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    Pilih Alamat Lain
                                </button>
                                <button class="btn-address-action" data-bs-toggle="modal" data-bs-target="#addAddressModal"
                                    data-return-url="{{ url()->current() }}">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Tambah Alamat Baru
                                </button>
                            </div>
                        @else
                            <div class="address-actions">
                                <button class="btn-address-action" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Tambah Alamat Baru
                                </button>
                            </div>
                        @endif


                    </div>

                    <div class="divider"></div>

                    <div class="section-block">
                        <h2 class="section-title">Produk Dipesan</h2>
                        <div class="product-list">
                            @foreach ($cartItems as $item)
                                <div class="product-item">
                                    <div class="prod-img">
                                        @if ($item->drug->image)
                                            <img src="{{ asset('images/drugs/' . $item->drug->image) }}" height="30">
                                        @else
                                            <svg ...>...</svg>
                                        @endif
                                    </div>

                                    <div class="prod-info">
                                        <h4>{{ $item->drug->name }}</h4>
                                        <p>{{ $item->quantity }} x Rp {{ number_format($item->drug->price, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <div class="prod-total">
                                        Rp {{ number_format($item->quantity * $item->drug->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="divider"></div>

                    <div class="section-block">
                        <h2 class="section-title">Voucher & Pembayaran</h2>
                        <form action="{{ route('apotek.checkout.use_voucher') }}" method="POST" class="voucher-box w-100">
                            @csrf

                            <div class="input-group">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                    </path>
                                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                </svg>

                                <input type="text" name="voucher_code" class="form-control"
                                    placeholder="Masukkan kode voucher" required>
                            </div>

                            <button type="submit" class="btn-apply">
                                Pakai
                            </button>
                        </form>

                        @if (session('voucher'))
                            <div class="text-success small mt-2">
                                Voucher <strong>{{ session('voucher.code') }}</strong> digunakan
                                (-Rp {{ number_format(session('voucher.discount'), 0, ',', '.') }})
                            </div>
                        @endif

                        <div class="price-summary">
                            <div class="summary-row">
                                <span>Subtotal Produk</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>

                            <div class="summary-row">
                                <span>Biaya Pengiriman</span>
                                <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                            </div>

                            <div class="summary-row discount">
                                <span>Diskon Pengiriman</span>
                                <span>-Rp {{ number_format($shipping_discount, 0, ',', '.') }}</span>
                            </div>

                            @if ($voucher)
                                <div class="summary-row discount">
                                    <span>Voucher ({{ $voucher['code'] }})</span>
                                    <span>-Rp {{ number_format($voucher['discount'], 0, ',', '.') }}</span>
                                </div>
                            @endif


                            <div class="summary-row">
                                <span>Biaya Layanan</span>
                                <span>Rp {{ number_format($service_fee, 0, ',', '.') }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <footer class="checkout-footer">
                <div class="footer-container">
                    <div class="total-section">
                        <span class="label">Total Pembayaran</span>
                        <span class="amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <form action="{{ route('apotek.checkout.pay') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-pay">Bayar Sekarang</button>
                    </form>

                </div>
            </footer>
        </main>
    </div>
    @if (!$noAddress)
        <div class="modal fade" id="editAddressModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Alamat Pengiriman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('address.update', $defaultAddress->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Label Alamat</label>
                                <input type="text" name="label" class="form-control"
                                    value="{{ $defaultAddress->label }}" required>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Nama Penerima</label>
                                    <input type="text" name="recipient_name" class="form-control"
                                        value="{{ $defaultAddress->recipient_name }}" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">No. Telepon</label>
                                    <input type="text" name="phone_number" class="form-control"
                                        value="{{ $defaultAddress->phone_number }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="address_line" class="form-control" rows="3" required>{{ $defaultAddress->address_line }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Provinsi</label>
                                <select name="province" class="form-control" id="editProvinceSelect" required>
                                    @foreach ($provinces as $prov)
                                        <option value="{{ $prov->province_id }}"
                                            {{ $defaultAddress->provinceRelation && $defaultAddress->provinceRelation->province_id == $prov->province_id ? 'selected' : '' }}>
                                            {{ $prov->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <select name="city" class="form-control" id="editCitySelect" required>
                                    @foreach ($cities as $c)
                                        @if ($c->province_id == $defaultAddress->province)
                                            <option value="{{ $c->city_id }}"
                                                {{ $defaultAddress->cityRelation && $defaultAddress->cityRelation->city_id == $c->city_id ? 'selected' : '' }}>
                                                {{ $c->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" class="form-control" name="zip_code"
                                    value="{{ $defaultAddress->zip_code }}">
                            </div>

                        </div> 

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary"
                                style="background-color: #1C274C; border: none;">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="savedAddressModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Alamat Pengiriman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group">
                        @foreach ($addresses as $address)
                            <form action="{{ route('address.set_default') }}" method="POST" class="w-100">
                                @csrf
                                <input type="hidden" name="address_id" value="{{ $address->id }}">

                                <button type="submit" class="list-group-item list-group-item-action text-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="fw-bold mb-1">
                                            {{ $address->label }} ({{ $address->recipient_name }})

                                            @if ($defaultAddress->id === $address->id)
                                                <span class="badge bg-primary ms-2">Utama</span>
                                            @endif
                                        </h6>
                                        <small>{{ $address->phone_number }}</small>
                                    </div>

                                    <p class="small mb-1">
                                        {{ $address->address_line }},
                                        {{ $address->cityRelation->name }},
                                        {{ $address->provinceRelation->name }}
                                    </p>
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Alamat Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('address.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="return_url" id="returnUrlInput">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Label Alamat</label>
                            <input type="text" class="form-control" name="label" placeholder="Rumah / Kantor"
                                required>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Nama Penerima</label>
                                <input type="text" class="form-control" name="recipient_name" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" class="form-control" name="phone_number" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="address_line" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <select name="province" class="form-control" id="addProvinceSelect" required>
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $prov)
                                    <option value="{{ $prov->province_id }}">
                                        {{ $prov->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <select name="city" class="form-control" id="addCitySelect" required>
                                <option value="">Pilih Kota</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" name="zip_code">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"
                            style="background-color: #1C274C; border: none;">Simpan
                            Alamat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let allCities = @json($cities);

            function populateCities(provinceId, citySelect, selectedCity = null) {
                citySelect.innerHTML = "";

                if (!provinceId) {
                    citySelect.innerHTML = `<option value="">Pilih Kota</option>`;
                    return;
                }

                const filtered = allCities.filter(c => String(c.province_id) === String(provinceId));

                if (filtered.length === 0) {
                    citySelect.innerHTML = `<option value="">Tidak ada kota</option>`;
                    return;
                }

                filtered.forEach(c => {
                    const option = document.createElement("option");
                    option.value = c.city_id;
                    option.textContent = c.name;
                    if (selectedCity && Number(selectedCity) === Number(c.city_id)) {
                        option.selected = true;
                    }

                    citySelect.appendChild(option);
                });
            }

            const editProv = document.getElementById("editProvinceSelect");
            const editCity = document.getElementById("editCitySelect");

            const defaultProvince = "{{ $defaultAddress->provinceRelation->province_id ?? '' }}";
            const defaultCity = "{{ $defaultAddress->cityRelation->city_id ?? '' }}";


            if (editProv && editCity && defaultProvince !== "") {
                populateCities(defaultProvince, editCity, defaultCity);
                editProv.addEventListener("change", function() {
                    populateCities(this.value, editCity);
                });
            }
            const addProv = document.getElementById("addProvinceSelect");
            const addCity = document.getElementById("addCitySelect");

            if (addProv && addCity) {
                addProv.addEventListener("change", function() {
                    populateCities(this.value, addCity);
                });
            }
            const addAddressBtn = document.querySelector("[data-return-url]");
            const returnUrlInput = document.getElementById("returnUrlInput");

            addAddressBtn.addEventListener("click", function() {
                returnUrlInput.value = this.dataset.returnUrl;
            });
        });
    </script>
@endpush
