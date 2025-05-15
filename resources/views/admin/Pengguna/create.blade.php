@extends('layouts.dashboardadmin')
@section('title', 'Tambah Pengguna Baru - HandTalk')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-pengguna-form.css') }}">
@endpush

@section('content')
<div class="pengguna-form-container">
    <div class="form-header">
        <h1>Tambah Pengguna Baru</h1>
        <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-card">
        <form action="{{ route('admin.pengguna.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-grid">
                <div class="form-section">
                    <h3>Informasi Dasar</h3>
                    
                    <div class="form-group">
                        <label for="first_name">Nama Depan <span class="required">*</span></label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name">Nama Belakang <span class="required">*</span></label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3>Keamanan</h3>
                    
                    <div class="form-group">
                        <label for="password">Password <span class="required">*</span></label>
                        <input type="password" id="password" name="password" required>
                        <p class="form-hint">Minimum 8 karakter</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password <span class="required">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3>Foto Profil</h3>
                    
                    <div class="form-group">
                        <label for="profile_picture">Unggah Foto Profil</label>
                        <div class="profile-upload-container">
                            <div class="profile-preview">
                                <img id="profilePreview" src="{{ asset('storage/profile_pictures/default.png') }}" alt="Preview">
                            </div>
                            <div class="upload-controls">
                                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                                <p class="form-hint">Maksimal 2MB. Format: JPG, PNG</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preview foto profil saat diunggah
        const profileInput = document.getElementById('profile_picture');
        const profilePreview = document.getElementById('profilePreview');
        
        profileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush