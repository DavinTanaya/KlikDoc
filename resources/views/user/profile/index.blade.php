@extends('layout')

@section('title', 'Profil Saya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profile/styles.css') }}">
@endpush

@section('body')
    <div class="profile-page-wrapper">
        <div class="container">
            <a href="{{ route('home') }}" class="btn-back">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
            <div class="profile-header">
                <h1 class="page-title">Profil Saya</h1>
                <p class="page-subtitle">Kelola informasi profil Anda untuk mengontrol, melindungi, dan mengamankan akun
                    Anda.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data"
                class="profile-content-grid">
                @csrf
                @method('PUT')

                <div class="profile-card user-summary-card">
                    <div class="card-body text-center">
                        <div class="avatar-wrapper">
                            <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                class="profile-avatar" id="avatar-preview">
                            <input type="file" name="avatar" id="avatar-input" accept="image/*" style="display: none;"
                                onchange="previewImage(event)">

                            <button type="button" class="btn-change-avatar"
                                onclick="document.getElementById('avatar-input').click()" title="Ganti Foto">
                                <i class="bi bi-camera-fill"></i>
                            </button>
                        </div>

                        <h3 class="user-name">{{ Auth::user()->name }}</h3>
                        <span
                            class="user-role badge-role">{{ Auth::user()->role === 'user' ? 'Pasien' : ucfirst(Auth::user()->role) }}</span>

                        <div class="user-joined">
                            Bergabung sejak {{ \Carbon\Carbon::parse(Auth::user()->created_at)->translatedFormat('d F Y') }}
                        </div>

                        @error('avatar')
                            <div class="text-danger-custom mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="profile-card edit-form-card">
                    <div class="card-header-simple">
                        <h2>Ubah Biodata Diri</h2>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <div class="input-wrapper">
                                <i class="bi bi-person input-icon"></i>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="{{ old('name', Auth::user()->name) }}">
                            </div>
                            @error('name')
                                <span class="text-danger-custom">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <div class="input-wrapper disabled">
                                <i class="bi bi-envelope input-icon"></i>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ Auth::user()->email }}" readonly
                                    title="Email tidak dapat diubah sembarangan">
                                <span class="badge-verified"><i class="bi bi-patch-check-fill"></i> Verified</span>
                            </div>
                            <small class="form-hint">Hubungi admin jika Anda ingin mengubah alamat email.</small>
                        </div>

                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <div class="input-wrapper">
                                <i class="bi bi-telephone input-icon"></i>
                                <input type="tel" name="phone" id="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="{{ old('phone', Auth::user()->phone_number ?? '-') }}">
                            </div>
                            @error('phone')
                                <span class="text-danger-custom">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <i class="bi bi-floppy2-fill"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('avatar-preview');
                output.src = reader.result;
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
@endsection
