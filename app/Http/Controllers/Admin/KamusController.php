<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KamusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Manajemen Kamus';

        $categories = [
            ['id' => 1, 'name' => 'Alfabet'],
            ['id' => 2, 'name' => 'Angka'],
            ['id' => 3, 'name' => 'Sapaan'],
            ['id' => 4, 'name' => 'Keluarga'],
            ['id' => 5, 'name' => 'Aktivitas Sehari-hari'],
            ['id' => 6, 'name' => 'Tempat'],
            ['id' => 7, 'name' => 'Makanan & Minuman'],
        ];

        $dictionary_items = [
            [
                'id' => 1,
                'word' => 'Halo',
                'category_id' => 3,
                'category_name' => 'Sapaan',
                'image' => 'huruf2.png',
                'gif' => 'Saya.webm',
                'views' => 245
            ],
            [
                'id' => 2,
                'word' => 'Terima Kasih',
                'category_id' => 3,
                'category_name' => 'Sapaan',
                'image' => 'huruf1.png',
                'gif' => 'Saya.webm',
                'views' => 200
            ],
            [
                'id' => 3,
                'word' => 'A',
                'category_id' => 1,
                'category_name' => 'Alfabet',
                'image' => 'angka1.png',
                'gif' => 'Minum.webm',
                'views' => 156
            ],
            [
                'id' => 4,
                'word' => 'Satu',
                'category_id' => 2,
                'category_name' => 'Angka',
                'image' => 'angka2.png',
                'gif' => 'satu.gif',
                'views' => 112
            ],
        ];

        return view('admin.kamus.index', compact('pageTitle', 'categories', 'dictionary_items'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kamus.create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.kamus.edit');
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
        // return view('admin.kamus.destroy');
    }
}
