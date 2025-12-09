@extends('layout')

@section('title', 'KlikDoc | Pembayaran Berhasil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/konsultasi/payment/success.css') }}">
@endpush

@section('body')
    <div class="success-page">
        <div class="success-card">
            <div class="success-icon-wrapper">
                <div class="success-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <div class="ripple"></div>
            </div>
            <div class="text-content">
                <h1>Pembayaran Berhasil!</h1>
                <p>
                    Terima kasih <strong>{{ $consultation->user->name }}</strong>,
                    pembayaran untuk konsultasi dengan
                    <strong>{{ $consultation->doctor->full_name }}</strong>
                    telah berhasil.
                </p>
            </div>
            <div class="receipt-box">
                <div class="receipt-row">
                    <span class="label">No. Konsultasi</span>
                    <span class="value">#{{ $consultation->consultation_code }}</span>
                </div>

                <div class="receipt-row">
                    <span class="label">Layanan</span>
                    <span class="value">Konsultasi Dokter (Chat Online)</span>
                </div>

                <div class="receipt-row">
                    <span class="label">Dokter</span>
                    <span class="value">{{ $consultation->doctor->full_name }}</span>
                </div>

                <div class="receipt-row">
                    <span class="label">Spesialisasi</span>
                    <span class="value">{{ $consultation->doctor->spesialisasi }}</span>
                </div>

                <div class="receipt-row">
                    <span class="label">Waktu Transaksi</span>
                    <span class="value">
                        {{ $consultation->created_at->format('d M Y, H:i') }}
                    </span>
                </div>

                <div class="receipt-row">
                    <span class="label">Metode Pembayaran</span>
                    <span class="value">Midtrans</span>
                </div>

                <div class="divider"></div>

                <div class="receipt-row">
                    <span class="label">Konsultasi</span>
                    <span class="value">Rp {{ number_format($consultation->consultation_fee) }}</span>
                </div>

                <div class="receipt-row">
                    <span class="label">Biaya Layanan</span>
                    <span class="value">Rp {{ number_format($consultation->service_fee) }}</span>
                </div>

                <div class="receipt-row">
                    <span class="label">Platform Fee</span>
                    <span class="value">Rp {{ number_format($consultation->platform_fee) }}</span>
                </div>

                <div class="receipt-row total">
                    <span class="label">Total Dibayar</span>
                    <span class="value">Rp {{ number_format($consultation->total) }}</span>
                </div>
            </div>
            <div class="action-buttons">
                <a href="{{ route('chat.index') }}" class="btn-primary">
                    Mulai Konsultasi
                </a>

                <a href="{{ url('/') }}" class="btn-secondary">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
@endsection
