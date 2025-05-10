@extends('layouts.auth')

@section('title', 'Sign Up | HandTalk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/signup.css') }}">
@endpush

@section('content')
    <h1>Create Account</h1>
    {{-- Tambahkan enctype agar bisa upload file --}}
    <form id="signUpForm" method="POST" action="{{ url('/signup') }}" enctype="multipart/form-data">
        @csrf

        {{-- Nama Depan & Belakang --}}
        <div class="input-group">
            <input type="text" id="firstName" name="first_name" placeholder="Nama Depan" required>
            <input type="text" id="lastName" name="last_name" placeholder="Nama Belakang" required>
        </div>

        {{-- Email --}}
        <input type="email" id="email" name="email" placeholder="Email" required>

        {{-- Password --}}
        <div class="password-container">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span class="toggle-password">
                <img src="{{ asset('img/eye-closed.svg') }}" alt="Toggle Password" id="togglePassword">
            </span>
        </div>

        {{-- Tombol Submit --}}
        <button type="submit">Create Account</button>
    </form>

    <p>Sudah punya akun? gas <a href="{{ route('login') }}">login</a></p>
@endsection

@push('scripts')
<script src="{{ asset('js/signup.js') }}"></script>
@endpush
