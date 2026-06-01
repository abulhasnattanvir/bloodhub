<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'profession',
        'blood_group',
        'address',
        'city',
        'status',
        'photo',
    ];
}