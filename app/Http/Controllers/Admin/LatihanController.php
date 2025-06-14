<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Latihan;
use App\Models\Materi;
use App\Models\Topik;
use App\Models\Kamus;

class LatihanController extends Controller
{
    public function index(Request $request)
    {
        $topikList = Topik::orderBy('created_at', 'asc')->get();
        $materiList = Materi::with('topik')->orderBy('created_at', 'asc')->get();

        $query = Latihan::with(['materi.topik']);

        if ($request->filled('topik_id')) {
            $materiIds = Materi::where('topik_id', $request->topik_id)->pluck('id');
            $query->whereIn('materi_id', $materiIds);
        }

        if ($request->filled('materi_id')) {
            $query->where('materi_id', $request->materi_id);
        }

        $latihanList = $query->latest()->get();

        return view('admin.latihan.index', compact('latihanList', 'topikList', 'materiList'));
    }

    public function create()
    {
        $topikList = Topik::orderBy('judul')->get();
        $materiList = Materi::with('topik')->orderBy('judul')->get();
        $kamusList = Kamus::orderBy('kata')->get();

        return view('admin.latihan.create', compact('topikList', 'materiList', 'kamusList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materi_id' => 'required|exists:materi,id',
            'soal' => 'required|string|max:255',
            'urutan' => 'required|integer|min:1',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        Latihan::create([
            'materi_id' => $request->materi_id,
            'soal' => $request->soal,
            'urutan' => $request->urutan,
            'jawaban_benar' => $request->jawaban_benar,
            'opsi_a_kamus_id' => $request->opsi_a_kamus_id,
            'opsi_b_kamus_id' => $request->opsi_b_kamus_id,
            'opsi_c_kamus_id' => $request->opsi_c_kamus_id,
            'opsi_d_kamus_id' => $request->opsi_d_kamus_id,
            'opsi_a_teks' => $request->opsi_a_teks,
            'opsi_b_teks' => $request->opsi_b_teks,
            'opsi_c_teks' => $request->opsi_c_teks,
            'opsi_d_teks' => $request->opsi_d_teks,
        ]);

        return redirect()->route('admin.latihan.index')->with('success', 'Latihan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $latihan = Latihan::with(['materi.topik', 'opsiA', 'opsiB', 'opsiC', 'opsiD'])->findOrFail($id);
        return view('admin.latihan.show', compact('latihan'));
    }

    public function edit($id)
    {
        $latihan = Latihan::findOrFail($id);
        $topikList = Topik::orderBy('judul')->get();
        $materiList = Materi::with('topik')->orderBy('judul')->get();
        $kamusList = Kamus::orderBy('kata')->get();

        return view('admin.latihan.edit', compact('latihan', 'topikList', 'materiList', 'kamusList'));
    }

    public function update(Request $request, $id)
    {
        $latihan = Latihan::findOrFail($id);

        $request->validate([
            'materi_id' => 'required|exists:materi,id',
            'soal' => 'required|string|max:255',
            'urutan' => 'required|integer|min:1',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        $latihan->update([
            'materi_id' => $request->materi_id,
            'soal' => $request->soal,
            'urutan' => $request->urutan,
            'jawaban_benar' => $request->jawaban_benar,
            'opsi_a_kamus_id' => $request->opsi_a_kamus_id,
            'opsi_b_kamus_id' => $request->opsi_b_kamus_id,
            'opsi_c_kamus_id' => $request->opsi_c_kamus_id,
            'opsi_d_kamus_id' => $request->opsi_d_kamus_id,
            'opsi_a_teks' => $request->opsi_a_teks,
            'opsi_b_teks' => $request->opsi_b_teks,
            'opsi_c_teks' => $request->opsi_c_teks,
            'opsi_d_teks' => $request->opsi_d_teks,
        ]);

        return redirect()->route('admin.latihan.index')->with('success', 'Latihan berhasil diperbarui.');
}
    public function destroy($id)
    {
        $latihan = Latihan::findOrFail($id);
        $latihan->delete();

        return redirect()->route('admin.latihan.index')->with('success', 'Latihan berhasil dihapus.');
    }
}
