@extends('layouts.app')

@section('title', 'Settings | HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endpush

@section('content')
    <div class="settings-container">
        <h1 class="settings-title">Account Settings</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="profile-section">
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="profile-picture-container">
                    <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'profile_pictures/default.png')) }}" 
                         alt="Profile Picture" id="profileImage" 
                         class="profile-image">
                    <div class="profile-picture-controls">
                        <input type="file" name="profile_picture" id="fileInput" accept="image/*" style="display: none;">
                        <button type="button" id="changePictureBtn" class="btn change-picture">Change Picture</button>
                        @error('profile_picture')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-section">
                    <div class="name-fields">
                        <div class="field">
                            <label for="firstName">First Name</label>
                            <input type="text" name="first_name" id="firstName" value="{{ Auth::user()->first_name }}" required>
                            @error('first_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="last_name" id="lastName" value="{{ Auth::user()->last_name }}" required>
                            @error('last_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" value="{{ Auth::user()->email }}" disabled>
                    </div>

                    <div class="password-section">
                        <h3>Change Password</h3>
                        <div class="field">
                            <label for="current_password">Current Password</label>
                            <div class="password-input-container">
                                <input type="password" name="current_password" id="current_password" placeholder="Enter current password">
                                <button type="button" class="toggle-password" data-target="current_password">
                                    <img src="{{ asset('img/eye-closed.svg') }}" alt="Toggle password visibility">
                                </button>
                            </div>
                            @error('current_password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="password">New Password</label>
                            <div class="password-input-container">
                                <input type="password" name="password" id="password" placeholder="Enter new password">
                                <button type="button" class="toggle-password" data-target="password">
                                    <img src="{{ asset('img/eye-closed.svg') }}" alt="Toggle password visibility">
                                </button>
                            </div>
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="password_confirmation">Confirm New Password</label>
                            <div class="password-input-container">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm new password">
                                <button type="button" class="toggle-password" data-target="password_confirmation">
                                    <img src="{{ asset('img/eye-closed.svg') }}" alt="Toggle password visibility">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="buttons">
                    <a href="{{ url()->previous() }}" class="btn back">Back</a>
                    <button type="reset" class="btn cancel">Cancel</button>
                    <button type="submit" class="btn save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div class="danger-zone">
        <h3>Danger Zone</h3>
        <div class="delete-account-section">
            <form action="{{ route('account.delete') }}" method="POST" id="deleteAccountForm">
                @csrf
                @method('DELETE')
                <p>Once you delete your account, there is no going back. Please be certain.</p>
                <button type="button" id="deleteAccountBtn" class="btn delete-account">
                    <img src="{{ asset('img/trash.svg') }}" alt="Delete Icon">
                    Delete Account
                </button>
            </form>
        </div>
    </div>

    <div id="deleteConfirmModal" class="modal hidden">
        <div class="modal-content">
            <h3>Confirm Account Deletion</h3>
            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
            <div class="modal-buttons">
                <button id="cancelDelete" class="btn cancel">Cancel</button>
                <button id="confirmDelete" class="btn delete">Delete My Account</button>
            </div>
        </div>
    </div>

    <div id="toast" class="toast hidden">Profile updated!</div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Profile picture upload preview
            const profileImage = document.getElementById('profileImage');
            const fileInput = document.getElementById('fileInput');
            const changePictureBtn = document.getElementById('changePictureBtn');

            changePictureBtn.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Toggle password visibility
            const toggleButtons = document.querySelectorAll('.toggle-password');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);
                    const icon = this.querySelector('img');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.src = "{{ asset('img/eye-open.svg') }}";
                    } else {
                        passwordInput.type = 'password';
                        icon.src = "{{ asset('img/eye-closed.svg') }}";
                    }
                });
            });

            // Delete account modal
            const deleteAccountBtn = document.getElementById('deleteAccountBtn');
            const deleteConfirmModal = document.getElementById('deleteConfirmModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const confirmDelete = document.getElementById('confirmDelete');
            const deleteAccountForm = document.getElementById('deleteAccountForm');

            deleteAccountBtn.addEventListener('click', function() {
                deleteConfirmModal.classList.remove('hidden');
            });

            cancelDelete.addEventListener('click', function() {
                deleteConfirmModal.classList.add('hidden');
            });

            confirmDelete.addEventListener('click', function() {
                deleteAccountForm.submit();
            });

            // Display toast message if in URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('updated')) {
                const toast = document.getElementById('toast');
                toast.classList.remove('hidden');
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 3000);
            }
        });
    </script>
@endpush