<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'title',
        'genres',
        'description',
        'director',
        'actors',
        'year',
        'runtime',
        'rating',
        ];

    protected $casts = [
        'genres' => 'array',
        'actors' => 'array',
    ];
}
