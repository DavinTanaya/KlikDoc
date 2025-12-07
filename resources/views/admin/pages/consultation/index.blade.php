@extends('admin.layout')

@section('title', 'Daftar Konsultasi')

@section('body')
  <div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <a href="{{ route('admin.index') }}" class="btn-back">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7" />
          </svg>
          Kembali
        </a>
        <h4 class="mb-0">Konsultasi Chat</h4>
        <small class="text-muted">
          Monitoring realtime konsultasi dokter & pasien
        </small>
      </div>
    </div>

    {{-- TABLE --}}
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>Pasien</th>
              <th>Dokter</th>
              <th>Status</th>
              <th>Metode</th>
              <th width="120">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($consultations as $c)
              <tr>
                <td>{{ $c->user->name }}</td>
                <td>{{ $c->doctor->full_name }}</td>
                <td>
                  <span class="badge {{ $c->status === 'AKTIF' ? 'bg-success' : 'bg-secondary' }}">
                    {{ $c->status }}
                  </span>
                </td>
                <td>{{ strtoupper($c->method) }}</td>
                <td>
                  @if ($c->chat)
                    <button class="btn btn-sm btn-outline-primary" onclick="openMonitor({{ $c->id }})">
                      Monitor
                    </button>
                  @else
                    <span class="text-muted small">No chat</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        {{ $consultations->links() }}
      </div>
    </div>
  </div>

  {{-- MODAL --}}
  <div class="modal fade" id="monitorModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Live Chat Monitor</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-0" id="monitorContent">
          <div class="text-muted p-4 text-center">
            Loading chat...
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.0/dist/echo.iife.js"></script>
  <script>
    window.Echo = new Echo({
      broadcaster: 'pusher',
      key: "{{ config('broadcasting.connections.pusher.key') }}",
      wsHost: "5.175.183.160",
      wsPort: 6001,
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

    function openMonitor(consultationId) {
      const modal = new bootstrap.Modal(
        document.getElementById('monitorModal')
      );

      document.getElementById('monitorContent').innerHTML =
        '<div class="text-center p-4 text-muted">Loading chat...</div>';

      fetch(`/admin/consultation/${consultationId}/monitor`)
        .then(res => res.text())
        .then(html => {
          document.getElementById('monitorContent').innerHTML = html;
          window.initAdminMonitor(consultationId);
        });

      modal.show();
    }
  </script>
@endpush
