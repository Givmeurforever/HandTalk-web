@extends('layouts.dashboardadmin')
@section('title', 'Detail Pengguna')

@section('content')
    <h1>Detail Pengguna</h1>

    @php
        $user = ['id' => 1, 'nama' => 'Andi Setiawan', 'email' => 'andi@mail.com', 'role' => 'User'];
    @endphp

    <p><strong>Nama:</strong> {{ $user['nama'] }}</p>
    <p><strong>Email:</strong> {{ $user['email'] }}</p>
    <p><strong>Role:</strong> {{ $user['role'] }}</p>

    <a href="{{ route('admin.pengguna.index') }}" class="btn-aksi">← Kembali</a>
@endsection
