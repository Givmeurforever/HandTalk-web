<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
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
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

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
}
