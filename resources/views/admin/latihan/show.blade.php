@extends('layouts.dashboardadmin')
@section('title', 'Detail Latihan')

@section('content')
<h1>Detail Latihan</h1>

@php
    $latihan = [
        'judul' => 'Latihan Isyarat Angka',
        'pertanyaan' => 'Berapa ini?',
        'media' => 'angka5.webm',
        'a' => '3', 'b' => '5', 'c' => '2', 'd' => '1',
        'jawaban_benar' => 'b',
        'penjelasan' => 'Tangan menunjukkan angka 5',
    ];
@endphp

<p><strong>Judul:</strong> {{ $latihan['judul'] }}</p>
<p><strong>Pertanyaan:</strong> {{ $latihan['pertanyaan'] }}</p>

@if ($latihan['media'])
    <video width="160" autoplay muted loop>
        <source src="{{ asset('media/' . $latihan['media']) }}" type="video/webm">
    </video>
@endif

<ul>
    <li>A. {{ $latihan['a'] }}</li>
    <li>B. {{ $latihan['b'] }}</li>
    <li>C. {{ $latihan['c'] }}</li>
    <li>D. {{ $latihan['d'] }}</li>
</ul>
<p><strong>Jawaban Benar:</strong> {{ strtoupper($latihan['jawaban_benar']) }}</p>
<p><strong>Penjelasan:</strong> {{ $latihan['penjelasan'] }}</p>

<a href="{{ route('admin.latihan.index') }}" class="btn-aksi">← Kembali</a>
@endsection
