@extends('layouts.dashboardadmin')
@section('title', 'Tambah Materi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Materi Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.materi.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Judul Materi</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="form-group">
            <label>Slug (otomatis jika kosong)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label>ID Video YouTube / File Path</label>
            <input type="text" name="video" class="form-control" value="{{ old('video') }}" placeholder="Contoh: dQw4w9WgXcQ atau path/video.mp4">
        </div>

        <div class="form-group">
            <label>Durasi Video</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="number" id="menit" class="form-control" min="0" placeholder="Menit" value="{{ old('menit') }}">
                    <small class="form-text text-muted">Menit</small>
                </div>
                <div class="col-md-6">
                    <input type="number" id="detik" class="form-control" min="0" max="59" placeholder="Detik" value="{{ old('detik') }}">
                    <small class="form-text text-muted">Detik</small>
                </div>
            </div>
            <input type="hidden" name="durasi" id="durasi_total" value="{{ old('durasi') }}">
            <small class="form-text text-muted mt-2">
                <strong>Tips:</strong> Untuk YouTube, Anda bisa melihat durasi video di halaman YouTube. 
                <br>Contoh: Video 5 menit 30 detik = 5 menit dan 30 detik
            </small>
        </div>

        <div class="form-group">
            <label>Topik</label>
            <select name="topik_id" class="form-control" required>
                <option value="">-- Pilih Topik --</option>
                @foreach ($topiks as $topik)
                    <option value="{{ $topik->id }}" {{ old('topik_id') == $topik->id ? 'selected' : '' }}>
                        {{ $topik->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" min="1" value="{{ old('urutan', 1) }}">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menitInput = document.getElementById('menit');
    const detikInput = document.getElementById('detik');
    const durasiTotalInput = document.getElementById('durasi_total');

    // Fungsi untuk menghitung total durasi dalam detik
    function hitungDurasiTotal() {
        const menit = parseInt(menitInput.value) || 0;
        const detik = parseInt(detikInput.value) || 0;
        const totalDetik = (menit * 60) + detik;
        durasiTotalInput.value = totalDetik;
    }

    // Event listener untuk perubahan input
    menitInput.addEventListener('input', hitungDurasiTotal);
    detikInput.addEventListener('input', hitungDurasiTotal);

    // Jika ada old value, konversi kembali ke menit dan detik
    const oldDurasi = durasiTotalInput.value;
    if (oldDurasi) {
        const totalDetik = parseInt(oldDurasi);
        const menit = Math.floor(totalDetik / 60);
        const detik = totalDetik % 60;
        menitInput.value = menit;
        detikInput.value = detik;
    }

    // Hitung durasi total saat halaman dimuat
    hitungDurasiTotal();
});
</script>
@endpush