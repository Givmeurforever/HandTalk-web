@extends('layouts.dashboardadmin')

@section('title', 'Edit Topik')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Topik</h1>

    <form action="{{ route('admin.topik.update', $topik['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="judul">Judul Topik</label>
            <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $topik['judul']) }}" required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi', $topik['deskripsi']) }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @for ($i = 1; $i <= 3; $i++)
        <div class="form-group">
            <label>Gambar {{ $i }}</label>
            <input type="file" name="gambar{{ $i }}" class="form-control-file @error('gambar' . $i) is-invalid @enderror" accept="image/*">
            @php $gambarField = 'gambar' . $i; @endphp
            @if (isset($topik[$gambarField]))
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $topik[$gambarField]) }}" alt="Gambar {{ $i }}" style="max-height: 100px;">
                </div>
            @endif
            @error('gambar' . $i)
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @endfor

        <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
    </form>
</div>
@endsection
