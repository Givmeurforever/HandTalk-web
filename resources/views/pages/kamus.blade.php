@extends('layouts.app')

@section('title', 'Kamus')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kamus.css') }}">
@endpush

@section('content')
    <div class="kamus-container">
        @if ($kataDicari)
            <h2 class="title">Hasil Pencarian Kata</h2>

            @if ($hasil)
                <div class="hasil-box">
                    <div class="hasil-gif">
                        {{-- Periksa ekstensi file dari $hasil['video'] --}}
                        @php
                            $mediaPath = $hasil['video'] ?? ''; // Ambil path media, default ke string kosong
                            $extension = pathinfo($mediaPath, PATHINFO_EXTENSION); // Dapatkan ekstensi file
                        @endphp

                        @if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif'])) {{-- Jika ekstensi adalah format gambar --}}
                            <img src="{{ $mediaPath }}" alt="{{ $hasil['kata'] }}" class="responsive-media">
                        @elseif (in_array($extension, ['webm', 'mp4', 'ogg'])) {{-- Jika ekstensi adalah format video --}}
                            <video autoplay muted loop playsinline class="responsive-media">
                                <source src="{{ $mediaPath }}" type="video/{{ $extension }}">
                                Browser tidak mendukung video.
                            </video>
                        @else
                            {{-- Opsional: Tampilkan pesan atau gambar placeholder jika format tidak dikenali --}}
                            <p>Tidak ada media yang tersedia atau format tidak didukung.</p>
                        @endif
                    </div>
                    <div class="hasil-kata">
                        <h1>{{ ucfirst($hasil['kata']) }}</h1>
                    </div>
                </div>
            @else
                <p class="not-found">Kata "<strong>{{ $kataDicari }}</strong>" tidak ditemukan.</p>
            @endif
        @else
            <p class="no-search">Silakan masukkan kata untuk mencari dalam kamus.</p>
        @endif
    </div>
@endsection
