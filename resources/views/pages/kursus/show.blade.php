@extends('layouts.app')

@section('title', $topik['judul'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endpush
@section('content')
<div class="course-container">
    <!-- Header Section -->
    <div class="course-header">
        <div class="breadcrumb">
            <a href="{{ route('kursus.index') }}" class="breadcrumb-link">
                <i class="fas fa-home"></i>
                Kursus
            </a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">{{ $topik['judul'] }}</span>
        </div>
        
        <div class="course-title-section">
            <h1 class="course-title">{{ $topik['judul'] }}</h1>
            <p class="course-description">{{ $topik['description'] }}</p>
        </div>
        
        <div class="course-stats">
            <div class="stat-item">
                <i class="fas fa-book-open"></i>
                <span>{{ count($topik['materi']) }} Materi</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-clock"></i>
                <span>{{ count($topik['materi']) * 3 }} Menit</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-trophy"></i>
                <span>Sertifikat</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="course-content">
        <!-- Course Navigation -->
        <div class="course-sidebar">
            <div class="sidebar-header">
                <h3>Daftar Materi</h3>
                <div class="progress-info">
                    <span class="progress-text">Progress: 0/{{ count($topik['materi']) }}</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 0%"></div>
                    </div>
                </div>
            </div>
            
            <div class="material-list">
                @foreach($topik['materi'] as $index => $materi)
                <div class="material-item">
                    <div class="material-number">{{ $index + 1 }}</div>
                    <div class="material-info">
                        <h4 class="material-title">{{ $materi['judul'] }}</h4>
                        <div class="material-meta">
                            <span class="material-duration">
                                <i class="fas fa-clock"></i>
                                {{ $materi['durasi'] }}
                            </span>
                            <span class="material-type">
                                <i class="fas fa-play-circle"></i>
                                Video
                            </span>
                        </div>
                    </div>
                    <div class="material-actions">
                        <a href="{{ route('topik.materi', [$topik['slug'], $materi['slug']]) }}" 
                           class="btn btn-start">
                            <i class="fas fa-play"></i>
                            Mulai
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Quiz Section -->
            <div class="quiz-section">
                <div class="quiz-header">
                    <h4>Kuis Akhir</h4>
                    <span class="quiz-badge">Required</span>
                </div>
                <p class="quiz-description">
                    Selesaikan kuis untuk mendapatkan sertifikat penyelesaian
                </p>
                <a href="{{ route('topik.kuis', $topik['slug']) }}" class="btn btn-quiz">
                    <i class="fas fa-clipboard-check"></i>
                    Mulai Kuis
                </a>
            </div>
        </div>

        <!-- Course Preview -->
        <div class="course-preview">
            <div class="preview-card">
                <div class="preview-header">
                    <h3>Preview Kursus</h3>
                    <span class="preview-badge">Gratis</span>
                </div>
                
                <div class="preview-video">
                    <div class="video-placeholder">
                        <i class="fas fa-play-circle"></i>
                        <p>Video Preview</p>
                    </div>
                </div>
                
                <div class="preview-content">
                    <h4>Apa yang akan Anda pelajari?</h4>
                    <ul class="learning-objectives">
                        <li><i class="fas fa-check"></i> Memahami konsep dasar {{ $topik['judul'] }}</li>
                        <li><i class="fas fa-check"></i> Menerapkan teori dalam praktik</li>
                        <li><i class="fas fa-check"></i> Menyelesaikan studi kasus nyata</li>
                        <li><i class="fas fa-check"></i> Mendapatkan sertifikat penyelesaian</li>
                    </ul>
                </div>
                
                <div class="preview-actions">
                    @if(count($topik['materi']) > 0)
                    <a href="{{ route('topik.materi', [$topik['slug'], $topik['materi'][0]['slug']]) }}" 
                       class="btn btn-primary btn-large">
                        <i class="fas fa-rocket"></i>
                        Mulai Belajar Sekarang
                    </a>
                    @endif
                    <button class="btn btn-outline btn-large">
                        <i class="fas fa-bookmark"></i>
                        Simpan ke Favorit
                    </button>
                </div>
            </div>
            
            <!-- Course Info -->
            <div class="course-info-card">
                <h4>Informasi Kursus</h4>
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Level:</strong>
                        <span>Pemula</span>
                    </div>
                    <div class="info-item">
                        <strong>Bahasa:</strong>
                        <span>Indonesia</span>
                    </div>
                    <div class="info-item">
                        <strong>Format:</strong>
                        <span>Video & Latihan</span>
                    </div>
                    <div class="info-item">
                        <strong>Akses:</strong>
                        <span>Selamanya</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection