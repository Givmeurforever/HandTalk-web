<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamus;

class KamusUserController extends Controller
{
    public function index(Request $request)
    {
        $kataDicari = $request->query('search');

        $hasil = null;
        if ($kataDicari) {
            $hasil = Kamus::where('kata', strtolower($kataDicari))->first();
            if ($hasil) {
                $hasil = [
                    'kata' => $hasil->kata,
                    'video' => asset('storage/' . $hasil->video)
                ];
            }
        }

        return view('pages.kamus', compact('hasil', 'kataDicari'));
    }
}
