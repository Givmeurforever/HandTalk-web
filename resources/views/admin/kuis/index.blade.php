@extends('layouts.dashboardadmin')

@section('title', 'Manajemen Kuis - HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-kuis.css') }}">
@endpush

@section('content')
<div class="kuis-container">
    <div class="kuis-header">
        <h1>Manajemen Kuis</h1>
        <div class="kuis-actions">
            <div class="search-container">
                <input type="text" id="searchKuis" placeholder="Cari kuis...">
                <button class="search-btn"><i class="fas fa-search"></i></button>
            </div>
            <div class="filter-container">
                <select id="filterTopik">
                    <option value="">Semua Topik</option>
                    @foreach ($topikList as $topik)
                        <option value="{{ $topik->id }}">{{ $topik->judul }}</option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('admin.kuis.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kuis
            </a>
        </div>
    </div>

    <div class="kuis-table-container">
        <table class="kuis-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Soal</th>
                    <th>Topik</th>
                    <th>Media</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kuisList as $kuis)
                <tr>
                    <td>{{ $kuis->id }}</td>
                    <td>
                        <strong>{{ $kuis->soal }}</strong>
                        @if ($kuis->media_type)
                            <div class="media-indicator">
                                @if ($kuis->media_type === 'image')
                                    <i class="fas fa-image"></i> Gambar
                                @elseif ($kuis->media_type === 'video')
                                    <i class="fas fa-video"></i> Video
                                @endif
                            </div>
                        @endif
                    </td>
                    <td>{{ $kuis->topik->judul ?? '-' }}</td>
                    <td>
                        @if ($kuis->media)
                            @if ($kuis->media_type === 'image')
                                <img src="{{ asset('storage/' . $kuis->media) }}" alt="Gambar" width="100">
                            @elseif ($kuis->media_type === 'video')
                                <video src="{{ asset('storage/' . $kuis->media) }}" width="100" controls muted></video>
                            @endif
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $kuis->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.kuis.show', $kuis->id) }}" class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.kuis.edit', $kuis->id) }}" class="btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.kuis.destroy', $kuis->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus kuis ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
