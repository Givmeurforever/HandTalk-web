@extends('layouts.dashboardadmin')
@section('title', 'Dashboard Admin')
@section('content')

<div class="dashboard-container">
    <!-- Stats Cards -->
    <div class="stats-cards">
        <div class="stat-card users">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Pengguna</p>
                <div class="stat-details">
                    <span>{{ $activeUsers }} Aktif</span>
                    <span>{{ $newUsers }} Baru</span>
                </div>
            </div>
        </div>
        
        <div class="stat-card topics">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalTopics }}</h3>
                <p>Topik</p>
            </div>
        </div>
        
        <div class="stat-card content">
            <div class="stat-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalMaterials + $totalQuizzes }}</h3>
                <p>Konten Pembelajaran</p>
                <div class="stat-details">
                    <span>{{ $totalMaterials }} Materi</span>
                    <span>{{ $totalQuizzes }} Kuis</span>
                </div>
            </div>
        </div>
        
        <div class="stat-card dictionary">
            <div class="stat-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalDictionary }}</h3>
                <p>Item Kamus</p>
            </div>
        </div>
    </div>
    
    <!-- Charts & Analytics -->
    <div class="dashboard-row">
        <div class="dashboard-col">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Aktivitas Pengguna (7 Hari Terakhir)</h3>
                </div>
                <div class="card-body">
                    <canvas id="userActivityChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="dashboard-col">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Topik Paling Populer</h3>
                </div>
                <div class="card-body">
                    <ul class="popular-list">
                        @foreach ($popularTopics as $topic)
                        <li>
                            <span class="popular-name">{{ $topic['name'] }}</span>
                            <span class="popular-value">{{ $topic['views'] }} views</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="dashboard-row">
        <div class="dashboard-col">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Pencarian Kamus Teratas</h3>
                </div>
                <div class="card-body">
                    <ul class="popular-list">
                        @foreach ($dictionarySearches as $search)
                        <li>
                            <span class="popular-name">{{ $search['word'] }}</span>
                            <span class="popular-value">{{ $search['searches'] }} pencarian</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="dashboard-col">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Aktivitas Terbaru</h3>
                </div>
                <div class="card-body">
                    <ul class="activity-list">
                        @foreach ($recentActivities as $activity)
                        <li>
                            <div class="activity-icon">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="activity-info">
                                <p>
                                    <strong>{{ $activity['user'] }}</strong> 
                                    {{ $activity['action'] }}
                                    @if (!empty($activity['object']))
                                        <strong>{{ $activity['object'] }}</strong>
                                    @endif
                                </p>
                                <span class="activity-time">{{ $activity['time'] }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk chart -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    const ctx = document.getElementById('userActivityChart').getContext('2d');
    const userActivityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($userActivityData['labels']),
            datasets: [{
                label: 'Aktivitas Pengguna',
                data: @json($userActivityData['data']),
                fill: true,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection