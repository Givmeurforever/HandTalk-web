@extends('layouts.app')
@section('title', 'Latihan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/latihan.css') }}">
@endpush

@section('content')
<a href="{{ url()->previous() }}" class="back-btn">← Kembali</a>

<div class="latihan-container">
    <h2>Latihan: {{ $materi->nama }}</h2>
    <p>Soal {{ $pagination['start_number'] }} - {{ $pagination['end_number'] }} dari {{ $pagination['total_soal'] }}</p>

    @foreach($latihans as $index => $latihan)
    <div class="soal-card">
        <h4>Soal {{ $pagination['start_number'] + $index }}</h4>
        <p>{{ $latihan->soal ?? 'Tidak ditemukan' }}</p>

        <form class="form-latihan" method="POST">
            @csrf
            <input type="hidden" name="latihan_id" value="{{ $latihan->id }}">
            
            <div class="opsi-container">
                @foreach (['A', 'B', 'C', 'D'] as $opsi)
                    @php
                        $kamus = null;
                        switch($opsi) {
                            case 'A': $kamus = $latihan->opsiA; break;
                            case 'B': $kamus = $latihan->opsiB; break;
                            case 'C': $kamus = $latihan->opsiC; break;
                            case 'D': $kamus = $latihan->opsiD; break;
                        }

                        $media = $kamus->video ?? null;
                        $ext = $media ? pathinfo($media, PATHINFO_EXTENSION) : null;
                    @endphp
                    
                    <label class="opsi-item">
                        <input type="radio" name="jawaban" value="{{ $opsi }}">
                        <span class="opsi-label">{{ $opsi }}.</span>
                        
                        @if ($kamus && $media)
                            @if (in_array($ext, ['mp4', 'webm']))
                                <video width="200" controls>
                                    <source src="{{ asset('storage/' . $media) }}" type="video/{{ $ext }}">
                                    Video tidak didukung.
                                </video>
                            @elseif (in_array($ext, ['png', 'jpg', 'jpeg', 'gif']))
                                <img src="{{ asset('storage/' . $media) }}" alt="gambar opsi" width="200">
                            @else
                                <span class="opsi-text">{{ $kamus->kata ?? 'Teks tidak tersedia' }}</span>
                            @endif
                        @elseif($kamus)
                            <span class="opsi-text">{{ $kamus->kata ?? 'Teks tidak tersedia' }}</span>
                        @else
                            <span class="opsi-text text-muted">Opsi tidak ditemukan</span>
                        @endif
                    </label>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Cek Jawaban</button>
            
            <div class="feedback" style="display: none;">
                <strong>Jawaban Benar:</strong> <span class="jawaban-benar text-success"></span>
            </div>
        </form>
    </div>
    @endforeach

    <!-- Pagination -->
    <div class="pagination-nav d-flex justify-content-between align-items-center mt-4">
        @if ($pagination['has_prev'])
            <a href="{{ route('latihan.index', [$topikSlug, $materiSlug, $pagination['prev_page']]) }}" 
               class="btn btn-outline-secondary">← Sebelumnya</a>
        @else
            <span></span>
        @endif

        <span>Halaman {{ $pagination['current_page'] }} dari {{ $pagination['total_pages'] }}</span>

        @if ($pagination['has_next'])
            <a href="{{ route('latihan.index', [$topikSlug, $materiSlug, $pagination['next_page']]) }}" 
               class="btn btn-outline-secondary">Selanjutnya →</a>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.form-latihan').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        
        fetch('{{ route('latihan.check') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            form.querySelector('.feedback').style.display = 'block';
            form.querySelector('.jawaban-benar').innerText = data.jawaban_benar;
            
            const radios = form.querySelectorAll('input[type=radio]');
            radios.forEach(radio => {
                const parent = radio.closest('.opsi-item');
                if (radio.value === data.jawaban_benar) {
                    parent.style.borderColor = 'green';
                    parent.style.backgroundColor = '#d4edda';
                } else {
                    parent.style.opacity = 0.6;
                }
                radio.disabled = true;
            });

            form.querySelector('button[type=submit]').disabled = true;
        });
    });
});
</script>
@endpush
