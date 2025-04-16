@extends('layouts.dashboardadmin')
@section('title', 'Detail Kursus')

@section('content')
<h1>Detail Kursus</h1>

@php
    $kursus = [
        'judul' => 'Bahasa Isyarat Angka',
        'slug' => 'angka',
        'deskripsi' => 'Kursus ini mengenalkan angka 1–10 dalam bahasa isyarat',
        'status' => 'Aktif'
    ];
@endphp

<p><strong>Judul:</strong> {{ $kursus['judul'] }}</p>
<p><strong>Slug:</strong> {{ $kursus['slug'] }}</p>
<p><strong>Deskripsi:</strong> {{ $kursus['deskripsi'] }}</p>
<p><strong>Status:</strong> {{ $kursus['status'] }}</p>

<a href="{{ route('admin.kursus.index') }}" class="btn-aksi">← Kembali</a>
@endsection
