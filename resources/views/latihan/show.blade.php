@extends('layouts.app')
@section('title', 'Latihan Isyarat')

@section('content')
<div class="latihan-container">
    <h2>Latihan: Mengenal Alfabet</h2>

    <div class="soal-box">
        <p><strong>Soal 1:</strong> Apa arti dari gambar ini?</p>
        <img src="{{ asset('img/latihan/a.png') }}" alt="Soal Gambar" width="150">

        <form>
            <label><input type="radio" name="jawaban"> A</label><br>
            <label><input type="radio" name="jawaban"> B</label><br>
            <label><input type="radio" name="jawaban"> C</label><br>
            <label><input type="radio" name="jawaban"> D</label><br>

            <button type="button" onclick="tampilkanFeedback()">Cek Jawaban</button>
        </form>

        <div id="feedback" style="display:none; margin-top:15px;">
            <p style="color: green;"><strong>Benar!</strong> Jawaban kamu tepat.</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function tampilkanFeedback() {
        document.getElementById('feedback').style.display = 'block';
    }
</script>
@endsection
