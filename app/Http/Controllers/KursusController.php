<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KursusController extends Controller
{
    public function show($slug)
    {
        $courses = [
            'pengantar-bahasa-isyarat' => [
                'title' => 'Pengantar Bahasa Isyarat',
                'description' => 'Bahasa isyarat adalah bentuk komunikasi visual...',
                'images' => ['pengantar1.png', 'pengantar2.png', 'pengantar3.png'],
                'info' => ['2 Topik', '10 menit'],
                'curriculum' => ['Sejarah & Perkembangan', 'Bahasa Isyarat di Dunia', 'Prinsip Dasar Komunikasi', 'Ekspresi Wajah & Gerakan']
            ],
            'huruf-dalam-bahasa-isyarat' => [
                'title' => 'Huruf dalam Bahasa Isyarat',
                'description' => 'Dalam bahasa isyarat, huruf digunakan untuk mengeja kata...',
                'images' => ['huruf1.png', 'huruf2.png', 'huruf3.png'],
                'info' => ['3 Topik', '15 menit'],
                'curriculum' => ['Mengenal Alfabet Isyarat', 'Teknik Mengeja Kata', 'Latihan Mengeja Nama']
            ],
            'angka-dalam-bahasa-isyarat' => [
                'title' => 'Angka dalam Bahasa Isyarat',
                'description' => 'Angka digunakan untuk menyatakan jumlah, waktu, dan harga...',
                'images' => ['Angka1.png', 'Angka2.png', 'Angka3.png'],
                'info' => ['3 Topik', '15 menit'],
                'curriculum' => ['Angka 0-9', 'Puluhan', 'Waktu']
            ],
            'kata-dalam-bahasa-isyarat' => [
                'title' => 'Kata dalam Bahasa Isyarat',
                'description' => 'Beberapa kata memiliki isyarat tetap yang sering digunakan...',
                'images' => ['Kata1.png', 'Kata2.png', 'Kata3.png'],
                'info' => ['3 Topik', '15 menit'],
                'curriculum' => ['Kata Sehari-hari', 'Kata Sifat', 'Kata Kerja']
            ],
        ];

        if (!isset($courses[$slug])) {
            abort(404);
        }

        return view('pages.topik', [
            'course' => $courses[$slug]
        ]);
    }
}
