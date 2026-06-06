<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galleries extends Model
{
    protected $fillable = [
        'title',
        'image',
        'category',
        'event_date',
        'description',
        'is_active'
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_active' => 'boolean',
    ];
}