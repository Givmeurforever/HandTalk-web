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

    <form action="{{ route('admin.kamus.update', $kamus->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 600px; margin: 0 auto;">
        @csrf
        @method('PUT')

        <label for="kata">Kata</label>
        <input type="text" name="kata" id="kata" required value="{{ old('kata', $kamus->kata) }}" placeholder="Contoh: Halo">

        <label>Video Saat Ini (.webm)</label><br>
        <video controls muted width="300" style="margin: 10px 0;">
            <source src="{{ asset('storage/' . $kamus->video) }}" type="video/webm">
            Browser tidak mendukung video.
        </video>

        <br>

        <label for="video">Ganti Video (opsional)</label>
        <input type="file" name="video" id="video" accept=".webm,.png,.gif">

        <div style="display: flex; justify-content: space-between; margin-top: 20px;">
            <a href="{{ route('admin.kamus.index') }}" class="btn btn-outline" style="flex: 1; margin-right: 10px; text-align: center; text-decoration: none;">
                ← Kembali
            </a>
            <button type="submit" class="btn btn-primary" style="flex: 1;">Simpan Perubahan</button>
        </div>
    </form>
@endsection
