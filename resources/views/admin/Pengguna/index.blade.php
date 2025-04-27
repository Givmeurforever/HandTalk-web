@extends('layouts.dashboardadmin')

@section('title', 'Manajemen Pengguna')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-pengguna.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Pengguna</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Pengguna</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahPenggunaModal">
                                    <i class="fas fa-plus"></i> Tambah Pengguna
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari pengguna...">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th style="width: 15%">Nama</th>
                                            <th style="width: 20%">Email</th>
                                            <th style="width: 15%">Username</th>
                                            <th style="width: 15%">Role</th>
                                            <th style="width: 15%">Status</th>
                                            <th style="width: 15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        // Data contoh untuk tampilan UI
                                        $contohPengguna = [
                                            [
                                                'id' => 1,
                                                'name' => 'Administrator',
                                                'email' => 'admin@handtalk.id',
                                                'username' => 'admin',
                                                'is_admin' => true,
                                                'status' => 'active'
                                            ],
                                            [
                                                'id' => 2,
                                                'name' => 'Budi Santoso',
                                                'email' => 'budi@example.com',
                                                'username' => 'budi123',
                                                'is_admin' => false,
                                                'status' => 'active'
                                            ],
                                            [
                                                'id' => 3,
                                                'name' => 'Siti Nuraini',
                                                'email' => 'siti@example.com',
                                                'username' => 'siti_nur',
                                                'is_admin' => false,
                                                'status' => 'active'
                                            ],
                                            [
                                                'id' => 4,
                                                'name' => 'Dimas Prakoso',
                                                'email' => 'dimas@example.com',
                                                'username' => 'dimas_p',
                                                'is_admin' => false,
                                                'status' => 'inactive'
                                            ],
                                            [
                                                'id' => 5,
                                                'name' => 'Anita Wijaya',
                                                'email' => 'anita@example.com',
                                                'username' => 'anita_w',
                                                'is_admin' => false,
                                                'status' => 'active'
                                            ]
                                        ];
                                        @endphp

                                        @foreach($contohPengguna as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user['name'] }}</td>
                                                <td>{{ $user['email'] }}</td>
                                                <td>{{ $user['username'] }}</td>
                                                <td>
                                                    @if($user['is_admin'])
                                                        <span class="badge badge-primary">Admin</span>
                                                    @else
                                                        <span class="badge badge-info">Pengguna</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user['status'] == 'active')
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Nonaktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editPenggunaModal{{ $user['id'] }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusPenggunaModal{{ $user['id'] }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    @if($user['status'] == 'active')
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#nonaktifkanPenggunaModal{{ $user['id'] }}">
                                                            <i class="fas fa-ban"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#aktifkanPenggunaModal{{ $user['id'] }}">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-3">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengguna -->
{{-- <div class="modal fade" id="tambahPenggunaModal" tabindex="-1" role="dialog" aria-labelledby="tambahPenggunaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPenggunaModalLabel">Tambah Pengguna Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="is_admin">
                        <option value="0">Pengguna</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit dan Hapus untuk setiap pengguna -->
@foreach($contohPengguna as $user)
    <!-- Modal Edit Pengguna -->
    <div class="modal fade" id="editPenggunaModal{{ $user['id'] }}" tabindex="-1" role="dialog" aria-labelledby="editPenggunaModalLabel{{ $user['id'] }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPenggunaModalLabel{{ $user['id'] }}">Edit Pengguna: {{ $user['name'] }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name{{ $user['id'] }}">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name{{ $user['id'] }}" name="name" value="{{ $user['name'] }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email{{ $user['id'] }}">Email</label>
                        <input type="email" class="form-control" id="email{{ $user['id'] }}" name="email" value="{{ $user['email'] }}" required>
                    </div>
                    <div class="form-group">
                        <label for="username{{ $user['id'] }}">Username</label>
                        <input type="text" class="form-control" id="username{{ $user['id'] }}" name="username" value="{{ $user['username'] }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password{{ $user['id'] }}">Password (kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" class="form-control" id="password{{ $user['id'] }}" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation{{ $user['id'] }}">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation{{ $user['id'] }}" name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <label for="role{{ $user['id'] }}">Role</label>
                        <select class="form-control" id="role{{ $user['id'] }}" name="is_admin">
                            <option value="0" {{ $user['is_admin'] ? '' : 'selected' }}>Pengguna</option>
                            <option value="1" {{ $user['is_admin'] ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Pengguna -->
    <div class="modal fade" id="hapusPenggunaModal{{ $user['id'] }}" tabindex="-1" role="dialog" aria-labelledby="hapusPenggunaModalLabel{{ $user['id'] }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusPenggunaModalLabel{{ $user['id'] }}">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pengguna "<strong>{{ $user['name'] }}</strong>"?</p>
                    <p class="text-danger">Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait pengguna ini.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nonaktifkan Pengguna -->
    <div class="modal fade" id="nonaktifkanPenggunaModal{{ $user['id'] }}" tabindex="-1" role="dialog" aria-labelledby="nonaktifkanPenggunaModalLabel{{ $user['id'] }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nonaktifkanPenggunaModalLabel{{ $user['id'] }}">Konfirmasi Nonaktifkan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menonaktifkan pengguna "<strong>{{ $user['name'] }}</strong>"?</p>
                    <p>Pengguna yang dinonaktifkan tidak akan dapat masuk ke sistem.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-warning">Nonaktifkan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Aktifkan Pengguna -->
    <div class="modal fade" id="aktifkanPenggunaModal{{ $user['id'] }}" tabindex="-1" role="dialog" aria-labelledby="aktifkanPenggunaModalLabel{{ $user['id'] }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aktifkanPenggunaModalLabel{{ $user['id'] }}">Konfirmasi Aktifkan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengaktifkan kembali pengguna "<strong>{{ $user['name'] }}</strong>"?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success">Aktifkan</button>
                </div>
            </div>
        </div>
    </div>
@endforeach --}}

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Script untuk notifikasi (akan diimplementasikan nanti)
    // Contoh penggunaan SweetAlert
    // Uncomment untuk mengaktifkan setelah mengimplementasi SweetAlert
    /*
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Data berhasil disimpan',
        timer: 3000,
        showConfirmButton: false
    });
    */
});
</script>
@endpush