@extends('layouts.dashboardadmin')

@section('title', 'Manajemen Pengguna - HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-pengguna.css') }}">
@endpush

@section('content')
<div class="pengguna-container">
    <div class="pengguna-header">
        <h1>Manajemen Pengguna</h1>
        <div class="pengguna-actions">
            <div class="search-container">
                <input type="text" id="searchPengguna" placeholder="Cari pengguna...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="filter-container">
                <select id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                </select>
            </div>
            <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pengguna
            </a>
        </div>
    </div>

    <div class="pengguna-stats">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>Total Pengguna</h3>
                <p>246</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon active">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="stat-info">
                <h3>Pengguna Aktif</h3>
                <p>189</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="stat-info">
                <h3>Pendaftar Baru</h3>
                <p>24</p>
                <span class="stat-period">7 hari terakhir</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <div class="stat-info">
                <h3>Progres Rata-rata</h3>
                <p>67%</p>
            </div>
        </div>
    </div>

    <div class="pengguna-table-container">
        <table class="pengguna-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pengguna</th>
                    <th>Email</th>
                    <th>Progres</th>
                    <th>Terakhir Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data pengguna akan diisi di sini -->
                <tr>
                    <td>1</td>
                    <td class="pengguna-info">
                        <div class="pengguna-avatar">
                            <img src="{{ asset('img/huruf1.jpg') }}" alt="Foto Profil">
                        </div>
                        <div class="pengguna-nama">
                            <p>Ahmad Rizky</p>
                            <span class="pengguna-tanggal">Bergabung: 15 Mar 2025</span>
                        </div>
                    </td>
                    <td>ahmad.rizky@example.com</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" style="width: 75%"></div>
                            </div>
                            <span class="progress-text">75%</span>
                        </div>
                        <div class="progress-detail">
                            <span class="badge materi-complete">
                                <i class="fas fa-book"></i> 6/8
                            </span>
                            <span class="badge latihan-complete">
                                <i class="fas fa-tasks"></i> 5/8
                            </span>
                            <span class="badge kuis-complete">
                                <i class="fas fa-question-circle"></i> 4/8
                            </span>
                        </div>
                    </td>
                    <td>28 Apr 2025</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.pengguna.show', 1) }}" class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pengguna.edit', 1) }}" class="btn-edit" title="Edit Pengguna">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn-delete" title="Hapus Pengguna" data-id="1">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="pengguna-info">
                        <div class="pengguna-avatar">
                            <img src="{{ asset('images/avatars/user-2.jpg') }}" alt="Foto Profil">
                        </div>
                        <div class="pengguna-nama">
                            <p>Siti Nuraini</p>
                            <span class="pengguna-tanggal">Bergabung: 10 Apr 2025</span>
                        </div>
                    </td>
                    <td>siti.nuraini@example.com</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" style="width: 32%"></div>
                            </div>
                            <span class="progress-text">32%</span>
                        </div>
                        <div class="progress-detail">
                            <span class="badge materi-complete">
                                <i class="fas fa-book"></i> 3/8
                            </span>
                            <span class="badge latihan-complete">
                                <i class="fas fa-tasks"></i> 2/8
                            </span>
                            <span class="badge kuis-complete">
                                <i class="fas fa-question-circle"></i> 1/8
                            </span>
                        </div>
                    </td>
                    <td>29 Apr 2025</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.pengguna.edit', 2) }}" class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pengguna.edit', 2) }}" class="btn-edit" title="Edit Pengguna">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn-delete" title="Hapus Pengguna" data-id="2">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="pengguna-info">
                        <div class="pengguna-avatar">
                            <img src="{{ asset('images/avatars/user-3.jpg') }}" alt="Foto Profil">
                        </div>
                        <div class="pengguna-nama">
                            <p>Budi Santoso</p>
                            <span class="pengguna-tanggal">Bergabung: 22 Mar 2025</span>
                        </div>
                    </td>
                    <td>budi.santoso@example.com</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" style="width: 100%"></div>
                            </div>
                            <span class="progress-text">100%</span>
                        </div>
                        <div class="progress-detail">
                            <span class="badge materi-complete">
                                <i class="fas fa-book"></i> 8/8
                            </span>
                            <span class="badge latihan-complete">
                                <i class="fas fa-tasks"></i> 8/8
                            </span>
                            <span class="badge kuis-complete">
                                <i class="fas fa-question-circle"></i> 8/8
                            </span>
                        </div>
                    </td>
                    <td>27 Apr 2025</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.pengguna.show', 3) }}" class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pengguna.edit', 3) }}" class="btn-edit" title="Edit Pengguna">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn-delete" title="Hapus Pengguna" data-id="3">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td class="pengguna-info">
                        <div class="pengguna-avatar">
                            <img src="{{ asset('images/avatars/user-4.jpg') }}" alt="Foto Profil">
                        </div>
                        <div class="pengguna-nama">
                            <p>Dewi Anggraini</p>
                            <span class="pengguna-tanggal">Bergabung: 5 Apr 2025</span>
                        </div>
                    </td>
                    <td>dewi.anggraini@example.com</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" style="width: 62%"></div>
                            </div>
                            <span class="progress-text">62%</span>
                        </div>
                        <div class="progress-detail">
                            <span class="badge materi-complete">
                                <i class="fas fa-book"></i> 5/8
                            </span>
                            <span class="badge latihan-complete">
                                <i class="fas fa-tasks"></i> 5/8
                            </span>
                            <span class="badge kuis-complete">
                                <i class="fas fa-question-circle"></i> 3/8
                            </span>
                        </div>
                    </td>
                    <td>30 Apr 2025</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.pengguna.show', 4) }}" class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pengguna.edit', 4) }}" class="btn-edit" title="Edit Pengguna">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn-delete" title="Hapus Pengguna" data-id="4">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
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
            <a href="#">12</a>
        </div>
        <button class="pagination-btn next">
            Selanjutnya <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>

<!-- Modal Detail Progress Pengguna -->
<div id="progressModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h2>Detail Progres Pengguna</h2>
            <span class="close-modal">&times;</span>
        </div>
        <div class="modal-body">
            <div class="user-profile-header">
                <div class="user-avatar-large">
                    <img id="modalUserAvatar" src="" alt="Foto Profil">
                </div>
                <div class="user-info">
                    <h3 id="modalUserName"></h3>
                    <p id="modalUserEmail"></p>
                    <p class="join-date" id="modalJoinDate"></p>
                </div>
            </div>
            
            <div class="progress-overview">
                <h4>Progres Keseluruhan</h4>
                <div class="progress-container large">
                    <div class="progress-bar">
                        <div class="progress" id="modalOverallProgress"></div>
                    </div>
                    <span class="progress-text" id="modalProgressText"></span>
                </div>
            </div>
            
            <div class="progress-by-topic">
                <h4>Progres per Topik</h4>
                <div class="topics-progress-list" id="topicsProgressList">
                    <!-- Akan diisi dinamis -->
                </div>
            </div>
            
            <div class="quiz-performance">
                <h4>Performa Kuis</h4>
                <div class="quiz-chart-container">
                    <canvas id="quizPerformanceChart"></canvas>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" id="closeProgressModal">Tutup</button>
        </div>
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
            <p>Apakah Anda yakin ingin menghapus pengguna ini?</p>
            <p>Tindakan ini akan menghapus semua data terkait pengguna dan tidak dapat dibatalkan.</p>
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
        const closeDeleteModal = document.querySelector('#deleteModal .close-modal');
        const cancelDelete = document.getElementById('cancelDelete');
        const confirmDelete = document.getElementById('confirmDelete');
        let deleteId = null;

        // Modal progress
        const progressModal = document.getElementById('progressModal');
        const viewButtons = document.querySelectorAll('.btn-view');
        const closeProgressModal = document.querySelector('#progressModal .close-modal');
        const closeProgressBtn = document.getElementById('closeProgressModal');

        // Buka modal hapus ketika tombol hapus diklik
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                deleteId = this.getAttribute('data-id');
                deleteModal.style.display = 'flex';
            });
        });

        // Tutup modal hapus
        closeDeleteModal.addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });

        cancelDelete.addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });

        // Aksi konfirmasi hapus
        confirmDelete.addEventListener('click', function() {
            // Di sini akan ditambahkan kode untuk menghapus data
            console.log('Hapus pengguna dengan ID:', deleteId);
            
            // Setelah berhasil dihapus, tutup modal dan refresh halaman
            deleteModal.style.display = 'none';
            // window.location.reload();
        });

        // Buka modal progress ketika tombol view diklik
        viewButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const userId = this.closest('tr').querySelector('td:first-child').textContent;
                const userAvatar = this.closest('tr').querySelector('.pengguna-avatar img').src;
                const userName = this.closest('tr').querySelector('.pengguna-nama p').textContent;
                const userEmail = this.closest('tr').querySelector('td:nth-child(3)').textContent;
                const joinDate = this.closest('tr').querySelector('.pengguna-tanggal').textContent;
                const progressPercent = this.closest('tr').querySelector('.progress-text').textContent;
                
                // Isi data ke modal
                document.getElementById('modalUserAvatar').src = userAvatar;
                document.getElementById('modalUserName').textContent = userName;
                document.getElementById('modalUserEmail').textContent = userEmail;
                document.getElementById('modalJoinDate').textContent = joinDate;
                document.getElementById('modalOverallProgress').style.width = progressPercent;
                document.getElementById('modalProgressText').textContent = progressPercent;

                // Di sini akan menampilkan data progres per topik (dummy data untuk contoh)
                const topicsProgressList = document.getElementById('topicsProgressList');
                topicsProgressList.innerHTML = `
                    <div class="topic-progress-item">
                        <div class="topic-info">
                            <h5>Pengenalan Bahasa Isyarat</h5>
                            <div class="progress-container">
                                <div class="progress-bar">
                                    <div class="progress" style="width: 100%"></div>
                                </div>
                                <span class="progress-text">100%</span>
                            </div>
                        </div>
                        <div class="topic-badges">
                            <span class="badge materi-complete"><i class="fas fa-book"></i> 1/1</span>
                            <span class="badge latihan-complete"><i class="fas fa-tasks"></i> 1/1</span>
                            <span class="badge kuis-complete"><i class="fas fa-question-circle"></i> 1/1</span>
                        </div>
                    </div>
                    <div class="topic-progress-item">
                        <div class="topic-info">
                            <h5>Alfabet dan Angka</h5>
                            <div class="progress-container">
                                <div class="progress-bar">
                                    <div class="progress" style="width: 85%"></div>
                                </div>
                                <span class="progress-text">85%</span>
                            </div>
                        </div>
                        <div class="topic-badges">
                            <span class="badge materi-complete"><i class="fas fa-book"></i> 1/1</span>
                            <span class="badge latihan-complete"><i class="fas fa-tasks"></i> 1/1</span>
                            <span class="badge kuis-incomplete"><i class="fas fa-question-circle"></i> 0/1</span>
                        </div>
                    </div>
                    <div class="topic-progress-item">
                        <div class="topic-info">
                            <h5>Percakapan Dasar</h5>
                            <div class="progress-container">
                                <div class="progress-bar">
                                    <div class="progress" style="width: 67%"></div>
                                </div>
                                <span class="progress-text">67%</span>
                            </div>
                        </div>
                        <div class="topic-badges">
                            <span class="badge materi-complete"><i class="fas fa-book"></i> 1/1</span>
                            <span class="badge latihan-complete"><i class="fas fa-tasks"></i> 1/1</span>
                            <span class="badge kuis-incomplete"><i class="fas fa-question-circle"></i> 0/1</span>
                        </div>
                    </div>
                `;

                progressModal.style.display = 'flex';
            });
        });

        // Tutup modal progress
        closeProgressModal.addEventListener('click', function() {
            progressModal.style.display = 'none';
        });

        closeProgressBtn.addEventListener('click', function() {
            progressModal.style.display = 'none';
        });

        // Ketika user klik di luar modal
        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                deleteModal.style.display = 'none';
            }
            if (event.target === progressModal) {
                progressModal.style.display = 'none';
            }
        });

        // Pencarian
        const searchInput = document.getElementById('searchPengguna');
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                // Logika pencarian akan ditambahkan di sini
                console.log('Mencari:', this.value);
            }
        });

        // Filter status
        const filterStatus = document.getElementById('filterStatus');
        filterStatus.addEventListener('change', function() {
            // Logika filter akan ditambahkan di sini
            console.log('Filter status:', this.value);
        });
    });
</script>
@endsection