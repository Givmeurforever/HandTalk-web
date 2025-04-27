<header class="navbar">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <div class="logo-container">
        <img src="{{ asset('img/logo.png') }}" alt="HandTalk Logo">
        <a href="{{ route('home') }}">HandTalk</a>
    </div>

    <form action="{{ route('kamus') }}" method="GET" class="search-container">
        <input type="text" name="search" placeholder="Cari kata..." required>
        <button type="submit">
            <img src="{{ asset('img/search.svg') }}" alt="Search">
        </button>
    </form>

    <!-- Untuk guest -->
    <div class="auth-buttons">
        <a href="{{ route('signup') }}" class="btn signup">Sign Up</a>
        <a href="{{ route('login') }}" class="btn login">Login</a>
    </div>

    <!-- Untuk user (ditampilkan via JS kalau ada user di localStorage) -->
    <div class="user-info" id="userInfo">
        <img src="{{ asset('img/profile-default.png') }}" alt="Profile" class="profile-img">
        <div class="user-name-tooltip">
            <span id="userFullName">Nama User</span>
            <div class="user-dropdown">
                <a href="/dashboard"><i class="fas fa-user"></i> Dashboard</a>
                <a href="/notifications"><i class="fas fa-bell"></i> Notifikasi</a>
                <a href="/settings"><i class="fas fa-cog"></i> Pengaturan</a>
                <a href="#" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
    
</header>
