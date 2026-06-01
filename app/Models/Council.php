<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Council extends Model
{
    protected $fillable = [
        'name',
        'position',
        'phone',
        'email',
        'bio',
        'photo',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'status'
    ];
}