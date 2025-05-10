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
            <i class="fas fa-plus"></i> Tambah Latihan baru
        </a>
        {{-- <a href="#" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Latihan Baru
        </a> --}}
    </div>

    <div class="latihan-filter">
        <div class="filter-group">
            <label for="filterTopic">Filter berdasarkan Topik:</label>
            <select id="filterTopic" class="filter-select">
                <option value="">Semua Topik</option>
                <option value="1">Perkenalan Bahasa Isyarat</option>
                <option value="2">Alfabet</option>
                <option value="3">Angka</option>
                <option value="4">Sapaan Sehari-hari</option>
            </select>
        </div>
        <div class="search-group">
            <input type="text" placeholder="Cari latihan..." class="search-input">
            <button class="btn-search"><i class="fas fa-search"></i></button>
        </div>
    </div>

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
                @foreach ($latihanList as $latihan)
                <tr>
                    <td>{{ $latihan['id'] }}</td>
                    <td>{{ $latihan['soal'] }}</td>
                    <td>{{ $latihan['topik'] }}</td>
                    <td>{{ $latihan['jawaban'] }}</td>
                    <td><span class="badge-media">{{ $latihan['media'] }}</span></td>
                    <td>{{ $latihan['tanggal'] }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.latihan.show', $latihan['id']) }}" class="btn-view" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.latihan.edit', $latihan['id']) }}" class="btn-edit" title="Edit">

                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn-delete" data-id="{{ $latihan['id'] }}" data-soal="{{ $latihan['soal'] }}" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
                
        </table>
    </div>

    <div class="pagination">
        <a href="#" class="page-nav disabled"><i class="fas fa-chevron-left"></i></a>
        <a href="#" class="page-number active">1</a>
        <a href="#" class="page-number">2</a>
        <a href="#" class="page-number">3</a>
        <a href="#" class="page-nav"><i class="fas fa-chevron-right"></i></a>
    </div>

    <!-- Modal Konfirmasi Hapus -->
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
    document.addEventListener('DOMContentLoaded', function() {
        // Delete confirmation
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');
                const soal = this.getAttribute('data-soal');
                
                document.getElementById('deleteLatihan').textContent = soal;
                const baseDeleteUrl = '{{ route("admin.latihan.delete", "__id__") }}';
                document.getElementById('deleteForm').setAttribute('action', baseDeleteUrl.replace('__id__', id));
                document.getElementById('deleteModal').style.display = 'block';
            });
        });
        
        // Close modal
        const closeButtons = document.querySelectorAll('.close');
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                this.closest('.modal').style.display = 'none';
            });
        });
        
        // Batal delete
        document.getElementById('btnBatalHapus').addEventListener('click', function() {
            document.getElementById('deleteModal').style.display = 'none';
        });
        
        // Close when clicking outside modal
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        });
        
        // Filter functionality (simulasi tanpa database)
        document.getElementById('filterTopic').addEventListener('change', function() {
            console.log('Filter berdasarkan topic: ' + this.value);
            // Implementasi filter akan terintegrasi dengan database nantinya
        });
        
        // Search functionality (simulasi tanpa database)
        document.querySelector('.btn-search').addEventListener('click', function() {
            const searchTerm = document.querySelector('.search-input').value;
            console.log('Mencari: ' + searchTerm);
            // Implementasi pencarian akan terintegrasi dengan database nantinya
        });
    });
</script>
@endsection