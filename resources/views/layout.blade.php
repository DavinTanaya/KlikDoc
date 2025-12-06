<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KlikDoc')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('head')
    @stack('styles')
</head>

<body>
  @include('components.navbar')
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
  @include('components.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  @stack('scripts')
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.0/dist/echo.iife.js"></script>

  <script>
    window.Echo = new Echo({
      broadcaster: 'pusher',
      key: "{{ config('broadcasting.connections.pusher.key') }}",
      wsHost: "5.175.183.160",
      wsPort: 6001,
      forceTLS: false,
      encrypted: false,
      disableStats: true,
      authEndpoint: "/broadcasting/auth",
      auth: {
        headers: {
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
      },
    });

    let onlineUsers = {};

    window.Echo.join('presence.online')
      .here((users) => {
        console.log("[ONLINE] Current:", users);
        onlineUsers = {};
        users.forEach(u => onlineUsers[u.id] = u);
        updateOnlineUI();
      })
      .joining((user) => {
        console.log("[ONLINE] User joined:", user);
        onlineUsers[user.id] = user;
        updateOnlineUI();
      })
      .leaving((user) => {
        console.log("[ONLINE] User left:", user);
        delete onlineUsers[user.id];
        updateOnlineUI();
      });

    function updateOnlineUI() {
      document.querySelectorAll("[data-user-id]").forEach(el => {
        let uid = el.dataset.userId;
        if (onlineUsers[uid]) {
          el.innerHTML = '<span class="text-success">● Online</span>';
        } else {
          el.innerHTML = '<span class="text-muted">● Offline</span>';
        }
      });
    }
  </script>

</body>

</html>
