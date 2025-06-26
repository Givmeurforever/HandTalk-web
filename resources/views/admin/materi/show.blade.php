@extends('layouts.dashboardadmin')

@section('title', 'Detail Materi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-materi.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Detail Materi</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $materi->judul }}</h5>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Topik:</strong> {{ $materi->topik->judul ?? '-' }}</p>
                    <p><strong>Urutan:</strong> {{ $materi->urutan }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Durasi:</strong> 
                        @if($materi->durasi)
                            {{ floor($materi->durasi / 60) }} menit {{ $materi->durasi % 60 }} detik
                        @else
                            Belum diatur
                        @endif
                    </p>
                    <p><strong>Dibuat:</strong> {{ $materi->created_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>

            @if($materi->deskripsi)
                <div class="mb-4">
                    <p><strong>Deskripsi:</strong></p>
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($materi->deskripsi)) !!}
                    </div>
                </div>
            @endif

            <div class="mb-4">
                <p><strong>Video Pembelajaran:</strong></p>
                @if($materi->video)
                    @if(Str::length($materi->video) <= 20)
                        {{-- Embed YouTube --}}
                        <div class="video-container">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $materi->video }}" frameborder="0" allowfullscreen class="img-fluid"></iframe>
                        </div>
                        <small class="text-muted d-block mt-2">YouTube Video ID: {{ $materi->video }}</small>
                    @else
                        {{-- Path file video --}}
                        <div class="video-container">
                            <video width="560" height="315" controls class="img-fluid">
                                <source src="{{ asset('storage/' . $materi->video) }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutar video.
                            </video>
                        </div>
                        <small class="text-muted d-block mt-2">File Path: {{ $materi->video }}</small>
                    @endif
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Video belum diatur untuk materi ini.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.materi.edit', $materi->id) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Materi
        </a>
        <a href="{{ route('admin.materi.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<style>
.video-container {
    position: relative;
    max-width: 100%;
}

.video-container iframe,
.video-container video {
    max-width: 100%;
    height: auto;
}

@media (max-width: 768px) {
    .video-container iframe,
    .video-container video {
        width: 100%;
        height: 200px;
    }
}
</style>
@endsection