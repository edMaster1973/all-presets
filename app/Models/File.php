<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'nome',
        'descricao',
        'segment_id',
        'category_id',
        'equipament_id',
        'instrumento',
        'tags',
        'file_path',
        'image_path',
        'link_audio',
        'link_video',
        'privacidade',
        'user_id',
    ];

    public function downloads()
    {
        // Um arquivo (file) tem muitos downloads
        return $this->hasMany(Download::class, 'file_id');
    }

    public function shares()
    {
        return $this->hasMany(Share::class, 'file_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'file_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'file_id', 'id');
    }
}
