@extends('layouts.dashboardadmin')
@section('title', 'Manajemen Pengguna')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-pengguna.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endpush

@section('content')
    <div class="content-header">
        <h1>Daftar Pengguna</h1>
        <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">+ Tambah Pengguna</a>
    </div>

    @php
        $users = [
            ['id' => 1, 'nama' => 'Andi Setiawan', 'email' => 'andi@mail.com', 'role' => 'User'],
            ['id' => 2, 'nama' => 'Budi Raharjo', 'email' => 'budi@mail.com', 'role' => 'User'],
        ];
    @endphp

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user['nama'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['role'] }}</td>
                    <td>
                        <a href="{{ route('admin.pengguna.show', $user['id']) }}">Lihat</a> |
                        <a href="{{ route('admin.pengguna.edit', $user['id']) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
