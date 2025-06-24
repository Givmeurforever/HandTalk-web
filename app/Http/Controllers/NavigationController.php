<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    // public function kursus()
    // {
    //     return view('pages.kursus');
    // }

    public function settings()
    {
        return view('pages.settings');
    }

    public function about()
    {
        return view('pages.about-handtalk');
    }
}
