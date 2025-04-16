@extends('layouts.dashboardadmin')
@section('title', 'Manajemen Materi')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-materi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endpush

@section('content')
<div class="content-header">
    <h1>Daftar Materi</h1>
    <a href="{{ route('admin.materi.create') }}" class="btn btn-primary">+ Tambah Materi</a>
</div>

@php
    $materi = [
        ['id' => 1, 'judul' => 'Isyarat Alfabet A-C', 'video' => 'abcd123', 'kursus' => 'Bahasa Isyarat Alfabet'],
        ['id' => 2, 'judul' => 'Isyarat Angka 1–5', 'video' => 'angka567', 'kursus' => 'Bahasa Isyarat Angka'],
    ];
@endphp

<table class="table-custom">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kursus</th>
            <th>Video</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($materi as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['judul'] }}</td>
                <td>{{ $item['kursus'] }}</td>
                <td>
                    <iframe width="150" height="85" src="https://www.youtube.com/embed/{{ $item['video'] }}" frameborder="0" allowfullscreen></iframe>
                </td>
                <td>
                    <a href="{{ route('admin.materi.show', $item['id']) }}" class="btn-aksi">Lihat</a>
                    <a href="{{ route('admin.materi.edit', $item['id']) }}" class="btn-aksi">Edit</a>
                    <form action="{{ route('admin.materi.destroy', $item['id']) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-aksi" onclick="return confirm('Yakin hapus materi?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
