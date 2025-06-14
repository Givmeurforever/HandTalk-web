<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Topik;
use App\Models\Materi;
use App\Models\Latihan;
use App\Models\Kuis;
use App\Models\Kamus;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Dashboard';

        // 📊 Statistik umum
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('last_activity')->count();
        $newUsers = User::whereDate('created_at', '>=', now()->subDays(7))->count();

        $totalTopics = Topik::count();
        $totalMaterials = Materi::count();
        $totalExercises = Latihan::count();
        $totalQuizzes = Kuis::count();
        $totalDictionary = Kamus::count();

        // 📈 Aktivitas pengguna (jumlah user yang login per hari selama 7 hari terakhir)
        $activity = User::select(DB::raw("DATE_FORMAT(last_activity, '%a') as day"), DB::raw("COUNT(*) as total"))
            ->whereDate('last_activity', '>=', now()->subDays(6))
            ->groupBy('day')
            ->orderByRaw("FIELD(day, 'Mon','Tue','Wed','Thu','Fri','Sat','Sun')")
            ->pluck('total', 'day')->toArray();

        $labels = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
        $translated = ['Sen','Sel','Rab','Kam','Jum','Sab','Min'];
        $userActivityData = [
            'labels' => $translated,
            'data' => array_map(fn($day) => $activity[$day] ?? 0, $labels),
        ];

        // 🔥 Topik paling populer (berdasarkan jumlah materi)
        $popularTopics = Topik::withCount('materi')
            ->orderByDesc('materi_count')
            ->limit(5)
            ->get()
            ->map(fn($t) => [
                'name' => $t->judul,
                'views' => $t->materi_count * 100, // asumsikan 100 views per materi
            ])
            ->toArray();

        // 📚 Kamus paling banyak dipakai (contoh berdasarkan created_at jika belum ada log)
        $dictionarySearches = Kamus::orderByDesc('created_at')
            ->limit(5)
            ->get()
            ->map(fn($k) => [
                'word' => $k->kata,
                'searches' => rand(50, 300) // random sementara jika belum ada tabel logs
            ])
            ->toArray();

        // 🕓 Aktivitas terbaru (berdasarkan last_activity)
        $recentActivities = User::whereNotNull('last_activity')
            ->orderByDesc('last_activity')
            ->limit(5)
            ->get()
            ->map(fn($u) => [
                'user' => $u->first_name . ' ' . $u->last_name,
                'action' => 'login terakhir',
                'object' => '',
                'time' => $u->last_activity->diffForHumans(),
            ])
            ->toArray();

        return view('admin.dashboard', compact(
            'pageTitle',
            'totalUsers',
            'activeUsers',
            'newUsers',
            'totalTopics',
            'totalMaterials',
            'totalExercises',
            'totalQuizzes',
            'totalDictionary',
            'userActivityData',
            'popularTopics',
            'dictionarySearches',
            'recentActivities'
        ));
    }
}
