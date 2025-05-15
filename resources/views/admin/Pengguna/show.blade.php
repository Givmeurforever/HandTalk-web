@extends('layouts.dashboardadmin')
@section('title', 'Detail Pengguna - HandTalk')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-pengguna-detail.css') }}">
@endpush

@section('content')
<div class="pengguna-detail-container">
    <div class="detail-header">
        <h1>Detail Pengguna</h1>
        <div class="header-actions">
            <a href="{{ route('admin.pengguna.edit', $pengguna->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Pengguna
            </a>
            <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="detail-content">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <img src="{{ $pengguna->profile_picture_url }}" alt="Foto Profil {{ $pengguna->full_name }}">
                </div>
                <div class="profile-info">
                    <h2>{{ $pengguna->full_name }}</h2>
                    <p class="profile-email">{{ $pengguna->email }}</p>
                    <p class="profile-join-date">
                        <i class="fas fa-calendar-alt"></i> Bergabung: {{ $pengguna->created_at->format('d M Y') }}
                    </p>
                    <p class="profile-last-active">
                        <i class="fas fa-clock"></i> Terakhir aktif: 
                        {{ $pengguna->last_activity ? $pengguna->last_activity->format('d M Y H:i') : 'Belum pernah' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div class="stat-info">
                    <h3>Progres Keseluruhan</h3>
                    <div class="progress-container large">
                        <div class="progress-bar">
                            <div class="progress" style="width: {{ $pengguna->progress }}%"></div>
                        </div>
                        <span class="progress-text">{{ $pengguna->progress }}%</span>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-info">
                    <h3>Materi Selesai</h3>
                    <p class="stat-number">{{ floor($pengguna->progress / 100 * 8) }}/8</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="stat-info">
                    <h3>Latihan Selesai</h3>
                    <p class="stat-number">{{ floor($pengguna->progress / 100 * 8) }}/8</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>Kuis Selesai</h3>
                    <p class="stat-number">{{ floor($pengguna->progress / 100 * 8) }}/8</p>
                </div>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-tabs">
                <button class="tab-button active" data-tab="progres">Progres Belajar</button>
                <button class="tab-button" data-tab="aktivitas">Riwayat Aktivitas</button>
                <button class="tab-button" data-tab="kuis">Performa Kuis</button>
            </div>
            
            <div class="tab-content">
                <div id="progres" class="tab-pane active">
                    <h3>Progres per Topik</h3>
                    
                    <div class="topics-progress-list">
                        <div class="topic-progress-item">
                            <div class="topic-info">
                                <h5>Pengenalan Bahasa Isyarat</h5>
                                <div class="progress-container">
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 100%"></div>
                                    </div>
                                    <span class="progress-text">100%</span>
                                </div>
                            </div>
                            <div class="topic-badges">
                                <span class="badge materi-complete"><i class="fas fa-book"></i> 1/1</span>
                                <span class="badge latihan-complete"><i class="fas fa-tasks"></i> 1/1</span>
                                <span class="badge kuis-complete"><i class="fas fa-question-circle"></i> 1/1</span>
                            </div>
                        </div>
                        
                        <div class="topic-progress-item">
                            <div class="topic-info">
                                <h5>Alfabet dan Angka</h5>
                                <div class="progress-container">
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 85%"></div>
                                    </div>
                                    <span class="progress-text">85%</span>
                                </div>
                            </div>
                            <div class="topic-badges">
                                <span class="badge materi-complete"><i class="fas fa-book"></i> 1/1</span>
                                <span class="badge latihan-complete"><i class="fas fa-tasks"></i> 1/1</span>
                                <span class="badge kuis-incomplete"><i class="fas fa-question-circle"></i> 0/1</span>
                            </div>
                        </div>
                        
                        <div class="topic-progress-item">
                            <div class="topic-info">
                                <h5>Percakapan Dasar</h5>
                                <div class="progress-container">
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 67%"></div>
                                    </div>
                                    <span class="progress-text">67%</span>
                                </div>
                            </div>
                            <div class="topic-badges">
                                <span class="badge materi-complete"><i class="fas fa-book"></i> 1/1</span>
                                <span class="badge latihan-complete"><i class="fas fa-tasks"></i> 1/1</span>
                                <span class="badge kuis-incomplete"><i class="fas fa-question-circle"></i> 0/1</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="aktivitas" class="tab-pane">
                    <h3>Riwayat Aktivitas</h3>
                    
                    <div class="activity-timeline">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-title">Menyelesaikan Materi: Percakapan Dasar</p>
                                <p class="activity-time">12 Mei 2025, 14:30</p>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-title">Menyelesaikan Latihan: Percakapan Dasar</p>
                                <p class="activity-time">12 Mei 2025, 15:15</p>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-title">Menyelesaikan Materi: Alfabet dan Angka</p>
                                <p class="activity-time">10 Mei 2025, 09:45</p>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-title">Menyelesaikan Latihan: Alfabet dan Angka</p>
                                <p class="activity-time">10 Mei 2025, 10:30</p>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-title">Menyelesaikan Kuis: Pengenalan Bahasa Isyarat</p>
                                <p class="activity-time">8 Mei 2025, 16:20</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="kuis" class="tab-pane">
                    <h3>Performa Kuis</h3>
                    
                    <div class="quiz-chart-container">
                        <canvas id="quizPerformanceChart"></canvas>
                    </div>
                    
                    <div class="quiz-history">
                        <h4>Riwayat Kuis</h4>
                        
                        <div class="quiz-item">
                            <div class="quiz-info">
                                <h5>Kuis: Pengenalan Bahasa Isyarat</h5>
                                <p class="quiz-date">8 Mei 2025, 16:20</p>
                            </div>
                            <div class="quiz-score">
                                <p class="score">85%</p>
                                <p class="result">Lulus</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanes = document.querySelectorAll('.tab-pane');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons and panes
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabPanes.forEach(pane => pane.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Show corresponding pane
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
        
        // Quiz performance chart
        const ctx = document.getElementById('quizPerformanceChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pengenalan Bahasa Isyarat', 'Alfabet dan Angka', 'Percakapan Dasar'],
                datasets: [{
                    label: 'Nilai Kuis',
                    data: [85, 0, 0], // Hanya kuis pertama yang sudah diambil
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(200, 200, 200, 0.6)', // Belum diambil
                        'rgba(200, 200, 200, 0.6)'  // Belum diambil
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(200, 200, 200, 1)',
                        'rgba(200, 200, 200, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush