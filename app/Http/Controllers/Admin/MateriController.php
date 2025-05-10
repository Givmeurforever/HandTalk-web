<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiList = [
            [
                'id' => 1,
                'judul' => 'Pengenalan Bahasa Isyarat Indonesia',
                'topik' => 'Perkenalan Bahasa Isyarat',
                'urutan' => 1,
                'status' => 'aktif',
                'tanggal' => '05-03-2025'
            ],
            [
                'id' => 2,
                'judul' => 'Sejarah Bahasa Isyarat di Indonesia',
                'topik' => 'Perkenalan Bahasa Isyarat',
                'urutan' => 2,
                'status' => 'aktif',
                'tanggal' => '05-03-2025'
            ],
            [
                'id' => 3,
                'judul' => 'Cara Menggunakan Bahasa Isyarat',
                'topik' => 'Perkenalan Bahasa Isyarat',
                'urutan' => 3,
                'status' => 'draft',
                'tanggal' => '06-03-2025'
            ],
            [
                'id' => 4,
                'judul' => 'Pengenalan Huruf A-E',
                'topik' => 'Alfabet',
                'urutan' => 1,
                'status' => 'aktif',
                'tanggal' => '07-03-2025'
            ],
            [
                'id' => 5,
                'judul' => 'Pengenalan Huruf F-J',
                'topik' => 'Alfabet',
                'urutan' => 2,
                'status' => 'aktif',
                'tanggal' => '07-03-2025'
            ]
        ];

        return view('admin.materi.index', compact('materiList'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.materi.create');
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
        return view('admin.materi.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.materi.edit');
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
