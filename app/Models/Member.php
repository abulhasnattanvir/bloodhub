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

    public function subscriptions()
    {
        return $this->hasMany(MemberSubscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}