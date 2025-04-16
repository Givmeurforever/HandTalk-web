<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HandTalk') | HandTalk</title>
    <link rel="icon" type="image/png" href="img/Logo.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @stack('styles')
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo-group">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
                    <span class="brand-name">HandTalk</span>
                </div>
            </div>
        
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                <li><a href="{{ route('admin.pengguna.index') }}"><i class="fas fa-users"></i> <span>Pengguna</span></a></li>
                <li><a href="{{ route('admin.kursus.index') }}"><i class="fas fa-layer-group"></i> <span>Kursus</span></a></li>
                <li><a href="{{ route('admin.materi.index') }}"><i class="fas fa-book"></i> <span>Materi</span></a></li>
                <li><a href="{{ route('admin.latihan.index') }}"><i class="fas fa-book-open"></i> <span>Latihan</span></a></li>
                <li><a href="{{ route('admin.kuis.index') }}"><i class="fas fa-graduation-cap"></i> <span>Kuis</span></a></li>
                <li><a href="{{ route('admin.kamus.index') }}"><i class="fas fa-atlas"></i> <span>Kamus</span></a></li>
                <li><a href="{{ route('admin.pengaturan.index') }}"><i class="fas fa-cog"></i> <span>Pengaturan</span></a></li>
                <li>
                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        
            <div class="sidebar-footer">
                <p>&copy; 2025 HandTalk</p>
            </div>
        </aside>
        

        <!-- Main Content -->
        <main class="main-content">
            <div class="top-navbar">
                <div class="toggle-sidebar"><i class="fas fa-bars"></i></div>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari...">
                </div>
                <div class="user-info">
                    <div class="notification-wrapper">
                        <div class="notifications" title="Notifikasi">
                            <i class="fas fa-bell"></i>
                            <span class="badge">3</span>
                        </div>
                        <div class="notification-dropdown">
                            <p><strong>Notifikasi Terbaru</strong></p>
                            <ul>
                                <li>User123 menyelesaikan materi A</li>
                                <li>User456 mengerjakan kuis</li>
                                <li>User789 mendaftar</li>
                            </ul>
                            <a href="{{ route('admin.notifications') }}" class="view-all">Lihat Semua</a>
                        </div>
                    </div>
                    <a href="{{ route('admin.profile') }}" class="user" title="Lihat Profil Admin">
                        <img src="{{ asset('img/profile-default.png') }}" alt="Avatar">
                        <div class="user-details">
                            <span class="user-name">Admin HandTalk</span>
                            <span class="user-role">Super Admin</span>
                        </div>
                    </a>
                </div>
                               
            </div>

            <section class="content">
                @yield('content')
            </section>
        </main>
    </div>

    <script>
        document.querySelector('.toggle-sidebar')?.addEventListener('click', () => {
            document.querySelector('.sidebar')?.classList.toggle('collapsed');
            document.querySelector('.main-content')?.classList.toggle('expanded');
        });
    </script>    

    @yield('scripts')
</body>
</html>
