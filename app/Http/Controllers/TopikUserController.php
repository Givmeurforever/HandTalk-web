<?php

namespace App\Http\Controllers;

use App\Models\Topik;
use Illuminate\Http\Request;

class TopikUserController extends Controller
{
    /**
     * Tampilkan semua topik pembelajaran (halaman kursus).
     */
    public function index()
    {
        // Ambil semua topik beserta jumlah materi-nya
        $topik = Topik::withCount('materi')->get();

        return view('pages.kursus', compact('topik'));
    }

    /**
     * Tampilkan materi tertentu dari sebuah topik.
     *
     * @param string $topikSlug
     * @param string $materiSlug
     */
    public function show($topikSlug, $materiSlug)
    {
        // Ambil topik berdasarkan slug
        $topik = Topik::where('slug', $topikSlug)->with('materi')->firstOrFail();

        // Cari materi berdasarkan slug dalam topik tersebut
        $materi = $topik->materi()->where('slug', $materiSlug)->firstOrFail();

        return view('pages.topik.show', compact('topik', 'materi'));
    }
}
