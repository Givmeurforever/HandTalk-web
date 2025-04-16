<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KamusUserController extends Controller
{
    public function index(Request $request)
    {
        $kataDicari = $request->query('search');

        $kamus = $this->getDummyKamus();

        $hasil = null;
        if ($kataDicari) {
            $hasil = collect($kamus)->firstWhere('kata', strtolower($kataDicari));
        }

        return view('pages.kamus', compact('hasil', 'kataDicari'));
    }

    private function getDummyKamus()
    {
        return [
            [
                'kata' => 'makan',
                'video' => asset('img/Makan.webm')

            ],
            [
                'kata' => 'minum',
                'video' => asset('img/Minum.webm')

            ],
            [
                'kata' => 'saya',
                'video' => asset('img/Saya.webm')

            ],
        ];
    }
}
