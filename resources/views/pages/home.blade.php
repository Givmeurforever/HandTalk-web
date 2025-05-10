@extends('layouts.app')

@section('title', 'HandTalk - Belajar Bahasa Isyarat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;700&display=swap" rel="stylesheet">
@endpush

@section('content')
    <!-- 🔹 Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-box">
                <h1><span>Bahasa Isyarat</span>, Tanpa Batas!</h1>
            </div>
            <p class="hero-subtext">Cara termudah untuk belajar bahasa isyarat</p>
            <p class="hero-question">Tahukah kamu bahwa tangan kita bisa digunakan untuk berkomunikasi?</p>
            @auth
                <a href="{{ route('kursus') }}" class="btn primary mulai-belajar">Mulai Belajar</a>
            @else
                <a href="{{ route('login') }}" class="btn primary mulai-belajar">Mulai Belajar</a>
            @endauth
        </div>
    </section>
    
    <section class="hero-image">
        <img src="{{ asset('img/hero-image.jpg') }}" alt="Belajar Bahasa Isyarat">
    </section>

    <!-- 🔹 Manfaat -->
    <section id="manfaat" class="manfaat">
        <h2>Manfaat</h2>
        <p class="manfaat-subtext">Belajar bahasa isyarat kini lebih mudah dan menyenangkan!</p>
        <div class="manfaat-container">
            @foreach([
                ['01', 'Meningkatkan Kemampuan Berkomunikasi', 'Membantu berinteraksi dengan penyandang tuna rungu dan tuna wicara.'],
                ['02', 'Meningkatkan Kesadaran & Inklusi', 'Membantu membangun masyarakat yang lebih inklusif dan peduli.'],
                ['03', 'Belajar dengan Cara Interaktif', 'Video, latihan, dan kuis membuat proses belajar lebih menarik.'],
                ['04', 'Akses Mudah Kapan Saja', 'Bisa belajar di mana saja.'],
                ['05', 'Menambah Keterampilan Baru', 'Bahasa isyarat bisa menjadi keahlian tambahan yang bermanfaat.'],
                ['06', 'Membantu Profesi Tertentu', 'Cocok untuk guru, pekerja sosial, dan tenaga medis.'],
            ] as $manfaat)
                <div class="manfaat-item">
                    <h3 class="angka">{{ $manfaat[0] }}</h3>
                    <h4>{{ $manfaat[1] }}</h4>
                    <p>{{ $manfaat[2] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 🔹 Fitur -->
    <section id="apa-kamu-dapat" class="fitur">
        <h2>Apa yang kamu dapat</h2>
        <p class="deskripsi">Di HandTalk, kamu bisa belajar bahasa isyarat dengan fitur lengkap:</p>

        <div class="fitur-container">
            @foreach([
                ['Materi.png', '4 Topik', 'Materi', 'Pelajari bahasa isyarat melalui video interaktif yang mudah dipahami.'],
                ['latihan.png', '100 Soal', 'Latihan', 'Uji pemahamanmu dengan latihan soal interaktif.'],
                ['kamus.png', '100+ Kata', 'Kamus', 'Cari dan temukan berbagai kata dalam bahasa isyarat.'],
                ['kuis.png', '10 Kuis', 'Kuis', 'Tantang dirimu dengan kuis interaktif.'],
            ] as $fitur)
                <div class="fitur-item">
                    <img src="{{ asset('img/' . $fitur[0]) }}" alt="{{ $fitur[2] }}">
                    <span class="fitur-tag">{{ $fitur[1] }}</span>
                    <h3>{{ $fitur[2] }}</h3>
                    <p>{{ $fitur[3] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 🔹 Materi -->
    <section id="isi-materi" class="materi-section">
        <h2 class="materi-title">Materi</h2>
        <div class="materi-container">
            @foreach([
                ['Pengantar Bahasa Isyarat', 'Komunikasi visual menggunakan gerakan tangan.'],
                ['Huruf', 'Digunakan untuk mengeja nama atau istilah dengan finger spelling.'],
                ['Angka', 'Digunakan untuk menyatakan jumlah, waktu, dan harga dengan isyarat khusus.'],
                ['Kata', 'Isyarat tetap untuk kata sehari-hari seperti "makan" atau "terima kasih".'],
            ] as $materi)
                <div class="materi-card">
                    <h3 class="materi-card-title">{{ $materi[0] }}</h3>
                    <p class="materi-card-description">{{ $materi[1] }}</p>
                </div>
            @endforeach
        </div>
    </section>
    
@endsection
