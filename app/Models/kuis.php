<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $table = 'kuis';

    protected $fillable = [
        'topik_id',
        'soal',
        'urutan',
        'media_type',
        'media_path',
        'jawaban_benar',
        'opsi_a_kamus_id',
        'opsi_b_kamus_id',
        'opsi_c_kamus_id',
        'opsi_d_kamus_id',
    ];

    // Relasi ke Topik
    public function topik()
    {
        return $this->belongsTo(Topik::class);
    }

    // Relasi ke Kamus untuk opsi jawaban
    public function opsiA()
    {
        return $this->belongsTo(Kamus::class, 'opsi_a_kamus_id');
    }

    public function opsiB()
    {
        return $this->belongsTo(Kamus::class, 'opsi_b_kamus_id');
    }

    public function opsiC()
    {
        return $this->belongsTo(Kamus::class, 'opsi_c_kamus_id');
    }

    public function opsiD()
    {
        return $this->belongsTo(Kamus::class, 'opsi_d_kamus_id');
    }

    // (Opsional) Jika kamu tidak menyimpan media_type tapi ingin menebaknya otomatis
    public function getGuessedMediaTypeAttribute()
    {
        if (!$this->media_path) return null;

        $ext = strtolower(pathinfo($this->media_path, PATHINFO_EXTENSION));
        return match ($ext) {
            'png', 'jpg', 'jpeg' => 'image',
            'gif' => 'gif',
            'webm', 'mp4' => 'video',
            default => 'unknown',
        };
    }
}
