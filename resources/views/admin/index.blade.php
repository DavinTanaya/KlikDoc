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

  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.0/dist/echo.iife.js"></script>
  <script>
    window.initAdminMonitor = function(chatId) {

      console.log('[ADMIN MONITOR] INIT', chatId);

      const container = document.getElementById('messageContainer');
      if (!container) return console.warn('messageContainer not found');

      window.Echo.private('chats.' + chatId)
        .listen('.new-message', e => {
          console.log('[ADMIN MONITOR] new message', e.message);

          if (e.message.type === 'system') return;

          container.insertAdjacentHTML('beforeend', `
        <div class="mb-3">
          <div class="small text-muted">
            ${e.message.sender?.name ?? 'System'}
          </div>
          <div class="bg-light rounded p-2">
            ${e.message.body}
          </div>
        </div>
      `);

          container.scrollTop = container.scrollHeight;
        });
    }

    window.Echo = new Echo({
      broadcaster: 'pusher',
      key: "{{ config('broadcasting.connections.pusher.key') }}",
      wsHost: "ws.klikdoc.online",
      wsPort: 443,
      forceTLS: false,
      encrypted: false,
      disableStats: true,
      authEndpoint: "/broadcasting/auth",
      auth: {
        headers: {
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
      },
    });

    let onlineUsers = {};
    let onlineDoctors = {};

    window.Echo.join('presence.online')
      .here((users) => {
        console.log("[ONLINE] Current:", users);
        onlineUsers = {};
        onlineDoctors = {};
        users.forEach(u => {
          if (u.role === 'doctor') {
            onlineDoctors[u.id] = u;
          } else {
            onlineUsers[u.id] = u;
          }
        });
        updateOnlineDoctorCount();
      })
      .joining((user) => {
        console.log("[ONLINE] User joined:", user);
        if (user.role === 'doctor') {
          onlineDoctors[user.id] = user;
        } else {
          onlineUsers[user.id] = user;
        }
        updateOnlineDoctorCount();
      })
      .leaving((user) => {
        console.log("[ONLINE] User left:", user);
        delete onlineUsers[user.id];
        delete onlineDoctors[user.id];
        updateOnlineDoctorCount();
      });


    function updateOnlineDoctorCount() {
      const el = document.getElementById("doctorOnlineCount");
      if (!el) return console.log("No element with id doctorOnlineCount found.");
      const count = Object.keys(onlineDoctors).length;
      el.innerText = count;
    }

    function openMonitor(consultationId) {

      document.getElementById('monitorContent').innerHTML = `
    <div class="text-muted py-5 text-center">
      Loading chat...
    </div>
  `;

      fetch(`/admin/consultation/${consultationId}/monitor`)
        .then(res => res.text())
        .then(html => {
          document.getElementById('monitorContent').innerHTML = html;
          window.initAdminMonitor(consultationId);
        })
        .catch(() => {
          document.getElementById('monitorContent').innerHTML = `
        <div class="text-danger py-5 text-center">
          Gagal memuat chat
        </div>
      `;
        });

      monitorModal.show();
    }
  </script>
@endpush
