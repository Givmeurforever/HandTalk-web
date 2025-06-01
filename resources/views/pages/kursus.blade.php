@extends('layouts.app')

@section('title', 'HandTalk - Kursus Bahasa Isyarat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kursus.css') }}">
@endpush

@section('content')
<section class="course-header">
    <h2>Kursus</h2>
    <p class="description">
        Pelajari bahasa isyarat dengan cara yang interaktif dan menyenangkan! Halaman ini berisi berbagai topik 
        pembelajaran yang disusun secara sistematis, mulai dari dasar hingga percakapan sehari-hari. 
        Setiap topik dilengkapi dengan materi video, latihan interaktif, dan kuis untuk menguji pemahamanmu. 
        Tingkatkan keterampilan berbahasa isyaratmu kapan saja dan di mana saja!
    </p>
</section>

<hr class="course-divider">

@foreach ($topik as $item)
    <section class="course-section">
        <div class="course-container">
            {{-- Judul --}}
            <h2 class="course-title">{{ $item->judul }}</h2>

            {{-- Deskripsi & Tombol --}}
            <div class="course-content">
                <p class="course-description">{{ Str::limit($item->deskripsi, 250) }}</p>
                @if ($item->materi->first())
                    <a href="{{ route('topik.show', [$item->slug, $item->materi->first()->slug]) }}" class="view-course-btn">
                        Mulai Belajar
                    </a>
                @else
                    <button class="view-course-btn" disabled>Belum Ada Materi</button>
                @endif
            </div>

            {{-- Gambar --}}
            <div class="course-images">
                @for ($i = 1; $i <= 3; $i++)
                    @php $gambar = 'gambar' . $i; @endphp
                    @if (!empty($item->$gambar))
                        <img src="{{ asset('storage/' . $item->$gambar) }}" alt="Gambar Topik {{ $i }}">
                    @endif
                @endfor
            </div>

            {{-- Info --}}
            <div class="course-info">
                <span class="course-badge"><i class="fas fa-book"></i> {{ $item->materi->count() }} Materi</span>
                <span class="course-badge"><i class="fas fa-clock"></i> ~ {{ $item->materi->count() * 5 }} menit</span>
            </div>

            {{-- Curriculum --}}
            @if ($item->materi->count())
            <div class="curriculum-container">
                <div class="curriculum">
                    <h3>Curriculum</h3>
                    <div class="curriculum-list">
                        @foreach ($item->materi->take(3) as $index => $materi)
                            <div class="curriculum-item">
                                <span class="number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="text">{{ $materi->judul }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
@endforeach
@endsection
