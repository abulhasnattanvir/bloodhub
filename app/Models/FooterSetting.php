<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'about_text',
        'subscribe_title',
        'subscribe_text',
        'subscribe_placeholder',
        'subscribe_button_text',
        'copyright_text',
        'developer_info',
        'developer_url',
        'social_links',
        'quick_links',
        'service_links',
        'footer_menus',
    ];

    protected $casts = [
        'social_links' => 'array',
        'quick_links' => 'array',
        'service_links' => 'array',
        'footer_menus' => 'array',
    ];
}