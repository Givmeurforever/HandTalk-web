@extends('layouts.dashboardadmin')
@section('title', 'Tambah Latihan')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<h1>Tambah Latihan Baru</h1>

<form action="#" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Judul Latihan</label>
    <input type="text" name="judul" required>

    <label>Pertanyaan</label>
    <textarea name="pertanyaan" rows="3" required></textarea>

    <label>Gambar / Video (opsional)</label>
    <input type="file" name="media" accept=".jpg,.png,.gif,.webm">

    <label>Pilihan Jawaban</label>
    <input type="text" name="a" placeholder="A" required>
    <input type="text" name="b" placeholder="B" required>
    <input type="text" name="c" placeholder="C" required>
    <input type="text" name="d" placeholder="D" required>

    <label>Jawaban Benar</label>
    <select name="jawaban_benar">
        <option value="a">A</option>
        <option value="b">B</option>
        <option value="c">C</option>
        <option value="d">D</option>
    </select>

    <label>Penjelasan Jawaban</label>
    <textarea name="penjelasan" rows="2" required></textarea>

    <button type="submit">Simpan</button>
</form>
@endsection
