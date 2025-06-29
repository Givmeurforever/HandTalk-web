@extends('layouts.app')
@section('title', 'Dashboard User')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user-dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
<a href="{{ route('kursus') }}" class="back-btn-enhanced">
    <i class="fas fa-arrow-left"></i> Kembali ke Kursus
</a>

<div class="dashboard-container">
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-details">
                <h2>Halo, {{ $user->first_name }} {{ $user->last_name }}</h2>
                <p class="user-email"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalTopik }}</h3>
                <p>Total Topik</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon completed">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalCompleted }}</h3>
                <p>Diselesaikan</p>
            </div>
        </div>
    </div>

    <!-- Progress Section -->
    <div class="progress-section">
        <h3><i class="fas fa-chart-line"></i> Progress Kamu</h3>
        <div class="progress-list">
            @foreach ($progress as $item)
                <div class="progress-item">
                    <div class="progress-header">
                        <h4>{{ $item['topik'] }}</h4>
                    </div>
                    <div class="progress-details">
                        <div class="detail-item">
                            <i class="fas fa-file-text"></i>
                            <span>Materi: {{ $item['materi'] }}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-question-circle"></i>
                            <span>Kuis: {{ $item['kuis'] }}</span>
                        </div>
                        <div class="detail-item score">
                            <i class="fas fa-star"></i>
                            <span>Skor: {{ $item['skor'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection