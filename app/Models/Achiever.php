<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achiever extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'role',
        'badge',
        'initials',
        'tone',
        'short_description',
        'profile_summary',
        'journey',
        'highlights',
        'photo',
        'hero_image',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'journey' => 'array',
        'highlights' => 'array',
        'is_published' => 'boolean',
    ];
}
