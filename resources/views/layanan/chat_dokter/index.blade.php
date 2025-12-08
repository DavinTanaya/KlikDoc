@extends('layout')

@section('title', 'KlikDoc | Chat Modern')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/layanan/chat_dokter/chat_dokter.css') }}">
@endpush

@section('body')
  <div class="chat-wrapper">
    <div class="app-container" id="appContainer">
      <aside class="sidebar">
        <div class="sidebar-header">
          <div class="sidebar-header-left">
            <a href="{{ url('/') }}" class="btn-home-back">
              <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="sidebar-title">Pesan</h2>
          </div>
          <div class="sidebar-tools">
            <i class="fas fa-edit"></i>
            <i class="fas fa-ellipsis-v"></i>
          </div>
        </div>

        <div class="search-box">
          <div class="search-input-wrapper">
            <i class="fas fa-search text-gray-400"></i>
            <input type="text" placeholder="Cari atau mulai chat baru">
          </div>
        </div>

        <ul class="chat-list">
          @foreach ($chats as $chat)
            @php
              $isActive = $activechat && $chat->id === $activechat->id;
              $partner = $authUser->id === $chat->user_id ? $chat->doctor : $chat->user;
              $lastMessage = $chat->messages->first();
            @endphp

            <li class="chat-item {{ $isActive ? 'active' : '' }}"
              onclick="selectChat(this, {{ $chat->id }}, '{{ $partner->application->full_name ?? $partner->name }}')">

              <div class="avatar-container">
                <img class="avatar"
                  src="https://ui-avatars.com/api/?name={{ urlencode($partner->application->full_name ?? $partner->name) }}&background=random">
              </div>

              <div class="chat-info">
                <div class="chat-header-info">
                  <span class="chat-name">{{ $partner->application->full_name ?? $partner->name }}</span>
                  <span class="chat-time">{{ optional($lastMessage)->created_at?->format('H:i') }}</span>
                </div>
                <div class="chat-preview">
                  <span class="last-message">
                    {{ Str::limit(optional($lastMessage)->body, 30) }}
                  </span>
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
            <div class="header-profile">
              <img class="avatar header-avatar" id="headerAvatar"
                src="https://ui-avatars.com/api/?name={{ urlencode($activechat?->doctor->application->full_name ?? ($activechat?->user->name ?? 'Chat')) }}&background=random">
              <div>
                <h6 class="header-name" id="headerName">
                  {{ $authUser->id === ($activechat->user_id ?? null)
                      ? $activechat->doctor->application->full_name ?? 'Chat'
                      : $activechat->user->name ?? 'Chat' }}
                </h6>
                <small class="header-status" id="headerStatus">Online</small>
              </div>
            </div>
          </div>

          <div class="header-actions">
            <i class="fas fa-phone-alt" onclick="startCall('audio')"></i>
            <i class="fas fa-video" onclick="startCall('video')"></i>
            <i class="fas fa-info-circle"></i>
          </div>
        </header>

        @php
          $isActiveConsultation = $activeConsultation !== null;
        @endphp

        <div id="chatStatusBar" class="chat-status-bar {{ $isActiveConsultation ? 'status-active' : 'status-closed' }}">
          <span id="statusIcon">
            <i class="fas {{ $isActiveConsultation ? 'fa-clock' : 'fa-lock' }}"></i>
          </span>
          <span id="statusText">
            {{ $isActiveConsultation ? 'Sesi chat sedang berlangsung' : 'Sesi konsultasi telah selesai' }}
          </span>
        </div>


        <div class="messages-container" id="messageContainer">
          @foreach ($messages as $message)
            @if ($message->type === 'prescription')
              <div class="message-row received">
                <div class="chat-card prescription">
                  <h4>🩺 Resep Dokter</h4>
                  <p>Dokter telah mengirimkan resep.</p>
                  <div class="prescription-actions">
                    <a href="{{ route('apotek.fromPrescription', $message->prescription_id) }}">
                      Tebus Obat
                    </a>
                  </div>
                </div>
              </div>
            @elseif ($message->type === 'referral')
              <div class="message-row received">
                <div class="chat-card referral">
                  <h4>🏥 Surat Rujukan</h4>
                  <p>Dokter merujuk Anda ke fasilitas lanjutan.</p>
                  <div class="referral-info">
                    <strong>RS:</strong> {{ $message->referral->destination }}
                    <strong>Poli:</strong> {{ $message->referral->department }}
                  </div>
                  <div class="referral-actions">
                    <a class="btn-secondary" href="{{ route('referral.download', $message->referral_id) }}">
                      Download Surat Rujukan
                    </a>
                  </div>
                </div>
              </div>
            @else
              <div class="message-row {{ $message->sender_id === $authUser->id ? 'sent' : 'received' }}">
                <div class="bubble">
                  {{ $message->body }}
                  <span class="bubble-time">{{ $message->created_at->format('H:i') }}</span>
                </div>
              </div>
            @endif
          @endforeach
        </div>

        <div id="callContainer" class="call-container">
          <div class="video-wrapper" id="videoWrapper">
            <video id="localVideo" class="video-local" autoplay playsinline muted></video>
            <video id="remoteVideoUser" class="video-remote" autoplay playsinline style="display: none;"></video>
            <video id="remoteVideoDoctor" class="video-remote" autoplay playsinline></video>
          </div>
          <div class="audio-wrapper" id="audioWrapper">
            <img id="incomingCallAvatar"
              src="https://ui-avatars.com/api/?name={{ urlencode($activechat?->doctor->name ?? ($activechat?->user->name ?? 'Chat')) }}"
              alt="Caller avatar">
          </div>
          <div class="call-controls">
            <button class="btn btn-danger btn-sm" onclick="hangupCall()">
              End Call
            </button>
          </div>
        </div>

        <footer class="input-area">
          <div id="inputWrapperActive" class="input-wrapper-active"
            style="{{ $isActiveConsultation ? '' : 'display:none' }}">

            <div class="input-actions">
              <i class="far fa-smile"></i>
              <i class="fas fa-paperclip"></i>
            </div>

            <input type="text" id="msgInput" class="chat-input" placeholder="Ketik pesan..."
              onkeypress="handleEnter(event)">

            <button class="btn-send" onclick="sendChat()">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>

          <div id="inputClosedMessage" class="input-closed-message"
            style="{{ $isActiveConsultation ? 'display:none' : 'display:block' }}">
            <i class="fas fa-lock me-2"></i>
            Sesi konsultasi telah selesai. Anda tidak dapat mengirim pesan.
          </div>
        </footer>
      </main>
    </div>
  </div>

  <div id="incomingCallModal" class="incoming-call-backdrop">
    <div class="incoming-call-box">
      <div class="incoming-call-avatar">
        <img id="incomingCallAvatar"
          src="https://ui-avatars.com/api/?name={{ urlencode($activechat?->doctor->name ?? ($activechat?->user->name ?? 'Chat')) }}"
          alt="Caller avatar">
      </div>
      <div class="incoming-call-title" id="incomingCallTitle">
        Panggilan Masuk
      </div>
      <div class="incoming-call-subtitle" id="incomingCallSubtitle">
        Seseorang sedang menghubungi Anda...
      </div>
      <div class="incoming-call-actions">
        <button type="button" class="btn-call-reject" onclick="rejectIncomingCall()">
          <i class="fas fa-phone-slash"></i> Tolak
        </button>
        <button type="button" class="btn-call-accept" onclick="acceptIncomingCall()">
          <i class="fas fa-phone"></i> Terima
        </button>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.0/dist/echo.iife.js"></script>

  <script>
    console.log("[INIT] ChatDokter script loaded");

    const authUserId = {{ $authUser->id }};
    const authRole = "{{ $authUser->role }}";
    let activeChatId = {{ $activechat?->id ?? 'null' }};
    const chatUserId = {{ $activechat?->user_id ?? 'null' }};
    const chatDoctorId = {{ $activechat?->doctor_id ?? 'null' }};

    console.table({
      authUserId,
      authRole,
      activeChatId,
      chatUserId,
      chatDoctorId
    });

    const appContainer = document.getElementById("appContainer");
    const msgContainer = document.getElementById("messageContainer");
    const incomingModal = document.getElementById("incomingCallModal");
    const incomingAvatar = document.getElementById("incomingCallAvatar");
    const incomingText = document.getElementById("incomingCallSubtitle");

    let callChannel = null;
    let incomingCall = null;
    let currentCallType = "video";
    let isCaller = false;

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
      console.log("[ECHO] state_change:", states.previous, "→", states.current);
    });

    pusherConn.bind("connected", () => {
      console.log("%c[ECHO] CONNECTED ✔", "color:#22c55e;font-weight:bold");
      subscribeChat(activeChatId);
      subscribeCall(activeChatId);
    });

    pusherConn.bind("error", (err) => {
      console.error("[ECHO] ERROR:", err);
    });

    pusherConn.bind("failed", (err) => {
      console.error("[ECHO] FAILED:", err);
    });

    window.selectChat = function(el, chatId, partnerName) {
      document.querySelectorAll(".chat-item").forEach(i => i.classList.remove("active"));
      el.classList.add("active");
      document.getElementById('headerAvatar').src =
        "https://ui-avatars.com/api/?name=" + encodeURIComponent(partnerName) + "&background=random";

      document.getElementById("headerName").innerText = partnerName;
      activeChatId = chatId;

      subscribeChat(chatId);
      subscribeCall(chatId);

      fetch(`/chat-dokter/messages/${chatId}`)
        .then(res => res.json())
        .then(data => {
          msgContainer.innerHTML = "";

          data.messages.forEach(msg => {
            appendMessage(msg, msg.sender_id === authUserId ? "sent" : "received");
          });

          const isActive = data.consultation_status === "AKTIF";

          document.getElementById("chatStatusBar").className =
            `chat-status-bar ${isActive ? 'status-active' : 'status-closed'}`;

          document.getElementById("statusIcon").innerHTML =
            isActive ? '<i class="fas fa-clock"></i>' : '<i class="fas fa-lock"></i>';

          document.getElementById("statusText").innerText =
            isActive ?
            'Sesi chat sedang berlangsung' :
            'Sesi konsultasi telah selesai';

          document.getElementById("inputWrapperActive").style.display =
            isActive ? "flex" : "none";

          document.getElementById("inputClosedMessage").style.display =
            isActive ? "none" : "flex";

          msgContainer.scrollTop = msgContainer.scrollHeight;
        });
      if (window.innerWidth <= 900 && appContainer) {
        appContainer.classList.add('chat-active');
      }
    };

    function subscribeChat(chatId) {
      if (!chatId) return console.warn("[CHAT] No chat ID");

      console.log("[CHAT] Subscribing chats." + chatId);

      window.Echo.private('chats.' + chatId)
        .listen('.new-message', e => {
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

    function appendMessage(msg, type) {

      if (msg.type === 'prescription') {
        msgContainer.insertAdjacentHTML("beforeend", `
                  <div class="message-row received">
                      <div class="chat-card prescription">
                          <h4>🩺 Resep Dokter</h4>
                          <p>Dokter telah mengirimkan resep.</p>
                          <div class="prescription-actions">
                              <a class="btn-secondary" href="/apotek/checkout/from-prescription/${msg.prescription_id}">
                                Tebus Obat
                              </a>
                          </div>
                      </div>
                  </div>
            `);
        return;
      }
      if (msg.type === 'referral') {
        msgContainer.insertAdjacentHTML("beforeend", `
    <div class="message-row received">
      <div class="chat-card referral">
        <h4>🏥 Surat Rujukan</h4>
        <p>Dokter merujuk Anda ke fasilitas lanjutan.</p>

        <div class="referral-info">
          <strong>Tujuan:</strong> ${msg.referral?.destination ?? '-'}<br>
          <strong>Poli:</strong> ${msg.referral?.department ?? '-'}
        </div>

        <div class="referral-actions">
          <a class="btn-secondary"
             href="/rujukan/${msg.referral_id}/download">
            Download Surat Rujukan
          </a>
        </div>
      </div>
    </div>
  `);
        return;
      }
      msgContainer.insertAdjacentHTML("beforeend", `
    <div class="message-row ${type}">
      <div class="bubble">
        ${msg.body}
        <span class="bubble-time">
          ${new Date(msg.created_at).toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit'
          })}
        </span>
      </div>
    </div>
  `);
    }

    function sendChat() {
      const input = document.getElementById("msgInput");
      const text = input.value.trim();

      if (!text) return;

      appendMessage({
        body: text,
        created_at: "Now"
      }, "sent");

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
      });

      input.value = "";
    }

    function handleEnter(e) {
      if (e.key !== "Enter") return;
      sendChat();
    }

    function closeChat() {
      appContainer.classList.remove("chat-active");
    }

    function subscribeCall(chatId) {
      if (!chatId) return;

      if (callChannel) {
        callChannel.stopListeningForWhisper("rtc-signal");
        window.Echo.leave("calls." + activeChatId);
      }

      endCallLocal();

      console.log("[CALL] Subscribing calls." + chatId);

      callChannel = window.Echo.private("calls." + chatId);

      callChannel.subscribed(() =>
        console.log("[CALL] ✔ Subscribed calls." + chatId)
      );

      callChannel.error(e =>
        console.error("[CALL] Channel error:", e)
      );

      callChannel.listenForWhisper("rtc-signal", async payload => {
        if (String(payload.from) === String(authUserId)) return;
        if (payload.to && String(payload.to) !== String(authUserId)) return;

        switch (payload.type) {
          case "incoming-call":
            return onIncomingCall(payload);
          case "accept-call":
            return onRemoteAccept(payload);
          case "reject-call":
            return onRemoteReject(payload);
          case "offer":
            return onOffer(payload);
          case "answer":
            return onAnswer(payload);
          case "ice":
            return onIce(payload);
          case "end":
            return endCallLocal();
        }
      });
    }

    const rtcConfig = {
      iceServers: [{
          urls: 'stun:stun.l.google.com:19302'
        },
        {
          urls: 'turn:openrelay.metered.ca:443',
          username: 'openrelayproject',
          credential: 'openrelayproject'
        }
      ]
    };


    let localStream = null;
    let pcs = {};
    let remoteStreams = {};

    const callContainer = document.getElementById("callContainer");
    const localVideo = document.getElementById("localVideo");
    const remoteVideoUser = document.getElementById("remoteVideoUser");
    const remoteVideoDoc = document.getElementById("remoteVideoDoctor");

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


    function videoElementFor(id) {
      if (id == chatUserId) return remoteVideoUser;
      if (id == chatDoctorId) return remoteVideoDoc;
      return remoteVideoUser;
    }

    function createPC(remoteId) {
      if (pcs[remoteId]) return pcs[remoteId];

      console.log("[RTC] Creating PC for", remoteId);

      const pc = new RTCPeerConnection(rtcConfig);
      pcs[remoteId] = pc;

      pc.onicecandidate = (e) => {
        if (e.candidate) {
          callChannel.whisper("rtc-signal", {
            type: "ice",
            from: authUserId,
            to: remoteId,
            candidate: e.candidate
          });
        }
      };

      pc.ontrack = (e) => {
        if (!remoteStreams[remoteId]) {
          remoteStreams[remoteId] = new MediaStream();
        }

        e.streams[0].getTracks().forEach(track => {
          remoteStreams[remoteId].addTrack(track);
        });

        const video = videoElementFor(remoteId);
        video.srcObject = remoteStreams[remoteId];

        video.play().catch(err => {
          console.warn('[RTC] autoplay blocked, retrying...', err);
        });
      };

      return pc;
    }

    async function startCall(type = "video") {
      console.log("%c[CALL] Start Call", "color:#60a5fa");

      isCaller = true;
      currentCallType = type;

      await getLocalStream(type);
      callContainer.style.display = "block";

      const targetId =
        authRole === 'doctor' ?
        chatUserId :
        chatDoctorId;

      if (!targetId || targetId === authUserId) {
        console.error("[CALL] Invalid target", {
          authUserId,
          chatUserId,
          chatDoctorId
        });
        return;
      }

      callChannel.whisper("rtc-signal", {
        type: "incoming-call",
        from: authUserId,
        to: targetId,
        call_type: type
      });
    }

    function onIncomingCall(payload) {
      console.log("[CALL] Incoming call from", payload.from);

      incomingCall = payload;
      currentCallType = payload.call_type;

      incomingText.textContent = currentCallType === "audio" ?
        "Panggilan Suara Masuk" :
        "Panggilan Video Masuk";

      incomingModal.style.display = "flex";
    }

    async function acceptIncomingCall() {
      console.log("[CALL] Accepting call");
      console.log(currentCallType);

      incomingModal.style.display = "none";

      await getLocalStream(currentCallType);
      callContainer.style.display = "block";

      callChannel.whisper("rtc-signal", {
        type: "accept-call",
        from: authUserId,
        to: incomingCall.from
      });
    }

    function rejectIncomingCall() {
      console.log("[CALL] Reject call");

      incomingModal.style.display = "none";

      callChannel.whisper("rtc-signal", {
        type: "reject-call",
        from: authUserId,
        to: incomingCall.from
      });
    }

    async function onRemoteAccept(payload) {
      if (!isCaller) return;
      console.log("[CALL] Remote accepted:", payload.from);

      await getLocalStream(currentCallType);
      callContainer.style.display = "block";

      makeOffer(payload.from);
    }
    async function onRemoteReject(payload) {
      if (!isCaller) return;
      console.log("[CALL] Remote rejected:", payload.from);

      endCallLocal();
    }

    async function makeOffer(remoteId) {
      const pc = createPC(remoteId);

      const offer = await pc.createOffer();
      await pc.setLocalDescription(offer);

      callChannel.whisper("rtc-signal", {
        type: "offer",
        from: authUserId,
        to: remoteId,
        sdp: offer
      });
    }

    async function onOffer(payload) {
      console.log("[CALL] OFFER from", payload.from);

      await getLocalStream(currentCallType);
      callContainer.style.display = "block";

      const pc = createPC(payload.from);

      await pc.setRemoteDescription(new RTCSessionDescription(payload.sdp));
      const answer = await pc.createAnswer();
      await pc.setLocalDescription(answer);

      callChannel.whisper("rtc-signal", {
        type: "answer",
        from: authUserId,
        to: payload.from,
        sdp: answer
      });
    }

    async function onAnswer(payload) {
      console.log("[CALL] ANSWER from", payload.from);

      const pc = pcs[payload.from];
      if (!pc) return;

      await pc.setRemoteDescription(new RTCSessionDescription(payload.sdp));
    }

    async function onIce(payload) {
      const pc = pcs[payload.from];
      if (!pc || !payload.candidate) return;

      await pc.addIceCandidate(new RTCIceCandidate(payload.candidate));
    }

    function hangupCall() {
      callChannel.whisper("rtc-signal", {
        type: "end",
        from: authUserId
      });

      endCallLocal();
    }

    function endCallLocal() {
      console.log("[CALL] Ending call");

      Object.values(pcs).forEach(pc => pc.close());
      pcs = {};
      remoteStreams = {};

      if (localStream) {
        localStream.getTracks().forEach(t => t.stop());
        localStream = null;
      }

      localVideo.srcObject = null;
      remoteVideoUser.srcObject = null;
      remoteVideoDoc.srcObject = null;

      callContainer.style.display = "none";
      incomingModal.style.display = "none";

      incomingCall = null;
      isCaller = false;
    }
  </script>
@endpush
