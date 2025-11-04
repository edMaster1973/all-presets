<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Preset extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'pedal_brand',
        'pedal_model',
        'description',
        'settings',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
