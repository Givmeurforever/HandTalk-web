@extends('layouts.dashboardadmin')
@section('title', 'Tambah Kuis')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<h1>Tambah Kuis</h1>

<form action="#" method="POST">
    @csrf
    <label>Judul Kuis</label>
    <input type="text" name="judul" placeholder="Contoh: Kuis Alfabet" required>

    <label>Pertanyaan</label>
    <textarea name="pertanyaan" rows="3" placeholder="Tulis pertanyaan di sini..." required></textarea>

    <label>Pilihan Jawaban</label>
    <input type="text" name="a" placeholder="A" required>
    <input type="text" name="b" placeholder="B" required>
    <input type="text" name="c" placeholder="C" required>
    <input type="text" name="d" placeholder="D" required>

    <label>Jawaban Benar</label>
    <select name="jawaban_benar" required>
        <option value="a">A</option>
        <option value="b">B</option>
        <option value="c">C</option>
        <option value="d">D</option>
    </select>

    <button type="submit">Simpan</button>
</form>
@endsection
