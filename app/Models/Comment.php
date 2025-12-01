<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'file_id',
        'user_id',
        'content',
    ];

    public function likes()
    {
        return $this->hasMany(LikeComment::class);
    }

    public function userLike()
    {
        return $this->hasOne(LikeComment::class)->where('user_id', auth()->id());
    }

    public function getLikedByUserAttribute()
    {
        return $this->userLike?->like == 1;
    }

    public function getDislikedByUserAttribute()
    {
        return $this->userLike?->dislike == 1;
    }
}
