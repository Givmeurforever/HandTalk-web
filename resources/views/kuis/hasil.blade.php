@extends('layouts.app')
@section('title', 'Hasil Kuis')

@section('content')
<div class="hasil-kuis">
    <h2>Hasil Kuis</h2>
    <p>Skor Kamu: <strong>80%</strong></p>
    <p>Jawaban benar: 4 dari 5 soal</p>
    <a href="{{ route('kuis.index') }}">Kembali ke Daftar Kuis</a>
</div>
@endsection
