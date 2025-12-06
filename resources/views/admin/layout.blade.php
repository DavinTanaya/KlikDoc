<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'KlikDoc | Admin Dashboard')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  @yield('head')
  @stack('styles')
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

</head>

<body>
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

  @yield('body')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  @stack('scripts')
</body>

</html>
