<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kamus extends Model
{
    use HasFactory;

    protected $table = 'kamus';

    protected $fillable = ['kata', 'video'];

    public function getVideoExtensionAttribute()
    {
        return pathinfo($this->video, PATHINFO_EXTENSION);
    }

}
