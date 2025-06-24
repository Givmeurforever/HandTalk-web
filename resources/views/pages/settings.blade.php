@extends('layouts.app')

@section('title', 'Settings | HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="settings-wrapper">
        <div class="settings-header">
            <div class="header-content">
                <i class="fas fa-cog header-icon"></i>
                <h1 class="settings-title">Account Settings</h1>
                <p class="settings-subtitle">Manage your profile and account preferences</p>
            </div>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="settings-container">
            <div class="profile-section">
                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="profile-card">
                        <div class="profile-picture-container">
                            <div class="profile-image-wrapper">
                                <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'profile_pictures/default.png')) }}" 
                                     alt="Profile Picture" id="profileImage" 
                                     class="profile-image">
                                <div class="image-overlay">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </div>
                            <div class="profile-picture-controls">
                                <input type="file" name="profile_picture" id="fileInput" accept="image/*" style="display: none;">
                                <button type="button" id="changePictureBtn" class="btn btn-outline change-picture">
                                    <i class="fas fa-upload"></i>
                                    Change Picture
                                </button>
                                @error('profile_picture')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="section-header">
                                <i class="fas fa-user"></i>
                                <h3>Personal Information</h3>
                            </div>
                            
                            <div class="name-fields">
                                <div class="field">
                                    <label for="firstName">
                                        <i class="fas fa-user-tag"></i>
                                        First Name
                                    </label>
                                    <input type="text" name="first_name" id="firstName" value="{{ Auth::user()->first_name }}" required>
                                    @error('first_name')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label for="lastName">
                                        <i class="fas fa-user-tag"></i>
                                        Last Name
                                    </label>
                                    <input type="text" name="last_name" id="lastName" value="{{ Auth::user()->last_name }}" required>
                                    @error('last_name')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="field">
                                <label for="email">
                                    <i class="fas fa-envelope"></i>
                                    Email Address
                                </label>
                                <input type="email" id="email" value="{{ Auth::user()->email }}" disabled>
                                <small class="field-note">Email cannot be changed</small>
                            </div>

                            <div class="password-section">
                                <div class="section-header">
                                    <i class="fas fa-lock"></i>
                                    <h3>Security Settings</h3>
                                </div>
                                
                                <div class="field">
                                    <label for="current_password">
                                        <i class="fas fa-key"></i>
                                        Current Password
                                    </label>
                                    <div class="password-input-container">
                                        <input type="password" name="current_password" id="current_password" placeholder="Enter current password">
                                        <button type="button" class="toggle-password" data-target="current_password">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="password">
                                        <i class="fas fa-lock"></i>
                                        New Password
                                    </label>
                                    <div class="password-input-container">
                                        <input type="password" name="password" id="password" placeholder="Enter new password">
                                        <button type="button" class="toggle-password" data-target="password">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="password_confirmation">
                                        <i class="fas fa-lock"></i>
                                        Confirm New Password
                                    </label>
                                    <div class="password-input-container">
                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm new password">
                                        <button type="button" class="toggle-password" data-target="password_confirmation">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="buttons">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Back
                            </a>
                            <button type="reset" class="btn btn-outline">
                                <i class="fas fa-undo"></i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="danger-zone">
            <div class="danger-card">
                <div class="section-header danger-header">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>Danger Zone</h3>
                </div>
                <div class="delete-account-section">
                    <form action="{{ route('account.delete') }}" method="POST" id="deleteAccountForm">
                        @csrf
                        @method('DELETE')
                        <p>Once you delete your account, there is no going back. Please be certain.</p>
                        <button type="button" id="deleteAccountBtn" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                            Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteConfirmModal" class="modal hidden">
        <div class="modal-backdrop"></div>
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-exclamation-triangle"></i>
                <h3>Confirm Account Deletion</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete your account? This action cannot be undone and all your data will be permanently lost.</p>
            </div>
            <div class="modal-buttons">
                <button id="cancelDelete" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <button id="confirmDelete" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                    Delete My Account
                </button>
            </div>
        </div>
    </div>

    <div id="toast" class="toast hidden">
        <i class="fas fa-check-circle"></i>
        Profile updated successfully!
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Profile picture upload preview
            const profileImage = document.getElementById('profileImage');
            const fileInput = document.getElementById('fileInput');
            const changePictureBtn = document.getElementById('changePictureBtn');
            const imageWrapper = document.querySelector('.profile-image-wrapper');

            changePictureBtn.addEventListener('click', function() {
                fileInput.click();
            });

            // Add click event to image wrapper for better UX
            imageWrapper.addEventListener('click', function() {
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
                    const icon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.className = 'fas fa-eye';
                    } else {
                        passwordInput.type = 'password';
                        icon.className = 'fas fa-eye-slash';
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
                document.body.style.overflow = 'hidden';
            });

            cancelDelete.addEventListener('click', function() {
                deleteConfirmModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });

            // Close modal when clicking backdrop
            deleteConfirmModal.addEventListener('click', function(e) {
                if (e.target === this || e.target.classList.contains('modal-backdrop')) {
                    deleteConfirmModal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
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
                }, 4000);
            }
            // Add smooth scroll behavior for better UX
            document.documentElement.style.scrollBehavior = 'smooth';
        });
    </script>
@endpush