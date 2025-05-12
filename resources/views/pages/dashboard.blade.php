@extends('layouts.app')
@section('title', 'Dashboard User')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user-dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
    <div class="container"> {{-- Atau class pembungkus global jika ada --}}
        <div class="user-dashboard fade-in">
            <div class="dashboard-header fade-in delay-1">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <h2><i class="fas fa-user-circle"></i> Halo, {{ $user->first_name }} 👋</h2>
                <a href="{{ route('kursus') }}" class="btn-lanjut">📚 Lanjutkan Belajar</a>
            </div>

            <div class="dashboard-stats fade-in delay-2">
                <div class="stat-card">
                    <i class="fas fa-graduation-cap stat-icon"></i>
                    <h4>Topik Selesai</h4>
                    <p>{{ $totalCompleted }} / {{ $totalTopik }}</p>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ ($totalCompleted / max($totalTopik, 1)) * 100 }}%;"></div>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-star stat-icon"></i>
                    <h4>Kamus Favorit</h4>
                    <p>{{ count($favorites) }}</p>
                </div>
            </div>

            <div class="dashboard-section fade-in delay-3">
                <h3><i class="fas fa-book-open"></i> Progres Belajar</h3>
                <ul class="progress-list">
                    @foreach ($progress as $item)
                        <li>
                            <strong>{{ $item['topik'] }}</strong><br>
                            <span class="badge {{ $item['materi'] === 'completed' ? 'success' : 'pending' }}">Materi: {{ $item['materi'] }}</span>
                            <span class="badge {{ $item['latihan'] === 'completed' ? 'success' : 'pending' }}">Latihan: {{ $item['latihan'] }}</span>
                            <span class="badge {{ $item['kuis'] === 'completed' ? 'success' : 'pending' }}">Kuis: {{ $item['kuis'] }}</span>
                            <span class="badge score">Skor: {{ $item['skor'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="dashboard-section fade-in delay-3">
                <h3><i class="fas fa-book"></i> Kamus Favorit</h3>
                <ul class="favorite-list">
                    @foreach ($favorites as $fav)
                        <li><i class="fas fa-hand-peace"></i> {{ $fav['word'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
