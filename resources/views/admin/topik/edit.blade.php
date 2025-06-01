@extends('layouts.dashboardadmin')
@section('title', 'Tambah Topik')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<h1>Tambah Topik Baru</h1>

<form action="#" method="POST">
    @csrf

    <label>Judul Topik</label>
    <input type="text" name="judul" placeholder="Contoh: Bahasa Isyarat Alfabet" required>

    <label>Deskripsi</label>
    <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat topik..." required></textarea>

    <label>Status</label>
    <select name="status">
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
    </select>

    <button type="submit">Simpan</button>
</form>
@endsection
