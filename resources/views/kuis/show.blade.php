@extends('layouts.app')
@section('title', 'Kuis Isyarat')

@section('content')
<div class="kuis-container">
    <h2>Kuis: Pengantar Bahasa Isyarat</h2>

    <form action="{{ route('kuis.hasil') }}" method="POST">
        @csrf
        <div class="soal">
            <p><strong>1. Apa arti dari gambar ini?</strong></p>
            <img src="{{ asset('img/kuis/huruf-b.png') }}" width="150">
            <label><input type="radio" name="q1"> A</label><br>
            <label><input type="radio" name="q1"> B</label><br>
            <label><input type="radio" name="q1"> C</label><br>
        </div>

        <div class="soal">
            <p><strong>2. Apa arti dari gambar ini?</strong></p>
            <img src="{{ asset('img/kuis/huruf-c.png') }}" width="150">
            <label><input type="radio" name="q2"> A</label><br>
            <label><input type="radio" name="q2"> C</label><br>
            <label><input type="radio" name="q2"> D</label><br>
        </div>

        <button type="submit">Selesai</button>
    </form>
</div>
@endsection
