@extends('dokter.layout')

@section('title', 'KlikDoc | Chat Dokter')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/dokter/chat/styles.css') }}">
  <style>
    .chat-card.referral {
      background: #f0fdf4;
      border: 1px solid #86efac;
      border-radius: 12px;
      padding: 12px 14px;
      max-width: 340px;
      font-size: 13px;
    }

    .referral-header {
      font-weight: 700;
      color: #065f46;
      margin-bottom: 6px;
    }

    .referral-body p {
      margin: 2px 0;
      color: #064e3b;
    }

    .referral-actions {
      margin-top: 8px;
      text-align: right;
    }

    .btn-rujukan {
      background: #10b981;
      border: none;
      border-radius: 999px;
      padding: 4px 10px;
      font-size: 12px;
      font-weight: 600;
      color: white;
      cursor: pointer;
    }

    .btn-rujukan:hover {
      background: #059669;
    }

    #remoteAudio {
      width: 1px;
      height: 1px;
      opacity: 0;
    }
  </style>
@endpush

@section('body')
  <div class="dokter-chat">

    <div class="chat-wrapper">
      <div class="app-container" id="appContainer">
        <aside class="sidebar">
          <div class="sidebar-header">
            <div class="sidebar-header-left">
              <a href="{{ route('dokter.dashboard') }}" class="btn-home-back">
                <i class="fas fa-arrow-left"></i>
              </a>
              <h2 class="sidebar-title">Chats</h2>
            </div>
          </div>

          <div class="search-box">
            <div class="search-input-wrapper">
              <i class="fas fa-search"></i>
              <input type="text" placeholder="Cari pasien...">
            </div>
          </div>

          <ul class="chat-list">
            @foreach ($chats as $chat)
              @php
                $isActive = $activechat && $activechat->id === $chat->id;
                $partner = $chat->user;
                $last = $chat->messages->first();
              @endphp

              <li class="chat-item {{ $isActive ? 'active' : '' }}"
                onclick="selectChat(this, {{ $chat->id }}, '{{ $partner->name }}')">

                <div class="avatar-container">
                  <img class="avatar" src="https://ui-avatars.com/api/?name={{ urlencode($partner->name) }}">
                </div>

                <div class="chat-info">
                  <div class="chat-header-info">
                    <span class="chat-name">{{ $partner->name }}</span>
                    <span class="chat-time">
                      {{ optional($last)->created_at?->format('H:i') }}
                    </span>
                  </div>
                  <div class="chat-preview">
                    {{ Str::limit(optional($last)->body, 28) }}
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </aside>
        <main class="chat-area">
          <header class="chat-room-header">
            <div class="header-left">
              <button class="btn-back" onclick="closeChat()">
                <i class="fas fa-arrow-left"></i>
              </button>

              @php $partner = $activechat?->user; @endphp
              <div class="header-profile">
                <img class="avatar header-avatar"
                  src="https://ui-avatars.com/api/?name={{ urlencode($partner->name ?? 'Chat') }}">
                <div>
                  <h6 class="header-name" id="headerName">{{ $partner->name ?? 'Chat' }}</h6>
                  <small class="header-status" id="headerStatus">Online</small>
                </div>
              </div>
            </div>

            <div class="header-actions">
              <i class="fas fa-phone-alt" onclick="startCall('audio')"></i>
              <i class="fas fa-video" onclick="startCall('video')"></i>
            </div>
          </header>

          <div id="chatStatusBar"
            class="chat-status-bar {{ $activechat?->consultation->status === 'AKTIF' ? 'status-active' : 'status-closed' }}">
            <div class="staus-content">
              <span id="statusIcon"><i class="fas fa-clock"></i></span>
              <span id="statusText">
                {{ $activechat?->consultation->status === 'AKTIF'
                    ? 'Sesi konsultasi sedang berlangsung'
                    : 'Sesi konsultasi telah selesai' }}
              </span>
            </div>

            @if ($activechat?->consultation->status === 'AKTIF')
              <div class="doctor-controls" id="doctorControls">
                <button class="btn-doc-action btn-resep" onclick="openPrescriptionModal()">
                  <i class="fas fa-prescription-bottle-alt"></i> Resep
                </button>

                <button class="btn-doc-action btn-rujukan" onclick="openReferralModal()">
                  <i class="fas fa-hospital"></i> Rujukan
                </button>

                <button class="btn-doc-action btn-selesai"
                  onclick="finishConsultation({{ $activechat->consultation_id }})">
                  <i class="fas fa-check-circle"></i> Selesai
                </button>
              </div>
            @endif
          </div>

          <div class="messages-container" id="messageContainer">
            @foreach ($messages as $msg)
              <div class="message-row {{ $msg->sender_id === $authUser->id ? 'sent' : 'received' }}">
                <div class="bubble">
                  {{ $msg->body }}
                  <span class="bubble-time">{{ $msg->created_at->format('H:i') }}</span>
                </div>
              </div>
            @endforeach
          </div>

          <div id="callContainer" class="call-container" style="display:none">
            <div class="video-wrapper" id="videoWrapper">
              <video class="video-local" id="localVideo" autoplay muted playsinline></video>
              <video class="video-remote" id="remoteVideoUser" autoplay playsinline></video>
              <video class="video-remote" id="remoteVideoDoctor" autoplay playsinline style="display: none;"></video>
            </div>
            <audio id="remoteAudio" autoplay></audio>
            <div class="audio-wrapper" id="audioWrapper">
              <img id="incomingCallAvatar"
                src="https://ui-avatars.com/api/?name={{ urlencode($activechat?->user->name ?? ($activechat?->user->name ?? 'Chat')) }}"
                alt="Caller avatar">
            </div>
            <div class="call-controls">
              <button class="btn btn-danger btn-sm" onclick="hangupCall()">
                End Call
              </button>
            </div>
          </div>

          <footer class="input-area {{ $activechat?->consultation->status !== 'AKTIF' ? 'closed' : '' }}">
            <div id="inputWrapperActive" class="input-wrapper-active"
              style="{{ $activechat?->consultation->status !== 'AKTIF' ? 'display:none' : '' }}">
              <input type="text" id="msgInput" class="chat-input" placeholder="Ketik pesan..."
                onkeypress="handleEnter(event)">
              <button class="btn-send" onclick="sendChat()">
                <i class="fas fa-paper-plane"></i>
              </button>
            </div>

            <div id="inputClosedMessage" class="input-closed-message"
              style="{{ $activechat?->consultation->status === 'AKTIF' ? 'display:none' : '' }}">
              <i class="fas fa-lock"></i> Sesi konsultasi sudah selesai
            </div>

          </footer>
        </main>

      </div>
    </div>

    <div id="incomingCallModal" class="incoming-call-backdrop">
      <div class="incoming-call-box">
        <div class="incoming-call-title">Panggilan Masuk</div>
        <div id="incomingCallSubtitle">Dokter memanggil Anda</div>
        <div class="incoming-call-actions">
          <button onclick="rejectIncomingCall()">Tolak</button>
          <button onclick="acceptIncomingCall()">Terima</button>
        </div>
      </div>
    </div>

    <div id="prescriptionModal" class="modal-overlay">
      <div class="modal-box">
        <div class="modal-header">
          <span class="modal-title">Buat Resep Dokter</span>
          <span class="close-modal" onclick="closePrescriptionModal()">&times;</span>
        </div>
        <div class="modal-body">

          <input type="hidden" id="consultationId" value="{{ $activechat?->consultation_id }}">

          <div class="form-group">
            <label>Diagnosis</label>
            <input type="text" id="diagnosis">
          </div>

          <div class="form-group">
            <label>Cari Obat</label>
            <input type="text" id="drugSearch" oninput="searchDrug(this.value)">
            <ul id="drugResult" class="drug-result-list"></ul>
          </div>

          <div class="form-group">
            <label>Daftar Obat</label>
            <div id="selectedDrugList"></div>
          </div>

          <div class="form-group">
            <label>Catatan</label>
            <textarea id="notes"></textarea>
          </div>

          <button class="btn-submit-resep" onclick="submitPrescription()">
            Simpan Resep
          </button>

        </div>
      </div>
    </div>

    <div id="referralModal" class="modal-overlay">
      <div class="modal-box">
        <div class="modal-header">
          <span class="modal-title">Buat Surat Rujukan</span>
          <span class="close-modal" onclick="closeReferralModal()">&times;</span>
        </div>

        <div class="modal-body">
          <input type="hidden" id="refConsultationId" value="{{ $activechat?->consultation_id }}">

          <div class="form-group">
            <label>Rumah Sakit Tujuan</label>
            <input type="text" id="refDestination">
          </div>

          <div class="form-group">
            <label>Poli Spesialis</label>
            <input type="text" id="refDepartment">
          </div>

          <div class="form-group">
            <label>Alasan Rujukan</label>
            <textarea id="refReason" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>Catatan Tambahan</label>
            <textarea id="refNotes" rows="3"></textarea>
          </div>

          <button class="btn-submit-resep" onclick="submitReferral()">
            Kirim Rujukan
          </button>
        </div>
      </div>
    </div>


  </div>
@endsection


@push('scripts')
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.0/dist/echo.iife.js"></script>

  <script>
    console.log('[DOKTER] chat + call script loaded');

    const appContainer = document.getElementById('appContainer');
    const msgContainer = document.getElementById('messageContainer');

    const authUserId = {{ $authUser->id }};
    const authRole = "{{ $authUser->role }}";
    let activeChatId = {{ $activechat?->id ?? 'null' }};
    let chatUserId = null;
    let chatDoctorId = null;

    let chatChannel = null;
    let subscribedChatId = null;
    console.table({
      authUserId,
      authRole,
      activeChatId,
      chatUserId,
      chatDoctorId
    });

    window.Echo = new Echo({
      broadcaster: "pusher",
      key: "{{ config('broadcasting.connections.pusher.key') }}",
      wsHost: "ws.klikdoc.online",
      wsPort: 443,
      forceTLS: false,
      encrypted: false,
      disableStats: true,
      enabledTransports: ["ws"],
      authEndpoint: "/broadcasting/auth",
      auth: {
        headers: {
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
      }
    });

    const pusherConn = window.Echo.connector.pusher.connection;

    pusherConn.bind("state_change", (states) => {
      console.log("[ECHO] state:", states.previous, "→", states.current);
    });

    pusherConn.bind("connected", () => {
      console.log("%c[ECHO] CONNECTED (dokter)", "color:#22c55e;font-weight:bold");
      if (activeChatId) {
        subscribeChat(activeChatId);
        subscribeCall(activeChatId);
      }
    });

    pusherConn.bind("error", (err) => console.error("[ECHO] ERROR:", err));
    pusherConn.bind("failed", (err) => console.error("[ECHO] FAILED:", err));

    window.selectChat = function(el, chatId, partnerName) {
      document.querySelectorAll('.chat-item').forEach(i => i.classList.remove('active'));
      el.classList.add('active');

      const headerName = document.getElementById('headerName');
      if (headerName) headerName.innerText = partnerName;

      activeChatId = chatId;

      subscribeChat(chatId);
      subscribeCall(chatId);

      fetch(`/chat-dokter/messages/${chatId}`)
        .then(res => res.json())
        .then(data => {
          chatUserId = data.user_id;
          chatDoctorId = data.doctor_id;

          console.table({
            '[CHAT CONTEXT UPDATED]': activeChatId,
            chatUserId,
            chatDoctorId
          });

          msgContainer.innerHTML = '';
          data.messages.forEach(m => {
            appendMessage(m, m.sender_id === authUserId ? 'sent' : 'received');
          });

          const isActive = data.consultation_status === 'AKTIF';

          document.getElementById('statusText').innerText =
            isActive ?
            'Sesi konsultasi sedang berlangsung' :
            'Sesi konsultasi telah selesai';

          document.getElementById('statusIcon').innerHTML =
            isActive ?
            '<i class="fas fa-clock"></i>' :
            '<i class="fas fa-lock"></i>';

          document.getElementById('chatStatusBar').className =
            `chat-status-bar ${isActive ? 'status-active' : 'status-closed'}`;

          document.getElementById('inputWrapperActive').style.display =
            isActive ? 'flex' : 'none';

          document.getElementById('inputClosedMessage').style.display =
            isActive ? 'none' : 'block';

          const doctorCtrl = document.getElementById('doctorControls');
          if (doctorCtrl) {
            doctorCtrl.style.display = isActive ? 'flex' : 'none';
          }

          msgContainer.scrollTop = msgContainer.scrollHeight;
        });
      if (window.innerWidth <= 900 && appContainer) {
        appContainer.classList.add('chat-active');
      }
    };

    function subscribeChat(chatId) {
      if (!chatId) return console.warn('[CHAT] no chatId');

      if (chatChannel && subscribedChatId === chatId) {
        console.log('[CHAT] already subscribed chats.' + chatId);
        return;
      }

      console.log('[CHAT] subscribe chats.' + chatId);

      if (chatChannel && subscribedChatId !== chatId) {
        console.log('[CHAT] leave previous chats.' + subscribedChatId);
        chatChannel.stopListening('.new-message');
        window.Echo.leave('chats.' + subscribedChatId);
        chatChannel = null;
      }

      subscribedChatId = chatId;
      chatChannel = window.Echo.private('chats.' + chatId);

      chatChannel.listen('.new-message', e => {
        const msg = e.message;
        console.log('[CHAT] NewMessage(dokter):', msg);

        if (msg.type === 'system' && msg.body === 'KONSULTASI_SELESAI') {
          const statusTextEl = document.getElementById('statusText');
          const statusIconEl = document.getElementById('statusIcon');
          const inputWrapperEl = document.getElementById('inputWrapperActive');
          const inputClosedEl = document.getElementById('inputClosedMessage');
          const doctorCtrlEl = document.getElementById('doctorControls');

          if (statusTextEl) statusTextEl.innerText = 'Sesi konsultasi telah selesai';
          if (statusIconEl) statusIconEl.innerHTML = '<i class="fas fa-lock"></i>';
          if (inputWrapperEl) inputWrapperEl.style.display = 'none';
          if (inputClosedEl) inputClosedEl.style.display = 'block';
          if (doctorCtrlEl) doctorCtrlEl.style.display = 'none';

          return;
        }

        if (msg.sender_id === authUserId) return;

        appendMessage(msg, 'received');
      });
    }

    function sendChat() {
      const input = document.getElementById("msgInput");
      const text = input.value.trim();

      if (!text) return;

      appendMessage({
        body: text,
        created_at: new Date()
      }, 'sent');

      fetch("{{ route('chat.send') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
          chat_id: activeChatId,
          body: text
        })
      }).catch(err => console.error('[CHAT] send error:', err));

      input.value = "";
    }

    function handleEnter(e) {
      if (e.key !== 'Enter') return;
      sendChat();
    }

    function appendMessage(msg, type) {
      if (msg.type === 'system') return;
      if (msg.type === 'referral') {
        msgContainer.insertAdjacentHTML('beforeend', `
    <div class="message-row ${type}">
      <div class="bubble">
        Dokter telah mengirimkan rujukan
        <span class="bubble-time">${new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span>
      </div>
    </div>
    `);
        msgContainer.scrollTop = msgContainer.scrollHeight;
        return;
      }

      if (msg.type === 'prescription') {
        msgContainer.insertAdjacentHTML('beforeend', `
      <div class="message-row received">
        <div class="chat-card prescription">
          <h4>🩺 Resep Dokter</h4>
          <p>Resep telah dikirim ke pasien.</p>
        </div>
      </div>
    `);
        return;
      }

      const time = new Date(msg.created_at).toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
      });

      msgContainer.insertAdjacentHTML('beforeend', `
    <div class="message-row ${type}">
      <div class="bubble">
        ${msg.body}
        <span class="bubble-time">${time}</span>
      </div>
    </div>
  `);

      msgContainer.scrollTop = msgContainer.scrollHeight;
    }

    const rtcConfig = {
      iceServers: [{
          urls: "stun:stun.l.google.com:19302"
        },
        {
          urls: [
            "turn:5.175.183.160:3478?transport=udp",
            "turn:5.175.183.160:3478?transport=tcp",
            "turns:5.175.183.160:5349"
          ],
          username: "klikdoc",
          credential: "passwordkuat"
        }
      ]
    };


    let localStream = null;
    let pcs = {};
    let remoteStreams = {};
    let callChannel = null;
    let incomingCall = null;
    let currentCallType = 'video';
    let isCaller = false;

    const callContainer = document.getElementById('callContainer');
    const localVideo = document.getElementById('localVideo');
    const remoteVideoUser = document.getElementById('remoteVideoUser');
    const remoteVideoDoc = document.getElementById('remoteVideoDoctor');

    const incomingModal = document.getElementById('incomingCallModal');
    const incomingAvatar = document.getElementById('incomingCallAvatar');
    const incomingSubtitle = document.getElementById('incomingCallSubtitle');

    function videoElementFor(id) {
      return remoteVideoUser;
    }


    async function getLocalStream(type) {
      if (localStream) return localStream;

      const constraints = type === 'audio' ? {
        audio: true,
        video: false
      } : {
        audio: true,
        video: true
      };

      localStream = await navigator.mediaDevices.getUserMedia(constraints);
      localVideo.srcObject = localStream;

      Object.values(pcs).forEach(pc => {
        localStream.getTracks().forEach(track => {
          pc.addTrack(track, localStream);
        });
      });

      return localStream;
    }

    function createPC(remoteId) {
      if (pcs[remoteId]) return pcs[remoteId];

      console.log('[RTC] Creating PC for', remoteId);
      const pc = new RTCPeerConnection(rtcConfig);
      pcs[remoteId] = pc;

      if (localStream) {
        localStream.getTracks().forEach(track => {
          pc.addTrack(track, localStream);
          console.log('[RTC] track added:', track.kind);
        });
      } else {
        console.warn('[RTC] localStream NOT READY when createPC');
      }

      pc.onicecandidate = e => {
        if (e.candidate && callChannel) {
          callChannel.whisper('rtc-signal', {
            type: 'ice',
            from: authUserId,
            to: remoteId,
            candidate: e.candidate
          });
        }
      };

      pc.ontrack = e => {
        console.log('[RTC] ✅ ontrack fired:', e.track.kind);

        if (!remoteStreams[remoteId]) {
          remoteStreams[remoteId] = new MediaStream();
        }

        remoteStreams[remoteId].addTrack(e.track);

        if (e.track.kind === 'audio') {
          const audio = document.getElementById('remoteAudio');
          audio.srcObject = remoteStreams[remoteId];
          audio.muted = false;
          audio.volume = 1.0;

          audio.play().catch(err => {
            console.warn('[RTC] audio autoplay blocked', err);
          });
        }

        if (e.track.kind === 'video') {
          const video = videoElementFor(remoteId);
          video.srcObject = remoteStreams[remoteId];
          video.muted = false;
          video.play().catch(() => {});
        }
      };


      return pc;
    }

    function subscribeCall(chatId) {
      if (!chatId) return console.warn('[CALL] no chatId');
      if (callChannel) {
        callChannel.stopListeningForWhisper('rtc-signal');
        window.Echo.leave('calls.' + activeChatId);
      }
      endCallLocal();
      console.log('[CALL] subscribe calls.' + chatId);

      callChannel = window.Echo.private('calls.' + chatId);
      callChannel
        .subscribed(() => console.log('[CALL] ✔ subscribed calls.' + chatId))
        .error(e => console.error('[CALL] channel error:', e));

      callChannel.listenForWhisper('rtc-signal', async payload => {
        console.log('[CALL] rtc-signal (dokter):', payload);
        if (String(payload.from) === String(authUserId)) {
          console.warn('[CALL] ignore self rtc-signal');
          return;
        }
        if (payload.to && String(payload.to) !== String(authUserId)) {
          return; // not for this doctor
        }

        switch (payload.type) {
          case 'incoming-call':
            return onIncomingCall(payload);
          case 'accept-call':
            return onRemoteAccept(payload);
          case 'reject-call':
            return onRemoteReject(payload);
          case 'offer':
            return onOffer(payload);
          case 'answer':
            return onAnswer(payload);
          case 'ice':
            return onIce(payload);
          case 'end':
            return endCallLocal();
        }
      });
    }

    async function startCall(type = 'video') {
      console.log('%c[CALL] start (dokter)', 'color:#60a5fa');
      isCaller = true;
      currentCallType = type;

      await getLocalStream(type);
      if (callContainer) callContainer.style.display = 'block';

      const targetId =
        authRole === 'doctor' ?
        chatUserId :
        chatDoctorId;

      if (!targetId || targetId === authUserId) {
        console.error('[CALL] invalid target', {
          authUserId,
          chatUserId,
          chatDoctorId,
          activeChatId
        });
        return;
      }

      callChannel.whisper('rtc-signal', {
        type: 'incoming-call',
        from: authUserId,
        to: targetId,
        call_type: type
      });
    }

    function onIncomingCall(payload) {
      console.log('[CALL] incoming from', payload.from);
      incomingCall = payload;
      currentCallType = payload.call_type;

      if (incomingSubtitle) {
        incomingSubtitle.textContent =
          currentCallType === 'audio' ?
          'Panggilan suara masuk' :
          'Panggilan video masuk';
      }

      if (incomingModal) incomingModal.style.display = 'flex';
    }

    async function acceptIncomingCall() {
      console.log('[CALL] accept');
      if (incomingModal) incomingModal.style.display = 'none';

      await getLocalStream(currentCallType);
      if (callContainer) callContainer.style.display = 'block';

      const audio = document.getElementById('remoteAudio');
      audio.muted = false;
      audio.play().catch(() => {});

      if (!callChannel) return;
      callChannel.whisper('rtc-signal', {
        type: 'accept-call',
        from: authUserId,
        to: incomingCall.from
      });
    }

    function rejectIncomingCall() {
      console.log('[CALL] reject');
      if (incomingModal) incomingModal.style.display = 'none';

      if (!callChannel) return;
      callChannel.whisper('rtc-signal', {
        type: 'reject-call',
        from: authUserId,
        to: incomingCall.from
      });
    }

    async function onRemoteAccept(payload) {
      if (!isCaller) return;
      console.log('[CALL] remote accept', payload.from);

      await getLocalStream(currentCallType);
      if (callContainer) callContainer.style.display = 'block';

      makeOffer(payload.from);
    }

    async function makeOffer(remoteId) {
      console.log('[CALL] makeOffer to', remoteId);

      await getLocalStream(currentCallType);

      const pc = createPC(remoteId);

      const offer = await pc.createOffer();
      await pc.setLocalDescription(offer);

      callChannel.whisper('rtc-signal', {
        type: 'offer',
        from: authUserId,
        to: remoteId,
        sdp: offer
      });
    }


    async function onOffer(payload) {
      console.log('[CALL] receive OFFER from', payload.from);

      await getLocalStream(currentCallType);

      const pc = createPC(payload.from);

      await pc.setRemoteDescription(new RTCSessionDescription(payload.sdp));

      const answer = await pc.createAnswer();
      await pc.setLocalDescription(answer);

      callChannel.whisper('rtc-signal', {
        type: 'answer',
        from: authUserId,
        to: payload.from,
        sdp: answer
      });
    }

    async function onAnswer(payload) {
      console.log('[CALL] receive ANSWER from', payload.from);
      const pc = pcs[payload.from];
      if (!pc) return;
      await pc.setRemoteDescription(new RTCSessionDescription(payload.sdp));
    }

    async function onIce(payload) {
      const pc = pcs[payload.from];
      if (!pc || !payload.candidate) return;

      try {
        await pc.addIceCandidate(new RTCIceCandidate(payload.candidate));
      } catch (e) {
        console.warn('[RTC] addIceCandidate failed:', e);
      }
    }


    function onRemoteReject(payload) {
      console.log('[CALL] remote reject', payload.from);
      incomingCall = null;
      isCaller = false;
      endCallLocal();
    }


    function hangupCall() {
      if (callChannel) {
        callChannel.whisper('rtc-signal', {
          type: 'end',
          from: authUserId
        });
      }
      endCallLocal();
    }

    function endCallLocal() {
      console.log('[CALL] end local (dokter)');

      Object.values(pcs).forEach(pc => pc.close());
      pcs = {};
      remoteStreams = {};

      if (localStream) {
        localStream.getTracks().forEach(t => t.stop());
        localStream = null;
      }

      if (localVideo) localVideo.srcObject = null;
      if (remoteVideoUser) remoteVideoUser.srcObject = null;
      if (remoteVideoDoc) remoteVideoDoc.srcObject = null;

      if (callContainer) callContainer.style.display = 'none';
      if (incomingModal) incomingModal.style.display = 'none';

      incomingCall = null;
      isCaller = false;
    }

    function openPrescriptionModal() {
      const m = document.getElementById('prescriptionModal');
      if (m) m.style.display = 'flex';
    }

    function closePrescriptionModal() {
      const m = document.getElementById('prescriptionModal');
      if (m) m.style.display = 'none';
    }

    let prescriptionItems = [];

    function searchDrug(keyword) {
      if (keyword.length < 2) {
        document.getElementById('drugResult').innerHTML = '';
        return;
      }

      fetch(`/api/drugs/search?q=${keyword}`)
        .then(res => res.json())
        .then(data => {
          let html = '';
          data.forEach(drug => {
            html += `
              <li onclick="addDrug(${drug.id}, '${drug.name.replace(/'/g, "\\'")}')">
                ${drug.name}
              </li>`;
          });
          document.getElementById('drugResult').innerHTML = html;
        });
    }

    function addDrug(id, name) {
      if (prescriptionItems.find(i => i.drug_id === id)) {
        alert('Obat ini sudah ditambahkan');
        return;
      }

      prescriptionItems.push({
        drug_id: id,
        name: name,
        qty: 1
      });
      renderDrugList();

      document.getElementById('drugSearch').value = '';
      document.getElementById('drugResult').innerHTML = '';
    }

    function renderDrugList() {
      const container = document.getElementById('selectedDrugList');
      container.innerHTML = '';

      prescriptionItems.forEach((item, index) => {
        container.innerHTML += `
          <div class="drug-item">
            <div class="drug-main">
              <span class="drug-name">${item.name}</span>
              <div class="drug-qty-row">
                <label>Jumlah</label>
                <input type="number"
                       min="1"
                       value="${item.qty}"
                       onchange="updateQty(${index}, this.value)">
              </div>
            </div>
            <button type="button" class="drug-remove-btn"
                    onclick="removeDrug(${index})">✕</button>
          </div>
        `;
      });
    }

    function updateQty(index, value) {
      prescriptionItems[index].qty = Math.max(1, parseInt(value) || 1);
    }

    function removeDrug(index) {
      prescriptionItems.splice(index, 1);
      renderDrugList();
    }

    function submitPrescription() {
      if (prescriptionItems.length === 0) {
        alert('Tambahkan minimal 1 obat');
        return;
      }

      const consultationId = chatId;

      const payload = {
        diagnosis: document.getElementById('diagnosis').value,
        notes: document.getElementById('notes').value,
        items: prescriptionItems.map(i => ({
          drug_id: i.drug_id,
          qty: i.qty
        }))
      };

      const url = "{{ route('dokter.prescription.chat', ':id') }}".replace(':id', consultationId);

      fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(() => {
          appendMessage({
            body: 'Dokter telah mengirimkan resep',
            created_at: new Date()
          }, 'sent');

          prescriptionItems = [];
          renderDrugList();
          closePrescriptionModal();
        })
        .catch(err => console.error('[RESEP] error:', err));
    }

    function finishConsultation(consultationId) {
      if (!confirm('Selesaikan sesi konsultasi ini?')) return;

      const url = "{{ route('dokter.consultation.finish', ':id') }}"
        .replace(':id', chatId);

      fetch(url, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
            'Accept': 'application/json'
          }
        })
        .then(async res => {
          const data = await res.json();

          if (!res.ok) {
            throw new Error(data.message || 'Gagal menyelesaikan konsultasi');
          }

          return data;
        })
        .then(() => {
          const statusTextEl = document.getElementById('statusText');
          const statusIconEl = document.getElementById('statusIcon');
          const inputWrapperEl = document.getElementById('inputWrapperActive');
          const inputClosedEl = document.getElementById('inputClosedMessage');
          const doctorCtrlEl = document.getElementById('doctorControls');

          if (statusTextEl) statusTextEl.innerText = 'Sesi konsultasi telah selesai';
          if (statusIconEl) statusIconEl.innerHTML = '<i class="fas fa-lock"></i>';
          if (inputWrapperEl) inputWrapperEl.style.display = 'none';
          if (inputClosedEl) inputClosedEl.style.display = 'block';
          if (doctorCtrlEl) doctorCtrlEl.style.display = 'none';
        })
        .catch(err => {
          console.error('[CONSULT] finish error:', err);

          alert(err.message);
        });
    }

    function closeChat() {
      if (appContainer) appContainer.classList.remove('chat-active');
    }

    function openReferralModal() {
      document.getElementById('referralModal').style.display = 'flex';
    }

    function closeReferralModal() {
      document.getElementById('referralModal').style.display = 'none';
    }

    function submitReferral() {
      const payload = {
        consultation_id: chatId,
        destination: document.getElementById('refDestination').value,
        department: document.getElementById('refDepartment').value,
        reason: document.getElementById('refReason').value,
        notes: document.getElementById('refNotes').value
      };

      fetch("{{ route('dokter.rujukan.store') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
          appendMessage({
            type: 'referral',
            created_at: new Date(),
            metadata: {
              referral_id: data.referral_id,
              destination: payload.destination,
              department: payload.department
            }
          }, 'sent');

          closeReferralModal();
        })
        .catch(err => console.error('[REFERRAL] error:', err));
    }

    document.addEventListener('DOMContentLoaded', () => {
      if (msgContainer) msgContainer.scrollTop = msgContainer.scrollHeight;
    });
  </script>
@endpush
