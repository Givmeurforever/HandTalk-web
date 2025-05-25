@extends('layouts.dashboardadmin')
@section('title', 'Edit Kamus Isyarat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
    <h1 style="text-align: center; margin-bottom: 20px;">Edit Kata Isyarat</h1>

    @if ($errors->any())
        <div class="alert alert-danger" style="max-width: 600px; margin: 0 auto 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kamus.update', $kamus->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="kata">Kata</label>
        <input type="text" name="kata" id="kata" required value="{{ old('kata', $kamus->kata) }}">

        <label>Media Saat Ini</label><br>
        @if ($kamus->video_extension === 'gif')
            <img src="{{ asset('storage/' . $kamus->video) }}" width="200" alt="{{ $kamus->kata }}">
        @else
            <video controls muted width="200">
                <source src="{{ asset('storage/' . $kamus->video) }}" type="video/webm">
                Tidak dapat memutar media.
            </video>
        @endif

        <br><br>

        <label for="video">Ganti Media (opsional)</label>
        <input type="file" name="video" id="video" accept=".webm,.gif">

        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <a href="{{ route('admin.kamus.index') }}" class="btn btn-outline" style="flex: 1; text-align: center; background: #f3f3f3; color: #333; text-decoration: none;">
                ← Kembali
            </a>
            <button type="submit" style="flex: 1;">Update</button>
        </div>
    </form>
@endsection
