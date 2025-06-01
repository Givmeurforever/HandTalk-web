<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kuis;
use App\Models\Topik;
use App\Models\Kamus;

class KuisController extends Controller
{
    public function index(Request $request)
    {
        $topikList = Topik::orderBy('judul')->get();

        $query = Kuis::with('topik');

        if ($request->filled('topik_id')) {
            $query->where('topik_id', $request->topik_id);
        }

        $kuisList = $query->orderBy('urutan')->get();

        return view('admin.kuis.index', compact('kuisList', 'topikList'));
    }

    public function create()
    {
        $topikList = Topik::orderBy('judul')->get();
        $kamusList = Kamus::orderBy('kata')->get();

        return view('admin.kuis.create', compact('topikList', 'kamusList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'topik_id' => 'required|exists:topik,id',
            'urutan' => 'nullable|integer|min:1',
            'soal' => 'required|string|max:255',
            'opsi_a_kamus_id' => 'nullable|exists:kamus,id',
            'opsi_b_kamus_id' => 'nullable|exists:kamus,id',
            'opsi_c_kamus_id' => 'nullable|exists:kamus,id',
            'opsi_d_kamus_id' => 'nullable|exists:kamus,id',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        $urutan = $request->urutan ?? Kuis::where('topik_id', $request->topik_id)->max('urutan') + 1;

        Kuis::create([
            'topik_id' => $request->topik_id,
            'urutan' => $urutan,
            'soal' => $request->soal,
            'opsi_a_kamus_id' => $request->opsi_a_kamus_id,
            'opsi_b_kamus_id' => $request->opsi_b_kamus_id,
            'opsi_c_kamus_id' => $request->opsi_c_kamus_id,
            'opsi_d_kamus_id' => $request->opsi_d_kamus_id,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return redirect()->route('admin.kuis.index')->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kuis = Kuis::findOrFail($id);
        $topikList = Topik::orderBy('judul')->get();
        $kamusList = Kamus::orderBy('kata')->get();

        return view('admin.kuis.edit', compact('kuis', 'topikList', 'kamusList'));
    }

    public function update(Request $request, $id)
    {
        $kuis = Kuis::findOrFail($id);

        $request->validate([
            'topik_id' => 'required|exists:topik,id',
            'urutan' => 'nullable|integer|min:1',
            'soal' => 'required|string|max:255',
            'opsi_a_kamus_id' => 'nullable|exists:kamus,id',
            'opsi_b_kamus_id' => 'nullable|exists:kamus,id',
            'opsi_c_kamus_id' => 'nullable|exists:kamus,id',
            'opsi_d_kamus_id' => 'nullable|exists:kamus,id',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        $kuis->update([
            'topik_id' => $request->topik_id,
            'urutan' => $request->urutan ?? $kuis->urutan,
            'soal' => $request->soal,
            'opsi_a_kamus_id' => $request->opsi_a_kamus_id,
            'opsi_b_kamus_id' => $request->opsi_b_kamus_id,
            'opsi_c_kamus_id' => $request->opsi_c_kamus_id,
            'opsi_d_kamus_id' => $request->opsi_d_kamus_id,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return redirect()->route('admin.kuis.index')->with('success', 'Kuis berhasil diperbarui.');
    }
    public function show($id)
    {
        $kuis = Kuis::with(['topik', 'opsiA', 'opsiB', 'opsiC', 'opsiD'])->findOrFail($id);

        return view('admin.kuis.show', compact('kuis'));
    }


    public function destroy($id)
    {
        $kuis = Kuis::findOrFail($id);
        $kuis->delete();

        return redirect()->route('admin.kuis.index')->with('success', 'Kuis berhasil dihapus.');
    }
}
