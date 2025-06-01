@extends('layouts.dashboardadmin')

@section('title', 'Detail Materi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-materi.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Detail Materi</h1>

    <p><strong>Judul:</strong> {{ $materi->judul }}</p>
    <p><strong>Topik:</strong> {{ $materi->topik->judul ?? '-' }}</p>
    <p><strong>Deskripsi:</strong></p>
    <div class="bg-light p-3 rounded mb-3">
        {!! nl2br(e($materi->deskripsi)) !!}
    </div>

    <p><strong>Video Pembelajaran:</strong></p>
    @if(Str::length($materi->video) <= 20)
        {{-- Embed YouTube --}}
        <iframe width="480" height="270" src="https://www.youtube.com/embed/{{ $materi->video }}" frameborder="0" allowfullscreen></iframe>
    @else
        {{-- Path file video --}}
        <video width="480" height="270" controls>
            <source src="{{ asset('storage/' . $materi->video) }}" type="video/mp4">
            Browser Anda tidak mendukung pemutar video.
        </video>
    @endif

    <div class="mt-4">
        <a href="{{ route('admin.materi.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>
</div>
@endsection
