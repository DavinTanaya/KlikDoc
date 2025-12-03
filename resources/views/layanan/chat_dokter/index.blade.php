@extends('layout')

@section('title', 'KlikDoc | Chat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/chat_dokter/chat_dokter.css') }}">
@endpush

@section('body')
    <main class="chat_wrapper py-4">
        <div class="container">
            <div class="chat_container">

                {{-- Sidebar --}}
                <div class="chat_sidebar">
                    <div class="chat_sidebar-header">
                        <h5>Chat</h5>
                    </div>

                    <ul class="chat_list">
                        <li class="chat_list-item active">
                            <div class="chat_avatar">
                                <img src="{{ asset('image/default-avatar.png') }}" alt="">
                            </div>
                            <div class="chat_info">
                                <p class="chat_name mb-0">digibot_NEW</p>
                                <span class="chat_status">penjual</span>
                            </div>
                        </li>

                        <li class="chat_list-item">
                            <div class="chat_avatar">
                                <img src="{{ asset('image/default-avatar.png') }}" alt="">
                            </div>
                            <div class="chat_info">
                                <p class="chat_name mb-0">pcb expres jo…</p>
                                <span class="chat_status">penjual</span>
                            </div>
                        </li>

                        <li class="chat_list-item">
                            <div class="chat_avatar">
                                <img src="{{ asset('image/default-avatar.png') }}" alt="">
                            </div>
                            <div class="chat_info">
                                <p class="chat_name mb-0">solarperfect</p>
                                <span class="chat_status">penjual</span>
                            </div>
                        </li>
                    </ul>
                </div>

                {{-- Chat Room --}}
                <div class="chat_room">
                    <div class="chat_room-header">
                        <div class="d-flex align-items-center gap-3">
                            <div class="chat_avatar">
                                <img src="{{ asset('image/default-avatar.png') }}" alt="">
                            </div>
                            <div>
                                <h6 class="mb-0">digibot_NEW</h6>
                                <small class="text-success fw-semibold">Penjual</small>
                            </div>
                        </div>
                    </div>

                    {{-- Chat Messages --}}
                    <div class="chat_messages">

                        <div class="message message-right">
                            <div class="bubble">
                                permisi kak, apakah ini sudah tersolder?
                            </div>
                            <span class="time">21:46</span>
                        </div>

                        <div class="message message-left">
                            <div class="bubble">
                                Terima kasih atas pesan Anda 🙏<br><br>
                                Digibot sedang tidak ada saat ini, tetapi akan merespons secepat mungkin, mohon ditunggu ya
                                😊🙏<br>
                                <small>Powered by Digi AI</small>
                            </div>
                            <span class="time">21:49</span>
                        </div>

                        <div class="date_separator">13 Aug 2025</div>

                        <div class="message message-left">
                            <div class="bubble">
                                belum ya kak - mimin
                            </div>
                            <span class="time">14:21</span>
                        </div>

                    </div>

                    {{-- Input --}}
                    <div class="chat_input-bar">
                        <input type="text" class="chat_input" placeholder="Tulis Pesan...">
                        <button class="chat_send-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </main>
@endsection
