@extends('layouts.dashboardadmin')

@section('title', 'Edit Latihan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-latihan.css') }}">
@endpush

@section('content')
<div class="latihan-container">
    <div class="latihan-header">
        <h1>Edit Latihan</h1>
        <a href="{{ route('admin.latihan.index') }}" class="btn btn-secondary">
            ← Kembali ke Manajemen Latihan
        </a>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.latihan.update', $latihan['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="materi_id">Materi</label>
                <select name="materi_id" id="materi_id" required>
                    <option value="">Pilih Materi</option>
                    @foreach ($materiList as $materi)
                        <option value="{{ $materi->id }}" 
                                {{ old('materi_id', $latihan['materi_id']) == $materi->id ? 'selected' : '' }}>
                            {{ $materi->topik->judul ?? 'Tanpa Topik' }} - {{ $materi->judul }}
                        </option>
                    @endforeach
                </select>
                @error('materi_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="urutan">Nomor Urutan Soal</label>
                <input type="number" name="urutan" id="urutan" 
                       value="{{ old('urutan', $latihan['urutan']) }}" 
                       min="1" required>
                @error('urutan')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="soal">Soal/Pertanyaan</label>
                <textarea name="soal" id="soal" rows="4" required>{{ old('soal', $latihan['soal']) }}</textarea>
                @error('soal')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-section">
                <h3>Pilihan Jawaban</h3>
                
                @foreach (['A', 'B', 'C', 'D'] as $opt)
                    @php 
                        $opsiRelation = 'opsi' . $opt;
                        $opsi = $latihan->$opsiRelation;
                        $opsi_teks_field = 'opsi_' . strtolower($opt) . '_teks';
                        $opsi_teks = $latihan->$opsi_teks_field;
                        $kamus_id_field = 'opsi_' . strtolower($opt) . '_kamus_id';
                        $kamus_id = $latihan->$kamus_id_field;
                    @endphp

                    <div class="opsi-box">
                        <h4>Opsi {{ $opt }}</h4>
                        
                        <div class="form-group">
                            <label for="opsi_{{ strtolower($opt) }}_kamus_id">Pilih dari Kamus (opsional)</label>
                            <select name="opsi_{{ strtolower($opt) }}_kamus_id" id="opsi_{{ strtolower($opt) }}_kamus_id">
                                <option value="">-- Pilih dari Kamus --</option>
                                @foreach ($kamusList as $kamus)
                                    <option value="{{ $kamus->id }}" 
                                            {{ old('opsi_' . strtolower($opt) . '_kamus_id', $kamus_id) == $kamus->id ? 'selected' : '' }}>
                                        {{ $kamus->kata }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="opsi_{{ strtolower($opt) }}_teks">Atau Tulis Manual</label>
                            <input type="text" 
                                   name="opsi_{{ strtolower($opt) }}_teks" 
                                   id="opsi_{{ strtolower($opt) }}_teks"
                                   value="{{ old('opsi_' . strtolower($opt) . '_teks', $opsi_teks) }}"
                                   placeholder="Tulis jawaban manual jika tidak memilih dari kamus">
                        </div>

                        @if ($opsi && $opsi->media)
                            <div class="current-media">
                                <label>Media Saat Ini:</label>
                                <div class="media-preview">
                                    @if (Str::endsWith(strtolower($opsi->media), ['.png', '.jpg', '.jpeg', '.gif']))
                                        <img src="{{ asset('storage/kamus_videos/' . $opsi->media) }}" 
                                             alt="Media Opsi {{ $opt }}" 
                                             class="media-image-preview">
                                    @elseif (Str::endsWith(strtolower($opsi->media), ['.webm', '.mp4', '.mov']))
                                        <video class="media-video-preview" controls preload="metadata">
                                            <source src="{{ asset('storage/kamus_videos/' . $opsi->media) }}" 
                                                    type="video/{{ pathinfo($opsi->media, PATHINFO_EXTENSION) }}">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @endif
                                    <p class="media-filename">{{ $opsi->media }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="media_{{ strtolower($opt) }}">
                                {{ $opsi && $opsi->media ? 'Ganti Media (opsional)' : 'Upload Media (opsional)' }}
                            </label>
                            <input type="file" 
                                   name="media_{{ strtolower($opt) }}" 
                                   id="media_{{ strtolower($opt) }}"
                                   accept=".jpg,.jpeg,.png,.gif,.webm,.mp4,.mov">
                            <small class="file-info">Format yang didukung: JPG, PNG, GIF, WEBM, MP4, MOV (Max: 10MB)</small>
                        </div>

                        @error('opsi_' . strtolower($opt) . '_kamus_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        @error('opsi_' . strtolower($opt) . '_teks')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        @error('media_' . strtolower($opt))
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="jawaban_benar">Jawaban Benar</label>
                <select name="jawaban_benar" id="jawaban_benar" required>
                    <option value="">Pilih Jawaban Benar</option>
                    @foreach (['A', 'B', 'C', 'D'] as $opt)
                        <option value="{{ $opt }}" 
                                {{ old('jawaban_benar', $latihan['jawaban_benar']) === $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
                @error('jawaban_benar')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.latihan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview file upload
    const fileInputs = document.querySelectorAll('input[type="file"]');
    
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                const previewContainer = this.parentNode.querySelector('.media-preview') || 
                                       this.parentNode.appendChild(document.createElement('div'));
                previewContainer.className = 'media-preview new-preview';
                
                reader.onload = function(e) {
                    if (file.type.startsWith('image/')) {
                        previewContainer.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" class="media-image-preview">
                            <p class="media-filename">${file.name}</p>
                        `;
                    } else if (file.type.startsWith('video/')) {
                        previewContainer.innerHTML = `
                            <video class="media-video-preview" controls preload="metadata">
                                <source src="${e.target.result}" type="${file.type}">
                                Browser Anda tidak mendukung tag video.
                            </video>
                            <p class="media-filename">${file.name}</p>
                        `;
                    }
                };
                
                reader.readAsDataURL(file);
            }
        });
    });

    // Auto-select kamus option when typing manually
    const kamusSelects = document.querySelectorAll('select[name*="_kamus_id"]');
    const tekstInputs = document.querySelectorAll('input[name*="_teks"]');

    kamusSelects.forEach(select => {
        select.addEventListener('change', function() {
            if (this.value) {
                const optionLetter = this.name.match(/opsi_([a-d])_kamus_id/)[1];
                const tekstInput = document.querySelector(`input[name="opsi_${optionLetter}_teks"]`);
                if (tekstInput) {
                    tekstInput.value = '';
                    tekstInput.disabled = true;
                }
            } else {
                const optionLetter = this.name.match(/opsi_([a-d])_kamus_id/)[1];
                const tekstInput = document.querySelector(`input[name="opsi_${optionLetter}_teks"]`);
                if (tekstInput) {
                    tekstInput.disabled = false;
                }
            }
        });
    });

    tekstInputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                const optionLetter = this.name.match(/opsi_([a-d])_teks/)[1];
                const kamusSelect = document.querySelector(`select[name="opsi_${optionLetter}_kamus_id"]`);
                if (kamusSelect) {
                    kamusSelect.value = '';
                    kamusSelect.disabled = true;
                }
            } else {
                const optionLetter = this.name.match(/opsi_([a-d])_teks/)[1];
                const kamusSelect = document.querySelector(`select[name="opsi_${optionLetter}_kamus_id"]`);
                if (kamusSelect) {
                    kamusSelect.disabled = false;
                }
            }
        });
    });

    // Initialize disabled states on page load
    kamusSelects.forEach(select => {
        if (select.value) {
            const optionLetter = select.name.match(/opsi_([a-d])_kamus_id/)[1];
            const tekstInput = document.querySelector(`input[name="opsi_${optionLetter}_teks"]`);
            if (tekstInput) {
                tekstInput.disabled = true;
            }
        }
    });

    tekstInputs.forEach(input => {
        if (input.value.trim()) {
            const optionLetter = input.name.match(/opsi_([a-d])_teks/)[1];
            const kamusSelect = document.querySelector(`select[name="opsi_${optionLetter}_kamus_id"]`);
            if (kamusSelect) {
                kamusSelect.disabled = true;
            }
        }
    });
});
</script>
@endpush
@endsection