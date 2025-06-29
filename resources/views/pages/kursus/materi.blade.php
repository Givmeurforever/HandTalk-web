@extends('layouts.app')
@section('title', 'Materi: ' . $materi['judul'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/materi.css') }}">
@endpush

@section('content')
<a href="{{ route('kursus') }}" class="back-btn">← Kembali ke Kursus</a>

<div class="topik-body">

    {{-- Kiri: Konten --}}
    <div class="topik-left animate-fade-up">
        {{-- Video --}}
        <div class="video-container">
            <iframe
                src="https://www.youtube.com/embed/{{ $materi['video'] }}"
                frameborder="0"
                allowfullscreen
                title="Video {{ $materi['judul'] }}">
            </iframe>
        </div>

        {{-- Deskripsi --}}
        <div class="materi-description mt-3">
            <h3>{{ $materi['judul'] }}</h3>
            <p>{{ $materi['deskripsi'] }}</p>
        </div>

        {{-- Tombol Tandai Selesai --}}
        <div class="mt-3">
            @if (!$materi_selesai)
                <form method="POST" action="{{ route('materi.complete', [$topik['slug'], $materi['slug']]) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        Tandai Materi Selesai
                    </button>
                </form>
            @else
                <div class="alert alert-success mt-2">
                    ✅ Materi ini telah kamu selesaikan.
                </div>
            @endif
        </div>

        {{-- Navigasi ke latihan & kuis --}}
        <div class="mt-4">
            <a href="{{ route('kursus.latihan', [$topik['slug'], $materi['slug'], 1]) }}" class="btn btn-outline-primary">
                Mulai Latihan
            </a>
            <a href="{{ route('kursus.kuis', $topik['slug']) }}" class="btn btn-outline-secondary ml-2">
                Kerjakan Kuis
            </a>
        </div>
    </div>

    {{-- Kanan: Daftar materi --}}
    <div class="topik-right animate-fade-up">
        <h4>Daftar Materi</h4>
        <ul class="materi-list">
            @foreach ($topik['materi'] as $item)
                <li class="{{ $item['slug'] === $materi['slug'] ? 'active' : '' }}">
                    <a href="{{ route('kursus.show', [$topik['slug'], $item['slug']]) }}">
                        <input type="radio" {{ $item['slug'] === $materi['slug'] ? 'checked' : '' }} disabled>
                        <span class="judul">{{ $item['judul'] }}</span>
                        <span class="durasi">{{ $item['durasi'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
