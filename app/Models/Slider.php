<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'highlight_text',
        'description',
        'button_text',
        'button_link',
        'image',
        'order',
        'status'
    ];
}