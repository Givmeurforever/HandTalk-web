<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auth | HandTalk')</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.png') }}">
    
    <!-- CSS khusus halaman auth -->
    @stack('styles')
</head>
<body>
    <div class="container">
        <!-- Bagian Kiri -->
        <div class="left-section">
            <img src="{{ asset('img/sket.png') }}" alt="Lampu di atas tangan">
        </div>

        <!-- Bagian Kanan -->
        <div class="right-section">
            <img src="{{ asset('img/Logo.png') }}" alt="Logo HandTalk" class="logo">
            @yield('content')
        </div>
    </div>

    <!-- Script khusus halaman auth -->
    <script src="{{ asset('JS/auth.js') }}"></script>
    @stack('scripts')
</body>
</html>
