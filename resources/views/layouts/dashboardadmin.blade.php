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
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.pengguna') }}"><i class="fas fa-users"></i> Pengguna</a></li>
                <li><a href="{{ route('admin.kursus') }}"><i class="fas fa-layer-group"></i> Kursus</a></li>
                <li><a href="{{ route('admin.materi') }}"><i class="fas fa-book"></i> Materi</a></li>
                <li><a href="{{ route('admin.latihan') }}"><i class="fas fa-book-open"></i> Latihan</a></li>
                <li><a href="{{ route('admin.kuis') }}"><i class="fas fa-graduation-cap"></i> Kuis</a></li>
                <li><a href="{{ route('admin.kamus') }}"><i class="fas fa-atlas"></i> Kamus</a></li>
                <li><a href="{{ route('admin.pengaturan') }}"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li>
                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
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
                    <div class="user-info">
                        <div class="notifications">
                            <i class="fas fa-bell"></i>
                            <span class="badge">3</span>
                        </div>
                        <div class="user">
                            <img src="{{ asset('img/profile-default.png') }}" alt="Avatar">
                            <div class="user-details">
                                <span class="user-name">Admin HandTalk</span>
                                <span class="user-role">Super Admin</span>
                            </div>
                        </div>
                    </div>
                    
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
