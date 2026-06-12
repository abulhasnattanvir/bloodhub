<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'faname',
        'age',
        'email',
        'phone',
        'gender',
        'profession',
        'fee_applicable',
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

    public function hasUnpaidSubscription()
    {
        return $this->subscriptions()
            ->where('status', 'unpaid')
            ->exists();
    }
}