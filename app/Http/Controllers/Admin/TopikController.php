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
                $topik->$fileKey = $request->file($fileKey)->store('topik_images', 'public');
            }
        }

        $topik->save();

        return redirect()->route('admin.topik.index')->with('success', 'Topik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $topik = Topik::findOrFail($id);
        return view('admin.topik.edit', compact('topik'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar1' => 'nullable|image|max:2048',
            'gambar2' => 'nullable|image|max:2048',
            'gambar3' => 'nullable|image|max:2048',
        ]);

        $topik = Topik::findOrFail($id);
        $topik->judul = $request->judul;
        $topik->slug = Str::slug($request->judul);
        $topik->deskripsi = $request->deskripsi;

        foreach ([1, 2, 3] as $i) {
            $fileKey = 'gambar' . $i;
            if ($request->hasFile($fileKey)) {
                // Hapus gambar lama dari disk 'public' jika ada
                if ($topik->$fileKey) {
                    Storage::disk('public')->delete($topik->$fileKey);
                }
                $topik->$fileKey = $request->file($fileKey)->store('topik_images', 'public');
            }
        }

        $topik->save();

        return redirect()->route('admin.topik.index')->with('success', 'Topik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $topik = Topik::findOrFail($id);

        foreach ([1, 2, 3] as $i) {
            $fileKey = 'gambar' . $i;
            if ($topik->$fileKey) {
                Storage::disk('public')->delete($topik->$fileKey);
            }
        }

        $topik->delete();

        return redirect()->route('admin.topik.index')->with('success', 'Topik berhasil dihapus.');
    }
}
