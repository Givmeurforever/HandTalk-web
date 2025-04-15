@extends('layouts.app')

@section('title', $topik['title'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endpush

@section('content')
    <a href="{{ route('kursus') }}" class="back-btn">← Kembali ke Kursus</a>

    <section class="topik-header">
        <h2>{{ $topik['title'] }}</h2>
        <p class="description">{{ $topik['description'] }}</p>
    </section>

    <hr class="course-divider">

    <div class="topik-body">
        <div class="topik-left">
            <!-- Video -->
            <div class="video-container">
                <iframe width="100%" height="400"
                    src="https://www.youtube.com/embed/{{ $materi['video'] }}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>

            <!-- Deskripsi Materi -->
            <div class="materi-description">
                <p>{{ $materi['deskripsi'] }}</p>
            </div>
        </div>

        <div class="topik-right">
            <h3>Daftar Materi</h3>
            <ul class="materi-list">
                @foreach ($topik['materi'] as $index => $item)
                    <li class="{{ $item['slug'] == $materi['slug'] ? 'active' : '' }}">
                        <a href="{{ url('kursus/' . $topik['slug'] . '/' . $item['slug']) }}">
                            <input type="radio" {{ $item['slug'] == $materi['slug'] ? 'checked' : '' }} disabled>
                            {{ $item['judul'] }}
                            <span class="durasi">{{ $item['durasi'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
