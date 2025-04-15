<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="img/Logo.png">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    @stack('styles')
</head>
<body>

    <!-- 🔹 Header -->
    @include('partials.header')

    <!-- 🔹 Konten utama -->
    <main>
        @yield('content')
    </main>

    <!-- 🔹 Footer -->
    @include('partials.footer')

    <script src="{{ asset('js/auth-guard.js') }}"></script>
    <script src="{{ asset('js/header.js') }}"></script>


    @stack('scripts') <!-- Untuk JavaScript tambahan per halaman -->
</body>
</html>
