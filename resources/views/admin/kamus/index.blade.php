@extends('layouts.dashboardadmin')
@section('title', 'Manajemen Kamus')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page-kamus.css') }}">
@endpush

@section('content')
<div class="content-header">
    <h1>Daftar Kamus Isyarat</h1>
    <a href="{{ route('admin.kamus.create') }}" class="btn btn-primary">+ Tambah Kata</a>
</div>

@php
    $kamus = [
        ['id' => 1, 'kata' => 'Halo', 'media' => 'Saya.webm'],
        ['id' => 2, 'kata' => 'Terima Kasih', 'media' => 'Minum.webm'],
    ];
@endphp

<table class="table-custom">
    <thead>
        <tr>
            <th>No</th>
            <th>Kata</th>
            <th>Media</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kamus as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['kata'] }}</td>
                <td>
                    <video width="100" autoplay muted loop playsinline>
                        <source src="{{ asset('media/' . $item['media']) }}" type="video/webm">
                        Browser Anda tidak mendukung tag video.
                    </video>
                </td>                
                <td>
                    <a href="{{ route('admin.kamus.show', $item['id']) }}" class="btn-aksi">Lihat</a>
                    <a href="{{ route('admin.kamus.edit', $item['id']) }}" class="btn-aksi">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
