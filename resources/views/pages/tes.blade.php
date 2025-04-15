@extends('layouts.app')

@section('title', 'HandTalk - Kursus Bahasa Isyarat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kursus.css') }}">
@endpush

@section('content')
    <!-- Header Kursus -->
    <section class="course-header">
        <h2>Kursus</h2>
        <p class="description">
            Pelajari bahasa isyarat dengan cara yang interaktif dan menyenangkan! Halaman ini berisi berbagai topik 
            pembelajaran yang disusun secara sistematis, mulai dari dasar hingga percakapan sehari-hari. 
            Setiap topik dilengkapi dengan materi video, latihan interaktif, dan kuis untuk menguji pemahamanmu. 
            Tingkatkan keterampilan berbahasa isyaratmu kapan saja dan di mana saja!
        </p>
    </section>

    <!-- Garis Pembatas -->
    <hr class="course-divider">

    <!-- Daftar Kursus -->
    @php
        $courses = [
            [
                "title" => "Pengantar Bahasa Isyarat",
                "slug" => "pengantar-bahasa-isyarat",
                "description" => "Bahasa isyarat adalah bentuk komunikasi visual yang menggunakan gerakan tangan, ekspresi wajah, dan gerakan tubuh. 
                                Topik ini akan membahas sejarah, prinsip dasar, serta pentingnya bahasa isyarat dalam kehidupan sehari-hari. 
                                Kamu akan belajar bagaimana ekspresi dan gerakan dapat menyampaikan makna dengan jelas dan efektif.",
                "images" => ["pengantar1.png", "pengantar2.png", "pengantar3.png"],
                "info" => ["2 Topik", "10 menit"],
                "curriculum" => ["Sejarah & Perkembangan", "Bahasa Isyarat di Dunia", "Prinsip Dasar Komunikasi", "Ekspresi Wajah & Gerakan"]
            ],
            [
                "title" => "Huruf dalam Bahasa Isyarat",
                "slug" => "huruf-dalam-bahasa-isyarat",
                "description" => "Dalam bahasa isyarat, huruf digunakan untuk mengeja kata-kata yang belum memiliki isyarat khusus. 
                                Pada topik ini, kamu akan mempelajari alfabet bahasa isyarat dan cara menggunakannya dalam komunikasi sehari-hari.",
                "images" => ["huruf1.png", "huruf2.png", "huruf3.png"],
                "info" => ["3 Topik", "15 menit"],
                "curriculum" => ["Mengenal Alfabet Isyarat", "Teknik Mengeja Kata", "Latihan Mengeja Nama"]
            ],
            [
                "title" => "Angka dalam Bahasa Isyarat",
                "slug" => "angka-dalam-bahasa-isyarat",
                "description" => "Angka dalam bahasa isyarat digunakan untuk menyatakan jumlah, waktu, dan harga. Kamu akan belajar tentang angka dasar, pola dalam menyampaikan angka besar, serta cara menyatakan waktu dan harga dengan tepat menggunakan bahasa isyarat.",
                "images" => ["Angka1.png", "Angka2.png", "Angka3.png"],
                "info" => ["3 Topik", "15 menit"],
                "curriculum" => ["Angka 0-9", "Puluhan", "Waktu"]
            ],
            [
                "title" => "Kata dalam Bahasa Isyarat",
                "slug" => "kata-dalam-bahasa-isyarat",
                "description" => "Beberapa kata memiliki isyarat tetap yang sering digunakan dalam percakapan sehari-hari, seperti “makan”, “minum”, atau “terima kasih”. Dalam topik ini, kamu akan mengenal berbagai kata dasar, kata kerja, dan kata sifat yang umum digunakan dalam komunikasi menggunakan bahasa isyarat.",
                "images" => ["Kata1.png", "Kata2.png", "Kata3.png"],
                "info" => ["3 Topik", "15 menit"],
                "curriculum" => ["Kata Sehari-hari", "Kata Sifat", "Kata Kerja"]
            ]
        ];
    @endphp

    @foreach ($courses as $course)
        <section class="course-section">
            <div class="course-container">
                <h2 class="course-title">{{ $course['title'] }}</h2>

                <div class="course-content">
                    <p class="course-description">{{ $course['description'] }}</p>
                    <a href="{{ url('kursus/' . $course['slug']) }}" class="view-course-btn">View Course</a>
                </div>

                <!-- Gambar Kursus -->
                <div class="course-images">
                    @foreach ($course['images'] as $image)
                        <img src="{{ asset('img/' . $image) }}" alt="Kursus">
                    @endforeach
                </div>

                <!-- Informasi Kursus -->
                <div class="course-info">
                    @foreach ($course['info'] as $info)
                        <span class="course-badge">{{ $info }}</span>
                    @endforeach
                </div>

                <!-- Kurikulum -->
                <div class="curriculum-container">
                    <div class="curriculum">
                        <h3>Curriculum</h3>
                        <div class="curriculum-list">
                            @foreach ($course['curriculum'] as $index => $topic)
                                <div class="curriculum-item">
                                    <span class="number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text">{{ $topic }}</span>
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
