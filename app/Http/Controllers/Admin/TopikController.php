<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topik;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TopikController extends Controller
{
    public function index()
    {
        $topiks = Topik::latest()->paginate(10);
        return view('admin.topik.index', compact('topiks'));
    }

    public function create()
    {
        return view('admin.topik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar1' => 'nullable|image|max:2048',
            'gambar2' => 'nullable|image|max:2048',
            'gambar3' => 'nullable|image|max:2048',
        ]);

        $topik = new Topik();
        $topik->judul = $request->judul;
        $topik->slug = Str::slug($request->judul);
        $topik->deskripsi = $request->deskripsi;

        foreach ([1, 2, 3] as $i) {
            $fileKey = 'gambar' . $i;
            if ($request->hasFile($fileKey)) {
                $topik->$fileKey = $request->file($fileKey)->store('kursus_images', 'public');
            }
        }

        $topik->save();

        return redirect()->route('admin.kursus.index')->with('success', 'Topik berhasil ditambahkan.');
    }

    public function edit(Topik $kursus)
    {
        return view('admin.topik.edit', ['topik' => $kursus]);
    }

    public function update(Request $request, Topik $kursus)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar1' => 'nullable|image|max:2048',
            'gambar2' => 'nullable|image|max:2048',
            'gambar3' => 'nullable|image|max:2048',
        ]);

        $kursus->judul = $request->judul;
        $kursus->slug = Str::slug($request->judul);
        $kursus->deskripsi = $request->deskripsi;

        foreach ([1, 2, 3] as $i) {
            $fileKey = 'gambar' . $i;
            if ($request->hasFile($fileKey)) {
                // Hapus gambar lama jika ada
                if ($kursus->$fileKey && Storage::disk('public')->exists($kursus->$fileKey)) {
                    Storage::disk('public')->delete($kursus->$fileKey);
                }
                $kursus->$fileKey = $request->file($fileKey)->store('kursus_images', 'public');
            }
        }

        $kursus->save();

        return redirect()->route('admin.kursus.index')->with('success', 'Topik berhasil diperbarui.');
    }

    public function destroy(Topik $kursus)
    {
        foreach ([1, 2, 3] as $i) {
            $fileKey = 'gambar' . $i;
            if ($kursus->$fileKey && Storage::disk('public')->exists($kursus->$fileKey)) {
                Storage::disk('public')->delete($kursus->$fileKey);
            }
        }

        $kursus->delete();

        return redirect()->route('admin.kursus.index')->with('success', 'Topik berhasil dihapus.');
    }
}
