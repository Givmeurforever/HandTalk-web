@extends('layouts.dashboardadmin')
@section('title', 'Manajemen Latihan')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-latihan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endpush

@section('content')
<div class="content-header">
    <h1>Daftar Latihan</h1>
    <a href="{{ route('admin.latihan.create') }}" class="btn btn-primary">+ Tambah Latihan</a>
</div>

@php
    $latihan = [
        ['id' => 1, 'judul' => 'Latihan Isyarat Angka'],
        ['id' => 2, 'judul' => 'Latihan Salam'],
    ];
@endphp

<table class="table-custom">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($latihan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['judul'] }}</td>
                <td>
                    <a href="{{ route('admin.latihan.show', $item['id']) }}" class="btn-aksi">Lihat</a>
                    <a href="{{ route('admin.latihan.edit', $item['id']) }}" class="btn-aksi">Edit</a>
                    <form action="{{ route('admin.latihan.destroy', $item['id']) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-aksi" onclick="return confirm('Yakin ingin hapus latihan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
