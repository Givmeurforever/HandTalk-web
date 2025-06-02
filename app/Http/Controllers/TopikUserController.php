<?php

namespace App\Http\Controllers;

use App\Models\Topik;
use App\Models\Materi;
use App\Models\Latihan;
use App\Models\Kuis;
use Illuminate\Http\Request;

class TopikUserController extends Controller
{
    public function index()
    {
        $topik = Topik::with('materi')->oldest()->get();
        return view('pages.kursus.index', compact('topik'));
    }

    public function show($topikSlug, $materiSlug)
    {
        $topik = Topik::with('materi')->where('slug', $topikSlug)->firstOrFail();
        $materi = $topik->materi->where('slug', $materiSlug)->first();

        if (!$materi) {
            abort(404);
        }

        return view('pages.kursus.materi', [
            'topik' => [
                'judul' => $topik->judul,
                'slug' => $topik->slug,
                'description' => $topik->deskripsi,
                'materi' => $topik->materi->map(function ($m) {
                    return [
                        'judul' => $m->judul,
                        'slug' => $m->slug,
                        'durasi' => '3 Menit',
                    ];
                }),
            ],
            'materi' => [
                'judul' => $materi->judul,
                'slug' => $materi->slug,
                'video' => $materi->video,
                'deskripsi' => $materi->deskripsi,
            ]
        ]);
    }

    public function latihan($topikSlug, $materiSlug, $page = 1)
    {
        $materi = Materi::where('slug', $materiSlug)->firstOrFail();
        
        // Jumlah soal per halaman
        $perPage = 5;
        
        // Hitung offset
        $offset = ($page - 1) * $perPage;
        
        // Ambil soal-soal dengan pagination dan relasi ke tabel kamus
        $latihans = Latihan::with([
                'opsiA',  // relasi ke kamus melalui opsi_a_kamus_id
                'opsiB',  // relasi ke kamus melalui opsi_b_kamus_id
                'opsiC',  // relasi ke kamus melalui opsi_c_kamus_id
                'opsiD'   // relasi ke kamus melalui opsi_d_kamus_id
            ])
            ->forMateri($materi->id)           // menggunakan scope yang ada
            ->orderBy('urutan', 'asc')
            ->offset($offset)
            ->limit($perPage)
            ->get();
        
        // Hitung total soal
        $totalSoal = Latihan::forMateri($materi->id)->count();
        $totalPages = ceil($totalSoal / $perPage);
        
        // Informasi pagination
        $pagination = [
            'current_page' => (int) $page,
            'total_pages' => $totalPages,
            'per_page' => $perPage,
            'total_soal' => $totalSoal,
            'has_prev' => $page > 1,
            'has_next' => $page < $totalPages,
            'prev_page' => $page > 1 ? $page - 1 : null,
            'next_page' => $page < $totalPages ? $page + 1 : null,
            'start_number' => ($page - 1) * $perPage + 1,
            'end_number' => min($page * $perPage, $totalSoal)
        ];
        
        return view('pages.kursus.latihan', compact(
            'latihans', 
            'materiSlug', 
            'topikSlug', 
            'pagination',
            'materi'
        ));
    }

    public function checkLatihan(Request $request)
    {
        $latihan = Latihan::findOrFail($request->input('latihan_id'));
        $benar = $request->input('jawaban') === $latihan->jawaban_benar;

        return response()->json([
            'benar' => $benar,
            'jawaban_benar' => $latihan->jawaban_benar,
        ]);
    }

    // Kuis - Show all questions at once
    public function kuis($topikSlug)
    {
        $topik = Topik::where('slug', $topikSlug)->firstOrFail();

        $kuisQuestions = Kuis::with(['opsiA', 'opsiB', 'opsiC', 'opsiD'])
            ->forTopik($topik->id)
            ->ordered()
            ->get();

        if ($kuisQuestions->isEmpty()) {
            return redirect()->back()->with('error', 'Belum ada kuis untuk topik ini.');
        }

        return view('pages.kursus.kuis', compact('kuisQuestions', 'topik', 'topikSlug'));
    }

    // Submit all kuis answers
    public function submitKuis(Request $request, $topikSlug)
    {
        $topik = Topik::where('slug', $topikSlug)->firstOrFail();
        
        $kuisQuestions = Kuis::forTopik($topik->id)->ordered()->get();
        $jawabanUser = $request->input('jawaban', []);
        
        // Hitung score
        $totalSoal = $kuisQuestions->count();
        $benar = 0;
        
        $hasil = [];
        foreach ($kuisQuestions as $kuis) {
            $jawabanUserUntukSoal = $jawabanUser[$kuis->id] ?? null;
            $isBenar = $jawabanUserUntukSoal === $kuis->jawaban_benar;
            
            if ($isBenar) {
                $benar++;
            }
            
            $hasil[$kuis->id] = [
                'soal' => $kuis->soal,
                'jawaban_user' => $jawabanUserUntukSoal,
                'jawaban_benar' => $kuis->jawaban_benar,
                'is_benar' => $isBenar
            ];
        }
        
        $score = $totalSoal > 0 ? round(($benar / $totalSoal) * 100) : 0;
        
        // Store results in session for hasil page
        session([
            'kuis_hasil' => [
                'topik' => $topik,
                'hasil' => $hasil,
                'total_soal' => $totalSoal,
                'benar' => $benar,
                'score' => $score
            ]
        ]);

        return redirect()->route('kursus.kuis.hasil', $topikSlug);
    }
    
    // Show kuis results
    public function hasilKuis($topikSlug)
    {
        $hasilData = session('kuis_hasil');
        
        if (!$hasilData) {
            return redirect()->route('kursus.kuis', $topikSlug)
                ->with('error', 'Data hasil kuis tidak ditemukan.');
        }
        
        return view('pages.kursus.kuis-hasil', $hasilData);
    }
}
