@extends('layouts.dashboardadmin')

@section('title', 'Manajemen Latihan - Admin HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-latihan.css') }}">
@endpush

@section('content')
<div class="latihan-container">
    <div class="latihan-header">
        <h1>Manajemen Latihan</h1>
        <a href="{{ url('admin/latihan/create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Latihan Baru
        </a>
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
                <!-- Data latihan akan diisi di sini, berikut contoh tampilan -->
                <tr>
                    <td>1</td>
                    <td>Apa gerakan isyarat untuk kata "Halo"?</td>
                    <td>Sapaan Sehari-hari</td>
                    <td>Lambaikan tangan terbuka ke arah lawan bicara</td>
                    <td><span class="badge-media">Gambar</span></td>
                    <td>10-03-2025</td>
                    <td class="action-buttons">
                        <a href="{{ url('admin/latihan/read/1') }}" class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                        <a href="{{ url('admin/latihan/update/1') }}" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn-delete" data-id="1" data-soal="Apa gerakan isyarat untuk kata 'Halo'?" title="Hapus"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Tunjukkan gerakan isyarat untuk huruf "A"</td>
                    <td>Alfabet</td>
                    <td>Telapak tangan menghadap ke depan, semua jari mengepal kecuali jempol yang tegak</td>
                    <td><span class="badge-media">Video</span></td>
                    <td>11-03-2025</td>
                    <td class="action-buttons">
                        <a href="{{ url('admin/latihan/read/2') }}" class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                        <a href="{{ url('admin/latihan/update/2') }}" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn-delete" data-id="2" data-soal="Tunjukkan gerakan isyarat untuk huruf 'A'" title="Hapus"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Bagaimana cara menunjukkan angka "5" dalam bahasa isyarat?</td>
                    <td>Angka</td>
                    <td>Telapak tangan terbuka dengan lima jari terentang</td>
                    <td><span class="badge-media">GIF</span></td>
                    <td>12-03-2025</td>
                    <td class="action-buttons">
                        <a href="{{ url('admin/latihan/read/3') }}" class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                        <a href="{{ url('admin/latihan/update/3') }}" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn-delete" data-id="3" data-soal="Bagaimana cara menunjukkan angka '5' dalam bahasa isyarat?" title="Hapus"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Praktikkan gerakan isyarat untuk "Terima kasih"</td>
                    <td>Sapaan Sehari-hari</td>
                    <td>Tangan terbuka dengan jari-jari merapat, disentuhkan ke dagu kemudian digerakkan ke depan</td>
                    <td><span class="badge-media">Video</span></td>
                    <td>13-03-2025</td>
                    <td class="action-buttons">
                        <a href="{{ url('admin/latihan/read/4') }}" class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                        <a href="{{ url('admin/latihan/update/4') }}" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn-delete" data-id="4" data-soal="Praktikkan gerakan isyarat untuk 'Terima kasih'" title="Hapus"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Tunjukkan bagaimana menyatakan "Saya mau belajar" dalam bahasa isyarat</td>
                    <td>Perkenalan Bahasa Isyarat</td>
                    <td>Kombinasi gerakan "saya", "mau", dan "belajar"</td>
                    <td><span class="badge-media">Gambar</span></td>
                    <td>14-03-2025</td>
                    <td class="action-buttons">
                        <a href="{{ url('admin/latihan/read/5') }}" class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                        <a href="{{ url('admin/latihan/update/5') }}" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn-delete" data-id="5" data-soal="Tunjukkan bagaimana menyatakan 'Saya mau belajar' dalam bahasa isyarat" title="Hapus"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
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
                document.getElementById('deleteForm').setAttribute('action', '{{ url("admin/latihan/delete") }}/' + id);
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