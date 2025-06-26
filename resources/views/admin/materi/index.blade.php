@extends('layouts.dashboardadmin')

@section('title', 'Manajemen Materi - Admin HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-materi.css') }}">
@endpush

@section('content')
<div class="materi-container">
    <div class="materi-header">
        <h1>Manajemen Materi</h1>
        <a href="{{ route('admin.materi.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Materi
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Filter Topik --}}
    <form method="GET" class="mb-4" id="filterForm">
        <div class="row align-items-end">
            <div class="col-md-4">
                <label for="topik">Filter berdasarkan Topik:</label>
                <select name="topik" id="topik" class="form-control" onchange="document.getElementById('filterForm').submit()">
                    <option value="">-- Semua Topik --</option>
                    @foreach ($topiks as $topik)
                        <option value="{{ $topik->id }}" {{ request('topik') == $topik->id ? 'selected' : '' }}>
                            {{ $topik->judul }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    {{-- Tabel Materi --}}
    <div class="materi-table-container">
        <table class="materi-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Materi</th>
                    <th>Topik</th>
                    <th>Durasi</th>
                    <th>Urutan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($materiList as $materi)
                <tr>
                    <td>{{ $materi->id }}</td>
                    <td>{{ $materi->judul }}</td>
                    <td>{{ $materi->topik->judul ?? '-' }}</td>
                    <td>
                        @if($materi->durasi)
                            {{ floor($materi->durasi / 60) }}:{{ str_pad($materi->durasi % 60, 2, '0', STR_PAD_LEFT) }} menit
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $materi->urutan }}</td>
                    <td>{{ $materi->created_at->format('d-m-Y') }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.materi.show', $materi->id) }}" class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.materi.edit', $materi->id) }}" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" title="Hapus" onclick="return confirm('Hapus materi ini?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada materi tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $materiList->withQueryString()->links() }}
    </div>
</div>
@endsection
