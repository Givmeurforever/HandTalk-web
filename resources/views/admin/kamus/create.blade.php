@extends('layouts.dashboardadmin')
@section('title', 'Tambah Kata Isyarat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
    <h1>Tambah Kata Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
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

        <button type="submit">Simpan</button>
    </form>
@endsection
