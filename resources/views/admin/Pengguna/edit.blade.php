@extends('layouts.dashboardadmin')
@section('title', 'Edit Pengguna')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
    <h1>Edit Pengguna</h1>

    @php
        $user = ['id' => 1, 'nama' => 'Andi Setiawan', 'email' => 'andi@mail.com', 'role' => 'User'];
    @endphp

    <form action="#" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Lengkap</label>
        <input type="text" name="nama" value="{{ $user['nama'] }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ $user['email'] }}" required>

        <label>Password Baru (opsional)</label>
        <input type="password" name="password">

        <label>Role</label>
        <select name="role">
            <option value="User" {{ $user['role'] == 'User' ? 'selected' : '' }}>User</option>
            <option value="Admin" {{ $user['role'] == 'Admin' ? 'selected' : '' }}>Admin</option>
        </select>

        <button type="submit">Update</button>
    </form>
@endsection
