<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopikController extends Controller
{
    public function show($topikSlug, $materiSlug)
    {
        $data = $this->getDummyData();

        $topik = $data[$topikSlug] ?? null;

        if (!$topik) {
            abort(404);
        }

        $materi = collect($topik['materi'])->firstWhere('slug', $materiSlug);

        if (!$materi) {
            abort(404);
        }

        return view('pages.topik.show', compact('topik', 'materi'));
    }

    private function getDummyData()
    {
        return [
            'pengantar-bahasa-isyarat' => [
                'title' => 'Pengantar Bahasa Isyarat',
                'slug' => 'pengantar-bahasa-isyarat',
                'description' => 'Finger spelling digunakan untuk mengeja nama atau istilah...',
                'materi' => [
                    [
                        'judul' => 'Sejarah dan Perkembangan',
                        'slug' => 'sejarah-dan-perkembangan',
                        'video' => 'xnxydJPDD1M',
                        'deskripsi' => 'Penjelasan sejarah bahasa isyarat.',
                        'durasi' => '5 menit'
                    ],
                    [
                        'judul' => 'Bahasa Isyarat di Dunia',
                        'slug' => 'bahasa-isyarat-di-dunia',
                        'video' => 'lio9OmhZa5I',
                        'deskripsi' => 'Jenis bahasa isyarat dari berbagai negara.',
                        'durasi' => '5 menit'
                    ],
                    [
                        'judul' => 'Prinsip Dasar Komunikasi',
                        'slug' => 'prinsip-dasar-komunikasi',
                        'video' => '3JZ_D3ELwOQ',
                        'deskripsi' => 'Prinsip dasar komunikasi dalam isyarat.',
                        'durasi' => '5 menit'
                    ],
                    [
                        'judul' => 'Kuis Pengantar Bahasa Isyarat',
                        'slug' => 'kuis-pengantar-bahasa-isyarat',
                        'video' => 'hY7m5jjJ9mM',
                        'deskripsi' => 'Latihan pemahaman melalui kuis.',
                        'durasi' => '5 menit'
                    ]
                ]
            ],
            'huruf-dalam-bahasa-isyarat' => [
                'title' => 'Huruf dalam Bahasa Isyarat',
                'slug' => 'huruf-dalam-bahasa-isyarat',
                'description' => 'Mempelajari huruf A-Z dalam bahasa isyarat dan mengeja nama.',
                'materi' => [
                    [
                        'judul' => 'Mengenal Alfabet Isyarat',
                        'slug' => 'mengenal-alfabet-isyarat',
                        'video' => 'RzGEvJxygis',
                        'deskripsi' => 'Belajar huruf A-Z dengan gerakan tangan.',
                        'durasi' => '6 menit'
                    ],
                    [
                        'judul' => 'Teknik Mengeja Kata',
                        'slug' => 'teknik-mengeja-kata',
                        'video' => 'fPzU-RYzL04',
                        'deskripsi' => 'Mengeja kata sederhana dengan bahasa isyarat.',
                        'durasi' => '7 menit'
                    ],
                    [
                        'judul' => 'Latihan Mengeja Nama',
                        'slug' => 'latihan-mengeja-nama',
                        'video' => 'HzmVW3zP8ek',
                        'deskripsi' => 'Latihan praktis mengeja nama kamu sendiri.',
                        'durasi' => '5 menit'
                    ]
                ]
            ],
            'angka-dalam-bahasa-isyarat' => [
                'title' => 'Angka dalam Bahasa Isyarat',
                'slug' => 'angka-dalam-bahasa-isyarat',
                'description' => 'Belajar menyatakan angka, waktu, dan harga dalam bahasa isyarat.',
                'materi' => [
                    [
                        'judul' => 'Angka 0-9',
                        'slug' => 'angka-0-9',
                        'video' => 'xnxydJPDD1M',
                        'deskripsi' => 'Pelajari gerakan angka dasar dari 0 sampai 9.',
                        'durasi' => '5 menit'
                    ],
                    [
                        'judul' => 'Puluhan',
                        'slug' => 'puluhan',
                        'video' => 'xnxydJPDD1M',
                        'deskripsi' => 'Bagaimana cara menunjukkan puluhan secara jelas.',
                        'durasi' => '6 menit'
                    ],
                    [
                        'judul' => 'Waktu',
                        'slug' => 'waktu',
                        'video' => 'xnxydJPDD1M',
                        'deskripsi' => 'Gunakan bahasa isyarat untuk menunjukkan jam dan waktu.',
                        'durasi' => '7 menit'
                    ]
                ]
            ],
            'kata-dalam-bahasa-isyarat' => [
                'title' => 'Kata dalam Bahasa Isyarat',
                'slug' => 'kata-dalam-bahasa-isyarat',
                'description' => 'Berbagai kata penting untuk percakapan sehari-hari.',
                'materi' => [
                    [
                        'judul' => 'Kata Sehari-hari',
                        'slug' => 'kata-sehari-hari',
                        'video' => 'lio9OmhZa5I',
                        'deskripsi' => 'Kata-kata umum seperti “makan”, “minum”, dll.',
                        'durasi' => '5 menit'
                    ],
                    [
                        'judul' => 'Kata Sifat',
                        'slug' => 'kata-sifat',
                        'video' => 'lio9OmhZa5I',
                        'deskripsi' => 'Isyarat untuk kata sifat seperti “besar”, “cepat”.',
                        'durasi' => '6 menit'
                    ],
                    [
                        'judul' => 'Kata Kerja',
                        'slug' => 'kata-kerja',
                        'video' => 'lio9OmhZa5I',
                        'deskripsi' => 'Gerakan untuk kata kerja seperti “pergi”, “datang”.',
                        'durasi' => '6 menit'
                    ]
                ]
            ]
        ];
    }    

}
