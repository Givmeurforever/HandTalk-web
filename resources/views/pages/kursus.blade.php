@extends('layouts.app')

@section('title', 'HandTalk - Kursus Bahasa Isyarat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kursus.css') }}">
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
        <h2>Kursus</h2>
        <p class="description">
            Pelajari bahasa isyarat dengan cara yang interaktif dan menyenangkan! Halaman ini berisi berbagai topik 
            pembelajaran yang disusun secara sistematis, mulai dari dasar hingga percakapan sehari-hari. 
            Setiap topik dilengkapi dengan materi video, latihan interaktif, dan kuis untuk menguji pemahamanmu. 
            Tingkatkan keterampilan berbahasa isyaratmu kapan saja dan di mana saja!
        </p>
    </section>

    <hr class="course-divider">

    @foreach ($courses as $course)
        <section class="course-section">
            <div class="course-container">
                <h2 class="course-title">{{ $course['title'] }}</h2>

                <div class="course-content">
                    <p class="course-description">{{ $course['description'] }}</p>
                    <a href="{{ route('topik.show', [$course['slug'], $course['curriculum'][0]['slug']]) }}" class="view-course-btn">
                        View Course
                    </a>
                </div>

                <div class="course-images">
                    @foreach ($course['images'] as $image)
                        <img src="{{ asset('img/' . $image) }}" alt="Kursus">
                    @endforeach
                </div>

                <div class="course-info">
                    @foreach ($course['info'] as $info)
                        <span class="course-badge">{{ $info }}</span>
                    @endforeach
                </div>

                <div class="curriculum-container">
                    <div class="curriculum">
                        <h3>Curriculum</h3>
                        <div class="curriculum-list">
                            @foreach ($course['curriculum'] as $index => $topic)
                                <div class="curriculum-item">
                                    <span class="number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text">{{ $topic['judul'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection

@section('scripts')
    <script src="{{ asset('JS/course.js') }}"></script>
    <script src="{{ asset('JS/include.js') }}"></script>
    <script src="{{ asset('JS/header.js') }}"></script>
@endsection
