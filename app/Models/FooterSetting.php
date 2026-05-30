<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'about_text',
        'social_links',
        'quick_links',
        'service_links',
        'footer_menus',
        'subscribe_title',
        'subscribe_text',
    ];

    protected $casts = [
        'social_links' => 'array',
        'quick_links' => 'array',
        'service_links' => 'array',
        'footer_menus' => 'array',
    ];
}