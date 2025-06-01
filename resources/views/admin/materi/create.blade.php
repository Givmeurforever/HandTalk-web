@extends('layouts.dashboardadmin')
@section('title', 'Tambah Materi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Materi Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.materi.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Judul Materi</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="form-group">
            <label>Slug (otomatis jika kosong)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label>ID Video YouTube / File Path</label>
            <input type="text" name="video" class="form-control" value="{{ old('video') }}" placeholder="Contoh: dQw4w9WgXcQ atau path/video.mp4">
        </div>

        <div class="form-group">
            <label>Topik</label>
            <select name="topik_id" class="form-control" required>
                <option value="">-- Pilih Topik --</option>
                @foreach ($topiks as $topik)
                    <option value="{{ $topik->id }}" {{ old('topik_id') == $topik->id ? 'selected' : '' }}>
                        {{ $topik->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" min="1" value="{{ old('urutan', 1) }}">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
