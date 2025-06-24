@extends('layouts.app')
@section('title', 'Apa itu HandTalk')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about-handtalk.css') }}">
@endpush

@section('content')
<div class="about-container">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Apa itu <span class="highlight">HandTalk</span>?</h1>
                <p class="hero-subtitle">Platform pembelajaran bahasa isyarat berbasis web yang inovatif dan mudah diakses untuk semua kalangan</p>
            </div>
            <div class="hero-image">
                <div class="hero-icon">
                    <i class="fas fa-hands"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content-section">
        <div class="content-wrapper">
            <!-- Introduction -->
            <div class="intro-card">
                <h2>Mengenal HandTalk</h2>
                <p>HandTalk adalah platform pembelajaran bahasa isyarat berbasis web yang dikembangkan untuk meningkatkan literasi Bahasa Isyarat Indonesia (SIBI) di kalangan masyarakat umum. Dengan antarmuka yang menarik dan konten yang disusun secara sistematis, HandTalk menjadikan pembelajaran bahasa isyarat lebih mudah diakses, dipahami, dan dipelajari oleh siapa saja tanpa memerlukan latar belakang khusus.</p>
            </div>

            <!-- Features Grid -->
            <div class="features-section">
                <h2>Fitur Unggulan</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3>Kamus SIBI Interaktif</h3>
                        <p>Kamus Bahasa Isyarat Indonesia lengkap berdasarkan standar SIBI dari Kemdikbud dengan tampilan interaktif yang mudah dipahami.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3>Kursus Terstruktur</h3>
                        <p>Pembelajaran dibagi menjadi 3 komponen utama: materi video edukatif, latihan soal, dan kuis evaluasi untuk setiap topik.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <h3>Video Pembelajaran</h3>
                        <p>Materi visual berbasis video dari sumber tepercaya YouTube edukatif dengan pendekatan pembelajaran topikal.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3>Evaluasi Mandiri</h3>
                        <p>Latihan soal dan kuis interaktif dengan format pilihan ganda untuk menguji pemahaman setiap materi.</p>
                    </div>
                </div>
            </div>

            <!-- Learning Topics -->
            <div class="topics-section">
                <h2>Topik Pembelajaran</h2>
                <div class="topics-grid">
                    <div class="topic-card">
                        <div class="topic-number">01</div>
                        <h3>Pengantar Bahasa Isyarat</h3>
                        <p>Dasar-dasar dan pengenalan awal tentang bahasa isyarat Indonesia</p>
                    </div>
                    
                    <div class="topic-card">
                        <div class="topic-number">02</div>
                        <h3>Huruf dalam Bahasa Isyarat</h3>
                        <p>Pembelajaran alfabet dan cara membentuk huruf menggunakan bahasa isyarat</p>
                    </div>
                    
                    <div class="topic-card">
                        <div class="topic-number">03</div>
                        <h3>Angka dalam Bahasa Isyarat</h3>
                        <p>Cara mengekspresikan angka dan bilangan dalam bahasa isyarat</p>
                    </div>
                    
                    <div class="topic-card">
                        <div class="topic-number">04</div>
                        <h3>Kata dalam Bahasa Isyarat</h3>
                        <p>Kosakata dan frasa umum yang sering digunakan dalam kehidupan sehari-hari</p>
                    </div>
                </div>
            </div>

            <!-- Target Users -->
            <div class="users-section">
                <h2>Untuk Siapa HandTalk?</h2>
                <div class="users-grid">
                    <div class="user-card">
                        <div class="user-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Masyarakat Umum</h3>
                        <p>Siapa saja yang ingin mempelajari bahasa isyarat untuk berkomunikasi dengan teman tuli</p>
                    </div>
                    
                    <div class="user-card">
                        <div class="user-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3>Pelajar & Mahasiswa</h3>
                        <p>Siswa dan mahasiswa yang tertarik mempelajari bahasa isyarat sebagai skill tambahan</p>
                    </div>
                    
                    <div class="user-card">
                        <div class="user-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Pembelajar Antusias</h3>
                        <p>Individu yang memiliki minat besar terhadap bahasa isyarat tanpa latar belakang khusus</p>
                    </div>
                </div>
            </div>

            <!-- Mission -->
            <div class="mission-section">
                <div class="mission-content">
                    <h2>Misi Kami</h2>
                    <div class="mission-grid">
                        <div class="mission-item">
                            <div class="mission-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <p>Meningkatkan literasi Bahasa Isyarat Indonesia di kalangan masyarakat umum</p>
                        </div>
                        
                        <div class="mission-item">
                            <div class="mission-icon">
                                <i class="fas fa-universal-access"></i>
                            </div>
                            <p>Menjadikan bahasa isyarat lebih mudah diakses, dipahami, dan dipelajari oleh siapa saja</p>
                        </div>
                        
                        <div class="mission-item">
                            <div class="mission-icon">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <p>Mendukung pendidikan inklusif melalui media pembelajaran daring yang inovatif</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Development Info -->
            <div class="development-section">
                <div class="dev-card">
                    <h2>Dikembangkan dengan Dedikasi</h2>
                    <p>HandTalk dikembangkan oleh tim mahasiswa Sistem Informasi Universitas Airlangga sebagai solusi inovatif untuk menjawab kurangnya media pembelajaran bahasa isyarat berbasis daring yang praktis dan terstruktur. Proyek yang dimulai pada tahun 2023 dan terus dikembangkan hingga 2025 ini menggunakan referensi resmi dari Kementerian Pendidikan dan Kebudayaan untuk memastikan akurasi konten pembelajaran.</p>
                    
                    <div class="dev-highlights">
                        <div class="highlight-item">
                            <strong>Platform:</strong> Web-based Laravel dengan MySQL
                        </div>
                        <div class="highlight-item">
                            <strong>Referensi:</strong> SIBI Kemdikbud Official
                        </div>
                        <div class="highlight-item">
                            <strong>Pengembang:</strong> Mahasiswa SI Universitas Airlangga
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection