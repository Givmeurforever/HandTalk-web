@extends('layouts.dashboardadmin')
@section('title', 'Tambah Kata Isyarat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
    <h1 style="text-align: center; margin-bottom: 20px;">Tambah Kata Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger" style="max-width: 600px; margin: 0 auto 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kamus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="kata">Kata</label>
        <input type="text" name="kata" id="kata" placeholder="Contoh: Halo" required value="{{ old('kata') }}">

        <label for="video">Video (.webm)</label>
        <input type="file" name="video" id="video" accept=".webm" required>

        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <a href="{{ route('admin.kamus.index') }}" class="btn btn-outline" style="flex: 1; text-align: center; background: #f3f3f3; color: #333; text-decoration: none;">
                ← Kembali
            </a>
            <button type="submit" style="flex: 1;">Simpan</button>
        </div>
    </form>
@endsection