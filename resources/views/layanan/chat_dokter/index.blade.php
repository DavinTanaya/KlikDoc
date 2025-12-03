@extends('layout')

@section('title', 'KlikDoc | Chat Modern')

@push('styles')
    <!-- Font Inter untuk Chat -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user/layanan/chat_dokter/chat_dokter.css') }}">
@endpush

@section('body')
    <div class="chat-wrapper">
        <div class="app-container" id="appContainer">
            <aside class="sidebar">
                <div class="sidebar-header">
                    <div class="sidebar-header-left">
                        <a href="{{ url('/') }}" class="btn-home-back" title="Kembali ke Beranda">
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
                    <li class="chat-item active" onclick="openChat('digibot_NEW', 'Penjual')">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name=Digibot&background=0D8ABC&color=fff" class="avatar"
                                alt="Digibot">
                            <div class="status-dot"></div>
                        </div>
                        <div class="chat-info">
                            <div class="chat-header-info">
                                <span class="chat-name">digibot_NEW</span>
                                <span class="chat-time">14:21</span>
                            </div>
                            <div class="chat-preview">
                                <span class="last-message">belum ya kak - mimin</span>
                            </div>
                        </div>
                    </li>

                    <li class="chat-item" onclick="openChat('PCB Express', 'Penjual')">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name=PCB+Express&background=random" class="avatar"
                                alt="PCB">
                        </div>
                        <div class="chat-info">
                            <div class="chat-header-info">
                                <span class="chat-name">PCB Express Jogja</span>
                                <span class="chat-time">Kemarin</span>
                            </div>
                            <div class="chat-preview">
                                <span class="last-message">Pesanan sudah dikirim ya kak</span>
                                <span class="unread-badge">2</span>
                            </div>
                        </div>
                    </li>

                    <li class="chat-item" onclick="openChat('Solar Perfect', 'Admin')">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name=Solar+Perfect&background=random" class="avatar"
                                alt="Solar">
                        </div>
                        <div class="chat-info">
                            <div class="chat-header-info">
                                <span class="chat-name">Solar Perfect</span>
                                <span class="chat-time">Senin</span>
                            </div>
                            <div class="chat-preview">
                                <span class="last-message"><i class="fas fa-image fa-xs me-1"></i> Foto produk</span>
                            </div>
                        </div>
                    </li>
                    <li class="chat-item" onclick="openChat('PCB Express', 'Penjual')">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name=PCB+Express&background=random" class="avatar"
                                alt="PCB">
                        </div>
                        <div class="chat-info">
                            <div class="chat-header-info">
                                <span class="chat-name">PCB Express Jogja</span>
                                <span class="chat-time">Kemarin</span>
                            </div>
                            <div class="chat-preview">
                                <span class="last-message">Pesanan sudah dikirim ya kak</span>
                                <span class="unread-badge">2</span>
                            </div>
                        </div>
                    </li>
                    <li class="chat-item" onclick="openChat('PCB Express', 'Penjual')">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name=PCB+Express&background=random" class="avatar"
                                alt="PCB">
                        </div>
                        <div class="chat-info">
                            <div class="chat-header-info">
                                <span class="chat-name">PCB Express Jogja</span>
                                <span class="chat-time">Kemarin</span>
                            </div>
                            <div class="chat-preview">
                                <span class="last-message">Pesanan sudah dikirim ya kak</span>
                                <span class="unread-badge">2</span>
                            </div>
                        </div>
                    </li>
                    <li class="chat-item" onclick="openChat('PCB Express', 'Penjual')">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name=PCB+Express&background=random" class="avatar"
                                alt="PCB">
                        </div>
                        <div class="chat-info">
                            <div class="chat-header-info">
                                <span class="chat-name">PCB Express Jogja</span>
                                <span class="chat-time">Kemarin</span>
                            </div>
                            <div class="chat-preview">
                                <span class="last-message">Pesanan sudah dikirim ya kak</span>
                                <span class="unread-badge">2</span>
                            </div>
                        </div>
                    </li>
                    <li class="chat-item" onclick="openChat('PCB Express', 'Penjual')">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name=PCB+Express&background=random" class="avatar"
                                alt="PCB">
                        </div>
                        <div class="chat-info">
                            <div class="chat-header-info">
                                <span class="chat-name">PCB Express Jogja</span>
                                <span class="chat-time">Kemarin</span>
                            </div>
                            <div class="chat-preview">
                                <span class="last-message">Pesanan sudah dikirim ya kak</span>
                                <span class="unread-badge">2</span>
                            </div>
                        </div>
                    </li><li class="chat-item" onclick="openChat('PCB Express', 'Penjual')">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name=PCB+Express&background=random" class="avatar"
                                alt="PCB">
                        </div>
                        <div class="chat-info">
                            <div class="chat-header-info">
                                <span class="chat-name">PCB Express Jogja</span>
                                <span class="chat-time">Kemarin</span>
                            </div>
                            <div class="chat-preview">
                                <span class="last-message">Pesanan sudah dikirim ya kak</span>
                                <span class="unread-badge">2</span>
                            </div>
                        </div>
                    </li>
                    <li class="chat-item" onclick="openChat('PCB Express', 'Penjual')">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name=PCB+Express&background=random" class="avatar"
                                alt="PCB">
                        </div>
                        <div class="chat-info">
                            <div class="chat-header-info">
                                <span class="chat-name">PCB Express Jogja</span>
                                <span class="chat-time">Kemarin</span>
                            </div>
                            <div class="chat-preview">
                                <span class="last-message">Pesanan sudah dikirim ya kak</span>
                                <span class="unread-badge">2</span>
                            </div>
                        </div>
                    </li>
                    <li class="chat-item" onclick="openChat('PCB Express', 'Penjual')">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name=PCB+Express&background=random" class="avatar"
                                alt="PCB">
                        </div>
                        <div class="chat-info">
                            <div class="chat-header-info">
                                <span class="chat-name">PCB Express Jogja</span>
                                <span class="chat-time">Kemarin</span>
                            </div>
                            <div class="chat-preview">
                                <span class="last-message">Pesanan sudah dikirim ya kak</span>
                                <span class="unread-badge">2</span>
                            </div>
                        </div>
                    </li>
                    <li class="chat-item" onclick="openChat('PCB Express', 'Penjual')">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name=PCB+Express&background=random" class="avatar"
                                alt="PCB">
                        </div>
                        <div class="chat-info">
                            <div class="chat-header-info">
                                <span class="chat-name">PCB Express Jogja</span>
                                <span class="chat-time">Kemarin</span>
                            </div>
                            <div class="chat-preview">
                                <span class="last-message">Pesanan sudah dikirim ya kak</span>
                                <span class="unread-badge">2</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </aside>

            <!-- CHAT AREA -->
            <main class="chat-area">
                <!-- Header -->
                <header class="chat-room-header">
                    <div class="header-left">
                        <button class="btn-back" onclick="closeChat()">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <div class="header-profile">
                            <img src="https://ui-avatars.com/api/?name=Digibot&background=0D8ABC&color=fff"
                                class="avatar header-avatar" id="headerAvatar" alt="">
                            <div>
                                <h6 class="header-name" id="headerName">digibot_NEW</h6>
                                <small class="header-status" id="headerStatus">Online</small>
                            </div>
                        </div>
                    </div>

                    <div class="header-actions">
                        <i class="fas fa-phone-alt"></i>
                        <i class="fas fa-video"></i>
                        <i class="fas fa-info-circle"></i>
                    </div>
                </header>

                <!-- Messages List -->
                <div class="messages-container" id="messageContainer">

                    <div class="date-divider">
                        <span>HARI INI</span>
                    </div>

                    <div class="message-row sent">
                        <div class="bubble">
                            permisi kak, apakah ini sudah tersolder?
                            <span class="bubble-time">21:46 <i class="fas fa-check-double text-primary ms-1"></i></span>
                        </div>
                    </div>

                    <div class="message-row received">
                        <div class="bubble">
                            Terima kasih atas pesan Anda 🙏
                            Digibot sedang tidak ada saat ini, tetapi akan merespons secepat mungkin.
                            <span class="bubble-time">21:49</span>
                        </div>
                    </div>

                    <div class="date-divider">
                        <span>13 AGUSTUS 2025</span>
                    </div>

                    <div class="message-row received">
                        <div class="bubble">
                            belum ya kak - mimin
                            <span class="bubble-time">14:21</span>
                        </div>
                    </div>

                    <!-- DUMMY DATA UNTUK TEST SCROLL -->
                    <div class="message-row sent">
                        <div class="bubble">
                            Oke siap kak, ditunggu kabar baiknya ya
                            <span class="bubble-time">14:25 <i class="fas fa-check text-grey ms-1"></i></span>
                        </div>
                    </div>

                    <div class="message-row received">
                        <div class="bubble">
                            Baik kak, mohon maaf atas keterlambatan respon kami.
                            <span class="bubble-time">14:30</span>
                        </div>
                    </div>

                    <div class="message-row sent">
                        <div class="bubble">
                            Apakah barang ready stok? Saya butuh 5 pcs untuk project kampus.
                            <span class="bubble-time">14:35 <i class="fas fa-check-double text-primary ms-1"></i></span>
                        </div>
                    </div>

                    <div class="message-row received">
                        <div class="bubble">
                            Ready kak! Silakan langsung diorder sebelum kehabisan ya.
                            <span class="bubble-time">14:40</span>
                        </div>
                    </div>

                    <div class="message-row sent">
                        <div class="bubble">
                            Siap, meluncur ke TKP checkout!
                            <span class="bubble-time">14:42 <i class="fas fa-check-double text-primary ms-1"></i></span>
                        </div>
                    </div>

                    <div class="message-row received">
                        <div class="bubble">
                            Ditunggu orderannya kak, terima kasih! :)
                            <span class="bubble-time">14:45</span>
                        </div>
                    </div>
                </div>

                <!-- Input Area -->
                <footer class="input-area">
                    <div class="input-actions">
                        <i class="far fa-smile"></i>
                        <i class="fas fa-paperclip"></i>
                    </div>
                    <input type="text" class="chat-input" placeholder="Ketik pesan..."
                        onkeypress="handleEnter(event)">
                    <button class="btn-send">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </footer>
            </main>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const appContainer = document.getElementById('appContainer');
        const headerName = document.getElementById('headerName');
        const headerAvatar = document.getElementById('headerAvatar');

        function openChat(name, status) {
            headerName.innerText = name;
            headerAvatar.src = `https://ui-avatars.com/api/?name=${name.replace(' ', '+')}&background=random`;

            if (window.innerWidth <= 900) {
                appContainer.classList.add('chat-active');
            }

            const items = document.querySelectorAll('.chat-item');
            items.forEach(item => item.classList.remove('active'));
            event.currentTarget.classList.add('active');
        }

        function closeChat() {
            appContainer.classList.remove('chat-active');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById('messageContainer');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        });

        function handleEnter(e) {
            if (e.key === 'Enter') {
                const input = e.target;
                const container = document.getElementById('messageContainer');

                if (input.value.trim() === '') return;

                const msgHtml = `
                <div class="message-row sent">
                    <div class="bubble">
                        ${input.value}
                        <span class="bubble-time">Barusan <i class="fas fa-check text-grey ms-1"></i></span>
                    </div>
                </div>
            `;

                container.insertAdjacentHTML('beforeend', msgHtml);
                input.value = '';
                container.scrollTop = container.scrollHeight;
            }
        }
    </script>
@endpush
