@extends('layouts.app')
@section('title', 'Hasil Kuis - ' . $topik['nama'])

@push('styles')
<link rel="stylesheet" href="{{ asset('css/latihan.css') }}">
@endpush

@section('content')
<div class="latihan-container">
    <div class="hasil-header">
        <h2>Hasil Kuis: {{ $topik['nama'] }}</h2>
        
        <div class="score-summary">
            <div class="score-circle">
                <div class="score-number">{{ $score }}%</div>
                <div class="score-label">Score</div>
            </div>
            <div class="score-details">
                <p><strong>Benar:</strong> {{ $benar }} dari {{ $total_soal }} soal</p>
                <p><strong>Status:</strong> 
                    <span class="status-badge {{ $score >= 70 ? 'status-lulus' : 'status-tidak-lulus' }}">
                        {{ $score >= 70 ? 'LULUS' : 'TIDAK LULUS' }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="hasil-detail">
        <h3>Detail Jawaban</h3>
        
        @foreach($hasil as $kuisId => $detail)
        <div class="detail-card {{ $detail['is_benar'] ? 'correct' : 'incorrect' }}">
            <div class="detail-header">
                <h4>Soal {{ $loop->iteration }}</h4>
                <span class="result-icon">
                    {{ $detail['is_benar'] ? '✓' : '✗' }}
                </span>
            </div>
            
            <p class="detail-soal">{{ $detail['soal'] }}</p>
            
            <div class="detail-jawaban">
                <p><strong>Jawaban Anda:</strong> 
                    <span class="{{ $detail['is_benar'] ? 'text-success' : 'text-danger' }}">
                        {{ $detail['jawaban_user'] ?? 'Tidak dijawab' }}
                    </span>
                </p>
                
                @if(!$detail['is_benar'])
                <p><strong>Jawaban Benar:</strong> 
                    <span class="text-success">{{ $detail['jawaban_benar'] }}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="hasil-actions">
        <a href="{{ route('kursus.kuis', $topik['slug']) }}" class="btn btn-primary">Ulangi Kuis</a>
        <a href="{{ route('kursus') }}" class="btn btn-outline-secondary">Kembali ke Kursus</a>
    </div>
</div>
@endsection