@extends('layouts.dashboardadmin')

@section('title', 'Tambah Kuis - Admin HandTalk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/page-latihan.css') }}">
<link rel="stylesheet" href="{{ asset('css/page-latihan-form.css') }}">
@endpush

@section('content')
<div class="latihan-container">
    <div class="page-header">
        <h1>Tambah Kuis Baru</h1>
        <a href="{{ route('admin.kuis.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.kuis.store') }}" method="POST">
            @csrf

            <div class="form-section">
                <h3>Informasi Kuis</h3>

                <div class="form-group">
                    <label for="topik_id">Topik:</label>
                    <select name="topik_id" id="topik_id" class="form-control" required>
                        <option value="">Pilih Topik</option>
                        @foreach($topikList as $topik)
                            <option value="{{ $topik->id }}">{{ $topik->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="urutan">Urutan Soal:</label>
                    <input type="number" name="urutan" id="urutan" class="form-control" min="1" required>
                </div>

                <div class="form-group">
                    <label for="soal">Soal:</label>
                    <textarea name="soal" id="soal" class="form-control" rows="3" required></textarea>
                </div>
            </div>

            <div class="form-section">
                <h3>Opsi Jawaban</h3>

                @foreach(['A', 'B', 'C', 'D'] as $label)
                <div class="form-group">
                    <label for="opsi_{{ strtolower($label) }}_kamus_id">Opsi {{ $label }}:</label>
                    <select name="opsi_{{ strtolower($label) }}_kamus_id" class="form-control">
                        <option value="">Pilih dari Kamus</option>
                        @foreach($kamusList as $kamus)
                            <option value="{{ $kamus->id }}">{{ $kamus->kata }}</option>
                        @endforeach
                    </select>
                </div>
                @endforeach

                <div class="form-group">
                    <label for="jawaban_benar">Jawaban Benar:</label>
                    <select name="jawaban_benar" id="jawaban_benar" class="form-control" required>
                        <option value="">Pilih jawaban</option>
                        <option value="A">Opsi A</option>
                        <option value="B">Opsi B</option>
                        <option value="C">Opsi C</option>
                        <option value="D">Opsi D</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan Kuis</button>
                <a href="{{ route('admin.kuis.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
