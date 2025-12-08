<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KlikDoc | Buat Kata Sandi Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/auth/new-password.css') }}">
</head>
<body>
    <div class="auth-page-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <div class="icon-wrapper">
                    <i class="bi bi-key-fill"></i>
                </div>
                <h1 class="auth-title">Kata Sandi Baru</h1>
                <p class="auth-subtitle">
                    Buat kata sandi baru yang kuat dan unik untuk melindungi akun Anda.
                </p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('status') }}
                </div>
            @endif

            <form action="" method="POST" class="auth-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token ?? '' }}">
                <input type="hidden" name="email" value="{{ $email ?? '' }}">

                {{-- Password Baru --}}
                <div class="form-group">
                    <label for="password">Kata Sandi Baru</label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" name="password" id="password" 
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 8 karakter" 
                               required>
                        <button type="button" class="btn-toggle-password" onclick="togglePassword('password')">
                            <i class="bi bi-eye-slash" id="icon-password"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-danger-custom">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="form-control"
                               placeholder="Ulangi kata sandi baru" 
                               required>
                        <button type="button" class="btn-toggle-password" onclick="togglePassword('password_confirmation')">
                            <i class="bi bi-eye-slash" id="icon-password_confirmation"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-primary-auth">
                    Reset Kata Sandi
                </button>
            </form>

            <div class="auth-footer">
                <a href="{{ route('login') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i> Kembali ke Login
                </a>
            </div>
        </div>
    </div>

    {{-- Script Toggle Password --}}
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById('icon-' + inputId);
            
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = "password";
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>
</html>