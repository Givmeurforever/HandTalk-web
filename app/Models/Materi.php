<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'video',
        'urutan',
        'topik_id',
    ];

    public function topik()
    {
        return $this->belongsTo(Topik::class);
    }
    public function latihan()
    {
        return $this->hasMany(Latihan::class);
    }
}