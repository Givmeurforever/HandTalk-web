@extends('layouts.dashboardadmin')
@section('title', 'Dashboard Admin - Kamus')
@section('content')

<div class="kamus-container">
    <div class="actions-bar">
        <div class="action-buttons">
            <a href="{{ route('admin.kamus.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Item Kamus
            </a>
        </div>

        <form method="GET" action="{{ route('admin.kamus.index') }}" class="search-box mt-3">
            <input type="text" name="search" placeholder="Cari kata..." value="{{ request('search') }}">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div class="card-grid dictionary-grid mt-4">
        @foreach ($dictionary_items as $item)
            <div class="item-card dictionary-item">
                <div class="item-card-body">
                    <h3 class="item-card-title">{{ ucfirst($item->kata) }}</h3>
                    <video controls muted style="width: 100%; height: auto;">
                        <source src="{{ asset('storage/' . $item->video) }}" type="video/webm">
                        Browser tidak mendukung video.
                    </video>
                    <div class="item-card-footer mt-2">
                        <div class="actions">
                            <a href="{{ route('admin.kamus.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.kamus.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus item ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination mt-4">
        {{ $dictionary_items->links() }}
    </div>
</div>

<style>
    .dictionary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }

    .item-card {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 6px;
        background: #fff;
    }

    .item-card-title {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .btn {
        margin-right: 5px;
    }

    .btn-outline {
        background: none;
        border: 1px solid #ddd;
        font-size: 11px;
        padding: 6px 10px;
    }

    .btn-outline:hover {
        background-color: #f5f7fa;
    }
</style>

@endsection
