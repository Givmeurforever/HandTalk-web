<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProgress;
use App\Models\Topik;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $topiks = Topik::with('materi')->get();
        $totalTopik = $topiks->count();

        $progress = [];
        $totalCompleted = 0;

        foreach ($topiks as $topik) {
            $materiIds = $topik->materi->pluck('id');

            // Cek apakah SEMUA materi diselesaikan
            $materiDone = UserProgress::where('user_id', $userId)
                ->where('content_type', 'materi')
                ->whereIn('content_id', $materiIds)
                ->where('completed', true)
                ->count();

            $isMateriComplete = $materiIds->count() === 0 || $materiDone === $materiIds->count();

            // Cek kuis (1 per topik)
            $kuisProgress = UserProgress::where('user_id', $userId)
                ->where('content_type', 'kuis')
                ->where('content_id', $topik->id)
                ->latest('completed_at')
                ->first();

            $isKuisComplete = !is_null($kuisProgress);
            $skor = $kuisProgress->score ?? 0;

            // Hitung progress selesai (materi dan kuis sama-sama completed)
            if ($isMateriComplete && $isKuisComplete) {
                $totalCompleted++;
            }

            $progress[] = [
                'topik' => $topik->judul,
                'materi' => $isMateriComplete ? 'completed' : 'incomplete',
                'kuis' => $isKuisComplete ? 'completed' : 'incomplete',
                'skor' => $skor
            ];
        }

        return view('pages.dashboard', compact('user', 'progress', 'totalCompleted', 'totalTopik'));
    }

}
