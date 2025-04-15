@extends('layouts.auth')

@section('title', 'Sign Up | HandTalk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/signup.css') }}">
@endpush

@section('content')
    <h1>Create Account</h1>
    <form id="signUpForm">
        <div class="input-group">
            <input type="text" id="firstName" placeholder="Nama Depan" required>
            <input type="text" id="lastName" placeholder="Nama Belakang" required>
        </div>
        <input type="email" id="email" placeholder="Email" required>
        <div class="password-container">
            <input type="password" id="password" placeholder="Password" required>
            <span class="toggle-password">
                <img src="{{ asset('img/eye-closed.svg') }}" alt="Toggle Password" id="togglePassword">
            </span>
        </div>
        <button type="submit">Create Account</button>
    </form>
    <p>Sudah punya akun? gas <a href="{{ route('login') }}">login</a></p>
@endsection

@push('scripts')
<script src="{{ asset('js/signup.js') }}"></script>
@endpush
