@extends('layouts.auth')

@section('title', 'Login | HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
    <h1>Welcome Back</h1>
    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <div class="password-container">
            <input type="password" name="password" placeholder="Password" required>
            <span class="toggle-password">
                <img src="{{ asset('img/eye-closed.svg') }}" alt="Toggle Password" id="togglePassword">
            </span>
        </div>
        <button type="submit">Login</button>
    </form>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <p>Belum punya akun? <a href="{{ route('signup') }}">Sign up</a></p>
@endsection