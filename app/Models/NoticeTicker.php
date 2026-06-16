<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeTicker extends Model
{
    protected $fillable = [
        'title',
        'url',
        'is_active'
    ];
}