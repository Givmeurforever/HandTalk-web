<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProgress extends Model
{
    use HasFactory;

    protected $table = 'user_progress';

    protected $fillable = [
        'user_id',
        'content_type',
        'content_id',
        'completed',
        'score',
        'completed_at',
    ];

    // Relasi ke User (optional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper method (optional)
    public static function markCompleted($userId, $type, $contentId, $score = null)
    {
        return self::updateOrCreate(
            [
                'user_id' => $userId,
                'content_type' => $type,
                'content_id' => $contentId,
            ],
            [
                'completed' => true,
                'score' => $score,
                'completed_at' => now(),
            ]
        );
    }
}
