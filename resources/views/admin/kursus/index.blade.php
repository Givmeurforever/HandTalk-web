@extends('layouts.dashboardadmin')
@section('title', 'Manajemen Kursus')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-kursus.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endpush

@section('content')
<div class="content-header">
    <h1>Daftar Kursus</h1>
    <a href="{{ route('admin.kursus.create') }}" class="btn btn-primary">+ Tambah Kursus</a>
</div>

@php
    $kursus = [
        ['id' => 1, 'judul' => 'Pengantar Bahasa Isyarat', 'slug' => 'pengantar'],
        ['id' => 2, 'judul' => 'Bahasa Isyarat Angka', 'slug' => 'angka'],
    ];
@endphp

<table class="table-custom">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Slug</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kursus as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['judul'] }}</td>
                <td>{{ $item['slug'] }}</td>
                <td>
                    <a href="{{ route('admin.kursus.show', $item['id']) }}" class="btn-aksi">Lihat</a>
                    <a href="{{ route('admin.kursus.edit', $item['id']) }}" class="btn-aksi">Edit</a>
                    <form action="{{ route('admin.kursus.destroy', $item['id']) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-aksi" onclick="return confirm('Yakin ingin hapus kursus ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
