@extends('layouts.dashboardadmin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="content-header">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang kembali 👋 Lihat ringkasan aktivitas terbaru platform.</p>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-box">
        <i class="fas fa-users icon bg-blue"></i>
        <div class="stat-text">
            <h3>1.200</h3>
            <p>Total Pengguna</p>
        </div>
    </div>
    <div class="stat-box">
        <i class="fas fa-video icon bg-green"></i>
        <div class="stat-text">
            <h3>300</h3>
            <p>Materi Video</p>
        </div>
    </div>
    <div class="stat-box">
        <i class="fas fa-book icon bg-purple"></i>
        <div class="stat-text">
            <h3>3.500</h3>
            <p>Modul Diselesaikan</p>
        </div>
    </div>
    <div class="stat-box">
        <i class="fas fa-chart-line icon bg-orange"></i>
        <div class="stat-text">
            <h3>+5.4%</h3>
            <p>Aktivitas Mingguan</p>
        </div>
    </div>
</div>

<!-- User Activity -->
<div class="activity-section">
    <h2>Aktivitas Terbaru Pengguna</h2>
    <div class="activity-cards">
        <div class="activity-card">
            <p><strong>User123</strong> menyelesaikan <em>Isyarat Dasar Sehari-hari</em></p>
            <span class="timestamp">15 April 2025</span>
        </div>
        <div class="activity-card">
            <p><strong>User567</strong> memberi rating 5 pada <em>Alfabet Bahasa Isyarat</em></p>
            <span class="timestamp">14 April 2025</span>
        </div>
        <div class="activity-card">
            <p><strong>User789</strong> menonton <em>Bahasa Isyarat untuk Emosi</em></p>
            <span class="timestamp">14 April 2025</span>
        </div>
        <div class="activity-card">
            <p><strong>User001</strong> memperoleh badge <em>Pemula Bahasa Isyarat</em></p>
            <span class="timestamp">13 April 2025</span>
        </div>
        <div class="activity-card">
            <p><strong>User001</strong> memperoleh badge <em>Pemula Bahasa Isyarat</em></p>
            <span class="timestamp">13 April 2025</span>
        </div>
    </div>
</div>
@endsection
