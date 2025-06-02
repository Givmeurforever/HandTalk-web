<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    use HasFactory;  // Tambahkan ini jika menggunakan factory

    protected $table = 'latihan';

    protected $fillable = [
        'materi_id',
        'soal',
        'media_type',
        'opsi_a_kamus_id',
        'opsi_b_kamus_id', 
        'opsi_c_kamus_id',
        'opsi_d_kamus_id',
        'jawaban_benar',
        'urutan' 
    ];

    // Tambahkan cast jika perlu
    protected $casts = [
        'jawaban_benar' => 'string',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    // Relasi ke model Kamus
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

    // Scope untuk query yang sering digunakan
    public function scopeForMateri($query, $materiId)
    {
        return $query->where('materi_id', $materiId);
    }
}