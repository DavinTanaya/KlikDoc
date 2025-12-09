@php
    $layout = auth()->user()->role === 'admin' ? 'admin.layout' : 'dokter.layout';
@endphp

@extends($layout)

@section('head')
    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 20000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast-msg {
            padding: 12px 18px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateX(20px);
            animation: slideIn 0.3s forwards, fadeOut 0.4s 3s forwards;
        }

        .toast-success {
            background: #28a745;
        }

        .toast-error {
            background: #dc3545;
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateX(20px);
            }
        }
    </style>
@endsection

@stack('styles')

@section('body')
    <div class="toast-container">

        @if (session('success'))
            <div class="toast-msg toast-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="toast-msg toast-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="toast-msg toast-error">
                {{ $errors->first() }}
            </div>
        @endif

    </div>
    <div class="article-layout-wrapper">
        @yield('article-content')
    </div>
@endsection
