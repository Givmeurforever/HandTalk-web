<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// Gunakan model yang sudah ada di project Anda
// Sesuaikan namespace dengan struktur project Anda

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Pengguna - menggunakan query builder untuk keamanan
        $totalUsers = DB::table('users')->count();
        $activeUsers = DB::table('users')
            ->where('last_activity', '>=', Carbon::now()->subDays(30))
            ->count();
        $newUsers = DB::table('users')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();

        // Statistik Topik
        $totalTopics = DB::table('topik')->count();
        $topicsWithMaterials = DB::table('topik')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('materi')
                      ->whereRaw('materi.topik_id = topik.id');
            })->count();

        // Statistik Konten Pembelajaran
        $totalMaterials = DB::table('materi')->count();
        $totalExercises = DB::table('latihan')->count();
        $totalQuizzes = DB::table('kuis')->count();

        // Statistik Kamus
        $totalDictionary = DB::table('kamus')->count();
        $videoCount = DB::table('kamus')->where('media_type', 'video')->count();
        $imageCount = DB::table('kamus')->where('media_type', 'image')->count();

        // Data untuk grafik registrasi pengguna (30 hari terakhir)
        $userRegistrationData = $this->getUserRegistrationData();

        // Data untuk grafik distribusi media kamus
        $mediaDistributionData = $this->getMediaDistributionData();

        // Topik dengan materi terbanyak
        $topicsWithMostMaterials = DB::table('topik')
            ->leftJoin('materi', 'topik.id', '=', 'materi.topik_id')
            ->select('topik.judul', DB::raw('COUNT(materi.id) as materials_count'))
            ->groupBy('topik.id', 'topik.judul')
            ->orderBy('materials_count', 'desc')
            ->take(5)
            ->get();

        // Pengguna terbaru
        $recentUsers = DB::table('users')
            ->select('first_name', 'last_name', 'email', 'created_at')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($user) {
                $user->created_at = Carbon::parse($user->created_at);
                return $user;
            });

        // Materi terbaru
        $recentMaterials = DB::table('materi')
            ->join('topik', 'materi.topik_id', '=', 'topik.id')
            ->select('materi.judul', 'topik.judul as topik_judul', 'materi.created_at')
            ->orderBy('materi.created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($material) {
                $material->created_at = Carbon::parse($material->created_at);
                return $material;
            });

        // Kata kamus terbaru
        $recentDictionary = DB::table('kamus')
            ->select('kata', 'media_type', 'created_at')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($word) {
                $word->created_at = Carbon::parse($word->created_at);
                return $word;
            });

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsers', 
            'newUsers',
            'totalTopics',
            'topicsWithMaterials',
            'totalMaterials',
            'totalExercises',
            'totalQuizzes',
            'totalDictionary',
            'videoCount',
            'imageCount',
            'userRegistrationData',
            'mediaDistributionData',
            'topicsWithMostMaterials',
            'recentUsers',
            'recentMaterials',
            'recentDictionary'
        ));
    }

    private function getUserRegistrationData()
    {
        $days = 30;
        $labels = [];
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('d/m');
            
            $count = DB::table('users')
                ->whereDate('created_at', $date)
                ->count();
            $data[] = $count;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    private function getMediaDistributionData()
    {
        $videoCount = DB::table('kamus')->where('media_type', 'video')->count();
        $imageCount = DB::table('kamus')->where('media_type', 'image')->count();
        $otherCount = DB::table('kamus')->whereNotIn('media_type', ['video', 'image'])->count();

        $labels = [];
        $data = [];

        if ($videoCount > 0) {
            $labels[] = 'Video';
            $data[] = $videoCount;
        }

        if ($imageCount > 0) {
            $labels[] = 'Gambar';
            $data[] = $imageCount;
        }

        if ($otherCount > 0) {
            $labels[] = 'Lainnya';
            $data[] = $otherCount;
        }

        // Jika tidak ada data, berikan data default
        if (empty($labels)) {
            $labels = ['Belum ada data'];
            $data = [1];
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    public function getStats()
    {
        // API endpoint untuk mendapatkan statistik real-time
        return response()->json([
            'total_users' => DB::table('users')->count(),
            'active_users' => DB::table('users')->where('last_activity', '>=', Carbon::now()->subDays(30))->count(),
            'new_users' => DB::table('users')->where('created_at', '>=', Carbon::now()->subDays(7))->count(),
            'total_topics' => DB::table('topik')->count(),
            'total_materials' => DB::table('materi')->count(),
            'total_exercises' => DB::table('latihan')->count(),
            'total_quizzes' => DB::table('kuis')->count(),
            'total_dictionary' => DB::table('kamus')->count(),
        ]);
    }
}