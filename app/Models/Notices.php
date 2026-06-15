<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notices extends Model
{
    protected $fillable = [
        'title',
        'pdf_file',
        'description',
        'notice_date',
        'is_active'
    ];

    protected $casts = [
        'notice_date' => 'date',
        'is_active'   => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('notice_date', 'desc');
    }
}