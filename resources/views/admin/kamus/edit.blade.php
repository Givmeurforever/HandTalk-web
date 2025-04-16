@extends('layouts.dashboardadmin')
@section('title', 'Edit Kamus Isyarat')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
    <h1>Edit Kata Isyarat</h1>

    @php
        $kamus = ['kata' => 'Terima Kasih', 'media' => 'terimakasih.gif'];
    @endphp

    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Kata</label>
        <input type="text" name="kata" value="{{ $kamus['kata'] }}" required>

        <label>Media Lama</label><br>
        <img src="{{ asset('media/' . $kamus['media']) }}" width="100" alt="{{ $kamus['kata'] }}"><br><br>

        <label>Ganti Media (opsional)</label>
        <input type="file" name="media" accept=".gif,.webm">

        <button type="submit">Update</button>
    </form>
@endsection
