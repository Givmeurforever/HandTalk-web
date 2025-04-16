<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show($slug)
{
    // Contoh data latihan (nanti diganti dengan data dari database)
    $latihan = [
        'judul' => 'Latihan Bahasa Isyarat',
        'deskripsi' => 'Latihan untuk menguji pemahaman dasar bahasa Isyarat',
        'soal' => [
            [
                'pertanyaan' => 'Apa bahasa Isyaratnya "Saya makan nasi"?',
                'pilihan' => [
                    'Aku mangan sego',
                    'Kulo nedho sekul',
                    'Aku maem sego',
                    'Kulo dhahar sekul'
                ],
                'jawaban_benar' => '0',
                'penjelasan' => '"Aku mangan sego" adalah ungkapan bahasa Jawa ngoko yang berarti "Saya makan nasi"'
            ],
            // Tambahkan soal lainnya
        ]
    ];

    return view('latihan.show', compact('latihan'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
