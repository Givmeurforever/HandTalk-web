@extends('layouts.dashboardadmin')
@section('title', 'Tambah Materi')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<h1>Tambah Materi Baru</h1>

<form action="#" method="POST">
    @csrf

    <label>Judul Materi</label>
    <input type="text" name="judul" required>

    <label>Deskripsi</label>
    <textarea name="deskripsi" rows="3" required></textarea>

    <label>ID Video YouTube</label>
    <input type="text" name="video" placeholder="Contoh: dQw4w9WgXcQ" required>

    <label>Kursus</label>
    <select name="kursus_id">
        <option value="1">Bahasa Isyarat Alfabet</option>
        <option value="2">Bahasa Isyarat Angka</option>
    </select>

    <button type="submit">Simpan</button>
</form>
@endsection
