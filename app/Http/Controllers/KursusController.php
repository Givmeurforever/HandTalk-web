@extends('layouts.app')

@section('title', 'HandTalk - Kursus Bahasa Isyarat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kursus.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
@php
$courses = [
    [
        "title" => "Pengantar Bahasa Isyarat",
        "slug" => "pengantar-bahasa-isyarat",
        "description" => "Bahasa isyarat adalah bentuk komunikasi visual...",
        "images" => ["pengantar1.png", "pengantar2.png", "pengantar3.png"],
        "info" => ["2 Topik", "10 menit"],
        "curriculum" => [
            ["judul" => "Sejarah dan Perkembangan", "slug" => "sejarah-dan-perkembangan"],
            ["judul" => "Bahasa Isyarat di Dunia", "slug" => "bahasa-isyarat-di-dunia"],
            ["judul" => "Prinsip Dasar Komunikasi", "slug" => "prinsip-dasar-komunikasi"],
            ["judul" => "Kuis Pengantar Bahasa Isyarat", "slug" => "kuis-pengantar-bahasa-isyarat"]
        ]
    ],
    [
        "title" => "Huruf dalam Bahasa Isyarat",
        "slug" => "huruf-dalam-bahasa-isyarat",
        "description" => "Dalam bahasa isyarat, huruf digunakan untuk mengeja kata-kata...",
        "images" => ["huruf1.png", "huruf2.png", "huruf3.png"],
        "info" => ["3 Topik", "15 menit"],
        "curriculum" => [
            ["judul" => "Mengenal Alfabet Isyarat", "slug" => "mengenal-alfabet-isyarat"],
            ["judul" => "Teknik Mengeja Kata", "slug" => "teknik-mengeja-kata"],
            ["judul" => "Latihan Mengeja Nama", "slug" => "latihan-mengeja-nama"]
        ]
    ],
    [
        "title" => "Angka dalam Bahasa Isyarat",
        "slug" => "angka-dalam-bahasa-isyarat",
        "description" => "Angka dalam bahasa isyarat digunakan untuk menyatakan jumlah...",
        "images" => ["Angka1.png", "Angka2.png", "Angka3.png"],
        "info" => ["3 Topik", "15 menit"],
        "curriculum" => [
            ["judul" => "Angka 0-9", "slug" => "angka-0-9"],
            ["judul" => "Puluhan", "slug" => "puluhan"],
            ["judul" => "Waktu", "slug" => "waktu"]
        ]
    ],
    [
        "title" => "Kata dalam Bahasa Isyarat",
        "slug" => "kata-dalam-bahasa-isyarat",
        "description" => "Beberapa kata memiliki isyarat tetap yang sering digunakan...",
        "images" => ["Kata1.png", "Kata2.png", "Kata3.png"],
        "info" => ["3 Topik", "15 menit"],
        "curriculum" => [
            ["judul" => "Kata Sehari-hari", "slug" => "kata-sehari-hari"],
            ["judul" => "Kata Sifat", "slug" => "kata-sifat"],
            ["judul" => "Kata Kerja", "slug" => "kata-kerja"]
        ]
    ]
];
@endphp

<section class="course-header">
    <h2>Kursus Bahasa Isyarat</h2>
    <p class="description">
        Pelajari bahasa isyarat secara menyenangkan! Tiap kursus menyajikan topik lengkap mulai dari huruf, angka, hingga percakapan sehari-hari. Setiap materi disertai video, latihan, dan kuis.
    </p>
</section>

<section class="courses-grid">
    @foreach ($courses as $course)
        <div class="course-card animate-fade">
            <h3 class="course-title">{{ $course['title'] }}</h3>

            <div class="course-images">
                @foreach ($course['images'] as $image)
                    <img src="{{ asset('img/' . $image) }}" alt="{{ $course['title'] }}">
                @endforeach
            </div>

            <p class="course-description">{{ $course['description'] }}</p>

            <div class="course-info">
                @foreach ($course['info'] as $info)
                    <span class="course-badge"><i class="fas fa-info-circle"></i> {{ $info }}</span>
                @endforeach
            </div>

            <div class="curriculum-container">
                <h4><i class="fas fa-list"></i> Kurikulum</h4>
                <ul class="curriculum-list">
                    @foreach ($course['curriculum'] as $item)
                        <li><i class="fas fa-check-circle"></i> {{ $item['judul'] }}</li>
                    @endforeach
                </ul>
            </div>

            <a href="{{ route('topik.show', [$course['slug'], $course['curriculum'][0]['slug']]) }}" class="view-course-btn">
                <i class="fas fa-play-circle"></i> Mulai Belajar
            </a>
        </div>
    @endforeach
</section>
@endsection

@push('scripts')
<script src="{{ asset('JS/course.js') }}"></script>
<script src="{{ asset('JS/include.js') }}"></script>
<script src="{{ asset('JS/header.js') }}"></script>
@endpush
