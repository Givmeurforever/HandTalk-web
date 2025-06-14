<?php

namespace App\Http\Controllers;

use App\Models\Topik;
use App\Models\Materi;
use App\Models\Latihan;
use App\Models\Kuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // Ambil topik berdasarkan slug, 404 kalau tidak ada
        $topik = Topik::where('slug', $topikSlug)->firstOrFail();

        // Ambil soal kuis berdasarkan topik
        $kuisQuestions = Kuis::with(['opsiA', 'opsiB', 'opsiC', 'opsiD'])
            ->where('topik_id', $topik->id)
            ->orderBy('urutan')
            ->get();

        if ($kuisQuestions->isEmpty()) {
            // Kalau soal kuis belum ada, redirect balik dengan pesan error
            return redirect()->back()->with('error', 'Belum ada kuis untuk topik ini.');
        }

        // Debug: pastikan data terkirim dengan benar
        Log::info('Kuis Data:', [
            'topik' => $topik->toArray(),
            'kuisQuestions' => $kuisQuestions->count(),
            'topikSlug' => $topikSlug
        ]);

        // PERBAIKAN: Gunakan path view yang sesuai dengan lokasi file
        return view('pages.kursus.kuis', [
            'kuisQuestions' => $kuisQuestions,
            'topik' => $topik,
            'topikSlug' => $topikSlug,
        ]);
    }

    public function submitKuis(Request $request, $topikSlug)
    {
        // Validasi input
        $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|in:A,B,C,D'
        ], [
            'jawaban.required' => 'Mohon jawab minimal satu soal.',
            'jawaban.*.required' => 'Semua soal harus dijawab.',
            'jawaban.*.in' => 'Pilihan jawaban tidak valid.'
        ]);

        $topik = Topik::where('slug', $topikSlug)->firstOrFail();

        // Perbaikan: gunakan query yang sama seperti di method kuis()
        $kuisQuestions = Kuis::with(['opsiA', 'opsiB', 'opsiC', 'opsiD'])
            ->where('topik_id', $topik->id)
            ->orderBy('urutan')
            ->get();

        $jawabanUser = $request->input('jawaban', []);

        // Validasi tambahan: pastikan semua soal dijawab
        if (count($jawabanUser) !== $kuisQuestions->count()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Mohon jawab semua soal sebelum submit.');
        }

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
                'is_benar' => $isBenar,
                'opsi_a' => $kuis->opsiA,
                'opsi_b' => $kuis->opsiB,
                'opsi_c' => $kuis->opsiC,
                'opsi_d' => $kuis->opsiD,
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
                'score' => $score,
                'topikSlug' => $topikSlug
            ]
        ]);

        return redirect()->route('kursus.kuis.hasil', $topikSlug);
    }

    public function hasilKuis($topikSlug)
    {
        $hasilData = session('kuis_hasil');

        if (!$hasilData) {
            return redirect()->route('kursus.kuis', $topikSlug)
                ->with('error', 'Data hasil kuis tidak ditemukan. Silakan kerjakan kuis terlebih dahulu.');
        }

        // Validasi topik slug sesuai dengan session
        if (isset($hasilData['topikSlug']) && $hasilData['topikSlug'] !== $topikSlug) {
            return redirect()->route('kursus.kuis', $topikSlug)
                ->with('error', 'Data hasil tidak sesuai dengan topik yang diminta.');
        }

        // PERBAIKAN: Gunakan path view yang sesuai
        return view('pages.kursus.kuis-hasil', $hasilData);
    }
}
