<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | HandTalk</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
</head>
<body>
    <div class="login-container">
        <!-- Side Image Section -->
        <div class="login-image">
            <div class="login-image-content">
                <div>
                    <div class="image-logo">
                        <img src="{{ asset('img/Logo.png') }}" alt="HandTalk Logo" onerror="this.src='https://via.placeholder.com/150x50'; this.alt='HandTalk Logo';">
                    </div>
                    <h2 class="image-title">Admin Panel HandTalk</h2>
                    <p class="image-text">
                        Akses dashboard untuk mengelola kursus, materi, dan pengguna aplikasi HandTalk. 
                        Pantau kemajuan pengguna dan kelola konten dengan mudah.
                    </p>
                </div>
                <div class="image-footer">
                    &copy; {{ date('Y') }} HandTalk Education. All rights reserved.
                </div>
            </div>
        </div>
        
        <!-- Login Form Section -->
        <div class="login-form">
            <div class="form-header">
                <img src="{{ asset('img/Logo.png') }}" alt="HandTalk Admin" onerror="this.src='https://via.placeholder.com/150x60'; this.alt='HandTalk Admin';">
                <h1>Admin Portal</h1>
                <p>Masuk untuk mengelola aplikasi HandTalk</p>
            </div>
            
            <form id="adminLoginForm" action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <div class="error-message {{ $errors->has('email') ? 'show' : '' }}" id="emailError">
                        {{ $errors->first('email') }}
                    </div>
                </div>
                
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <div class="error-message {{ $errors->has('password') ? 'show' : '' }}" id="passwordError">
                        {{ $errors->first('password') }}
                    </div>
                </div>
                
                <div class="options-row">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Ingat saya</label>
                    </div>
                    
                    <a href="#" class="forgot-password">Lupa password?</a>
                </div>
                
                <button type="submit" class="btn-login">Masuk ke Dashboard</button>
                
                {{-- <div class="error-message {{ session('error') ? 'show' : '' }}" id="loginError">
                    {{ session('error') }}
                </div> --}}
            </form>
            
            <div class="back-to-site">
                <a href="/">← Kembali ke halaman utama</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin-login.js') }}"></script>
</body>
</html>