@extends('layouts.dashboardadmin')

@section('title', 'Tambah Latihan Baru - Admin HandTalk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-latihan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page-latihan-form.css') }}">
@endpush

@section('content')
<div class="latihan-container">
    <div class="page-header">
        <h1>Tambah Latihan Baru</h1>
        <a href="{{ url('admin/latihan') }}" class="btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ url('admin/latihan/store') }}" method="POST" enctype="multipart/form-data" id="latihanForm">
            @csrf
            
            <div class="form-section">
                <h3>Informasi Latihan</h3>
                
                <div class="form-group">
                    <label for="topik">Topik:</label>
                    <select id="topik" name="id_topik" class="form-control" required>
                        <option value="">Pilih Topik</option>
                        <option value="1">Perkenalan Bahasa Isyarat</option>
                        <option value="2">Alfabet</option>
                        <option value="3">Angka</option>
                        <option value="4">Sapaan Sehari-hari</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="soal_teks">Soal Latihan:</label>
                    <textarea id="soal_teks" name="soal_teks" class="form-control" rows="3" required></textarea>
                    <small>Deskripsikan soal latihan dengan jelas</small>
                </div>
            </div>
            
            <div class="form-section">
                <h3>Media Soal</h3>
                
                <div class="form-group">
                    <label>Jenis Media:</label>
                    <div class="media-type-selector">
                        <div class="media-option">
                            <input type="radio" id="media_gambar" name="jenis_media" value="gambar" checked>
                            <label for="media_gambar">Gambar</label>
                        </div>
                        <div class="media-option">
                            <input type="radio" id="media_video" name="jenis_media" value="video">
                            <label for="media_video">Video</label>
                        </div>
                        <div class="media-option">
                            <input type="radio" id="media_gif" name="jenis_media" value="gif">
                            <label for="media_gif">GIF</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group" id="gambarUploadContainer">
                    <label for="soal_media_gambar">Upload Gambar:</label>
                    <input type="file" id="soal_media_gambar" name="soal_media_gambar" class="form-control-file" accept="image/*">
                    <div class="media-preview" id="previewGambar"></div>
                </div>
                
                <div class="form-group hidden" id="videoUploadContainer">
                    <label for="soal_media_video">Upload Video:</label>
                    <input type="file" id="soal_media_video" name="soal_media_video" class="form-control-file" accept="video/*">
                    <div class="media-preview" id="previewVideo"></div>
                </div>
                
                <div class="form-group hidden" id="gifUploadContainer">
                    <label for="soal_media_gif">Upload GIF:</label>
                    <input type="file" id="soal_media_gif" name="soal_media_gif" class="form-control-file" accept="image/gif">
                    <div class="media-preview" id="previewGif"></div>
                </div>
            </div>
            
            <div class="form-section">
                <h3>Jawaban & Penjelasan</h3>
                
                <div class="form-group">
                    <label for="jawaban_benar">Jawaban Benar:</label>
                    <textarea id="jawaban_benar" name="jawaban_benar" class="form-control" rows="3" required></textarea>
                    <small>Tuliskan jawaban yang benar dengan detail</small>
                </div>
                
                <div class="form-group">
                    <label for="penjelasan_latihan">Penjelasan:</label>
                    <textarea id="penjelasan_latihan" name="penjelasan_latihan" class="form-control rich-editor" rows="5"></textarea>
                    <small>Berikan penjelasan atau petunjuk tambahan untuk membantu pengguna</small>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Simpan Latihan
                </button>
                <a href="{{ url('admin/latihan') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Media type selector
        const mediaOptions = document.querySelectorAll('input[name="jenis_media"]');
        const mediaContainers = {
            gambar: document.getElementById('gambarUploadContainer'),
            video: document.getElementById('videoUploadContainer'),
            gif: document.getElementById('gifUploadContainer')
        };
        
        function updateMediaContainers(selectedValue) {
            Object.keys(mediaContainers).forEach(key => {
                if (key === selectedValue) {
                    mediaContainers[key].classList.remove('hidden');
                } else {
                    mediaContainers[key].classList.add('hidden');
                }
            });
        }
        
        mediaOptions.forEach(option => {
            option.addEventListener('change', function() {
                updateMediaContainers(this.value);
            });
        });
        
        // Preview media uploads
        document.getElementById('soal_media_gambar').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('previewGambar');
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview Gambar">`;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        document.getElementById('soal_media_video').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const preview = document.getElementById('previewVideo');
                preview.innerHTML = '<p>Video dipilih: ' + this.files[0].name + '</p>';
            }
        });
        
        document.getElementById('soal_media_gif').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('previewGif');
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview GIF">`;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Form submission
        document.getElementById('latihanForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulasi pengiriman form
            alert('Latihan berhasil ditambahkan! (Simulasi tanpa database)');
            window.location.href = '{{ url("admin/latihan") }}';
        });
    });
</script>
@endsection