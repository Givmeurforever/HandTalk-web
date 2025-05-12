<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Dummy progress
        $progress = [
            [
                'topik' => 'Perkenalan Dasar',
                'materi' => 'completed',
                'latihan' => 'completed',
                'kuis' => 'completed',
                'skor' => 85
            ],
            [
                'topik' => 'Alfabet Bahasa Isyarat',
                'materi' => 'incomplete',
                'latihan' => 'incomplete',
                'kuis' => 'incomplete',
                'skor' => 0
            ],
        ];

        // Dummy favorites
        $favorites = [
            ['word' => 'Halo'],
            ['word' => 'sorry'],
            ['word' => 'Terima Kasih'],
        ];

        $totalCompleted = 3;
        $totalTopik = 10;

        return view('pages.dashboard', compact('user', 'progress', 'favorites', 'totalCompleted', 'totalTopik'));
    }
}
