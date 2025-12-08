<style>
  /* === PAGE WRAPPER === */
  .verify-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e0f2fe, #dbeafe);
    padding: 16px;
    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont,
      'Segoe UI', Roboto, sans-serif;
  }

  /* === CARD === */
  .verify-card {
    width: 100%;
    max-width: 420px;
    background: #ffffff;
    border-radius: 16px;
    padding: 32px;
    text-align: center;
    box-shadow:
      0 20px 25px -5px rgba(0, 0, 0, 0.08),
      0 10px 10px -5px rgba(0, 0, 0, 0.04);
    animation: fadeIn 0.4s ease;
  }

  /* === TITLE === */
  .verify-title {
    font-size: 1.25rem;
    /* text-xl */
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
  }

  /* === DESCRIPTION === */
  .verify-text {
    font-size: 0.95rem;
    line-height: 1.6;
    color: #6b7280;
    margin-bottom: 24px;
  }

  /* === RESEND BUTTON === */
  .verify-resend-btn {
    background: none;
    border: none;
    padding: 0;
    font-size: 0.95rem;
    font-weight: 500;
    color: #2563eb;
    cursor: pointer;
    transition: color 0.2s ease;
  }

  .verify-resend-btn:hover {
    color: #1d4ed8;
    text-decoration: underline;
  }

  /* === BACK TO LOGIN LINK === */
  .verify-back-link {
    display: block;
    margin-top: 20px;
    font-size: 0.85rem;
    color: #6b7280;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .verify-back-link:hover {
    color: #374151;
    text-decoration: underline;
  }

  /* === ANIMATION === */
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(6px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .alert {
    max-width: 420px;
    margin: 0 auto 16px auto;
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 0.95rem;
    text-align: center;
  }

  .alert-success {
    background-color: #d1fae5;
    color: #065f46;
  }
</style>


<div class="verify-page">
  <div class="verify-card">
    <h1 class="verify-title">Verifikasi Email Diperlukan</h1>

    <p class="verify-text">
      Kami telah mengirimkan email verifikasi. Silakan cek inbox atau folder spam.
    </p>
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('verify.resend') }}">
      @csrf
      <input type="hidden" name="email" value="{{ $email }}">
      <button type="submit" class="verify-resend-btn">
        Kirim ulang email verifikasi
      </button>
    </form>

    <a href="{{ route('login') }}" class="verify-back-link">
      Kembali ke Login
    </a>
  </div>
</div>
