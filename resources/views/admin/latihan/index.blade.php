@extends('layouts.dashboardadmin')

@section('title', 'Manajemen Latihan - Admin HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-latihan.css') }}">
@endpush

@section('content')
<div class="latihan-container">
    <div class="latihan-header">
        <h1>Manajemen Latihan</h1>
        <a href="{{ route('admin.latihan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Latihan Baru
        </a>
    </div>

    {{-- Filter --}}
    <form method="GET" id="filterForm" class="d-flex mb-4" style="gap: 1rem;">
        <div>
            <label for="topik_id">Topik:</label>
            <select name="topik_id" id="topik_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                <option value="">-- Semua Topik --</option>
                @foreach ($topikList as $topik)
                    <option value="{{ $topik->id }}" {{ request('topik_id') == $topik->id ? 'selected' : '' }}>
                        {{ $topik->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="materi_id">Materi:</label>
            <select name="materi_id" id="materi_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                <option value="">-- Semua Materi --</option>
                @foreach ($materiList as $materi)
                    @if (!request('topik_id') || $materi->topik_id == request('topik_id'))
                        <option value="{{ $materi->id }}" {{ request('materi_id') == $materi->id ? 'selected' : '' }}>
                            {{ $materi->judul }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
    </form>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel --}}
    <div class="latihan-table-container">
        <table class="latihan-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Soal</th>
                    <th>Topik</th>
                    <th>Jawaban Benar</th>
                    <th>Media</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latihanList as $latihan)
                    <tr>
                        <td>{{ $latihan->id }}</td>
                        <td>{{ $latihan->soal }}</td>
                        <td>{{ $latihan->materi->topik->judul ?? '-' }}</td>
                        <td>{{ $latihan->jawaban_benar }}</td>
                        <td><span class="badge-media">{{ ucfirst($latihan->media_type ?? '-') }}</span></td>
                        <td>{{ $latihan->created_at->format('d-m-Y') }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('admin.latihan.show', $latihan->id) }}" class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.latihan.edit', $latihan->id) }}" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn-delete" data-id="{{ $latihan->id }}" data-soal="{{ $latihan->soal }}" title="Hapus"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada latihan tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="pagination-wrapper">
            <ul class="pagination">
                {{-- Previous --}}
                @if ($latihanList->onFirstPage())
                    <li class="disabled"><span>&laquo;</span></li>
                @else
                    <li><a href="{{ $latihanList->previousPageUrl() }}">&laquo;</a></li>
                @endif

                {{-- Page numbers --}}
                @for ($i = 1; $i <= $latihanList->lastPage(); $i++)
                    @if ($i == $latihanList->currentPage())
                        <li class="active"><span>{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $latihanList->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                {{-- Next --}}
                @if ($latihanList->hasMorePages())
                    <li><a href="{{ $latihanList->nextPageUrl() }}">&raquo;</a></li>
                @else
                    <li class="disabled"><span>&raquo;</span></li>
                @endif
            </ul>
        </div>


    </div>
    {{-- Modal Hapus --}}
    <div id="deleteModal" class="modal">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h2>Konfirmasi Hapus</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus latihan:</p>
                <p id="deleteLatihan" class="text-highlight"></p>
                <p class="text-danger">Tindakan ini tidak dapat dibatalkan!</p>
                <div class="form-actions">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">Hapus</button>
                        <button type="button" id="btnBatalHapus" class="btn-secondary">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const deleteLatihan = document.getElementById('deleteLatihan');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const id = this.dataset.id;
            const soal = this.dataset.soal;

            deleteLatihan.textContent = soal;
            const url = '{{ route("admin.latihan.destroy", "__id__") }}'.replace('__id__', id);
            deleteForm.setAttribute('action', url);
            deleteModal.style.display = 'block';
        });
    });

    document.querySelectorAll('.close').forEach(btn => {
        btn.addEventListener('click', () => {
            deleteModal.style.display = 'none';
        });
    });

    document.getElementById('btnBatalHapus').addEventListener('click', () => {
        deleteModal.style.display = 'none';
    });

    window.addEventListener('click', function (e) {
        if (e.target === deleteModal) {
            deleteModal.style.display = 'none';
        }
    });
});
</script>
@endsection
