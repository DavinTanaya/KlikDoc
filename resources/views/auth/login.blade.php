<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KlikDoc | Login</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Asumsi file CSS ini ada di project Laravel Anda -->
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

  <!-- CSS Tambahan untuk Modal (agar berfungsi jika file css/auth.css belum terload di preview ini) -->
  <style>
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 50;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }

    .modal-overlay.show {
      opacity: 1;
      visibility: visible;
    }

    .verification-popup {
      background: white;
      padding: 2rem;
      border-radius: 1rem;
      text-align: center;
      max-width: 400px;
      width: 90%;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      transform: scale(0.9);
      transition: transform 0.3s ease;
    }

    .modal-overlay.show .verification-popup {
      transform: scale(1);
    }

    .popup-icon-wrapper {
      font-size: 3rem;
      color: #3b82f6;
      margin-bottom: 1rem;
    }

    .popup-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #374151;
      margin-bottom: 0.5rem;
    }

    .popup-message {
      color: #6b7280;
      margin-bottom: 1.5rem;
      line-height: 1.5;
    }
  </style>
</head>

<body class="flex min-h-screen items-center justify-center bg-gradient-to-br from-sky-100 to-blue-200 p-4">

  <div class="animate-fade-in w-full max-w-md rounded-2xl bg-white p-8 shadow-xl">

    <div class="mb-6 flex flex-col items-center">
      <!-- Pastikan path image benar -->
      <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc Logo" class="h-12 object-contain">
    </div>

    <div class="mb-6 flex rounded-lg bg-gray-100 p-1">
      <button id="login-tab"
        class="tab-active w-1/2 rounded-md bg-white px-4 py-2 text-sm font-semibold text-blue-600 shadow-sm transition-all duration-300">Masuk</button>
      <button id="signup-tab"
        class="w-1/2 rounded-md px-4 py-2 text-sm font-semibold text-gray-600 transition-all duration-300 hover:text-gray-800">Daftar</button>
    </div>

    <!-- FORM LOGIN (Tetap menggunakan Form Submission biasa) -->
    <div id="login-form">
      <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-700">Selamat Datang Kembali!</h2>
        <p class="text-sm text-gray-500">Silakan masukkan detail Anda untuk masuk.</p>
      </div>
      @if (session('error'))
        <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700">
          {{ session('error') }}
        </div>
      @elseif(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700">
          {{ session('success') }}
        </div>
      @endif
      <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
        @csrf
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
              fill="currentColor">
              <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
              <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
            </svg>
          </span>
          <input type="email" name="email" placeholder="Masukkan email"
            class="w-full rounded-lg border py-2 pl-10 pr-4 text-gray-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
        </div>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
              fill="currentColor">
              <path fill-rule="evenodd"
                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                clip-rule="evenodd" />
            </svg>
          </span>
          <input id="login-password" name="password" type="password" placeholder="Masukkan password"
            class="w-full rounded-lg border py-2 pl-10 pr-10 text-gray-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
          <button type="button" id="toggle-login-password" class="absolute inset-y-0 right-0 flex items-center pr-3">
            <svg id="eye-icon-login" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
              viewBox="0 0 20 20" fill="currentColor">
              <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
              <path fill-rule="evenodd"
                d="M.458 10C3.732 4.943 7.523 3 10 3s6.268 1.943 9.542 7c-3.274 5.057-7.03 7-9.542 7S3.732 15.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                clip-rule="evenodd" />
            </svg>
            <svg id="eye-off-icon-login" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5 text-gray-400"
              viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.27 8.138 16.544 6.834 14.601 6.045L13.186 4.63A12.012 12.012 0 0010 3C7.523 3 3.732 4.943.458 10a12.038 12.038 0 003.249 2.293L3.707 2.293zM10 12a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd" />
              <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
              <path
                d="M2.458 10C3.732 15.057 7.523 17 10 17s6.268-1.943 9.542-7c-1.272-1.862-3.00-3.166-4.943-3.955L13.186 4.63A12.012 12.012 0 0010 3C7.523 3 3.732 4.943.458 10z" />
            </svg>
          </button>
        </div>
        <div class="flex items-center justify-between text-sm">
          <div class="flex items-center">
            <input type="checkbox" id="remember" name="remember"
              class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <label for="remember" class="ml-2 text-gray-600">Ingat saya</label>
          </div>
          <a href="{{ route('auth.forgot') }}" class="font-medium text-blue-600 hover:text-blue-500">Lupa
            password?</a>
        </div>
        <button type="submit"
          class="w-full transform rounded-lg bg-blue-500 px-4 py-2 font-bold text-white transition-all duration-300 hover:scale-105 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
          Masuk
        </button>
      </form>
    </div>

    <!-- FORM SIGNUP (Menggunakan JS Fetch) -->
    <div id="signup-form" class="hidden">
      <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-700">Buat Akun Baru</h2>
        <p class="text-sm text-gray-500">Isi detail di bawah untuk memulai.</p>
      </div>

      <!-- Perubahan: Hapus action/method, tambah ID dan data-action -->
      <form id="js-signup-form" data-action="{{ route('register.post') }}" class="space-y-4">
        @csrf
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
              fill="currentColor">
              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
          </span>
          <input type="text" placeholder="Masukkan nama" name="name"
            class="w-full rounded-lg border py-2 pl-10 pr-4 text-gray-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
        </div>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
              fill="currentColor">
              <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
              <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
            </svg>
          </span>
          <input type="email" placeholder="Masukkan email" name="email"
            class="w-full rounded-lg border py-2 pl-10 pr-4 text-gray-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
        </div>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
              fill="currentColor">
              <path
                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
            </svg>
          </span>
          <input type="tel" placeholder="Masukkan nomor telepon" name="phone_number"
            class="w-full rounded-lg border py-2 pl-10 pr-4 text-gray-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
        </div>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
              fill="currentColor">
              <path fill-rule="evenodd"
                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                clip-rule="evenodd" />
            </svg>
          </span>
          <input id="signup-password" type="password" placeholder="Buat password" name="password"
            class="w-full rounded-lg border py-2 pl-10 pr-10 text-gray-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
          <button type="button" id="toggle-signup-password"
            class="absolute inset-y-0 right-0 flex items-center pr-3">
            <svg id="eye-icon-signup" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
              viewBox="0 0 20 20" fill="currentColor">
              <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
              <path fill-rule="evenodd"
                d="M.458 10C3.732 4.943 7.523 3 10 3s6.268 1.943 9.542 7c-3.274 5.057-7.03 7-9.542 7S3.732 15.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                clip-rule="evenodd" />
            </svg>
            <svg id="eye-off-icon-signup" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5 text-gray-400"
              viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.27 8.138 16.544 6.834 14.601 6.045L13.186 4.63A12.012 12.012 0 0010 3C7.523 3 3.732 4.943.458 10a12.038 12.038 0 003.249 2.293L3.707 2.293zM10 12a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd" />
              <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
              <path
                d="M2.458 10C3.732 15.057 7.523 17 10 17s6.268-1.943 9.542-7c-1.272-1.862-3.00-3.166-4.943-3.955L13.186 4.63A12.012 12.012 0 0010 3C7.523 3 3.732 4.943.458 10z" />
            </svg>
          </button>
        </div>

        <!-- Perubahan: onclick="showVerificationModal()" dihapus, ditangani oleh eventListener JS -->
        <button type="submit" id="btn-submit-signup"
          class="w-full transform rounded-lg bg-blue-500 px-4 py-2 font-bold text-white transition-all duration-300 hover:scale-105 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:scale-100 disabled:bg-blue-300">
          Daftar
        </button>
      </form>
    </div>

    <div class="mt-6">
      <div class="relative">
        <div class="absolute inset-0 flex items-center">
          <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
          <span class="bg-white px-2 text-gray-500">Atau lanjut dengan</span>
        </div>
      </div>

      <div class="mt-4 grid grid-cols-2 gap-3">
        <div>
          <a href="{{ route('google.login') }}"
            class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 shadow-sm transition hover:bg-gray-50">
            <span class="sr-only">Lanjut dengan Google</span>
            <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                fill="#4285F4"></path>
              <path
                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                fill="#34A853"></path>
              <path
                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                fill="#FBBC05"></path>
              <path
                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                fill="#EA4335"></path>
            </svg>
          </a>
        </div>

        <div>
          <a href="#"
            class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 shadow-sm transition hover:bg-gray-50">
            <span class="sr-only">Lanjut dengan Facebook</span>
            <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
              <path fill="#1877F2"
                d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-1.5c-1 0-1.5.5-1.5 1.5V12h3l-.5 3h-2.5v6.8c4.56-.93 8-4.96 8-9.8z">
              </path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL VERIFIKASI -->
  <div id="emailVerificationModal" class="modal-overlay">
    <div class="verification-popup">
      <div class="popup-icon-wrapper">
        <i class="bi bi-envelope-check-fill"></i>
      </div>
      <h3 class="popup-title">Verifikasi Email Anda</h3>
      <p class="popup-message">
        Kami telah mengirimkan tautan verifikasi ke email Anda. Silakan periksa kotak masuk (atau folder spam)
        dan klik tautan untuk mengaktifkan akun.
      </p>
      <!-- Perubahan: Tombol "Sudah Verifikasi" diganti tombol Tutup -->
      <button onclick="closeModal()" class="mt-2 text-sm text-gray-500 hover:text-gray-700 hover:underline">
        Tutup
      </button>
    </div>
  </div>

  <!-- Script External (Auth Logic Tab Switcher etc) -->
  <script src="{{ asset('js/auth.js') }}"></script>

  <!-- Script Logic untuk Form dan Modal -->
  <script>
    // Tab switching logic (simple version in case js/auth.js is not present for preview)
    const loginTab = document.getElementById('login-tab');
    const signupTab = document.getElementById('signup-tab');
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');

    loginTab.addEventListener('click', () => {
      loginTab.classList.add('tab-active', 'bg-white', 'shadow-sm', 'text-blue-600');
      loginTab.classList.remove('text-gray-600');
      signupTab.classList.remove('tab-active', 'bg-white', 'shadow-sm', 'text-blue-600');
      signupTab.classList.add('text-gray-600');
      loginForm.classList.remove('hidden');
      signupForm.classList.add('hidden');
    });

    signupTab.addEventListener('click', () => {
      signupTab.classList.add('tab-active', 'bg-white', 'shadow-sm', 'text-blue-600');
      signupTab.classList.remove('text-gray-600');
      loginTab.classList.remove('tab-active', 'bg-white', 'shadow-sm', 'text-blue-600');
      loginTab.classList.add('text-gray-600');
      signupForm.classList.remove('hidden');
      loginForm.classList.add('hidden');
    });



    // --- LOGIC BARU: AJAX FORM SUBMISSION & MODAL ---

    function showVerificationModal() {
      document.getElementById('emailVerificationModal').classList.add('show');
    }

    function closeModal() {
      document.getElementById('emailVerificationModal').classList.remove('show');
    }

    // Menutup modal jika klik di luar area popup
    document.getElementById('emailVerificationModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeModal();
      }
    });

    const jsSignupForm = document.getElementById('js-signup-form');

    if (jsSignupForm) {
      jsSignupForm.addEventListener('submit', async function(e) {
        e.preventDefault(); // Mencegah reload halaman

        const btnSubmit = document.getElementById('btn-submit-signup');
        const originalText = btnSubmit.innerText;
        const url = this.getAttribute('data-action');

        // Visual Loading
        btnSubmit.innerText = 'Memproses...';
        btnSubmit.disabled = true;
        btnSubmit.classList.add('opacity-75', 'cursor-not-allowed');

        // Ambil Data Form
        const formData = new FormData(this);

        try {
          const response = await fetch(url, {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
          });

          const data = await response.json();

          if (response.ok) {
            // SUKSES
            showVerificationModal();
            jsSignupForm.reset(); // Reset form
          } else {
            // GAGAL (Validasi error dll)
            let errorMessage = data.message || 'Terjadi kesalahan saat mendaftar.';

            // Jika ada detail error validasi dari Laravel
            if (data.errors) {
              // Mengambil error pertama saja untuk ditampilkan di alert
              const firstErrorKey = Object.keys(data.errors)[0];
              errorMessage = data.errors[firstErrorKey][0];
            }

            alert(errorMessage);
          }
        } catch (error) {
          console.error('Error:', error);
          alert('Terjadi kesalahan koneksi atau server.');
        } finally {
          // Kembalikan tombol ke kondisi semula
          btnSubmit.innerText = originalText;
          btnSubmit.disabled = false;
          btnSubmit.classList.remove('opacity-75', 'cursor-not-allowed');
        }
      });
    }
  </script>

</body>

</html>
