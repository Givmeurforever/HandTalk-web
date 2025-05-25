<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamus extends Model
{
    use HasFactory;

    protected $table = 'kamus'; // ⬅️ Tambahkan ini!

    protected $fillable = ['kata', 'video'];
}
