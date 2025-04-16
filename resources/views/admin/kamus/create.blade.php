@extends('layouts.dashboardadmin')
@section('title', 'Tambah Kata Isyarat')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
    <h1>Tambah Kata Baru</h1>

    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Kata</label>
        <input type="text" name="kata" placeholder="Contoh: Halo" required>

        <label>Media (GIF/WebM)</label>
        <input type="file" name="media" accept=".gif,.webm" required>

        <button type="submit">Simpan</button>
    </form>
@endsection
