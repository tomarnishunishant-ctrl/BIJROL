<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillageSuggestion extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'category',
        'area',
        'title',
        'message',
        'is_public',
        'status',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];
}
