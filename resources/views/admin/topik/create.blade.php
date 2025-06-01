@extends('layouts.dashboardadmin')

@section('title', 'Tambah Topik')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Topik Baru</h1>

    <form action="{{ route('admin.kursus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="judul">Judul Topik</label>
            <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug (otomatis dibuat jika dikosongkan)</label>
            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Gambar 1</label>
            <input type="file" name="gambar1" class="form-control-file @error('gambar1') is-invalid @enderror" accept="image/*">
            <small class="form-text text-muted">Maksimal 2MB. Format: JPG, PNG, JPEG.</small>
            @error('gambar1')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Gambar 2</label>
            <input type="file" name="gambar2" class="form-control-file @error('gambar2') is-invalid @enderror" accept="image/*">
            @error('gambar2')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Gambar 3</label>
            <input type="file" name="gambar3" class="form-control-file @error('gambar3') is-invalid @enderror" accept="image/*">
            @error('gambar3')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('judul').addEventListener('input', function () {
        const judul = this.value;
        const slug = judul.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/[\s-]+/g, '-')
            .trim();
        const slugInput = document.getElementById('slug');
        if (!slugInput.value) {
            slugInput.value = slug;
        }
    });
</script>
@endpush
