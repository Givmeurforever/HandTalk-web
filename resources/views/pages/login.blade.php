@extends('layouts.auth')

@section('title', 'Login | HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
    <h1>Welcome Back</h1>
    <form id="loginForm">
        <input type="email" id="email" placeholder="Email" required>
        <div class="password-container">
            <input type="password" id="password" placeholder="Password" required>
            <span class="toggle-password">
                <img src="{{ asset('img/eye-closed.svg') }}" alt="Toggle Password" id="togglePassword">
            </span>
        </div>
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="{{ route('signup') }}">Sign up</a></p>
@endsection

@push('scripts')
<script src="{{ asset('js/login.js') }}"></script>
@endpush
