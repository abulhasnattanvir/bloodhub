<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'page_title',
        'page_subtitle',
        'get_in_touch_text',
        'email',
        'phone',
        'address',
        'map_embed',           // Google Map Embed Code
        'form_title',
        'success_message',
    ];

    protected $casts = [
        'map_embed' => 'string',
    ];
}