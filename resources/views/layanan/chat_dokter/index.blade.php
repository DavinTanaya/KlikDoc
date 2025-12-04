@extends('layout')

@section('title', 'KlikDoc | Chat Modern')

@push('styles')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
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
            <h2 class="sidebar-title">Chats</h2>
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
              onclick="selectChat(this, {{ $chat->id }}, '{{ $partner->name }}')">

              <div class="avatar-container">
                <img class="avatar"
                  src="https://ui-avatars.com/api/?name={{ urlencode($partner->name) }}&background=random">
              </div>

              <div class="chat-info">
                <div class="chat-header-info">
                  <span class="chat-name">{{ $partner->name }}</span>
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
                src="https://ui-avatars.com/api/?name={{ urlencode($activechat?->doctor->name ?? ($activechat?->user->name ?? 'Chat')) }}">
              <div>
                <h6 id="headerName">
                  {{ $authUser->id === ($activechat->user_id ?? null)
                      ? $activechat->doctor->name ?? 'Chat'
                      : $activechat->user->name ?? 'Chat' }}
                </h6>
                <small id="headerStatus">Online</small>
              </div>
            </div>
          </div>

          <div class="header-actions">
            <i class="fas fa-phone-alt" onclick="startCall('audio')"></i>
            <i class="fas fa-video" onclick="startCall('video')"></i>
            <i class="fas fa-info-circle"></i>
          </div>
        </header>

        <div id="chatStatusBar" class="chat-status-bar status-active">
          <span id="statusIcon"><i class="fas fa-clock"></i></span>
          <span id="statusText">Sesi chat sedang berlangsung</span>
        </div>

        <div class="messages-container" id="messageContainer">
          @foreach ($messages as $message)
            <div class="message-row {{ $message->sender_id === $authUser->id ? 'sent' : 'received' }}">
              <div class="bubble">
                {{ $message->body }}
                <span class="bubble-time">{{ $message->created_at->format('H:i') }}</span>
              </div>
            </div>
          @endforeach
        </div>

        <div id="callContainer" class="call-container">
          <div class="video-wrapper">
            <video id="localVideo" class="video-local" autoplay playsinline muted></video>
            <video id="remoteVideoUser" class="video-remote" autoplay playsinline></video>
            <video id="remoteVideoDoctor" class="video-remote" autoplay playsinline></video>
          </div>
          <div class="call-controls">
            <button class="btn btn-danger btn-sm" onclick="hangupCall()">
              End Call
            </button>
          </div>
        </div>

        <footer class="input-area">
          <div id="inputWrapperActive" class="input-wrapper-active">
            <div class="input-actions">
              <i class="far fa-smile"></i>
              <i class="fas fa-paperclip"></i>
            </div>

            <input type="text" id="msgInput" class="chat-input" placeholder="Ketik pesan..."
              onkeypress="handleEnter(event)">
            <button class="btn-send">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>

          <div id="inputClosedMessage" class="input-closed-message">
            <i class="fas fa-lock me-2"></i> Anda tidak dapat membalas percakapan ini.
          </div>
        </footer>
      </main>
    </div>
  </div>

  <div id="incomingCallModal" class="incoming-call-backdrop">
    <div class="incoming-call-box">
      <div class="incoming-call-avatar">
        <img id="incomingCallAvatar" src="" alt="Caller avatar">
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
    /* ===========================================================
         INITIAL VARIABLES
      =========================================================== */
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

    const msgContainer = document.getElementById("messageContainer");
    const incomingModal = document.getElementById("incomingCallModal");
    const incomingAvatar = document.getElementById("incomingCallAvatar");
    const incomingText = document.getElementById("incomingCallSubtitle");

    let callChannel = null;
    let incomingCall = null;
    let currentCallType = "video";
    let isCaller = false;

    // ==== PENTING: hidupkan log pusher dulu biar kelihatan error ====
    window.Pusher = Pusher;

    window.Echo = new Echo({
      broadcaster: "pusher",
      key: "{{ config('broadcasting.connections.pusher.key') }}",

      wsHost: "ws.cheapdl.online",
      wsPort: 443,
      wssPort: 443,

      forceTLS: false,
      encrypted: false,

      enabledTransports: ["wss"],
      disableStats: true,
      cluster: null,

      wsPath: "/app/{{ config('broadcasting.connections.pusher.key') }}",

      authEndpoint: "/broadcasting/auth",
      auth: {
        headers: {
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
      }
    });


    // ==== LOG STATE PERUBAHAN SUPAYA KELIHATAN APA YANG TERJADI ====
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


    /* ===========================================================
       SELECT CHAT (GLOBAL)
    =========================================================== */
    window.selectChat = function(el, chatId, partnerName) {
      console.log("%c[CHAT] Switching chat → " + chatId, "color:#fb923c");

      document.querySelectorAll(".chat-item").forEach(i => i.classList.remove("active"));
      el.classList.add("active");

      document.getElementById("headerName").innerText = partnerName;
      activeChatId = chatId;

      subscribeChat(chatId);
      subscribeCall(chatId);
    };

    /* ===========================================================
       SUBSCRIBE TO CHAT CHANNEL
    =========================================================== */
    function subscribeChat(chatId) {
      if (!chatId) return console.warn("[CHAT] No chat ID");

      console.log("[CHAT] Subscribing chats." + chatId);

      window.Echo.private("chats." + chatId)
        .subscribed(() => console.log("[CHAT] ✔ Subscribed chats." + chatId))
        .listen("NewMessage", e => {
          console.log("[CHAT] Received:", e);

          if (e.message.sender_id === authUserId) return;
          appendMessage(e.message, "received");
        });
    }

    function appendMessage(msg, type) {
      msgContainer.insertAdjacentHTML("beforeend", `
        <div class="message-row ${type}">
            <div class="bubble">
                ${msg.body}
                <span class="bubble-time">${msg.created_at}</span>
            </div>
        </div>
    `);
      msgContainer.scrollTop = msgContainer.scrollHeight;
    }

    function handleEnter(e) {
      if (e.key !== "Enter") return;

      const text = e.target.value.trim();
      if (!text) return;

      appendMessage({
        body: text,
        created_at: "Barusan"
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

      e.target.value = "";
    }

    /* ===========================================================
       CALL SIGNAL CHANNEL
    =========================================================== */
    function subscribeCall(chatId) {
      if (!chatId) return console.warn("[CALL] No chatId");

      console.log("[CALL] Subscribing calls." + chatId);

      callChannel = window.Echo.private("calls." + chatId);

      callChannel.subscribed(() => console.log("[CALL] ✔ Subscribed calls." + chatId));

      callChannel.error(e => console.error("[CALL] Channel error:", e));

      callChannel.listenForWhisper("rtc-signal", async payload => {
        console.log("[CALL] Signal:", payload);

        if (payload.to && String(payload.to) !== String(authUserId)) {
          console.log("[CALL] Signal ignored (not for me)");
          return;
        }

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

    /* ===========================================================
       WEBRTC
    =========================================================== */
    const rtcConfig = {
      iceServers: [{
        urls: "stun:stun.l.google.com:19302"
      }]
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

      const constraints = type === "audio" ? {
        audio: true,
        video: false
      } : {
        audio: true,
        video: true
      };

      console.log("[RTC] getUserMedia:", constraints);

      localStream = await navigator.mediaDevices.getUserMedia(constraints);
      localVideo.srcObject = localStream;

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
        if (!remoteStreams[remoteId]) remoteStreams[remoteId] = new MediaStream();

        e.streams[0].getTracks().forEach(t => {
          remoteStreams[remoteId].addTrack(t);
        });

        videoElementFor(remoteId).srcObject = remoteStreams[remoteId];
      };

      if (localStream) {
        localStream.getTracks().forEach(t => pc.addTrack(t, localStream));
      }

      return pc;
    }

    async function startCall(type = "video") {
      console.log("%c[CALL] Start Call", "color:#60a5fa");

      isCaller = true;
      currentCallType = type;

      await getLocalStream(type);
      callContainer.style.display = "block";

      const targets = [chatUserId, chatDoctorId].filter(id => id && id != authUserId);

      targets.forEach(rid => {
        console.log("[CALL] Whisper incoming-call →", rid);

        callChannel.whisper("rtc-signal", {
          type: "incoming-call",
          from: authUserId,
          to: rid,
          call_type: type
        });
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
