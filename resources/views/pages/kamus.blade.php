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
                        <video autoplay muted loop playsinline>
                            <source src="{{ $hasil['video'] }}" type="video/webm">
                            Browser tidak mendukung video.
                        </video>
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
