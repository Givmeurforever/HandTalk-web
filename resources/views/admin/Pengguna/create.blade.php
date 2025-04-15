@extends('layouts.dashboard')
@section('title', 'Tambah Pengguna')

@section('content')
    <h1>Tambah Pengguna Baru</h1>

    <form action="#" method="POST">
        @csrf
        <label>Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Nama pengguna">

        <label>Email</label>
        <input type="email" name="email" placeholder="Email pengguna">

        <label>Password</label>
        <input type="password" name="password" placeholder="Minimal 6 karakter">

        <label>Role</label>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit">Simpan</button>
    </form>
@endsection
