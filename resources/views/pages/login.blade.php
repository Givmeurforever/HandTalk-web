@extends('layouts.auth')

@section('title', 'Login | HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
    <h1>Welcome Back</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        
        <div class="password-container">
            <input type="password" name="password" placeholder="Password" required>
            <i class="fas fa-eye-slash toggle-password-icon"></i>
        </div>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('signup') }}">Sign up</a></p>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush
