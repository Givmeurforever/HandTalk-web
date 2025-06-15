@extends('layouts.dashboardadmin')

@section('title', 'Tambah Latihan Baru - Admin HandTalk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/page-latihan-form.css') }}">
@endpush

@section('content')
<div class="latihan-container">
    <div class="page-header">
        <h1>Tambah Latihan Baru</h1>
        <a href="{{ route('admin.latihan.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.latihan.store') }}" method="POST">
            @csrf

            {{-- Informasi Latihan --}}
            <div class="form-section">
                <h3>Informasi Latihan</h3>

                <div class="form-group">
                    <label for="topik">Topik:</label>
                    <select id="topik" name="topik_id" class="form-control" required>
                        <option value="">Pilih Topik</option>
                        @foreach($topikList as $topik)
                            <option value="{{ $topik->id }}">{{ $topik->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="materi_id">Materi:</label>
                    <select id="materi_id" name="materi_id" class="form-control" required>
                        <option value="">Pilih Materi</option>
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

            {{-- Opsi Jawaban --}}
            <div class="form-section">
                <h3>Opsi Jawaban</h3>

                @foreach(['A', 'B', 'C', 'D'] as $label)
                <div class="form-group">
                    <label for="opsi_{{ strtolower($label) }}">Opsi {{ $label }}:</label>
                    <select name="opsi_{{ strtolower($label) }}_kamus_id" class="form-control">
                        <option value="">Pilih dari Kamus</option>
                        @foreach($kamusList as $kamus)
                            <option value="{{ $kamus->id }}">{{ $kamus->kata }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Atau isi teks manual di bawah:</small>
                    <input type="text" name="opsi_{{ strtolower($label) }}_teks" class="form-control" placeholder="Teks alternatif (opsional)">
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

            {{-- Aksi --}}
            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Simpan Latihan
                </button>
                <a href="{{ route('admin.latihan.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const topikSelect = document.getElementById('topik');
        const materiSelect = document.getElementById('materi_id');

        topikSelect.addEventListener('change', function () {
            const selectedTopikId = this.value;
            materiSelect.innerHTML = '<option value="">Pilih Materi</option>';

            if (selectedTopikId) {
                fetch(`{{ url('admin/latihan/materi-by-topik') }}/${selectedTopikId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(materi => {
                            const option = document.createElement('option');
                            option.value = materi.id;
                            option.textContent = materi.judul;
                            materiSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }
        });
    });
</script>
@endpush
