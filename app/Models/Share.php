<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    protected $table = 'shares';

    protected $fillable = [
        'file_id',
        'user_id',
    ];

    // criar relacionamento com o Model file
    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
