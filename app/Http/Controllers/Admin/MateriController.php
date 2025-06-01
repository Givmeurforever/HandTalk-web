<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Topik;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $query = Materi::with('topik')->orderBy('topik_id')->orderBy('urutan');

        if ($request->filled('topik')) {
            $query->where('topik_id', $request->topik);
        }

        $materiList = $query->paginate(10);
        $topiks = Topik::orderBy('judul')->get();

        return view('admin.materi.index', compact('materiList', 'topiks'));
    }


    public function create()
    {
        $topiks = Topik::orderBy('judul')->get();
        return view('admin.materi.create', compact('topiks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:materi,slug',
            'deskripsi' => 'nullable|string',
            'video' => 'nullable|string',
            'urutan' => 'nullable|integer|min:1',
            'topik_id' => 'required|exists:topik,id',
        ]);

        $slug = $request->slug ?: Str::slug($request->judul);

        Materi::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'video' => $request->video,
            'urutan' => $request->urutan ?? 1,
            'topik_id' => $request->topik_id,
        ]);

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $materi = Materi::with('topik')->findOrFail($id);
        return view('admin.materi.show', compact('materi'));
    }

    public function edit(string $id)
    {
        $materi = Materi::findOrFail($id);
        $topiks = Topik::orderBy('judul')->get();
        return view('admin.materi.edit', compact('materi', 'topiks'));
    }

    public function update(Request $request, string $id)
    {
        $materi = Materi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:materi,slug,' . $materi->id,
            'deskripsi' => 'nullable|string',
            'video' => 'nullable|string',
            'urutan' => 'nullable|integer|min:1',
            'topik_id' => 'required|exists:topik,id',
        ]);

        $slug = $request->slug ?: Str::slug($request->judul);

        $materi->update([
            'judul' => $request->judul,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'video' => $request->video,
            'urutan' => $request->urutan ?? 1,
            'topik_id' => $request->topik_id,
        ]);

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();
        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
