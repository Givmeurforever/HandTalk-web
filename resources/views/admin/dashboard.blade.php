@extends('layouts.dashboardadmin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="dashboard-container">
    <!-- Stats Cards -->
    <div class="stats-cards">
        <!-- Pengguna -->
        <div class="stat-card users">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Pengguna</p>
                <div class="stat-details">
                    <span>{{ $activeUsers }} Aktif</span>
                    <span>{{ $newUsers }} Baru (7 hari)</span>
                </div>
            </div>
        </div>

        <!-- Topik -->
        <div class="stat-card topics">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalTopics }}</h3>
                <p>Total Topik</p>
                <div class="stat-details">
                    <span>{{ $topicsWithMaterials }} Berisi Materi</span>
                </div>
            </div>
        </div>

        <!-- Konten Pembelajaran -->
        <div class="stat-card content">
            <div class="stat-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalMaterials + $totalExercises + $totalQuizzes }}</h3>
                <p>Konten Pembelajaran</p>
                <div class="stat-details">
                    <span>{{ $totalMaterials }} Materi</span>
                    <span>{{ $totalExercises }} Latihan</span>
                    <span>{{ $totalQuizzes }} Kuis</span>
                </div>
            </div>
        </div>

        <!-- Kamus -->
        <div class="stat-card dictionary">
            <div class="stat-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalDictionary }}</h3>
                <p>Item Kamus</p>
                <div class="stat-details">
                    <span>{{ $videoCount }} Video</span>
                    <span>{{ $imageCount }} Gambar</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Topik Populer -->
    <div class="dashboard-row">
        <!-- Grafik Registrasi Pengguna -->
        <div class="dashboard-col">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Registrasi Pengguna (30 Hari Terakhir)</h3>
                </div>
                <div class="card-body">
                    <canvas id="userRegistrationChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Topik Terbanyak Materi -->
        <div class="dashboard-col">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Topik Dengan Materi Terbanyak</h3>
                </div>
                <div class="card-body">
                    <ul class="popular-list">
                        @forelse ($topicsWithMostMaterials as $topic)
                        <li>
                            <span class="popular-name">{{ $topic->judul }}</span>
                            <span class="popular-value">{{ $topic->materials_count }} materi</span>
                        </li>
                        @empty
                        <li>
                            <span class="popular-name">Belum ada data</span>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Konten dan Pengguna -->
    <div class="dashboard-row">
        <!-- Distribusi Media Kamus -->
        <div class="dashboard-col">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Distribusi Media Kamus</h3>
                </div>
                <div class="card-body">
                    <canvas id="mediaDistributionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Pengguna Terbaru -->
        <div class="dashboard-col">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Pengguna Terbaru</h3>
                </div>
                <div class="card-body">
                    <ul class="activity-list">
                        @forelse ($recentUsers as $user)
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-info">
                                <p>
                                    <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                                    <br>
                                    <small>{{ $user->email }}</small>
                                </p>
                                <span class="activity-time">{{ $user->created_at->diffForHumans() }}</span>
                            </div>
                        </li>
                        @empty
                        <li>
                            <div class="activity-info">
                                <p>Belum ada pengguna baru</p>
                            </div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Konten Terbaru -->
    <div class="dashboard-row">
        <!-- Materi Terbaru -->
        <div class="dashboard-col">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Materi Terbaru</h3>
                </div>
                <div class="card-body">
                    <ul class="activity-list">
                        @forelse ($recentMaterials as $material)
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-file-text"></i>
                            </div>
                            <div class="activity-info">
                                <p>
                                    <strong>{{ $material->judul }}</strong>
                                    <br>
                                    <small>Topik: {{ $material->topik_judul }}</small>
                                </p>
                                <span class="activity-time">{{ $material->created_at->diffForHumans() }}</span>
                            </div>
                        </li>
                        @empty
                        <li>
                            <div class="activity-info">
                                <p>Belum ada materi</p>
                            </div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Kata Kamus Terbaru -->
        <div class="dashboard-col">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Kata Kamus Terbaru</h3>
                </div>
                <div class="card-body">
                    <ul class="activity-list">
                        @forelse ($recentDictionary as $word)
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-{{ $word->media_type == 'video' ? 'video' : 'image' }}"></i>
                            </div>
                            <div class="activity-info">
                                <p>
                                    <strong>{{ $word->kata }}</strong>
                                    <br>
                                    <small>Media: {{ ucfirst($word->media_type) }}</small>
                                </p>
                                <span class="activity-time">{{ $word->created_at->diffForHumans() }}</span>
                            </div>
                        </li>
                        @empty
                        <li>
                            <div class="activity-info">
                                <p>Belum ada kata dalam kamus</p>
                            </div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
// Grafik Registrasi Pengguna
const userCtx = document.getElementById('userRegistrationChart').getContext('2d');
new Chart(userCtx, {
    type: 'line',
    data: {
        labels: @json($userRegistrationData['labels']),
        datasets: [{
            label: 'Registrasi Harian',
            data: @json($userRegistrationData['data']),
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: { 
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        },
        plugins: {
            legend: {
                display: true
            }
        }
    }
});

// Grafik Distribusi Media Kamus
const mediaCtx = document.getElementById('mediaDistributionChart').getContext('2d');
new Chart(mediaCtx, {
    type: 'doughnut',
    data: {
        labels: @json($mediaDistributionData['labels']),
        datasets: [{
            data: @json($mediaDistributionData['data']),
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 205, 86, 0.8)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 205, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endsection