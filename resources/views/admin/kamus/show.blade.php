@extends('layouts.dashboardadmin')
@section('title', 'Detail Kata Isyarat')

@section('content')
    <h1>Detail Kamus</h1>

    @php
        $kamus = ['kata' => 'Halo', 'media' => 'halo.gif'];
    @endphp

    <p><strong>Kata:</strong> {{ $kamus['kata'] }}</p>
    <p><strong>Media:</strong></p>
    <img src="{{ asset('media/' . $kamus['media']) }}" width="150" alt="{{ $kamus['kata'] }}">

    <br><br>
    <a href="{{ route('admin.kamus.index') }}" class="btn-aksi">← Kembali</a>
@endsection
