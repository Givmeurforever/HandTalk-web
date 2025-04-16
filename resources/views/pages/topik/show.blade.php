@extends('layouts.app')

@section('title', $topik['title'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endpush

@section('content')
    <a href="{{ route('kursus') }}" class="back-btn">← Kembali ke Kursus</a>

    <section class="topik-header animate-fade-in">
        <h2>{{ $topik['title'] }}</h2>
        <p class="description">{{ $topik['description'] }}</p>
    </section>

    <hr class="course-divider">

    <div class="topik-body">
        <!-- Kiri: Video / Latihan / Kuis -->
        <div class="topik-left animate-fade-up">
            @php
                $slug = $materi['slug'];
            @endphp

            @if(Str::contains($slug, 'latihan'))
                {{-- LATIHAN --}}
                <h3>{{ $materi['judul'] }}</h3>
                <form>
                    <p><strong>Soal:</strong> Apa arti gambar ini?</p>
                    <img src="{{ asset('img/sampel-makan.jpg') }}" width="150">
                    <label><input type="radio" name="jawaban"> A</label><br>
                    <label><input type="radio" name="jawaban"> B</label><br>
                    <label><input type="radio" name="jawaban"> C</label><br>
                    <br>
                    <button type="button" onclick="tampilkanFeedback()">Cek Jawaban</button>
                    <div id="feedback" style="display:none; margin-top:15px;">
                        <p style="color: green;"><strong>Benar!</strong> Jawaban kamu tepat.</p>
                    </div>
                </form>

            @elseif(Str::contains($slug, 'kuis'))
                {{-- KUIS --}}
                <h3>{{ $materi['judul'] }}</h3>
                <form action="#" method="POST">
                    <p>1. Apa arti dari gambar ini?</p>
                    <img src="{{ asset('img/sampel-makan.jpg') }}" width="150">
                    <label><input type="radio" name="q1"> A</label><br>
                    <label><input type="radio" name="q1"> B</label><br>
                    <label><input type="radio" name="q1"> C</label><br>
                    <br>
                    <button type="submit">Selesai</button>
                </form>

            @else
                {{-- VIDEO --}}
                <div class="video-container">
                    <iframe
                        src="https://www.youtube.com/embed/{{ $materi['video'] }}"
                        frameborder="0"
                        allowfullscreen
                        title="Video {{ $materi['judul'] }}">
                    </iframe>
                </div>
                <div class="materi-description">
                    <h4>{{ $materi['judul'] }}</h4>
                    <p>{{ $materi['deskripsi'] }}</p>
                </div>
            @endif
        </div>

        <!-- Kanan: Daftar Materi -->
        <div class="topik-right animate-fade-up">
            <h3>Daftar Materi</h3>
            <ul class="materi-list">
                @foreach ($topik['materi'] as $index => $item)
                    <li class="{{ $item['slug'] == $materi['slug'] ? 'active' : '' }}">
                        <a href="{{ url('kursus/' . $topik['slug'] . '/' . $item['slug']) }}">
                            <input type="radio" {{ $item['slug'] == $materi['slug'] ? 'checked' : '' }} disabled>
                            <span class="judul">{{ $item['judul'] }}</span>
                            <span class="durasi">{{ $item['durasi'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
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
