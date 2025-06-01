<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    protected $table = 'topik';

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    public function latihan()
    {
        return $this->hasMany(Latihan::class);
    }

    public function kuis()
    {
        return $this->hasMany(Kuis::class);
    }
}
