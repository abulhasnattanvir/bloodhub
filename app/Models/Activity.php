<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['icon', 'text', 'slug'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($activity) {
            if (empty($activity->slug)) {
                $activity->slug = Str::slug($activity->text);
            }
        });

        static::updating(function ($activity) {
            $activity->slug = Str::slug($activity->text);
        });
    }
}