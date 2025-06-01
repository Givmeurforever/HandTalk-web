@extends('layouts.dashboardadmin')
@section('title', 'Dashboard Admin - Kamus')

@section('content')
<div class="kamus-container">
    <div class="header-bar">
        <h2>Manajemen Kamus</h2>
        <a href="{{ route('admin.kamus.create') }}" class="btn primary-btn">
            <i class="fas fa-plus"></i> Tambah Item
        </a>
    </div>

    <form method="GET" action="{{ route('admin.kamus.index') }}" class="search-form">
        <input type="text" name="search" placeholder="Cari kata..." value="{{ request('search') }}">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>

    @if ($dictionary_items->count())
        <div class="grid">
            @foreach ($dictionary_items as $item)
                <div class="card">
                    <h3 class="card-title">{{ ucfirst($item->kata) }}</h3>

                    @if(!empty($item->video))
                        @php
                            $ext = strtolower(pathinfo($item->video, PATHINFO_EXTENSION));
                        @endphp

                        @if(in_array($ext, ['webm', 'mp4']))
                            <video controls muted class="video-preview" preload="metadata">
                                <source src="{{ asset('storage/' . $item->video) }}" type="video/{{ $ext }}">
                                Browser tidak mendukung video format {{ $ext }}.
                            </video>
                        @elseif(in_array($ext, ['png', 'jpg', 'jpeg', 'gif']))
                            <img src="{{ asset('storage/' . $item->video) }}" class="video-preview" alt="{{ $item->kata }}">
                        @else
                            <p class="empty-msg">File tidak dapat ditampilkan (format tidak didukung)</p>
                        @endif
                    @else
                        <p class="empty-msg">Tidak ada media tersedia</p>
                    @endif

                    <div class="card-actions">
                        <a href="{{ route('admin.kamus.edit', $item->id) }}" class="btn warning-btn">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.kamus.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn danger-btn">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $dictionary_items->links() }}
        </div>
    @else
        <p class="empty-msg">Tidak ada item kamus ditemukan.</p>
    @endif
</div>

<style>
.kamus-container {
    padding: 20px;
}

.header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.search-form {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.search-form input {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    flex: 1;
}

.search-form button {
    padding: 8px 12px;
    background-color: #555;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.search-form button:hover {
    background-color: #333;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 20px;
}

.card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-title {
    font-size: 18px;
    margin-bottom: 10px;
    color: #333;
}

.video-preview {
    width: 100%;
    max-height: 180px;
    object-fit: cover;
    border-radius: 6px;
    margin-bottom: 10px;
    background: #f8f9fa;
}

.card-actions {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-top: 10px;
}

.btn {
    padding: 6px 10px;
    font-size: 14px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    cursor: pointer;
}

.primary-btn {
    background-color: #3490dc;
    color: white;
}

.warning-btn {
    background-color: #f1c40f;
    color: white;
}

.danger-btn {
    background-color: #e74c3c;
    color: white;
}

.primary-btn:hover {
    background-color: #2779bd;
}

.warning-btn:hover {
    background-color: #d4ac0d;
}

.danger-btn:hover {
    background-color: #c0392b;
}

.empty-msg {
    text-align: center;
    color: #666;
    margin-top: 40px;
    font-style: italic;
}
</style>
@endsection