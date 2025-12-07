@extends('layout')

@section('title', $service->name . ' - KlikHome')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/layanan/klik-home/service/detail.css') }}">
@endpush

@section('body')
  <div class="klikhome-detail-page">
    <div class="detail-container">

      {{-- BACK --}}
      <div class="top-nav">
        <a href="{{ route('klik-home') }}" class="btn-back">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
          </svg>
          Kembali ke Daftar Layanan
        </a>
      </div>

      <div class="content-grid">

        {{-- ================= LEFT ================= --}}
        <div class="main-content">
          {{-- HERO --}}
          <div class="service-hero-image bg-orange-light">
            <div class="hero-icon">
              {!! $service->icon_svg ?? '' !!}
            </div>
            <span class="category-badge">{{ $service->category }}</span>
          </div>

          {{-- TITLE --}}
          <header class="service-header">
            <h1>{{ $service->name }}</h1>

            <div class="service-meta-row">
              <div class="meta-item">
                <div class="icon-box">⏱</div>
                <span>{{ $service->duration_minutes }} Menit</span>
              </div>
              <div class="meta-item">
                <div class="icon-box">👩‍⚕️</div>
                <span>{{ $service->handled_by }}</span>
              </div>
              <div class="meta-item">
                <div class="icon-box">🛡</div>
                <span>Alat Steril</span>
              </div>
            </div>
          </header>

          <hr class="divider">

          {{-- ABOUT --}}
          <div class="info-section">
            <h3>Tentang Layanan</h3>
            <p>{{ $service->description }}</p>
          </div>

          {{-- BENEFITS --}}
          @if ($service->benefits)
            <div class="info-section">
              <h3>Manfaat Utama</h3>
              <ul class="check-list">
                @foreach ($service->benefits as $b)
                  <li>{{ $b }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {{-- INCLUSIONS --}}
          @if ($service->inclusions)
            <div class="info-section">
              <h3>Yang Termasuk Dalam Paket</h3>
              <div class="inclusion-card">
                @foreach ($service->inclusions as $inc)
                  <div class="inc-item">
                    <span class="dot"></span> {{ $inc }}
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          {{-- SAFETY --}}
          @if ($service->safety_notes)
            <div class="info-section">
              <h3>Prosedur Keamanan</h3>
              <div class="safety-box">
                @foreach ($service->safety_notes as $safe)
                  <div class="safety-item">
                    <strong>{{ $safe['title'] }}</strong>
                    <p>{{ $safe['desc'] }}</p>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

        </div>

        {{-- ================= RIGHT ================= --}}
        <div class="booking-sidebar">
          <div class="booking-card">

            <div class="price-header">
              <span class="label">Total Biaya</span>
              <span class="price">
                Rp {{ number_format($service->price + $service->service_fee, 0, ',', '.') }}
              </span>
            </div>

            {{-- ADDRESS SECTION (APOTEK-STYLE) --}}
            <div class="booking-form">

              {{-- Normalisasi variabel kalau controller belum kirim --}}
              @php
                $addresses =
                    $addresses ??
                    auth()
                        ->user()
                        ->addresses()
                        ->with(['provinceRelation', 'cityRelation'])
                        ->get();
                $noAddress = $noAddress ?? $addresses->isEmpty();
                $defaultAddress = $defaultAddress ?? ($addresses->firstWhere('is_active', true) ?? $addresses->first());
              @endphp

              <div class="form-group">
                <label>Alamat Kunjungan</label>

                @if ($noAddress)
                  {{-- Tidak ada alamat sama sekali --}}
                  <div class="address-card empty-address">
                    <p>Anda belum memiliki alamat kunjungan.</p>
                    <button class="btn-add-address" data-bs-toggle="modal" data-bs-target="#addAddressModal"
                      data-return-url="{{ url()->current() }}">
                      Tambah Alamat Baru
                    </button>
                  </div>
                @else
                  {{-- Ada alamat default --}}
                  <div class="address-card">
                    <div class="address-icon">
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                      </svg>
                    </div>

                    <div class="address-details">
                      <span class="label-home">{{ $defaultAddress->label }}</span>
                      <h3>{{ $defaultAddress->recipient_name }} ({{ $defaultAddress->phone_number }})</h3>
                      <p>
                        {{ $defaultAddress->address_line }},
                        {{ $defaultAddress->cityRelation->name ?? '' }},
                        {{ $defaultAddress->provinceRelation->name ?? '' }}
                        {{ $defaultAddress->zip_code }}
                      </p>
                    </div>

                    <button class="btn-change" data-bs-toggle="modal" data-bs-target="#editAddressModal">
                      Ubah
                    </button>
                  </div>

                  {{-- Tombol tambahan: pilih lain / tambah baru --}}
                  <div class="address-actions mt-2">
                    <button class="btn-address-action" data-bs-toggle="modal" data-bs-target="#savedAddressModal">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                      </svg>
                      Pilih Alamat Lain
                    </button>

                    <button class="btn-address-action" data-bs-toggle="modal" data-bs-target="#addAddressModal"
                      data-return-url="{{ url()->current() }}">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                      </svg>
                      Tambah Alamat Baru
                    </button>
                  </div>
                @endif
              </div>

              {{-- DATE --}}
              <div class="form-group">
                <label>Jadwal Kunjungan</label>
                <input type="date" name="scheduled_date" id="visitDate" class="form-control" min="{{ date('Y-m-d') }}"
                  required>

              </div>

              {{-- TIME --}}
              @php
                $timeSlots = $service->time_slots ?: [
                    '09:00 - 10:00',
                    '10:00 - 11:00',
                    '11:00 - 12:00',
                    '13:00 - 14:00',
                    '14:00 - 15:00',
                    '15:00 - 16:00',
                ];
              @endphp
              <div class="form-group">
                <label>Waktu</label>
                <select name="scheduled_time" id="visitTime" class="form-control" required>

                  @foreach ($timeSlots as $t)
                    <option>{{ $t }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <hr class="card-divider">

            <div class="summary-row">
              <span>Harga Layanan</span>
              <span>Rp {{ number_format($service->price, 0, ',', '.') }}</span>
            </div>

            <div class="summary-row">
              <span>Biaya Layanan</span>
              <span>Rp {{ number_format($service->service_fee, 0, ',', '.') }}</span>
            </div>

            <div class="summary-row total">
              <span>Total Bayar</span>
              <span>Rp {{ number_format($service->price + $service->service_fee, 0, ',', '.') }}</span>
            </div>

            @if ($noAddress)
              <button class="btn-payment btn-payment-disabled" disabled>
                Lanjut Pembayaran
              </button>
            @else
              <form id="klikhomePayForm" action="{{ route('klikhome.pay', $service->slug) }}" method="POST">
                @csrf

                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <input type="hidden" name="address_id" value="{{ $defaultAddress?->id }}">
                <input type="hidden" name="scheduled_date" id="visitDateInput">
                <input type="hidden" name="scheduled_time" id="visitTimeInput">

                <button type="submit" class="btn-payment">
                  Lanjut Pembayaran
                </button>
              </form>
            @endif
          </div>
        </div>

      </div>
    </div>
  </div>

  {{-- ================= MODALS SECTION (PERSIS APOTEK) ================= --}}

  {{-- 1. Modal Edit Alamat --}}
  @if (!$noAddress)
    <div class="modal fade" id="editAddressModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title">Ubah Alamat Kunjungan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <form action="{{ route('address.update', $defaultAddress->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-body">

              <div class="mb-3">
                <label class="form-label">Label Alamat</label>
                <input type="text" name="label" class="form-control" value="{{ $defaultAddress->label }}"
                  required>
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
                    @if ($defaultAddress->provinceRelation && $c->province_id == $defaultAddress->provinceRelation->province_id)
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
                <input type="text" class="form-control" name="zip_code" value="{{ $defaultAddress->zip_code }}">
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" style="background-color:#1C274C;border:none;">
                Simpan Perubahan
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>
  @endif

  {{-- 2. Modal Pilih Alamat Tersimpan --}}
  @if (!$noAddress)
    <div class="modal fade" id="savedAddressModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title">Pilih Alamat Kunjungan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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

                        @if ($defaultAddress && $defaultAddress->id === $address->id)
                          <span class="badge bg-primary ms-2">Utama</span>
                        @endif
                      </h6>
                      <small>{{ $address->phone_number }}</small>
                    </div>

                    <p class="small mb-1">
                      {{ $address->address_line }},
                      {{ $address->cityRelation->name ?? '' }},
                      {{ $address->provinceRelation->name ?? '' }}
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
  @endif

  {{-- 3. Modal Tambah Alamat Baru --}}
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
              <input type="text" class="form-control" name="label" placeholder="Rumah / Kantor" required>
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
                  <option value="{{ $prov->province_id }}">{{ $prov->name }}</option>
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
            <button type="submit" class="btn btn-primary" style="background-color:#1C274C;border:none;">
              Simpan Alamat
            </button>
          </div>

        </form>

      </div>
    </div>
  </div>

@endsection

@push('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      let allCities = @json($cities ?? []);

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
          option.value = c.city_id; // penting: city_id
          option.textContent = c.name;

          if (selectedCity && Number(selectedCity) === Number(c.city_id)) {
            option.selected = true;
          }

          citySelect.appendChild(option);
        });
      }

      // EDIT MODAL
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

      // ADD MODAL
      const addProv = document.getElementById("addProvinceSelect");
      const addCity = document.getElementById("addCitySelect");

      if (addProv && addCity) {
        addProv.addEventListener("change", function() {
          populateCities(this.value, addCity);
        });
      }

      // set return_url dari tombol yang punya data-return-url
      const returnUrlInput = document.getElementById("returnUrlInput");
      document.querySelectorAll("[data-return-url]").forEach(btn => {
        btn.addEventListener("click", function() {
          if (returnUrlInput) {
            returnUrlInput.value = this.dataset.returnUrl;
          }
        });
      });
      document.getElementById("klikhomePayForm")
        .addEventListener("submit", function() {

          document.getElementById("visitDateInput").value =
            document.getElementById("visitDate").value;

          document.getElementById("visitTimeInput").value =
            document.getElementById("visitTime").value;
        });

    });
  </script>
@endpush
