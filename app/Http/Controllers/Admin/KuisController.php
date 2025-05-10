<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kuisList = [
            [
                'id' => 1,
                'soal' => 'Apa arti dari gerakan isyarat ini?',
                'topik' => 'Pengenalan Bahasa Isyarat',
                'media_type' => 'image',
                'media_path' => 'img/huruf1.jpg',
                'tanggal' => '22 Apr 2025'
            ],
            [
                'id' => 2,
                'soal' => 'Bagaimana cara mengisyaratkan kata "Terima Kasih"?',
                'topik' => 'Percakapan Dasar',
                'media_type' => 'video',
                'media_path' => 'images/placeholder-video.jpg',
                'tanggal' => '20 Apr 2025'
            ],
            [
                'id' => 3,
                'soal' => 'Identifikasi isyarat untuk huruf berikut',
                'topik' => 'Alfabet dan Angka',
                'media_type' => 'image',
                'media_path' => 'images/placeholder-isyarat.jpg',
                'tanggal' => '18 Apr 2025'
            ],
        ];

        return view('admin.kuis.index', compact('kuisList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kuis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.kuis.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.kuis.edit');
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 
    }
}
