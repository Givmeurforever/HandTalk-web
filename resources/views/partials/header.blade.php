<header class="navbar">
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
    
    <div class="auth-buttons">
        <a href="{{ route('signup') }}" class="btn signup">Sign Up</a>
        <a href="{{ route('login') }}" class="btn login">Login</a>
    </div>
    <div class="user-info" id="userInfo" style="display: none;">
        <img src="{{ asset('img/profile-default.png') }}" alt="Profile Picture" class="profile-img" id="userProfileImg">
        <span id="userFullName"></span>
    </div>    

</header>
