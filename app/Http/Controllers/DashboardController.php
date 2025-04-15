<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function managePengguna()
    {
        return view('admin.pengguna.index');
    }

    public function manageKursus()
    {
        return view('admin.kursus.index');
    }

    public function manageMateri()
    {
        return view('admin.materi.index');
    }

    public function manageLatihan()
    {
        return view('admin.latihan.index');
    }

    public function manageKuis()
    {
        return view('admin.kuis.index');
    }

    public function manageKamus()
    {
        return view('admin.kamus.index');
    }

    public function pengaturan()
    {
        return view('admin.pengaturan.index');
    }
}
