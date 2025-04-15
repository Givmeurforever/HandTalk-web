@extends('layouts.app')

@section('title', 'Settings | HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endpush

@section('content')
    <div class="settings-container">
        <div class="profile-section">
            <img src="{{ asset('img/profile-default.png') }}" alt="Profile Picture" id="profileImage">
            <input type="file" id="fileInput" accept="image/*" style="display: none;">
            <button id="changePictureBtn">Change picture</button>
        </div>

        <div class="form-section">
            <div class="name-fields">
                <div class="field">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" placeholder="First Name">
                </div>
                <div class="field">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" placeholder="Last Name">
                </div>
            </div>

            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Email" disabled>

            <label for="password">Password</label>
            <div class="relative">
                <input type="password" id="password" placeholder="Password">
                <button type="button" id="togglePassword">
                    <img src="{{ asset('img/eye-closed.svg') }}">
                </button>
            </div>
        </div>

        <div class="buttons">
            <button id="cancelBtn" class="btn cancel">Cancel</button>
            <button id="saveBtn" class="btn save">Save</button>
        </div>
    </div>

    {{-- Logout statis di bawah --}}
    <div class="logout-section-static">
        <button id="logoutBtn" class="btn logout">
            <img src="{{ asset('img/logout.svg') }}" alt="Logout Icon">
            Logout
        </button>
    </div>
    <div id="toast" class="toast hidden">Profile updated!</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/settings.js') }}"></script>
@endpush
