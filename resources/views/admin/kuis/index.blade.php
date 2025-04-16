@extends('layouts.dashboardadmin')
@section('title', 'Manajemen Kuis')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-kuis.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endpush

@section('content')
<div class="content-header">
    <h1>Daftar Kuis</h1>
    <a href="{{ route('admin.kuis.create') }}" class="btn btn-primary">+ Tambah Kuis</a>
</div>

@php
    $kuis = [
        ['id' => 1, 'judul' => 'Kuis Alfabet', 'jumlah_soal' => 5],
        ['id' => 2, 'judul' => 'Kuis Angka', 'jumlah_soal' => 3],
    ];
@endphp

<table class="table-custom">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Jumlah Soal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kuis as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['judul'] }}</td>
                <td>{{ $item['jumlah_soal'] }}</td>
                <td>
                    <a href="{{ route('admin.kuis.show', $item['id']) }}" class="btn-aksi">Lihat</a>
                    <a href="{{ route('admin.kuis.edit', $item['id']) }}" class="btn-aksi">Edit</a>
                    <form action="{{ route('admin.kuis.destroy', $item['id']) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-aksi" onclick="return confirm('Yakin ingin hapus kuis ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
