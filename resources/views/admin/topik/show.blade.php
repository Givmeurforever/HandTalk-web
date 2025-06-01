@extends('layouts.dashboardadmin')
@section('title', 'Detail topik')

@section('content')
<h1>Detail topik</h1>

@php
    $topik = [
        'judul' => 'Bahasa Isyarat Angka',
        'slug' => 'angka',
        'deskripsi' => 'topik ini mengenalkan angka 1–10 dalam bahasa isyarat',
        'status' => 'Aktif'
    ];
@endphp

<p><strong>Judul:</strong> {{ $topik['judul'] }}</p>
<p><strong>Slug:</strong> {{ $topik['slug'] }}</p>
<p><strong>Deskripsi:</strong> {{ $topik['deskripsi'] }}</p>
<p><strong>Status:</strong> {{ $topik['status'] }}</p>

<a href="{{ route('admin.topik.index') }}" class="btn-aksi">← Kembali</a>
@endsection
