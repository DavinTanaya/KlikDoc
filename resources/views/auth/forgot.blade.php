<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KlikDoc | Lupa Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth/forgot.css') }}">
</head>

<body>
    <div class="auth-page-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <div class="icon-wrapper">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <h1 class="auth-title">Lupa Kata Sandi?</h1>
                <p class="auth-subtitle">
                    Jangan khawatir. Masukkan alamat email yang terdaftar pada akun Anda, dan kami akan mengirimkan kode
                    OTP untuk verifikasi.
                </p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrapper">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            placeholder="nama@email.com" required autofocus>
                    </div>
                    @error('email')
                        <span class="text-danger-custom">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-primary-auth">
                    Kirim Email
                </button>
            </form>

            <div class="auth-footer">
                <a href="{{ route('login') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i> Kembali ke Halaman Masuk
                </a>
            </div>
        </div>
    </div>
</body>

</html>
