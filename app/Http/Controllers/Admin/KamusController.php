<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamus;
use Illuminate\Support\Facades\Storage;

class KamusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = 'Manajemen Kamus';

        $dictionary_items = Kamus::when($request->search, function ($query) use ($request) {
            $query->where('kata', 'like', '%' . $request->search . '%');
        })->orderBy('created_at', 'asc')->paginate(12);

        return view('admin.kamus.index', compact('pageTitle', 'dictionary_items'));
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
        $request->validate([
            'kata' => 'required|string|max:255|unique:kamus,kata',
            'video' => 'nullable|mimes:webm,png,gif|max:2048',
        ]);

        $videoPath = $request->file('video')->store('kamus_videos', 'public');

        Kamus::create([
            'kata' => $request->kata,
            'video' => $videoPath,
        ]);

        return redirect()->route('admin.kamus.index')->with('success', 'Kata berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamus $kamus)
    {
        return view('admin.kamus.edit', compact('kamus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamus $kamus)
    {
        $request->validate([
            'kata' => 'required|string|max:255|unique:kamus,kata,' . $kamus->id,
            'video' => 'nullable|mimes:webm,png,gif|max:2048',
        ]);

        if ($request->hasFile('video')) {
            if ($kamus->video && Storage::disk('public')->exists($kamus->video)) {
                Storage::disk('public')->delete($kamus->video);
            }

            $kamus->video = $request->file('video')->store('kamus_videos', 'public');
        }

        $kamus->kata = $request->kata;
        $kamus->save();

        return redirect()->route('admin.kamus.index')->with('success', 'Kata berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    
    
     public function destroy(Kamus $kamus)
    {

        if ($kamus->video && Storage::disk('public')->exists($kamus->video)) {
            Storage::disk('public')->delete($kamus->video);
        }

        $kamus->delete();

        return redirect()->route('admin.kamus.index')->with('success', 'Kata berhasil dihapus.');
    }
}
