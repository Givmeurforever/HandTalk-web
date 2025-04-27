@extends('layouts.dashboardadmin')
@section('title', 'Dashboard Admin - Kamus')
@section('content')

<div class="kamus-container">
    <div class="actions-bar">
        <div class="action-buttons">
            <a href="create.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Item Kamus
            </a>
            <a href="kategori.php" class="btn btn-info">
                <i class="fas fa-tags"></i> Kelola Kategori
            </a>
        </div>
        
        <div class="filters">
            <div class="form-group">
                <select class="form-select" id="category-filter">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>        
            
            <div class="search-box">
                <input type="text" placeholder="Cari kata...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
    
    <div class="card-grid dictionary-grid">
        @foreach ($dictionary_items as $item)
            <div class="item-card dictionary-item" data-category="{{ $item['category_id'] }}">
                <div class="item-card-img-container">
                    <img src="{{ asset('img/' . $item['image']) }}" alt="{{ $item['word'] }}" class="item-card-img">
                    <div class="item-badge">{{ $item['category_name'] }}</div>
                    <div class="item-views"><i class="fas fa-eye"></i> {{ $item['views'] }}</div>
                </div>
                <div class="item-card-body">
                    <h3 class="item-card-title">{{ $item['word'] }}</h3>
                    <div class="item-card-media">
                        <button class="btn btn-sm btn-outline view-image" data-image="{{ asset('img/' . $item['image']) }}" type="image/png">
                            <i class="fas fa-image"></i> Lihat Gambar
                        </button>
                        <button class="btn btn-sm btn-outline view-gif" data-gif="{{ asset('img/' . $item['gif']) }}" type="video/webm">
                            <i class="fas fa-play"></i> Lihat Gerakan
                        </button>
                    </div>
                </div>
                <div class="item-card-footer">
                    <div class="actions">
                        <a href="{{ url('admin/kamus/' . $item['id'] . '/edit') }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-danger" title="Hapus" onclick="confirmDelete({{ $item['id'] }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    
    <div class="pagination">
        <a href="#"><i class="fas fa-chevron-left"></i></a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#"><i class="fas fa-chevron-right"></i></a>
    </div>
    
    <!-- Modal untuk preview gambar/gif -->
    <div id="previewModal" class="modal-backdrop" style="display: none;">
        <div class="modal">
            <div class="modal-header">
                <h3 id="modalTitle">Preview</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body text-center">
                <div id="mediaPreview"></div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styles khusus untuk halaman kamus */
    .dictionary-grid {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    }
    
    .item-card-img-container {
        position: relative;
        height: 150px;
        overflow: hidden;
    }
    
    .item-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: rgba(52, 152, 219, 0.9);
        color: white;
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 12px;
    }
    
    .item-views {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 12px;
    }
    
    .item-card-media {
        display: flex;
        gap: 5px;
        margin-top: 10px;
    }
    
    .btn-outline {
        background: none;
        border: 1px solid #ddd;
        flex: 1;
        font-size: 11px;
    }
    
    .btn-outline:hover {
        background-color: #f5f7fa;
    }
    
    .text-center {
        text-align: center;
    }
    
    #mediaPreview img, 
    #mediaPreview video {
        max-width: 100%;
        max-height: 400px;
        display: block;
        margin: 0 auto;
    }
</style>

@endsection
