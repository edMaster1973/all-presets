<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileStyle extends Model
{
    use HasFactory;

    protected $table = 'files_styles';

    protected $fillable = [
        'file_id',
        'style_id',
    ];
}
