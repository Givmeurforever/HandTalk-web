@extends('layouts.dashboard')
@section('title', 'Edit Pengguna')

@section('content')
    <h1>Edit Pengguna</h1>

    @php
        $user = ['nama' => 'Andi Setiawan', 'email' => 'andi@mail.com', 'role' => 'User'];
    @endphp

    <form action="#" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Lengkap</label>
        <input type="text" name="nama" value="{{ $user['nama'] }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ $user['email'] }}">

        <label>Password Baru (opsional)</label>
        <input type="password" name="password">

        <label>Role</label>
        <select name="role">
            <option value="user" {{ $user['role'] == 'User' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user['role'] == 'Admin' ? 'selected' : '' }}>Admin</option>
        </select>

        <button type="submit">Update</button>
    </form>
@endsection
