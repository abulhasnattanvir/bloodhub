<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'url',
        'parent_id',
        'sort_order',
        'target_blank',
        'status',
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->where('status', 1)
            ->orderBy('sort_order');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class);
    }

    public function isActive()
    {
        return request()->is(trim($this->url, '/') . '/*')
            || request()->url() == url($this->url);
    }
}