<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialChat extends Model
{
    protected $fillable = [
        'site_name',
        'whatsapp_number',
        'whatsapp_title',
        'whatsapp_message',
        'whatsapp_enabled',
        'facebook_page_id'
    ];

    public static function SocialChatSettings()
    {
        return self::first();
    }
}