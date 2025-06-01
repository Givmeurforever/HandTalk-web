@extends('layouts.dashboardadmin')

@section('title', 'Manajemen Topik')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-kursus.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Manajemen Topik</h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            {{-- Flash Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Daftar Topik</h3>
                    <a href="{{ route('admin.topik.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Topik
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Thumbnail</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topiks as $index => $topik)
                                    <tr>
                                        <td>{{ $topiks->firstItem() + $index }}</td>
                                        <td>{{ ucfirst($topik->judul) }}</td>
                                        <td>{{ Str::limit($topik->deskripsi, 100) }}</td>
                                        <td>
                                            @if($topik->gambar1)
                                                <img src="{{ asset('storage/' . $topik->gambar1) }}" alt="gambar1" width="80">
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.topik.edit', $topik->id) }}" 
                                               class="btn btn-sm btn-warning" title="Edit Topik">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.topik.destroy', $topik->id) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Hapus topik ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" title="Hapus Topik">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-muted">Belum ada data topik.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $topiks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
