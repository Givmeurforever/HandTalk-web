@extends('layouts.dashboardadmin')
@section('title', 'Detail Kuis')

@section('content')
<h1>Detail Kuis</h1>

@php
    $kuis = [
        'judul' => 'Kuis Alfabet',
        'pertanyaan' => 'Apa huruf ke-3?',
        'a' => 'A',
        'b' => 'B',
        'c' => 'C',
        'd' => 'D',
        'jawaban_benar' => 'C',
    ];
@endphp

<p><strong>Judul:</strong> {{ $kuis['judul'] }}</p>
<p><strong>Pertanyaan:</strong> {{ $kuis['pertanyaan'] }}</p>
<ul>
    <li>A. {{ $kuis['a'] }}</li>
    <li>B. {{ $kuis['b'] }}</li>
    <li>C. {{ $kuis['c'] }}</li>
    <li>D. {{ $kuis['d'] }}</li>
</ul>
<p><strong>Jawaban Benar:</strong> {{ strtoupper($kuis['jawaban_benar']) }}</p>

<a href="{{ route('admin.kuis.index') }}" class="btn-aksi">← Kembali</a>
@endsection
