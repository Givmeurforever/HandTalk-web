@extends('layouts.dashboardadmin')
@section('title', 'Detail Materi')

@section('content')
<h1>Detail Materi</h1>

@php
    $materi = [
        'judul' => 'Isyarat Alfabet A-C',
        'deskripsi' => 'Belajar huruf A sampai C dalam bahasa isyarat.',
        'video' => 'abcd123',
        'kursus' => 'Bahasa Isyarat Alfabet',
    ];
@endphp

<p><strong>Judul:</strong> {{ $materi['judul'] }}</p>
<p><strong>Kursus:</strong> {{ $materi['kursus'] }}</p>
<p><strong>Deskripsi:</strong> {{ $materi['deskripsi'] }}</p>
<p><strong>Video:</strong></p>
<iframe width="320" height="180" src="https://www.youtube.com/embed/{{ $materi['video'] }}" frameborder="0" allowfullscreen></iframe>

<br><br>
<a href="{{ route('admin.materi.index') }}" class="btn-aksi">← Kembali</a>
@endsection
