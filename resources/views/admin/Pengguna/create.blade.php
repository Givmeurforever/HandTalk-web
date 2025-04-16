@extends('layouts.dashboardadmin')
@section('title', 'Tambah Pengguna')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
    <h1>Tambah Pengguna</h1>

    <form action="#" method="POST">
        @csrf
        <label>Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Nama pengguna" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="Email pengguna" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Minimal 6 karakter" required>

        <label>Role</label>
        <select name="role">
            <option value="User">User</option>
            <option value="Admin">Admin</option>
        </select>

        <button type="submit">Simpan</button>
    </form>
@endsection
