<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KuisController extends Controller
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
    // Contoh data kuis (nanti diganti dengan data dari database)
    $kuis = [
        'judul' => 'Kuis Bahasa Jawa Dasar',
        'deskripsi' => 'Kuis untuk menguji pemahaman dasar bahasa Jawa',
        'durasi' => 15, // dalam menit
        'soal' => [
            [
                'pertanyaan' => 'Apa bahasa Jawanya "Terima kasih"?',
                'pilihan' => [
                    'Maturnuwun',
                    'Sugeng rawuh',
                    'Nyuwun pangapunten',
                    'Sugeng enjang'
                ],
                'jawaban_benar' => '0',
                'penjelasan' => '"Maturnuwun" adalah ungkapan terima kasih dalam bahasa Jawa'
            ],
            // Tambahkan soal lainnya
        ]
    ];

    return view('kuis.show', compact('kuis'));
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
