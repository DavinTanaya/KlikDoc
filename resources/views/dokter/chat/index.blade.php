@extends('layout')

@section('title', 'KlikDoc | Chat Dokter')

@push('styles')
    <!-- Font Inter untuk Chat -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Mengarah ke file CSS yang sudah di-scope -->
    <link rel="stylesheet" href="{{ asset('css/dokter/chat/styles.css') }}">
@endpush

@section('body')
    <!-- WRAPPER UTAMA UNTUK SCOPING CSS -->
    <div class="dokter-chat">
        
        <div class="chat-wrapper">
            <div class="app-container" id="appContainer">

                <!-- SIDEBAR -->
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
                        <!-- Chat 1: Active -->
                        <li class="chat-item active" onclick="openChat('digibot_NEW', 'Online', true)">
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

                        <!-- Chat 2: Active -->
                        <li class="chat-item" onclick="openChat('PCB Express', 'Online', true)">
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

                        <!-- Chat 3: Closed -->
                        <li class="chat-item" onclick="openChat('Solar Perfect', 'Offline', false)">
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

                    <!-- Status Bar dengan Tombol Dokter -->
                    <div id="chatStatusBar" class="chat-status-bar status-active">
                        <div class="status-left">
                            <span id="statusIcon"><i class="fas fa-clock"></i></span>
                            <span id="statusText">Sesi chat sedang berlangsung</span>
                        </div>
                        
                        <!-- TOMBOL KHUSUS DOKTER -->
                        <div class="doctor-controls" id="doctorControls">
                            <button class="btn-doc-action btn-resep" onclick="openPrescriptionModal()">
                                <i class="fas fa-prescription-bottle-alt"></i> Resep
                            </button>
                            <button class="btn-doc-action btn-selesai" onclick="finishConsultation()">
                                <i class="fas fa-check-circle"></i> Selesai
                            </button>
                        </div>
                    </div>

                    <!-- Messages List -->
                    <div class="messages-container" id="messageContainer">
                        <div class="date-divider"><span>HARI INI</span></div>
                        <div class="message-row sent">
                            <div class="bubble">
                                permisi kak, apakah ini sudah tersolder?
                                <span class="bubble-time">21:46 <i class="fas fa-check-double text-primary ms-1"></i></span>
                            </div>
                        </div>
                        <div class="message-row received">
                            <div class="bubble">
                                Terima kasih atas pesan Anda 🙏 Digibot sedang tidak ada saat ini.
                                <span class="bubble-time">21:49</span>
                            </div>
                        </div>

                        <div class="date-divider"><span>13 AGUSTUS 2025</span></div>
                        <div class="message-row received">
                            <div class="bubble">
                                belum ya kak - mimin
                                <span class="bubble-time">14:21</span>
                            </div>
                        </div>

                        <div class="message-row sent">
                            <div class="bubble">
                                Oke siap kak, ditunggu kabar baiknya ya
                                <span class="bubble-time">14:25 <i class="fas fa-check text-grey ms-1"></i></span>
                            </div>
                        </div>
                    </div>

                    <!-- Input Area -->
                    <footer class="input-area" id="inputArea">
                        <div class="input-wrapper-active" id="inputWrapperActive">
                            <div class="input-actions">
                                <i class="far fa-smile"></i>
                                <i class="fas fa-paperclip"></i>
                            </div>
                            <input type="text" class="chat-input" id="msgInput" placeholder="Ketik pesan..."
                                onkeypress="handleEnter(event)">
                            <button class="btn-send">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>

                        <div class="input-closed-message" id="inputClosedMessage">
                            <i class="fas fa-lock me-2"></i> Anda tidak dapat membalas percakapan ini.
                        </div>
                    </footer>
                </main>
            </div>
        </div>

        <!-- MODAL RESEP OBAT -->
        <div id="prescriptionModal" class="modal-overlay">
            <div class="modal-box">
                <div class="modal-header">
                    <span class="modal-title">Buat Resep Obat</span>
                    <span class="close-modal" onclick="closePrescriptionModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Obat</label>
                        <input type="text" id="drugName" placeholder="Contoh: Paracetamol 500mg">
                    </div>
                    <div class="form-group">
                        <label>Dosis & Aturan Pakai</label>
                        <input type="text" id="drugDosage" placeholder="3x1 sesudah makan">
                    </div>
                    <div class="form-group">
                        <label>Catatan Tambahan</label>
                        <textarea rows="3" id="drugNotes" placeholder="Instruksi khusus..."></textarea>
                    </div>
                    <button class="btn-submit-resep" onclick="submitPrescription()">Kirim Resep</button>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const appContainer = document.getElementById('appContainer');
        const headerName = document.getElementById('headerName');
        const headerStatus = document.getElementById('headerStatus');
        const headerAvatar = document.getElementById('headerAvatar');

        // Element Status & Input
        const chatStatusBar = document.getElementById('chatStatusBar');
        const statusText = document.getElementById('statusText');
        const statusIcon = document.getElementById('statusIcon');
        const inputWrapperActive = document.getElementById('inputWrapperActive');
        const inputClosedMessage = document.getElementById('inputClosedMessage');
        const doctorControls = document.getElementById('doctorControls');

        function openChat(name, statusInfo, isActive) {
            headerName.innerText = name;
            headerStatus.innerText = statusInfo;
            headerAvatar.src = `https://ui-avatars.com/api/?name=${name.replace(' ', '+')}&background=random`;

            if (isActive) {
                chatStatusBar.className = 'chat-status-bar status-active';
                statusIcon.innerHTML = '<i class="fas fa-clock"></i>';
                statusText.innerText = 'Sesi chat sedang berlangsung';
                inputWrapperActive.style.display = 'flex';
                inputClosedMessage.style.display = 'none';
                if(doctorControls) doctorControls.style.display = 'flex';
            } else {
                chatStatusBar.className = 'chat-status-bar status-closed';
                statusIcon.innerHTML = '<i class="fas fa-check-circle"></i>';
                statusText.innerText = 'Sesi chat telah berakhir';
                inputWrapperActive.style.display = 'none';
                inputClosedMessage.style.display = 'block';
                if(doctorControls) doctorControls.style.display = 'none';
            }

            if (window.innerWidth <= 900) {
                appContainer.classList.add('chat-active');
            }

            const items = document.querySelectorAll('.chat-item');
            items.forEach(item => item.classList.remove('active'));
            event.currentTarget.classList.add('active');

            const container = document.getElementById('messageContainer');
            container.scrollTop = container.scrollHeight;
        }

        function closeChat() {
            appContainer.classList.remove('chat-active');
        }

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
        
        // --- DOCTOR FUNCTIONS ---
        function openPrescriptionModal() {
            document.getElementById('prescriptionModal').style.display = 'flex';
        }

        function closePrescriptionModal() {
            document.getElementById('prescriptionModal').style.display = 'none';
        }

        function submitPrescription() {
            const name = document.getElementById('drugName').value;
            if(!name) return alert("Mohon isi nama obat");
            
            // Simulasi kirim resep
            const container = document.getElementById('messageContainer');
            const msgHtml = `
                <div class="message-row sent">
                    <div class="bubble" style="background:#e0f2f1; border:1px solid #26a69a;">
                        <b><i class="fas fa-prescription"></i> Resep Dokter</b><br>
                        ${name}<br>
                        <span class="bubble-time">Barusan</span>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', msgHtml);
            container.scrollTop = container.scrollHeight;
            
            closePrescriptionModal();
        }

        function finishConsultation() {
            if(confirm("Selesaikan sesi konsultasi ini?")) {
                chatStatusBar.className = 'chat-status-bar status-closed';
                statusIcon.innerHTML = '<i class="fas fa-check-circle"></i>';
                statusText.innerText = 'Sesi Selesai';
                inputWrapperActive.style.display = 'none';
                inputClosedMessage.style.display = 'block';
                doctorControls.style.display = 'none';
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById('messageContainer');
            if (container) container.scrollTop = container.scrollHeight;
        });
    </script>
@endpush