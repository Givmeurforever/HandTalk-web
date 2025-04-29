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
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="filter-container">
                <select id="filterTopik">
                    <option value="">Semua Topik</option>
                    <option value="1">Pengenalan Bahasa Isyarat</option>
                    <option value="2">Alfabet dan Angka</option>
                    <option value="3">Percakapan Dasar</option>
                    <!-- Opsi lainnya dapat diisi dari database -->
                </select>
            </div>
            <a href="{{ route('admin.kuis.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kuis
            </a>
        </div>
    </div>

    <div class="kuis-stats">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-question-circle"></i>
            </div>
            <div class="stat-info">
                <h3>Total Kuis</h3>
                <p>24</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-bookmark"></i>
            </div>
            <div class="stat-info">
                <h3>Topik</h3>
                <p>6</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>Partisipasi</h3>
                <p>158</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-info">
                <h3>Rata-rata Nilai</h3>
                <p>78%</p>
            </div>
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
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data kuis akan diisi di sini -->
                <tr>
                    <td>1</td>
                    <td class="kuis-soal">
                        <p>Apa arti dari gerakan isyarat ini?</p>
                        <span class="media-indicator"><i class="fas fa-image"></i> Ada Gambar</span>
                    </td>
                    <td>Pengenalan Bahasa Isyarat</td>
                    <td>
                        <div class="media-thumbnail">
                            <img src="{{ asset('img/huruf1.jpg') }}" alt="Gambar Isyarat">
                        </div>
                    </td>
                    <td>22 Apr 2025</td>
                    <td>
                        <div class="action-buttons">
                            <a href="#" class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn-edit" title="Edit Kuis">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn-delete" title="Hapus Kuis" data-id="1">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="kuis-soal">
                        <p>Bagaimana cara mengisyaratkan kata "Terima Kasih"?</p>
                        <span class="media-indicator"><i class="fas fa-video"></i> Ada Video</span>
                    </td>
                    <td>Percakapan Dasar</td>
                    <td>
                        <div class="media-thumbnail video">
                            <img src="{{ asset('images/placeholder-video.jpg') }}" alt="Video Isyarat">
                            <div class="play-icon">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </td>
                    <td>20 Apr 2025</td>
                    <td>
                        <div class="action-buttons">
                            <a href="#" class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn-edit" title="Edit Kuis">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn-delete" title="Hapus Kuis" data-id="2">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="kuis-soal">
                        <p>Identifikasi isyarat untuk huruf berikut</p>
                    </td>
                    <td>Alfabet dan Angka</td>
                    <td>
                        <div class="media-thumbnail">
                            <img src="{{ asset('images/placeholder-isyarat.jpg') }}" alt="Gambar Isyarat">
                        </div>
                    </td>
                    <td>18 Apr 2025</td>
                    <td>
                        <div class="action-buttons">
                            <a href="#" class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.kuis.create') }}" class="btn-edit" title="Edit Kuis">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn-delete" title="Hapus Kuis" data-id="3">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Lebih banyak data kuis -->
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <button class="pagination-btn prev">
            <i class="fas fa-chevron-left"></i> Sebelumnya
        </button>
        <div class="pagination-numbers">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <span>...</span>
            <a href="#">10</a>
        </div>
        <button class="pagination-btn next">
            Selanjutnya <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Konfirmasi Hapus</h2>
            <span class="close-modal">&times;</span>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus kuis ini?</p>
            <p>Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-cancel" id="cancelDelete">Batal</button>
            <button class="btn btn-delete" id="confirmDelete">Hapus</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Ketika dokumen siap
    document.addEventListener('DOMContentLoaded', function() {
        // Modal hapus
        const deleteModal = document.getElementById('deleteModal');
        const deleteButtons = document.querySelectorAll('.btn-delete');
        const closeModal = document.querySelector('.close-modal');
        const cancelDelete = document.getElementById('cancelDelete');
        const confirmDelete = document.getElementById('confirmDelete');
        let deleteId = null;

        // Buka modal ketika tombol hapus diklik
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                deleteId = this.getAttribute('data-id');
                deleteModal.style.display = 'flex';
            });
        });

        // Tutup modal
        closeModal.addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });

        cancelDelete.addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });

        // Ketika user klik di luar modal
        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                deleteModal.style.display = 'none';
            }
        });

        // Aksi konfirmasi hapus
        confirmDelete.addEventListener('click', function() {
            // Di sini akan ditambahkan kode untuk menghapus data
            // Misalnya dengan AJAX request ke endpoint delete
            console.log('Hapus kuis dengan ID:', deleteId);
            
            // Setelah berhasil dihapus, tutup modal dan refresh halaman
            deleteModal.style.display = 'none';
            // Reload halaman atau hapus baris dari tabel
            // window.location.reload();
        });

        // Pencarian
        const searchInput = document.getElementById('searchKuis');
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                // Logika pencarian akan ditambahkan di sini
                console.log('Mencari:', this.value);
            }
        });

        // Filter topik
        const filterTopik = document.getElementById('filterTopik');
        filterTopik.addEventListener('change', function() {
            // Logika filter akan ditambahkan di sini
            console.log('Filter topik:', this.value);
        });
    });
</script>
@endsection