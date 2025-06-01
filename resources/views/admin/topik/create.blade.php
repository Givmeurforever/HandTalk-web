@extends('layouts.dashboardadmin')

@section('title', 'Tambah Topik')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Topik Baru</h1>

    <form action="{{ route('admin.topik.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="judul">Judul Topik</label>
            <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Hapus input slug jika slug auto-generate di backend --}}
        {{-- <div class="form-group">
            <label for="slug">Slug (otomatis dibuat jika dikosongkan)</label>
            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> --}}

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @foreach([1, 2, 3] as $i)
        <div class="form-group">
            <label for="gambar{{ $i }}">Gambar {{ $i }}</label>
            <input type="file" name="gambar{{ $i }}" id="gambar{{ $i }}" class="form-control-file @error('gambar'.$i) is-invalid @enderror" accept="image/*">
            <small class="form-text text-muted">Maksimal 2MB. Format: JPG, PNG, JPEG.</small>
            @error('gambar'.$i)
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const slugify = (text) => {
        return text.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/[\s-]+/g, '-')
            .trim();
    };

    document.getElementById('judul').addEventListener('input', function () {
        const slugInput = document.getElementById('slug');
        if (!slugInput || slugInput.value) return; // jika input slug dihapus, skip

        slugInput.value = slugify(this.value);
    });
</script>
@endpush
