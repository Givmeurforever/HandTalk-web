<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $table = 'kuis';

    public function topik()
    {
        return $this->belongsTo(Topik::class);
    }
}
