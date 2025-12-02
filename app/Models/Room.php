<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'host_name',
        'host_avatar',
        'participant_count',
        'is_live',
        'image',
    ];

    protected $casts = [
        'is_live' => 'boolean',
        'participant_count' => 'integer',
    ];
}
