@extends('layouts.dashboardadmin')
@section('title', 'Edit Kuis')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<h1>Edit Kuis</h1>

@php
    $kuis = [
        'judul' => 'Kuis Alfabet',
        'pertanyaan' => 'Apa huruf ke-3?',
        'a' => 'A',
        'b' => 'B',
        'c' => 'C',
        'd' => 'D',
        'jawaban_benar' => 'c',
    ];
@endphp

<form action="#" method="POST">
    @csrf
    @method('PUT')

    <label>Judul Kuis</label>
    <input type="text" name="judul" value="{{ $kuis['judul'] }}" required>

    <label>Pertanyaan</label>
    <textarea name="pertanyaan" rows="3">{{ $kuis['pertanyaan'] }}</textarea>

    <label>Pilihan Jawaban</label>
    <input type="text" name="a" value="{{ $kuis['a'] }}" required>
    <input type="text" name="b" value="{{ $kuis['b'] }}" required>
    <input type="text" name="c" value="{{ $kuis['c'] }}" required>
    <input type="text" name="d" value="{{ $kuis['d'] }}" required>

    <label>Jawaban Benar</label>
    <select name="jawaban_benar" required>
        <option value="a" {{ $kuis['jawaban_benar'] == 'a' ? 'selected' : '' }}>A</option>
        <option value="b" {{ $kuis['jawaban_benar'] == 'b' ? 'selected' : '' }}>B</option>
        <option value="c" {{ $kuis['jawaban_benar'] == 'c' ? 'selected' : '' }}>C</option>
        <option value="d" {{ $kuis['jawaban_benar'] == 'd' ? 'selected' : '' }}>D</option>
    </select>

    <button type="submit">Update</button>
</form>
@endsection
