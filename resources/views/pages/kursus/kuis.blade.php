@extends('layouts.app')
@section('title', 'Kuis - ' . (isset($topik) && is_object($topik) ? $topik->nama : 'Tidak ada topik'))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/latihan.css') }}">
@endpush

@section('content')
<a href="{{ url()->previous() }}" class="back-btn">← Kembali</a>

<div class="latihan-container">
    <div class="kuis-header">
        <h2>Kuis: {{ $topik->judul}}</h2>
        <p class="kuis-info">Total {{ $kuisQuestions->count() }} soal - Jawab semua soal lalu submit</p>
    </div>

    <form id="form-kuis" method="POST" action="{{ route('kursus.kuis.submit', $topikSlug) }}">
        @csrf
        
        @foreach($kuisQuestions as $index => $kuis)
        <div class="soal-card">
            <h4>Soal {{ $index + 1 }}</h4>
            <p class="soal-text">{{ $kuis->soal }}</p>
            
            <div class="opsi-container">
                @foreach (['A', 'B', 'C', 'D'] as $opsi)
                    @php
                        $kamus = null;
                        switch($opsi) {
                            case 'A': $kamus = $kuis->opsiA; break;
                            case 'B': $kamus = $kuis->opsiB; break;
                            case 'C': $kamus = $kuis->opsiC; break;
                            case 'D': $kamus = $kuis->opsiD; break;
                        }
                    @endphp
                    
                    <label class="opsi-item">
                        <input type="radio" name="jawaban[{{ $kuis->id }}]" value="{{ $opsi }}" required>
                        <span class="opsi-label">{{ $opsi }}.</span>
                        
                        @if ($kamus)
                            @if ($kamus->media_type === 'video')
                                <video width="200" controls>
                                    <source src="{{ asset('storage/' . $kamus->video) }}" type="video/mp4">
                                    Video tidak didukung.
                                </video>
                            @else
                                <span class="opsi-text">{{ $kamus->kata }}</span>
                            @endif
                        @else
                            <span class="opsi-text text-muted">Opsi tidak ditemukan</span>
                        @endif
                    </label>
                @endforeach
            </div>
        </div>
        @endforeach

        <div class="submit-section">
            <div class="submit-warning">
                <p><strong>Perhatian:</strong> Pastikan semua soal sudah dijawab sebelum submit!</p>
            </div>
            <button type="submit" class="btn btn-success btn-lg">Submit Kuis</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('form-kuis').addEventListener('submit', function(e) {
    const radios = this.querySelectorAll('input[type="radio"]');
    const soalIds = [...new Set(Array.from(radios).map(radio => radio.name.match(/\d+/)[0]))];
    
    let allAnswered = true;
    soalIds.forEach(id => {
        // Perbaikan syntax JavaScript
        const answered = this.querySelector('input[name="jawaban[' + id + ']"]:checked');
        if (!answered) {
            allAnswered = false;
        }
    });
    
    if (!allAnswered) {
        e.preventDefault();
        alert('Mohon jawab semua soal sebelum submit!');
        return false;
    }
    
    if (!confirm('Yakin ingin submit kuis? Jawaban tidak dapat diubah setelah submit.')) {
        e.preventDefault();
        return false;
    }
});
</script>
@endpush