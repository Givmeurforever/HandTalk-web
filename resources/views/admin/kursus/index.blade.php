@extends('layouts.dashboardadmin')

@section('title', 'Manajemen Topik')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-kursus.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Topik</h1>
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
                            <h3 class="card-title">Daftar Topik</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahTopikModal">
                                    <i class="fas fa-plus"></i> Tambah Topik
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari topik...">
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
                                            <th style="width: 20%">Nama Topik</th>
                                            <th style="width: 25%">Deskripsi</th>
                                            <th style="width: 15%">Total Kosakata</th>
                                            <th style="width: 15%">Status</th>
                                            <th style="width: 20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        // Data contoh untuk tampilan UI
                                        $contohTopik = [
                                            [
                                                'id' => 1,
                                                'nama' => 'Greetings',
                                                'deskripsi' => 'Topik berisi kosakata untuk salam dan perkenalan',
                                                'total_kosakata' => 25,
                                                'status' => 'active'
                                            ],
                                            [
                                                'id' => 2,
                                                'nama' => 'Family',
                                                'deskripsi' => 'Topik berisi kosakata yang berhubungan dengan keluarga',
                                                'total_kosakata' => 30,
                                                'status' => 'active'
                                            ],
                                            [
                                                'id' => 3,
                                                'nama' => 'Numbers',
                                                'deskripsi' => 'Topik berisi angka dan bilangan dalam bahasa isyarat',
                                                'total_kosakata' => 20,
                                                'status' => 'active'
                                            ],
                                            [
                                                'id' => 4,
                                                'nama' => 'Colors',
                                                'deskripsi' => 'Topik berisi nama-nama warna dalam bahasa isyarat',
                                                'total_kosakata' => 15,
                                                'status' => 'inactive'
                                            ],
                                            [
                                                'id' => 5,
                                                'nama' => 'Daily Activities',
                                                'deskripsi' => 'Topik berisi aktivitas sehari-hari dalam bahasa isyarat',
                                                'total_kosakata' => 35,
                                                'status' => 'active'
                                            ]
                                        ];
                                        @endphp

                                        @foreach($contohTopik as $index => $topik)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $topik['nama'] }}</td>
                                                <td>{{ $topik['deskripsi'] }}</td>
                                                <td><span class="badge badge-primary">{{ $topik['total_kosakata'] }} kata</span></td>
                                                <td>
                                                    @if($topik['status'] == 'active')
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Nonaktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('topik/detail/' . $topik['id']) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-list"></i> Kosakata
                                                    </a>
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editTopikModal{{ $topik['id'] }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusTopikModal{{ $topik['id'] }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
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

<!-- Modal Tambah Topik -->
{{-- <div class="modal fade" id="tambahTopikModal" tabindex="-1" role="dialog" aria-labelledby="tambahTopikModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahTopikModalLabel">Tambah Topik Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">Nama Topik</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar Topik (Opsional)</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar" name="gambar">
                        <label class="custom-file-label" for="gambar">Pilih gambar...</label>
                    </div>
                    <small class="form-text text-muted">Format yang diterima: JPG, PNG. Ukuran maksimal: 2MB</small>
                </div>
                <div class="form-group">
                    <label for="urutan">Urutan Tampil</label>
                    <input type="number" class="form-control" id="urutan" name="urutan" min="1" value="1">
                    <small class="form-text text-muted">Menentukan urutan tampil topik pada aplikasi</small>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
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

<!-- Modal Edit dan Hapus untuk setiap topik -->
@foreach($contohTopik as $topik)
    <!-- Modal Edit Topik -->
    <div class="modal fade" id="editTopikModal{{ $topik['id'] }}" tabindex="-1" role="dialog" aria-labelledby="editTopikModalLabel{{ $topik['id'] }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTopikModalLabel{{ $topik['id'] }}">Edit Topik: {{ $topik['nama'] }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama{{ $topik['id'] }}">Nama Topik</label>
                        <input type="text" class="form-control" id="nama{{ $topik['id'] }}" name="nama" value="{{ $topik['nama'] }}" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi{{ $topik['id'] }}">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi{{ $topik['id'] }}" name="deskripsi" rows="3" required>{{ $topik['deskripsi'] }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Gambar Topik Saat Ini</label>
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/img/topics/placeholder.jpg') }}" alt="{{ $topik['nama'] }}" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar{{ $topik['id'] }}" name="gambar">
                            <label class="custom-file-label" for="gambar{{ $topik['id'] }}">Pilih gambar baru (opsional)...</label>
                        </div>
                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                    </div>
                    <div class="form-group">
                        <label for="urutan{{ $topik['id'] }}">Urutan Tampil</label>
                        <input type="number" class="form-control" id="urutan{{ $topik['id'] }}" name="urutan" min="1" value="{{ $index + 1 }}">
                    </div>
                    <div class="form-group">
                        <label for="status{{ $topik['id'] }}">Status</label>
                        <select class="form-control" id="status{{ $topik['id'] }}" name="status">
                            <option value="active" {{ $topik['status'] == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ $topik['status'] == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
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

    <!-- Modal Hapus Topik -->
    <div class="modal fade" id="hapusTopikModal{{ $topik['id'] }}" tabindex="-1" role="dialog" aria-labelledby="hapusTopikModalLabel{{ $topik['id'] }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusTopikModalLabel{{ $topik['id'] }}">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus topik "<strong>{{ $topik['nama'] }}</strong>"?</p>
                    <p class="text-danger">Tindakan ini tidak dapat dibatalkan dan akan menghapus semua kosakata yang terkait dengan topik ini.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endforeach --}}

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Kustomisasi tampilan file input
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    
    // Script untuk filter dan pencarian (diimplementasikan nanti)
    /* 
    $("#searchTopik").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    */
});
</script>
@endpush