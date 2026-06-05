<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    protected $fillable = [
        'profession',
        'monthly_fee',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}