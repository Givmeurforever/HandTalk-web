@extends('layouts.dashboardadmin')

@section('title', 'Detail Latihan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-latihan.css') }}">
@endpush

@section('content')
<div class="latihan-container">
    <div class="latihan-header">
        <h1>Detail Latihan</h1>
        <a href="{{ route('admin.latihan.index') }}" class="btn btn-secondary">
            ← Kembali ke Manajemen Latihan
        </a>
    </div>

    <div class="latihan-detail">
        <div class="detail-item">
            <strong>Materi:</strong>
            <p>{{ isset($latihan['materi']['judul']) ? $latihan['materi']['judul'] : 'Tidak ada materi' }}</p>
        </div>

        <div class="detail-item">
            <strong>Topik:</strong>
            <p>{{ isset($latihan['materi']['topik']['judul']) ? $latihan['materi']['topik']['judul'] : 'Tidak ada topik' }}</p>
        </div>

        <div class="detail-item">
            <strong>Soal ke-{{ $latihan['urutan'] }}:</strong>
            <p>{{ $latihan['soal'] }}</p>
        </div>

        <div class="detail-item">
            <strong>Pilihan Jawaban:</strong>
            <ul class="jawaban-list">
                @foreach (['A', 'B', 'C', 'D'] as $opt)
                    @php
                        $opsiRelation = 'opsi' . $opt; // opsiA, opsiB, opsiC, opsiD
                        $opsi = $latihan->$opsiRelation; // Relasi ke tabel kamus
                        $opsi_teks_field = 'opsi_' . strtolower($opt) . '_teks';
                        $opsi_teks = $latihan->$opsi_teks_field;
                    @endphp
                    <li class="jawaban-option {{ $latihan['jawaban_benar'] == $opt ? 'correct-answer' : '' }}">
                        <div class="option-header">
                            <strong>{{ $opt }}.</strong>
                            @if ($opsi)
                                {{ $opsi->kata }}
                                @if ($opsi_teks)
                                    - <em>{{ $opsi_teks }}</em>
                                @endif
                            @elseif ($opsi_teks)
                                {{ $opsi_teks }}
                            @else
                                <em>Tidak ada data</em>
                            @endif
                            
                            @if ($latihan['jawaban_benar'] == $opt)
                                <span class="badge-correct">Jawaban Benar</span>
                            @endif
                        </div>

                        @if ($opsi && $opsi->media)
                            <div class="media-container">
                                @if (Str::endsWith(strtolower($opsi->media), ['.png', '.jpg', '.jpeg', '.gif']))
                                    <img src="{{ asset('storage/kamus_videos/' . $opsi->media) }}" 
                                         alt="Gambar Opsi {{ $opt }}" 
                                         class="media-image"
                                         loading="lazy">
                                @elseif (Str::endsWith(strtolower($opsi->media), ['.webm', '.mp4', '.mov', '.avi']))
                                    <video class="media-video" controls preload="metadata">
                                        <source src="{{ asset('storage/kamus_videos/' . $opsi->media) }}" 
                                                type="video/{{ pathinfo($opsi->media, PATHINFO_EXTENSION) }}">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                @else
                                    <div class="media-unsupported">
                                        <p>Format media tidak didukung: {{ $opsi->media }}</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="detail-item">
            <strong>Jawaban Benar:</strong>
            <p><span class="badge-media">{{ isset($latihan['jawaban_benar']) ? strtoupper($latihan['jawaban_benar']) : '' }}</span></p>
        </div>

        <div class="detail-item">
            <strong>Dibuat pada:</strong>
            <p>{{ isset($latihan['created_at']) ? \Carbon\Carbon::parse($latihan['created_at'])->format('d F Y H:i') : '-' }}</p>
        </div>

        @if (is_object($latihan) && isset($latihan->updated_at) && isset($latihan->created_at) && $latihan->updated_at != $latihan->created_at)
        <div class="detail-item">
            <strong>Terakhir diupdate:</strong>
            <p>{{ $latihan->updated_at->format('d F Y H:i') }}</p>
        </div>
        @endif
    </div>

    <div class="action-buttons">
        <a href="{{ route('admin.latihan.edit', $latihan->id) }}" class="btn btn-primary">
            Edit Latihan
        </a>
        <form action="{{ route('admin.latihan.destroy', $latihan->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus latihan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus Latihan</button>
        </form>
    </div>
</div>
@endsection