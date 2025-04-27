<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Dashboard';

        // Data dummy untuk stats
        $totalUsers = 350;
        $activeUsers = 285;
        $newUsers = 42;
        $totalTopics = 15;
        $totalMaterials = 78;
        $totalQuizzes = 45;
        $totalDictionary = 320;

        // Data dummy untuk grafik aktivitas
        $userActivityData = [
            'labels' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            'data' => [65, 80, 76, 68, 90, 75, 85],
        ];

        // Data dummy untuk topik populer
        $popularTopics = [
            ['name' => 'Perkenalan Dasar', 'views' => 1250],
            ['name' => 'Alfabet Bahasa Isyarat', 'views' => 980],
            ['name' => 'Percakapan Harian', 'views' => 876],
            ['name' => 'Isyarat Angka', 'views' => 654],
            ['name' => 'Keluarga', 'views' => 542],
        ];

        // Data dummy untuk pencarian kamus
        $dictionarySearches = [
            ['word' => 'Halo', 'searches' => 245],
            ['word' => 'Terima Kasih', 'searches' => 198],
            ['word' => 'Saya', 'searches' => 176],
            ['word' => 'Tolong', 'searches' => 145],
            ['word' => 'Maaf', 'searches' => 134],
        ];

        // Data dummy untuk aktivitas terbaru
        $recentActivities = [
            ['user' => 'Budi Santoso', 'action' => 'menyelesaikan kuis', 'object' => 'Perkenalan Dasar', 'time' => '5 menit yang lalu'],
            ['user' => 'Siti Rahayu', 'action' => 'mendaftar sebagai pengguna baru', 'object' => '', 'time' => '25 menit yang lalu'],
            ['user' => 'Ahmad Fauzi', 'action' => 'menyelesaikan topik', 'object' => 'Alfabet Bahasa Isyarat', 'time' => '45 menit yang lalu'],
            ['user' => 'Dewi Lestari', 'action' => 'mencari kata di kamus', 'object' => 'Terima Kasih', 'time' => '1 jam yang lalu'],
            ['user' => 'Rio Wijaya', 'action' => 'mendapatkan sertifikat', 'object' => 'Percakapan Dasar', 'time' => '2 jam yang lalu'],
        ];

        return view('admin.dashboard', compact(
            'pageTitle',
            'totalUsers',
            'activeUsers',
            'newUsers',
            'totalTopics',
            'totalMaterials',
            'totalQuizzes',
            'totalDictionary',
            'userActivityData',
            'popularTopics',
            'dictionarySearches',
            'recentActivities'
        ));
    }
}
