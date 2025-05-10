<header class="navbar">
    {{-- Font Awesome untuk ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    {{-- CSS utama --}}
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">

    <div class="logo-container">
        <img src="{{ asset('img/logo.png') }}" alt="HandTalk Logo">
        <a href="{{ route('home') }}">HandTalk</a>
    </div>

    @auth
        <form action="{{ route('kamus') }}" method="GET" class="search-container">
            <input type="text" name="search" placeholder="Cari kata..." required>
            <button type="submit">
                <img src="{{ asset('img/search.svg') }}" alt="Search">
            </button>
        </form>
    @else
        <form action="{{ route('login') }}" method="GET" class="search-container">
            <input type="text" name="search" placeholder="Cari kata..." required>
            <button type="submit">
                <img src="{{ asset('img/search.svg') }}" alt="Search">
            </button>
        </form>
        
    @endauth


    @guest
        <div class="auth-buttons">
            <a href="{{ route('signup') }}" class="btn signup">Sign Up</a>
            <a href="{{ route('login') }}" class="btn login">Login</a>
        </div>
    @endguest

    @auth
        <div class="user-info">
        <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'profile_pictures/default.png')) }}"
             alt="Profile" class="profile-img">
    
        <div class="user-dropdown-wrapper">
            <div class="user-name-tooltip">
                <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
            </div>
    
            <div class="user-dropdown">
                <a href="/dashboard"><i class="fas fa-user"></i> Dashboard</a>
                <a href="/notifications"><i class="fas fa-bell"></i> Notifikasi</a>
                <a href="/settings"><i class="fas fa-cog"></i> Pengaturan</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
        </div>     
    @endauth
</header>
