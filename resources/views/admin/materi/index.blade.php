@extends('layouts.dashboardadmin')

@section('title', 'Manajemen Materi - Admin HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-materi.css') }}">
@endpush

@section('content')
<div class="materi-container">
    <div class="materi-header">
        <h1>Manajemen Materi</h1>
        <button id="btnTambahMateri" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Materi Baru
        </button>
    </div>

    <div class="materi-filter">
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
            <input type="text" placeholder="Cari materi..." class="search-input">
            <button class="btn-search"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <div class="materi-table-container">
        <table class="materi-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Materi</th>
                    <th>Topik</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data materi akan diisi di sini, berikut contoh tampilan -->
                <tr>
                    <td>1</td>
                    <td>Pengenalan Bahasa Isyarat Indonesia</td>
                    <td>Perkenalan Bahasa Isyarat</td>
                    <td>1</td>
                    <td><span class="badge-active">Aktif</span></td>
                    <td>05-03-2025</td>
                    <td class="action-buttons">
                        <button class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                        <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Sejarah Bahasa Isyarat di Indonesia</td>
                    <td>Perkenalan Bahasa Isyarat</td>
                    <td>2</td>
                    <td><span class="badge-active">Aktif</span></td>
                    <td>05-03-2025</td>
                    <td class="action-buttons">
                        <button class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                        <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Cara Menggunakan Bahasa Isyarat</td>
                    <td>Perkenalan Bahasa Isyarat</td>
                    <td>3</td>
                    <td><span class="badge-draft">Draft</span></td>
                    <td>06-03-2025</td>
                    <td class="action-buttons">
                        <button class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                        <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Pengenalan Huruf A-E</td>
                    <td>Alfabet</td>
                    <td>1</td>
                    <td><span class="badge-active">Aktif</span></td>
                    <td>07-03-2025</td>
                    <td class="action-buttons">
                        <button class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                        <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Pengenalan Huruf F-J</td>
                    <td>Alfabet</td>
                    <td>2</td>
                    <td><span class="badge-active">Aktif</span></td>
                    <td>07-03-2025</td>
                    <td class="action-buttons">
                        <button class="btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                        <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
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

    <!-- Modal Tambah/Edit Materi -->
    <div id="materiModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Tambah Materi Baru</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form id="materiForm">
                    <div class="form-group">
                        <label for="judulMateri">Judul Materi:</label>
                        <input type="text" id="judulMateri" name="judulMateri" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="topikMateri">Topik:</label>
                        <select id="topikMateri" name="topikMateri" class="form-control" required>
                            <option value="">Pilih Topik</option>
                            <option value="1">Perkenalan Bahasa Isyarat</option>
                            <option value="2">Alfabet</option>
                            <option value="3">Angka</option>
                            <option value="4">Sapaan Sehari-hari</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="urutanMateri">Urutan:</label>
                        <input type="number" id="urutanMateri" name="urutanMateri" class="form-control" min="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="kontenMateri">Konten Materi:</label>
                        <textarea id="kontenMateri" name="kontenMateri" class="form-control rich-editor" rows="6"></textarea>
                        <small>Gunakan editor untuk menambahkan teks, gambar, dan format lainnya</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="videoMateri">Video Pembelajaran:</label>
                        <div class="video-upload-container">
                            <input type="file" id="videoMateri" name="videoMateri" class="form-control-file" accept="video/*">
                            <p>atau</p>
                            <input type="text" id="videoEmbed" name="videoEmbed" class="form-control" placeholder="URL YouTube/Embed Video">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="thumbnailMateri">Thumbnail Materi:</label>
                        <input type="file" id="thumbnailMateri" name="thumbnailMateri" class="form-control-file" accept="image/*">
                        <div id="thumbnailPreview" class="img-preview"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="statusMateri">Status:</label>
                        <select id="statusMateri" name="statusMateri" class="form-control">
                            <option value="aktif">Aktif</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" id="btnSimpan" class="btn-primary">Simpan</button>
                        <button type="button" id="btnBatal" class="btn-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail Materi -->
    <div id="detailModal" class="modal">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h2 id="detailTitle">Detail Materi</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="detail-container">
                    <div class="detail-header">
                        <div class="detail-thumbnail">
                            <img src="{{ asset('img/placeholder-thumbnail.jpg') }}" alt="Thumbnail Materi">
                        </div>
                        <div class="detail-info">
                            <h3 id="detailJudul">Pengenalan Bahasa Isyarat Indonesia</h3>
                            <p><strong>Topik:</strong> <span id="detailTopic">Perkenalan Bahasa Isyarat</span></p>
                            <p><strong>Urutan:</strong> <span id="detailUrutan">1</span></p>
                            <p><strong>Status:</strong> <span id="detailStatus" class="badge-active">Aktif</span></p>
                            <p><strong>Tanggal Dibuat:</strong> <span id="detailTanggal">05-03-2025</span></p>
                        </div>
                    </div>
                    
                    <div class="detail-section">
                        <h4>Video Pembelajaran</h4>
                        <div class="video-container">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/demo-video" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    
                    <div class="detail-section">
                        <h4>Konten Materi</h4>
                        <div id="detailKonten" class="detail-content">
                            <p>Ini adalah konten penuh dari materi pembelajaran. Materi ini memperkenalkan konsep dasar bahasa isyarat dan bagaimana menggunakannya untuk komunikasi sehari-hari.</p>
                            <p>Bahasa isyarat merupakan bahasa yang menggunakan gerakan tangan, ekspresi wajah, dan bahasa tubuh untuk berkomunikasi. Bahasa ini sangat penting bagi komunitas tuli dan orang-orang dengan gangguan pendengaran.</p>
                        </div>
                    </div>
                    
                    <div class="detail-actions">
                        <button id="btnDetailEdit" class="btn-primary"><i class="fas fa-edit"></i> Edit Materi</button>
                        <button id="btnDetailKembali" class="btn-secondary">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="modal">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h2>Konfirmasi Hapus</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus materi <strong id="deleteMateriTitle">Judul Materi</strong>?</p>
                <p class="text-danger">Tindakan ini tidak dapat dibatalkan!</p>
                
                <div class="form-actions">
                    <button id="btnKonfirmasiHapus" class="btn-danger">Hapus</button>
                    <button id="btnBatalHapus" class="btn-secondary">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Script untuk dummy interaksi (tanpa database)
    document.addEventListener('DOMContentLoaded', function() {
        // Open tambah modal
        document.getElementById('btnTambahMateri').addEventListener('click', function() {
            document.getElementById('modalTitle').textContent = 'Tambah Materi Baru';
            document.getElementById('materiForm').reset();
            document.getElementById('materiModal').style.display = 'block';
        });
        
        // Close modals
        const closeButtons = document.querySelectorAll('.close');
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                this.closest('.modal').style.display = 'none';
            });
        });
        
        // Dummy view detail
        const viewButtons = document.querySelectorAll('.btn-view');
        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                document.getElementById('detailModal').style.display = 'block';
            });
        });
        
        // Dummy edit
        const editButtons = document.querySelectorAll('.btn-edit');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                document.getElementById('modalTitle').textContent = 'Edit Materi';
                // Disini akan ada kode untuk mengisi form dengan data yang ada
                document.getElementById('materiModal').style.display = 'block';
            });
        });
        
        // Dummy delete
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const title = this.closest('tr').querySelectorAll('td')[1].textContent;
                document.getElementById('deleteMateriTitle').textContent = title;
                document.getElementById('deleteModal').style.display = 'block';
            });
        });
        
        // Close the modal when clicking outside
        window.addEventListener('click', function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(function(modal) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        });
        
        // Button actions in modal
        document.getElementById('btnBatal').addEventListener('click', function() {
            document.getElementById('materiModal').style.display = 'none';
        });
        
        document.getElementById('btnSimpan').addEventListener('click', function() {
            alert('Data materi berhasil disimpan! (simulasi tanpa database)');
            document.getElementById('materiModal').style.display = 'none';
        });
        
        document.getElementById('btnDetailKembali').addEventListener('click', function() {
            document.getElementById('detailModal').style.display = 'none';
        });
        
        document.getElementById('btnDetailEdit').addEventListener('click', function() {
            document.getElementById('detailModal').style.display = 'none';
            document.getElementById('modalTitle').textContent = 'Edit Materi';
            document.getElementById('materiModal').style.display = 'block';
        });
        
        document.getElementById('btnBatalHapus').addEventListener('click', function() {
            document.getElementById('deleteModal').style.display = 'none';
        });
        
        document.getElementById('btnKonfirmasiHapus').addEventListener('click', function() {
            alert('Materi berhasil dihapus! (simulasi tanpa database)');
            document.getElementById('deleteModal').style.display = 'none';
        });
        
        // Thumbnail preview
        document.getElementById('thumbnailMateri').addEventListener('change', function(e) {
            const preview = document.getElementById('thumbnailPreview');
            preview.innerHTML = '';
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection