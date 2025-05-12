@extends('layouts.auth')

@section('title', 'Sign Up | HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
    <h1>Create Account</h1>

    <form id="signUpForm" method="POST" action="{{ url('/signup') }}" enctype="multipart/form-data">
        @csrf

        <div class="input-group">
            <input type="text" name="first_name" placeholder="Nama Depan" required>
            <input type="text" name="last_name" placeholder="Nama Belakang" required>
        </div>

        <input type="email" name="email" placeholder="Email" required>

        <div class="password-container">
            <input type="password" name="password" placeholder="Password" required>
            <i class="fas fa-eye toggle-password-icon"></i>
        </div>

        <div class="password-container">
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
            <i class="fas fa-eye toggle-password-icon"></i>
        </div>

        <button type="submit">Create Account</button>
    </form>

    <p>Sudah punya akun? gas <a href="{{ route('login') }}">login</a></p>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush
