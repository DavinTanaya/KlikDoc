@extends('admin.layout')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/admin/styles.css') }}">
@endsection

@section('body')

  <body>
    <div class="d-flex" id="wrapper">
      @include('admin.components.sidebar')

      <div id="page-content-wrapper" class="w-100">
        @include('admin.components.navbar')

        <div class="container-fluid p-4" id="content">
        </div>
      </div>
    </div>


    <div class="modal fade" id="detailModal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailModalTitle">Detail</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body" id="detailModalBody">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="formModal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="formModalTitle">Form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body" id="formModalBody">
            <!-- Form will be loaded here -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="saveFormBtn">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="monitorModal" tabindex="-1">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Monitor Konsultasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body" id="monitorModalBody">
            <!-- Monitor view will be loaded here -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body" id="confirmModalBody">
            Apakah Anda yakin?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger" id="confirmBtn">Hapus</button>
          </div>
        </div>
      </div>
    </div>

  </body>
@endsection

@push('scripts')
  <script src="{{ asset('js/admin/script.js') }}"></script>
  <script src="{{ asset('js/admin/button-handlers.js') }}"></script>
  <script src="{{ asset('js/admin/modal-handlers.js') }}"></script>
  <script src="{{ asset('js/admin/modals.js') }}"></script>
@endpush
