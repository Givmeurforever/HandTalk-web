<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latihanList = [
            [
                'id' => 1,
                'soal' => 'Apa gerakan isyarat untuk kata "Halo"?',
                'topik' => 'Sapaan Sehari-hari',
                'jawaban' => 'Lambaikan tangan terbuka ke arah lawan bicara',
                'media' => 'Gambar',
                'tanggal' => '10-03-2025'
            ],
            [
                'id' => 2,
                'soal' => 'Tunjukkan gerakan isyarat untuk huruf "A"',
                'topik' => 'Alfabet',
                'jawaban' => 'Telapak tangan menghadap ke depan, semua jari mengepal kecuali jempol yang tegak',
                'media' => 'Video',
                'tanggal' => '11-03-2025'
            ],
            [
                'id' => 3,
                'soal' => 'Bagaimana cara menunjukkan angka "5" dalam bahasa isyarat?',
                'topik' => 'Angka',
                'jawaban' => 'Telapak tangan terbuka dengan lima jari terentang',
                'media' => 'GIF',
                'tanggal' => '12-03-2025'
            ],
            [
                'id' => 4,
                'soal' => 'Praktikkan gerakan isyarat untuk "Terima kasih"',
                'topik' => 'Sapaan Sehari-hari',
                'jawaban' => 'Tangan terbuka, disentuhkan ke dagu lalu digerakkan ke depan',
                'media' => 'Video',
                'tanggal' => '13-03-2025'
            ],
            [
                'id' => 5,
                'soal' => 'Tunjukkan bagaimana menyatakan "Saya mau belajar" dalam bahasa isyarat',
                'topik' => 'Perkenalan Bahasa Isyarat',
                'jawaban' => 'Kombinasi gerakan "saya", "mau", dan "belajar"',
                'media' => 'Gambar',
                'tanggal' => '14-03-2025'
            ]
        ];

        return view('admin.latihan.index', compact('latihanList'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.latihan.create');
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
        return view('admin.latihan.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.latihan.edit');
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
