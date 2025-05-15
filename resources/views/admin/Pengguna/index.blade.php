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

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="pengguna-stats">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>Total Pengguna</h3>
                <p>{{ $totalUsers }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon active">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="stat-info">
                <h3>Pengguna Aktif</h3>
                <p>{{ $activeUsers }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="stat-info">
                <h3>Pendaftar Baru</h3>
                <p>{{ $newUsers }}</p>
                <span class="stat-period">7 hari terakhir</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <div class="stat-info">
                <h3>Progres Rata-rata</h3>
                <p>{{ $averageProgress }}%</p>
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
            <tbody id="penggunaTableBody">
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td class="pengguna-info">
                        <div class="pengguna-avatar">
                            <img src="{{ $user->profile_picture_url }}" alt="Foto Profil {{ $user->full_name }}">
                        </div>
                        <div class="pengguna-nama">
                            <p>{{ $user->full_name }}</p>
                            <span class="pengguna-tanggal">Bergabung: {{ $user->created_at->format('d M Y') }}</span>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" style="width: {{ $user->progress }}%"></div>
                            </div>
                            <span class="progress-text">{{ $user->progress }}%</span>
                        </div>
                        <div class="progress-detail">
                            <!-- Progress details would be populated dynamically based on user's actual progress -->
                            <!-- This is placeholder data - replace with actual progress tracking -->
                            <span class="badge materi-complete">
                                <i class="fas fa-book"></i> {{ floor($user->progress / 100 * 8) }}/8
                            </span>
                            <span class="badge latihan-complete">
                                <i class="fas fa-tasks"></i> {{ floor($user->progress / 100 * 8) }}/8
                            </span>
                            <span class="badge kuis-complete">
                                <i class="fas fa-question-circle"></i> {{ floor($user->progress / 100 * 8) }}/8
                            </span>
                        </div>
                    </td>
                    <td>{{ $user->last_activity ? $user->last_activity->format('d M Y') : 'Belum pernah' }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.pengguna.show', $user->id) }}" class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="btn-edit" title="Edit Pengguna">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn-delete" title="Hapus Pengguna" data-id="{{ $user->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $users->links() }}
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
            <form id="deleteForm" action="" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete" id="confirmDelete">Hapus</button>
            </form>
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
        const deleteForm = document.getElementById('deleteForm');
        
        // Modal progress
        const progressModal = document.getElementById('progressModal');
        const viewButtons = document.querySelectorAll('.btn-view');
        const closeProgressModal = document.querySelector('#progressModal .close-modal');
        const closeProgressBtn = document.getElementById('closeProgressModal');

        // Buka modal hapus ketika tombol hapus diklik
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                deleteForm.action = `/admin/pengguna/${userId}`;
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

        // Buka modal progress ketika tombol view diklik
        viewButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                const userId = row.querySelector('td:first-child').textContent;
                const userAvatar = row.querySelector('.pengguna-avatar img').src;
                const userName = row.querySelector('.pengguna-nama p').textContent;
                const userEmail = row.querySelector('td:nth-child(3)').textContent;
                const joinDate = row.querySelector('.pengguna-tanggal').textContent;
                const progressPercent = row.querySelector('.progress-text').textContent;
                
                // Isi data ke modal
                document.getElementById('modalUserAvatar').src = userAvatar;
                document.getElementById('modalUserName').textContent = userName;
                document.getElementById('modalUserEmail').textContent = userEmail;
                document.getElementById('modalJoinDate').textContent = joinDate;
                document.getElementById('modalOverallProgress').style.width = progressPercent;
                document.getElementById('modalProgressText').textContent = progressPercent;

                // Lakukan AJAX request untuk mendapatkan detail progres
                fetch(`/admin/pengguna/${userId}`)
                    .then(response => {
                        if(response.ok) return response.json();
                        throw new Error('Gagal memuat data');
                    })
                    .then(data => {
                        // Bila ada data progress dari server, tampilkan di sini
                        // Untuk contoh, gunakan data dummy
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
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

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
                const query = this.value.trim();
                if (query !== '') {
                    searchUsers(query);
                }
            }
        });

        // Fungsi pencarian pengguna
        function searchUsers(query) {
            fetch(`/admin/pengguna/search?query=${encodeURIComponent(query)}`)
                .then(response => {
                    if (response.ok) return response.json();
                    throw new Error('Gagal mencari data');
                })
                .then(data => {
                    updateTableWithUsers(data.users);
                    document.querySelector('.pagination').innerHTML = data.pagination;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Filter status
        const filterStatus = document.getElementById('filterStatus');
        filterStatus.addEventListener('change', function() {
            const status = this.value;
            filterUsers(status);
        });

        // Fungsi filter pengguna
        function filterUsers(status) {
            fetch(`/admin/pengguna/filter?status=${encodeURIComponent(status)}`)
                .then(response => {
                    if (response.ok) return response.json();
                    throw new Error('Gagal memfilter data');
                })
                .then(data => {
                    updateTableWithUsers(data.users);
                    document.querySelector('.pagination').innerHTML = data.pagination;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Fungsi untuk memperbarui tabel dengan data pengguna
        function updateTableWithUsers(users) {
            const tableBody = document.getElementById('penggunaTableBody');
            tableBody.innerHTML = '';

            users.data.forEach(user => {
                const row = document.createElement('tr');
                
                // Format tanggal
                const createdDate = new Date(user.created_at);
                const formattedCreatedDate = `${createdDate.getDate()} ${getMonthName(createdDate.getMonth())} ${createdDate.getFullYear()}`;
                
                let lastActivity = 'Belum pernah';
                if (user.last_activity) {
                    const lastDate = new Date(user.last_activity);
                    lastActivity = `${lastDate.getDate()} ${getMonthName(lastDate.getMonth())} ${lastDate.getFullYear()}`;
                }
                
                // Placeholder untuk progress
                const progress = user.progress || Math.floor(Math.random() * 100);
                const materiComplete = Math.floor(progress / 100 * 8);
                const latihanComplete = Math.floor(progress / 100 * 8);
                const kuisComplete = Math.floor(progress / 100 * 8);
                
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td class="pengguna-info">
                        <div class="pengguna-avatar">
                            <img src="${user.profile_picture_url || '/storage/profile_pictures/default.png'}" alt="Foto Profil">
                        </div>
                        <div class="pengguna-nama">
                            <p>${user.first_name} ${user.last_name}</p>
                            <span class="pengguna-tanggal">Bergabung: ${formattedCreatedDate}</span>
                        </div>
                    </td>
                    <td>${user.email}</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" style="width: ${progress}%"></div>
                            </div>
                            <span class="progress-text">${progress}%</span>
                        </div>
                        <div class="progress-detail">
                            <span class="badge materi-complete">
                                <i class="fas fa-book"></i> ${materiComplete}/8
                            </span>
                            <span class="badge latihan-complete">
                                <i class="fas fa-tasks"></i> ${latihanComplete}/8
                            </span>
                            <span class="badge kuis-complete">
                                <i class="fas fa-question-circle"></i> ${kuisComplete}/8
                            </span>
                        </div>
                    </td>
                    <td>${lastActivity}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/pengguna/${user.id}" class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="/admin/pengguna/${user.id}/edit" class="btn-edit" title="Edit Pengguna">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn-delete" title="Hapus Pengguna" data-id="${user.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                tableBody.appendChild(row);
            });
            
            // Rebind event listeners to the new buttons
            bindDeleteButtons();
            bindViewButtons();
        }
        
        // Helper function to get month name
        function getMonthName(monthIndex) {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            return months[monthIndex];
        }
        
        // Function to bind event listeners to delete buttons
        function bindDeleteButtons() {
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    deleteForm.action = `/admin/pengguna/${userId}`;
                    deleteModal.style.display = 'flex';
                });
            });
        }
        
        // Function to bind event listeners to view buttons
        function bindViewButtons() {
            document.querySelectorAll('.btn-view').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const row = this.closest('tr');
                    const userId = row.querySelector('td:first-child').textContent;
                    const userAvatar = row.querySelector('.pengguna-avatar img').src;
                    const userName = row.querySelector('.pengguna-nama p').textContent;
                    const userEmail = row.querySelector('td:nth-child(3)').textContent;
                    const joinDate = row.querySelector('.pengguna-tanggal').textContent;
                    const progressPercent = row.querySelector('.progress-text').textContent;
                    
                    // Isi data ke modal
                    document.getElementById('modalUserAvatar').src = userAvatar;
                    document.getElementById('modalUserName').textContent = userName;
                    document.getElementById('modalUserEmail').textContent = userEmail;
                    document.getElementById('modalJoinDate').textContent = joinDate;
                    document.getElementById('modalOverallProgress').style.width = progressPercent;
                    document.getElementById('modalProgressText').textContent = progressPercent;
                    
                    // Display dummy data for progress details (same as above)
                    // ...
                    
                    progressModal.style.display = 'flex';
                });
            });
        }
    });
</script>
@endsection