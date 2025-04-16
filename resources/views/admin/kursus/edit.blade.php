@extends('layouts.dashboardadmin')
@section('title', 'Tambah Kursus')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<h1>Tambah Kursus Baru</h1>

<form action="#" method="POST">
    @csrf

    <label>Judul Kursus</label>
    <input type="text" name="judul" placeholder="Contoh: Bahasa Isyarat Alfabet" required>

    <label>Deskripsi</label>
    <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat kursus..." required></textarea>

    <label>Status</label>
    <select name="status">
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
    </select>

    <button type="submit">Simpan</button>
</form>
@endsection
