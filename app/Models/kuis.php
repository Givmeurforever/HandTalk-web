<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    protected $table = 'kuis';

    protected $fillable = [
        'topik_id',
        'urutan',
        'soal',
        'opsi_a_kamus_id',
        'opsi_b_kamus_id', 
        'opsi_c_kamus_id',
        'opsi_d_kamus_id',
        'jawaban_benar'
    ];

    protected $casts = [
        'jawaban_benar' => 'string',
    ];

    public function topik()
    {
        return $this->belongsTo(Topik::class, 'topik_id');
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
    public function scopeForTopik($query, $topikId)
    {
        return $query->where('topik_id', $topikId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}