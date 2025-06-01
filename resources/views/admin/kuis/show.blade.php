@extends('layouts.dashboardadmin')

@section('title', 'Detail Kuis - Admin HandTalk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/page-latihan.css') }}">
<link rel="stylesheet" href="{{ asset('css/page-latihan-form.css') }}">
@endpush

@section('content')
<div class="latihan-container">
    <div class="page-header">
        <h1>Detail Kuis</h1>
        <a href="{{ route('admin.kuis.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="form-container readonly">
        <div class="form-section">
            <h3>Informasi Kuis</h3>

            <div class="form-group">
                <label>Topik:</label>
                <p>
                    @if(isset($kuis->topik))
                        @if(is_object($kuis->topik))
                            {{ $kuis->topik->judul }}
                        @elseif(is_array($kuis->topik) && isset($kuis->topik['judul']))
                            {{ $kuis->topik['judul'] }}
                        @else
                            -
                        @endif
                    @else
                        -
                    @endif
                </p>
            </div>

            <div class="form-group">
                <label>Urutan Soal:</label>
                <p>{{ is_object($kuis) ? $kuis->urutan : '-' }}</p>
            </div>

            <div class="form-group">
                <label>Soal:</label>
                <p>{{ is_object($kuis) ? $kuis->soal : '-' }}</p>
            </div>
        </div>

        <div class="form-section">
            <h3>Opsi Jawaban</h3>

            @foreach (['A', 'B', 'C', 'D'] as $label)
                @php
                    $relation = 'opsi' . $label; // e.g., opsiA
                    $kamus = $kuis->$relation ?? null;
                @endphp
                <div class="form-group">
                    <label>Opsi {{ $label }}:</label>
                    @if ($kamus)
                        <p><strong>{{ $kamus->kata }}</strong></p>
                        @php $ext = strtolower(pathinfo($kamus->video, PATHINFO_EXTENSION)); @endphp

                        @if (in_array($ext, ['png', 'jpg', 'jpeg']))
                            <img src="{{ asset('storage/' . $kamus->video) }}" width="200" alt="Opsi {{ $label }}">
                        @elseif ($ext === 'webm')
                            <video src="{{ asset('storage/' . $kamus->video) }}" width="200" controls muted></video>
                        @else
                            <p><em>File tidak dapat ditampilkan</em></p>
                        @endif
                    @else
                        <p><em>-</em></p>
                    @endif
                </div>
            @endforeach

            <div class="form-group">
                <label>Jawaban Benar:</label>
                <p><strong>Opsi {{ $kuis->jawaban_benar }}</strong></p>
            </div>
        </div>
    </div>
</div>
@endsection
