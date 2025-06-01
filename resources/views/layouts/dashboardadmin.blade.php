<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HandTalk Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    <link rel="icon" type="image/png" href="img/Logo.png">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>HandTalk</h2>
                <p>Admin Panel</p>
            </div>
            
            <nav class="sidebar-nav">
                @php
                    function isActive($routes) {
                        $currentRoute = Route::currentRouteName();
                        if (is_array($routes)) {
                            foreach ($routes as $route) {
                                if (str_contains($currentRoute, $route)) return 'active';
                            }
                        } else {
                            return str_contains($currentRoute, $routes) ? 'active' : '';
                        }
                        return '';
                    }
                @endphp

                <ul>
                    <li class="{{ isActive('admin.dashboard') }}">
                        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>

                    <li class="{{ isActive('admin.pengguna') }}">
                        <a href="{{ route('admin.pengguna.index') }}"><i class="fas fa-users"></i> Manajemen Pengguna</a>
                    </li>

                    <li class="{{ isActive('admin.topik') }}">
                        <a href="{{ route('admin.topik.index') }}"><i class="fas fa-book"></i> Manajemen Topik</a>
                    </li>

                    <li class="{{ isActive(['admin.materi', 'admin.latihan', 'admin.kuis']) }}">
                        <a href="#"><i class="fas fa-graduation-cap"></i> Konten Pembelajaran</a>
                        <ul class="submenu">
                            <li><a href="{{ route('admin.materi.index') }}">Materi</a></li>
                            <li><a href="{{ route('admin.latihan.index') }}">Latihan</a></li>
                            <li><a href="{{ route('admin.kuis.index') }}">Kuis</a></li>
                        </ul>
                    </li>

                    <li class="{{ isActive('admin.kamus') }}">
                        <a href="{{ route('admin.kamus.index') }}"><i class="fas fa-book-open"></i> Manajemen Kamus</a>
                    </li>

                    <li class="{{ isActive('laporan') }}">
                        <a href="#"><i class="fas fa-chart-bar"></i> Laporan & Analitik</a>
                        <ul class="submenu">
                            <li><a href="#">Kemajuan Pengguna</a></li>
                            <li><a href="#">Statistik Penggunaan</a></li>
                            <li><a href="#">Performa Kuis</a></li>
                        </ul>
                    </li>

                    <li class="{{ isActive('settings') }}">
                        <a href="#"><i class="fas fa-cog"></i> Pengaturan</a>
                        <ul class="submenu">
                            <li><a href="#">Profil Admin</a></li>
                            <li><a href="#">Pengaturan Website</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            
            <div class="sidebar-footer">
                <p>© 2025 HandTalk</p>
                <a href="../logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <div class="header-left">
                    <button id="sidebar-toggle" class="sidebar-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">{{ $pageTitle ?? 'Dashboard' }}</h1>
                </div>

                <div class="header-right">
                    <div class="search-box">
                        <input type="text" placeholder="Cari...">
                        <button><i class="fas fa-search"></i></button>
                    </div>

                    <div class="notifications">
                        <span class="badge">3</span>
                        <i class="fas fa-bell"></i>
                    </div>

                    <div class="user-profile">
                        <img src="{{ asset('img/profile-default.png') }}" alt="Admin">
                        <span>Admin</span>
                    </div>
                </div>
            </header>

            <div class="content">
                {{-- Konten halaman akan di-render di sini --}}
                @yield('content')
            </div>
        </main>
        </div> {{-- Tutup .admin-container --}}

        <script>
            // Script sederhana untuk toggle sidebar pada tampilan mobile
            document.getElementById('sidebar-toggle').addEventListener('click', function() {
                document.querySelector('.sidebar').classList.toggle('collapsed');
                document.querySelector('.main-content').classList.toggle('expanded');
            });

            // Toggle submenu
            document.querySelectorAll('.sidebar-nav > ul > li > a').forEach(function(item) {
                item.addEventListener('click', function(e) {
                    const parent = this.parentElement;
                    const submenu = parent.querySelector('.submenu');
                    
                    if (submenu) {
                        e.preventDefault();
                        parent.classList.toggle('open');
                    }
                });
            });
        </script>

        @stack('scripts')
    </body>
</html>
